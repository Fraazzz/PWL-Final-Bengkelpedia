<?php

namespace App\Controllers;

use App\Models\LayananModel;

class LayananController extends BaseController
{
    protected $layananModel;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
        helper(['form', 'url']);
    }

    // 1. Menampilkan Halaman Daftar Layanan (Read)
    public function index()
    {
        $data = [
            'layanan' => $this->layananModel->findAll()
        ];
        return view('admin/layanan/v_index', $data);
    }

    // 2. Menampilkan Form Tambah Layanan
    public function create()
    {
        return view('admin/layanan/v_create');
    }

    // 3. Memproses Data & Upload Foto (Create)
    public function store()
    {
        // Aturan Validasi Input + Upload Foto
        $rules = [
            'nama_layanan' => 'required|min_length[3]',
            'harga'        => 'required|numeric',
            'durasi'       => 'required|numeric',
            'foto'         => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke form bawa pesan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        

        // Proses Upload Foto
        $fotoLayanan = $this->request->getFile('foto');
        $namaFoto = $fotoLayanan->getRandomName();
        $fotoLayanan->move('assets/img/layanan', $namaFoto);

        // Simpan ke Database
        $this->layananModel->save([
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'harga'        => $this->request->getPost('harga'),
            'durasi'       => $this->request->getPost('durasi'),
            'foto'         => $namaFoto
        ]);

        return redirect()->to(base_url('admin/layanan'))->with('success', 'Data layanan berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $data = [
            'layanan' => $this->layananModel->find($id)
        ];
        return view('admin/layanan/v_edit', $data);
    }

    public function update($id)
    {
        $layananLama = $this->layananModel->find($id);
        $fileFoto = $this->request->getFile('foto');
        
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getPost('foto_lama'); 
        } else {
            $namaFoto = $fileFoto->getRandomName();
            $fileFoto->move('assets/img/layanan', $namaFoto);
            if (file_exists('assets/img/layanan/' . $this->request->getPost('foto_lama'))) {
                unlink('assets/img/layanan/' . $this->request->getPost('foto_lama'));
            }
        }

        $this->layananModel->update($id, [
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'harga'        => $this->request->getPost('harga'),
            'durasi'       => $this->request->getPost('durasi'),
            'foto'         => $namaFoto
        ]);

        return redirect()->to(base_url('admin/layanan'))->with('success', 'Data layanan berhasil diubah!');
    }

    public function delete($id)
    {
        $layanan = $this->layananModel->find($id);
        if ($layanan['foto'] != '' && file_exists('assets/img/layanan/' . $layanan['foto'])) {
            unlink('assets/img/layanan/' . $layanan['foto']);
        }

        $this->layananModel->delete($id);
        return redirect()->to(base_url('admin/layanan'))->with('success', 'Data layanan berhasil dihapus!');
    }
}