<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananModel extends Model
{
    protected $table            = 'layanan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_layanan', 'deskripsi', 'harga', 'durasi', 'foto'];
    
    // Aktifkan ini jika kamu menggunakan created_at dan updated_at di databasemu
    // protected $useTimestamps = true; 
}