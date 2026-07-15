<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login'); 

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('register', 'AuthController::register');
$routes->post('register/process', 'AuthController::processRegister');

// ====================================================================
// GROUP ROUTE BERDASARKAN ROLE (SERVICE BOOKING)
// ====================================================================

// --- 1. ROUTE ADMIN ---
$routes->group('admin', ['filter' => 'role:admin'], static function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    
    // --- ROUTE CRUD LAYANAN ---
    $routes->get('layanan', 'LayananController::index');
    $routes->get('layanan/tambah', 'LayananController::create');
    $routes->post('layanan/simpan', 'LayananController::store');
    $routes->get('layanan/edit/(:num)', 'LayananController::edit/$1');
    $routes->post('layanan/update/(:num)', 'LayananController::update/$1');
    $routes->get('layanan/hapus/(:num)', 'LayananController::delete/$1');
    
    // --- ROUTE KELOLA TEKNISI ---
    $routes->get('teknisi', 'AdminController::teknisi');
    $routes->get('teknisi/tambah', 'AdminController::tambahTeknisi');
    $routes->post('teknisi/simpan', 'AdminController::simpanTeknisi');

    // ---> ROUTE KELOLA BOOKING ADMIN (SUDAH DIPINDAH KE SINI) <---
    $routes->get('booking', 'AdminController::booking');
    $routes->post('booking/assign/(:num)', 'AdminController::assignTeknisi/$1');
});

// --- 2. ROUTE PELANGGAN ---
$routes->group('pelanggan', ['filter' => 'role:pelanggan'], static function ($routes) {
    $routes->get('home', 'Home::index'); 
    
    // Rute Pesan Layanan
    $routes->get('pesan', 'PelangganController::pesan');
    $routes->post('simpan-pesan', 'PelangganController::simpanPesan');
    
    // Rute Riwayat Booking
    $routes->get('riwayat', 'PelangganController::riwayat');

    // ---> INI RUTE BARU UNTUK HALAMAN PEMBAYARAN MIDTRANS <---
    $routes->get('bayar/(:num)', 'PelangganController::bayar/$1');
});

// --- 3. ROUTE TEKNISI ---
$routes->group('teknisi', ['filter' => 'role:teknisi'], static function ($routes) {
    // Rute untuk melihat jadwal tugas harian
    $routes->get('jadwal', 'TeknisiController::jadwal');
    $routes->post('kerjakan/(:num)', 'TeknisiController::kerjakan/$1');
    $routes->post('selesai/(:num)', 'TeknisiController::selesaikan/$1');
    
    // Rute Profil & Absensi 
    $routes->get('profil', 'TeknisiController::profil');
    $routes->post('update-absen', 'TeknisiController::updateAbsen');
});  

$routes->get('/download', 'DownloadController::index');

// ---> RUTE SEMENTARA UNTUK TEST EMAIL <---
$routes->get('/tes-email', 'PelangganController::testEmail');

// ====================================================================
// GROUP ROUTE API (WEBSERVICE SERVER & WEBHOOK)
// ====================================================================

// ---> RUTE WEBHOOK MIDTRANS <---
// Diletakkan di luar namespace API agar langsung mengarah ke PaymentController
$routes->post('api/payment/callback', 'PaymentController::callback');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
    // Endpoint untuk mendapatkan semua layanan
    $routes->get('layanan', 'LayananController::index');
    
    // Endpoint untuk mendapatkan detail 1 layanan berdasarkan ID
    $routes->get('layanan/(:num)', 'LayananController::show/$1');
});