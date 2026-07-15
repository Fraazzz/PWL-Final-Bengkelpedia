<?php

namespace App\Controllers;

use App\Models\BookingModel;
use Midtrans\Notification;

class PaymentController extends BaseController
{
    public function callback()
    {
        // 1. Set konfigurasi kunci Sandbox (Menggunakan kunci asli dari akun barumu)
        \Midtrans\Config::$serverKey = 'Mid-server-t8IPQUj8PrrzAnZAjapsirdJ'; 
        \Midtrans\Config::$isProduction = false;

        // 2. Tangkap notifikasi yang dikirim oleh server Midtrans
        try {
            $notif = new Notification();
        } catch (\Exception $e) {
            exit($e->getMessage());
        }

        $transaction = $notif->transaction_status;
        $order_id = $notif->order_id;

        // 3. Ekstrak ID Booking asli dari format order_id (Contoh: BENGKEL-7-17890123)
        // Kita pecah berdasarkan tanda strip (-) dan ambil angka di posisi tengah
        $explode_id = explode('-', $order_id);
        $id_booking = $explode_id[1];

        $bookingModel = new BookingModel();

        // 4. Logika Update Status Database berdasarkan respon Midtrans
        if ($transaction == 'settlement' || $transaction == 'capture') {
            // Jika pembayaran berhasil lunas, ubah status menjadi 'Proses' (siap dikerjakan teknisi)
            $bookingModel->update($id_booking, ['status' => 'Proses']);
            
        } elseif ($transaction == 'pending') {
            // Jika pelanggan sudah memilih metode bayar tapi belum transfer
            $bookingModel->update($id_booking, ['status' => 'Menunggu Pembayaran']);
            
        } elseif ($transaction == 'deny' || $transaction == 'expire' || $transaction == 'cancel') {
            // Jika pelanggan batal bayar atau waktu transfer habis
            $bookingModel->update($id_booking, ['status' => 'Batal']);
        }

        // Kembalikan status HTTP 200 OK agar Midtrans tahu pesannya sudah berhasil kita terima
        return $this->response->setStatusCode(200)->setBody('Notifikasi Berhasil Diterima');
    }
}