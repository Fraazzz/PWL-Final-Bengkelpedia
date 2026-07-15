<?php

namespace App\Controllers;

// Tambahkan panggilan ke BookingModel di bagian atas
use App\Models\BookingModel;

class Home extends BaseController
{
    public function index()
    {
        // 1. Ambil data role dari session yang dibuat saat login
        $role = session()->get('role');

        // 2. Arahkan ke tampilan yang berbeda sesuai hak aksesnya
        if ($role == 'admin') {
            // Tampilan khusus Admin Bengkel
            return view('admin/v_dashboard');
            
        } elseif ($role == 'teknisi') {
            // Tampilan khusus Staff/Teknisi Bengkel
            return view('teknisi/v_jadwal');
            
        } elseif ($role == 'pelanggan') {
            // ---> LOGIKA BARU UNTUK MENGAMBIL DATA RIWAYAT PELANGGAN <---
            $bookingModel = new BookingModel();
            
            // Ambil ID pelanggan yang sedang login
            $id_pelanggan = session()->get('id');
            
            // Ambil data riwayat dari database
            $data['riwayat'] = $bookingModel->getRiwayatPelanggan($id_pelanggan);
            
            // Tampilan khusus Pelanggan/Customer dengan membawa data riwayat
            return view('pelanggan/v_home', $data);
        }

        // 3. Jika tidak ada session (belum login), tendang balik ke login
        return redirect()->to(base_url('login'));
    }
}