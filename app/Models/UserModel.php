<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    
    // allowedFields mengatur kolom apa saja yang diizinkan untuk diisi/diubah melalui form
    protected $allowedFields    = ['nama_lengkap', 'username', 'password', 'role', 'no_telp', 'spesialisasi', 'status_kehadiran'];
}