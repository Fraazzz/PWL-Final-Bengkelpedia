<?php

namespace App\Controllers;

use App\Models\BookingModel; 
use App\Models\UserModel;

class AdminController extends BaseController
{
    protected $userModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->bookingModel = new BookingModel();
    }

    // ===========================================
    // FITUR DASHBOARD DENGAN AI SUMOPOD
    // ===========================================

    public function dashboard()
    {
        // 1. Cek cache agar web tidak lemot
        $ai_insight = cache('bengkel_insight_2');

        // 2. Jika tidak ada di cache, panggil API SumoPod
        if (!$ai_insight) {
            try {
                $client = \Config\Services::curlrequest();
                
                $response = $client->post('https://api.sumopod.com/v1/chat/completions', [
                    'headers' => [
                        'Authorization' => 'Bearer sk-C47OCck0q62ZTLRbktWz2g', // API Key milikmu
                        'Content-Type'  => 'application/json',
                    ],
                    'json' => [
                        // Standar model untuk OpenAI compatible API
                        'model' => 'gpt-3.5-turbo', 
                        'messages' => [
                            ['role' => 'system', 'content' => 'Kamu adalah asisten ahli manajemen bengkel motor.'],
                            ['role' => 'user', 'content' => 'Berikan 1 kalimat motivasi atau tips singkat hari ini untuk admin bengkel. Maksimal 20 kata.']
                        ],
                        'max_tokens' => 50
                    ],
                    'http_errors' => false,
                    'timeout' => 5 ,
                    'verify' => false
                ]);

                // 3. Jika API berhasil menjawab
                if ($response->getStatusCode() === 200) {
                    $hasil = json_decode($response->getBody(), true);
                    $ai_insight = $hasil['choices'][0]['message']['content'];
                    
                    // Simpan ke Cache selama 12 jam
                    cache()->save('bengkel_insight_2', $ai_insight, 43200);
                } else {
                    $ai_insight = "Tetap semangat melayani pelanggan hari ini! (AI sedang istirahat)";
                }
            } catch (\Exception $e) {
                $ai_insight = "Fokus pada pelayanan terbaik! (Gagal terhubung ke AI)";
            }
        }

        $data = [
            'ai_insight' => $ai_insight
        ];

        return view('admin/v_dashboard', $data); 
    }

    // ===========================================
    // FITUR KELOLA TEKNISI
    // ===========================================

    public function teknisi()
    {
        $data['teknisi'] = $this->userModel->where('role', 'teknisi')->findAll();
        return view('admin/v_teknisi', $data);
    }

    public function tambahTeknisi()
    {
        return view('admin/v_teknisi_tambah');
    }

    public function simpanTeknisi()
    {
        $data = [
            'nama_lengkap'     => $this->request->getPost('nama_lengkap'),
            'username'         => $this->request->getPost('username'),
            'password'         => md5($this->request->getPost('password')),
            'no_telp'          => $this->request->getPost('no_telp'),
            'spesialisasi'     => $this->request->getPost('spesialisasi'),
            'role'             => 'teknisi',
            'status_kehadiran' => 'Off'
        ];

        $this->userModel->insert($data);
        
        session()->setFlashdata('pesan', 'Data Teknisi berhasil ditambahkan!');
        return redirect()->to(base_url('admin/teknisi'));
    }

    // ===========================================
    // FITUR KELOLA BOOKING (ADMIN) BARU
    // ===========================================

    public function booking()
    {
        $data['booking'] = $this->bookingModel->getAllBooking();
        $data['teknisi'] = $this->userModel->where('role', 'teknisi')->findAll();
        
        return view('admin/v_booking', $data);
    }

    public function assignTeknisi($id_booking)
    {
        $id_teknisi = $this->request->getPost('id_teknisi');

        $this->bookingModel->update($id_booking, [
            'id_teknisi' => $id_teknisi
        ]);

        session()->setFlashdata('pesan', 'Teknisi berhasil ditugaskan untuk pesanan ini!');
        return redirect()->to(base_url('admin/booking'));
    }
}