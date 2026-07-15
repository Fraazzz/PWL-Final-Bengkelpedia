<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table            = 'booking';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_pelanggan', 'id_teknisi', 'id_layanan', 'tanggal_booking', 'jam_booking', 'status'];

    // Fungsi ini yang akan dipakai Teknisi untuk melihat jadwalnya sendiri
    public function getJadwalTeknisi($id_teknisi)
    {
        // TAMBAHAN: booking.id as id_booking untuk mencegah bentrok ID antar tabel
        return $this->select('booking.*, booking.id as id_booking, layanan.nama_layanan, users.username as nama_pelanggan')
                    ->join('layanan', 'layanan.id = booking.id_layanan')
                    ->join('users', 'users.id = booking.id_pelanggan')
                    ->where('booking.id_teknisi', $id_teknisi)
                    ->where('booking.status !=', 'Batal')
                    ->orderBy('booking.tanggal_booking', 'ASC')
                    ->orderBy('booking.jam_booking', 'ASC')
                    ->findAll(); 
    }

    // ---> INI FUNGSI UNTUK PELANGGAN <---
    public function getRiwayatPelanggan($id_pelanggan)
    {
        // TAMBAHAN: booking.id as id_booking untuk mencegah bentrok ID antar tabel
        return $this->select('booking.*, booking.id as id_booking, layanan.nama_layanan, layanan.harga, users.nama_lengkap as nama_teknisi')
                    ->join('layanan', 'layanan.id = booking.id_layanan')
                    ->join('users', 'users.id = booking.id_teknisi', 'left') 
                    ->where('booking.id_pelanggan', $id_pelanggan)
                    ->orderBy('booking.tanggal_booking', 'DESC')
                    ->orderBy('booking.jam_booking', 'DESC')
                    ->findAll();
    }

    // ---> INI FUNGSI BARU UNTUK ADMIN <---
    public function getAllBooking()
    {
        // TAMBAHAN: booking.id as id_booking untuk mencegah bentrok ID antar tabel
        return $this->select('booking.*, booking.id as id_booking, layanan.nama_layanan, users.nama_lengkap as nama_pelanggan, teknisi.nama_lengkap as nama_teknisi')
                    ->join('layanan', 'layanan.id = booking.id_layanan')
                    ->join('users', 'users.id = booking.id_pelanggan')
                    ->join('users as teknisi', 'teknisi.id = booking.id_teknisi', 'left') 
                    ->orderBy('booking.tanggal_booking', 'DESC')
                    ->orderBy('booking.jam_booking', 'DESC')
                    ->findAll();
    }
}