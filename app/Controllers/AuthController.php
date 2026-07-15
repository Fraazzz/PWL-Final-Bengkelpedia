<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            // 1. Hubungkan ke Database dan cari username di tabel 'users'
            $db = \Config\Database::connect();
            $user = $db->table('users')->where('username', $username)->get()->getRowArray();

            // 2. Cek apakah username ditemukan di tabel database
            if ($user) {
                
                // 3. Cek kecocokan password (mendukung teks biasa seperti '123' atau MD5)
                if ($password == $user['password'] || md5($password) == $user['password']) {
                    
                    // 4. Siapkan data session (KITA MASUKKAN 'id' KESINI!)
                    $sessionData = [
                        'id'         => $user['id'], // Ini kunci agar jadwal bisa tampil!
                        'username'   => $user['username'],
                        'role'       => $user['role'],
                        'isLoggedIn' => TRUE
                    ];

                    session()->set($sessionData);
                    
                    // 5. Arahkan ke halaman (Dashboard) masing-masing sesuai Role
                    if ($user['role'] == 'admin') {
                        return redirect()->to(base_url('admin/dashboard'));
                    } elseif ($user['role'] == 'teknisi') {
                        return redirect()->to(base_url('teknisi/jadwal'));
                    } else {
                        return redirect()->to(base_url('pelanggan/home'));
                    }

                } else {
                    // Password salah
                    session()->setFlashdata('failed', 'Password Salah!');
                    return redirect()->back();
                }
            } else {
                // Username tidak ditemukan
                session()->setFlashdata('failed', 'Username Tidak Ditemukan!');
                return redirect()->back();
            }
        } 
        
        return view('v_Login');
    }
    // --- FITUR REGISTER ---
    public function register()
    {
        return view('v_Register');
    }

    public function processRegister()
    {
        // Panggil UserModel untuk input ke database
        $userModel = new \App\Models\UserModel();

        // Tangkap data dari form
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            // Kita gunakan MD5 agar password aman dan cocok dengan sistem loginmu sebelumnya
            'password'     => md5($this->request->getPost('password')), 
            'no_telp'      => $this->request->getPost('no_telp'),
            'role'         => 'pelanggan' // Paksa otomatis menjadi pelanggan
        ];

        // Simpan ke database
        $userModel->insert($data);

        // Beri pesan sukses dan arahkan kembali ke login
        session()->setFlashdata('success', 'Akun berhasil dibuat! Silakan login.');
        return redirect()->to(base_url('login'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}