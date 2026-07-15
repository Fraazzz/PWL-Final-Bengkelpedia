<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="pagetitle">
    <h1>Selamat Datang, <?= session()->get('username') ?></h1>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card bg-primary text-white text-center p-4">
                <h3>Butuh Servis Kendaraan?</h3>
                <p>Klik tombol di bawah untuk memesan jadwal secara online.</p>
                <a href="<?= base_url('pelanggan/pesan') ?>" class="btn btn-light fw-bold text-primary">Booking Sekarang</a>
            </div>
        </div>
        
        <div class="col-lg-12 mt-3">
            <h5>Riwayat Booking Terakhir</h5>
            <div class="card p-3">
                <!-- Cek apakah data riwayat ada atau kosong -->
                <?php if (!empty($riwayat)) : ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Potong array agar hanya menampilkan maksimal 3 data terbaru
                                $riwayat_terbaru = array_slice($riwayat, 0, 3);
                                foreach ($riwayat_terbaru as $item) : 
                                ?>
                                    <tr>
                                        <td><?= $item['tanggal_booking'] ?></td>
                                        <td><?= $item['jam_booking'] ?></td>
                                        <td>
                                            <!-- Berikan warna lencana (badge) yang berbeda berdasarkan status -->
                                            <?php if ($item['status'] == 'Menunggu') : ?>
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                            <?php elseif ($item['status'] == 'Proses') : ?>
                                                <span class="badge bg-info text-dark">Proses</span>
                                            <?php elseif ($item['status'] == 'Selesai' || $item['status'] == 'Lunas') : ?>
                                                <span class="badge bg-success"><?= $item['status'] ?></span>
                                            <?php else : ?>
                                                <span class="badge bg-secondary"><?= $item['status'] ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Tombol kecil untuk melihat riwayat penuh -->
                    <div class="text-end mt-3">
                        <a href="<?= base_url('pelanggan/riwayat') ?>" class="text-primary text-decoration-none small">Lihat Semua Riwayat &rarr;</a>
                    </div>
                <?php else : ?>
                    <p class="text-muted mb-0">Belum ada riwayat pengerjaan kendaraan.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>