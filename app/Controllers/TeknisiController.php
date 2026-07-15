<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\UserModel; // Tambahkan ini untuk mengakses tabel users

class TeknisiController extends BaseController
{
    protected $bookingModel;
    protected $userModel;

    public function __construct()
    {
        // Memanggil model booking dan user
        $this->bookingModel = new BookingModel();
        $this->userModel = new UserModel(); 
    }

    // ===========================================
    // BAGIAN 1: JADWAL & UPDATE STATUS PEKERJAAN
    // ===========================================
    
    public function jadwal()
    {
        // 1. Ambil ID Teknisi dari session akun yang sedang login saat ini
        $id_teknisi = session()->get('id'); 

        // 2. Ambil data jadwal khusus untuk teknisi ini dari BookingModel
        $data['jadwal'] = $this->bookingModel->getJadwalTeknisi($id_teknisi);

        // 3. Tampilkan halamannya dan bawa datanya
        return view('teknisi/v_jadwal', $data); 
    }

    // Fungsi untuk mengubah status menjadi 'Proses'
    public function kerjakan($id_booking)
    {
        $this->bookingModel->update($id_booking, ['status' => 'Proses']);
        session()->setFlashdata('pesan', 'Status tugas diperbarui menjadi PROSES.');
        return redirect()->to(base_url('teknisi/jadwal'));
    }

    // Fungsi untuk mengubah status menjadi 'Selesai'
    public function selesaikan($id_booking)
    {
        $this->bookingModel->update($id_booking, ['status' => 'Selesai']);
        session()->setFlashdata('pesan', 'Tugas telah SELESAI.');
        return redirect()->to(base_url('teknisi/jadwal'));
    }

    // ===========================================
    // BAGIAN 2: PROFIL & ABSENSI TEKNISI
    // ===========================================

    public function profil()
    {
        $id_teknisi = session()->get('id');
        // Ambil data user yang sedang login dari database
        $data['user'] = $this->userModel->find($id_teknisi); 
        
        return view('teknisi/v_profil', $data);
    }

    public function updateAbsen()
    {
        $id_teknisi = session()->get('id');
        $status_baru = $this->request->getPost('status_kehadiran');

        // Update status di database
        $this->userModel->update($id_teknisi, [
            'status_kehadiran' => $status_baru
        ]);

        session()->setFlashdata('pesan', 'Status kehadiran berhasil diperbarui!');
        return redirect()->to(base_url('teknisi/profil'));
    }
}