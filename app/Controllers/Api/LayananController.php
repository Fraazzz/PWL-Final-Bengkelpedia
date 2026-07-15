<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class LayananController extends ResourceController
{
    // Mengatur model yang digunakan dan format balasan default (JSON)
    protected $modelName = 'App\Models\LayananModel';
    protected $format    = 'json';

    // 1. ENDPOINT GET: Mengambil semua data layanan (localhost:8080/api/layanan)
    public function index()
    {
        $data = $this->model->findAll();
        
        return $this->respond([
            'status'  => 200,
            'message' => 'Berhasil mengambil daftar layanan bengkel',
            'data'    => $data
        ]);
    }

    // 2. ENDPOINT GET: Mengambil satu data layanan berdasarkan ID (localhost:8080/api/layanan/1)
    public function show($id = null)
    {
        $data = $this->model->find($id);
        
        if ($data) {
            return $this->respond([
                'status'  => 200,
                'message' => 'Detail layanan ditemukan',
                'data'    => $data
            ]);
        } else {
            // Jika ID tidak ditemukan di database
            return $this->failNotFound('Data layanan dengan ID tersebut tidak ditemukan');
        }
    }
}