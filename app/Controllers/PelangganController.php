<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\BookingModel;

class PelangganController extends BaseController
{
    protected $layananModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
        $this->bookingModel = new BookingModel();
    }

    public function pesan()
    {
        $data['layanan'] = $this->layananModel->findAll();
        return view('pelanggan/v_pesan', $data);
    }

    public function simpanPesan()
    {
        $data = [
            'id_pelanggan'    => session()->get('id'), 
            'id_layanan'      => $this->request->getPost('id_layanan'),
            'id_teknisi'      => NULL, 
            'tanggal_booking' => $this->request->getPost('tanggal_booking'),
            'jam_booking'     => $this->request->getPost('jam_booking'),
            'status'          => 'Menunggu'
        ];

        $this->bookingModel->insert($data);

        session()->setFlashdata('pesan', 'Booking berhasil dibuat! Menunggu konfirmasi Admin.');
        return redirect()->to(base_url('pelanggan/home')); 
    }

    public function riwayat()
    {
        $id_pelanggan = session()->get('id'); 
        $data['riwayat'] = $this->bookingModel->getRiwayatPelanggan($id_pelanggan);
        return view('pelanggan/v_riwayat', $data);
    }

    // Fungsi Proses Pembayaran Midtrans Sandbox (Dinamis)
    public function bayar($id_booking)
    {
        // 1. Ambil data booking dan data layanan dari Database untuk mendapatkan harga asli
        $booking = $this->bookingModel->find($id_booking);
        $id_layanan = is_object($booking) ? $booking->id_layanan : $booking['id_layanan'];
        
        $layanan = $this->layananModel->find($id_layanan);
        $harga = is_object($layanan) ? $layanan->harga : $layanan['harga'];

        // 2. Konfigurasi Kunci Server Midtrans
        \Midtrans\Config::$serverKey = 'Mid-server-t8IPQUj8PrrzAnZAjapsirdJ'; 
        \Midtrans\Config::$isProduction = false; 
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // 3. Siapkan data pesanan ke Midtrans (Sekarang Menggunakan Variabel $harga)
        $params = [
            'transaction_details' => [
                'order_id' => 'BENGKEL-' . $id_booking . '-' . time(), 
                'gross_amount' => $harga, // <-- HARGA SEKARANG DINAMIS SESUAI DATABASE
            ],
            'customer_details' => [
                'first_name' => 'Pelanggan',
                'email'      => 'pelanggan@example.com',
                'phone'      => '08123456789',
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // 4. Mengirim Token, Client Key, dan HARGA ke halaman View Pembayaran
        $data = [
            'snapToken'  => $snapToken,
            'clientKey'  => 'Mid-client-dPSY4h_virW1JsIL', 
            'id_booking' => $id_booking,
            'harga'      => $harga 
        ];

        return view('pelanggan/v_pembayaran', $data);
    }

    // FUNGSI SEMENTARA UNTUK TEST EMAIL
    public function testEmail()
    {
        $email = \Config\Services::email();

        // Menggunakan email pengirim yang sudah disiapkan di .env
        $email->setFrom('hendifarras@gmail.com', 'Bengkel PWL System');
        
        // Dikirim ke email yang sama untuk keperluan testing
        $email->setTo('hendifarras@gmail.com'); 
        
        $email->setSubject('Test Integrasi SMTP Gmail CI4');
        $email->setMessage('<h2>Halo, Farras!</h2><p>Jika kamu menerima email ini, berarti sistem pengiriman email otomatis di CodeIgniter 4 untuk proyekmu sudah <b>BERHASIL</b> beroperasi!</p>');

        if ($email->send()) {
            echo "Mantap! Email berhasil dikirim. Silakan cek inbox Gmail kamu.";
        } else {
            echo "Waduh, gagal mengirim email. Berikut pesan error-nya:<br>";
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }
}