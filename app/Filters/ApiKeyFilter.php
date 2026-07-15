<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\API\ResponseTrait;

class ApiKeyFilter implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null)
    {
        // Kunci rahasia API kita (Bisa kamu ganti dengan kode unik apapun)
        $validApiKey = 'BENGKEL-UDINUS-2026-SECRET'; 
        
        // Mengecek apakah ada API Key yang dikirim di Header
        $apiKey = $request->getHeaderLine('X-API-KEY');

        if (empty($apiKey)) {
            return \Config\Services::response()
                ->setJSON(['status' => 401, 'error' => 'Akses ditolak. API Key tidak ditemukan.'])
                ->setStatusCode(401);
        }

        if ($apiKey !== $validApiKey) {
            return \Config\Services::response()
                ->setJSON(['status' => 403, 'error' => 'Akses ditolak. API Key tidak valid.'])
                ->setStatusCode(403);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi setelah response
    }
}