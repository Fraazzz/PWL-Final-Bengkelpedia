<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Cek apakah user sudah login atau belum
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('failed', 'Silakan login terlebih dahulu.');
        }

        // 2. Cek apakah role user diizinkan mengakses rute ini
        if ($arguments) {
            $userRole = session()->get('role');
            
            // Jika role user saat ini tidak ada di dalam syarat rute (di Routes.php)
            if (!in_array($userRole, $arguments)) {
                // Tendang kembali ke halaman masing-masing agar tidak bisa ngintip halaman role lain
                if ($userRole == 'admin') {
                    return redirect()->to(base_url('admin/dashboard'));
                } elseif ($userRole == 'teknisi') {
                    return redirect()->to(base_url('teknisi/jadwal'));
                } else {
                    return redirect()->to(base_url('pelanggan/home'));
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Bagian ini biarkan kosong, kita hanya butuh filter 'before' (sebelum masuk halaman)
    }
}