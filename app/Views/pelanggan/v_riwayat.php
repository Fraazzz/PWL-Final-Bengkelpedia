<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Riwayat Pemesanan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('pelanggan/home') ?>">Home</a></li>
            <li class="breadcrumb-item active">Riwayat Booking</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="card shadow-sm border-0">
        <div class="card-body mt-3">
            <h5 class="card-title">Daftar Pesanan Servis Anda</h5>

            <table class="table table-bordered table-striped mt-2">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal & Waktu</th>
                        <th>Layanan</th>
                        <th>Harga</th>
                        <th>Teknisi</th>
                        <th>Status</th>
                        <!-- 1. INI TAMBAHAN JUDUL KOLOM BARU -->
                        <th>Aksi</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; if(!empty($riwayat)) : ?>
                        <?php foreach ($riwayat as $r) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?= date('d M Y', strtotime($r['tanggal_booking'])) ?> <br>
                                    <small class="text-muted fw-bold"><?= date('H:i', strtotime($r['jam_booking'])) ?> WIB</small>
                                </td>
                                <td><?= $r['nama_layanan'] ?></td>
                                <td>Rp <?= number_format($r['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if($r['nama_teknisi']) : ?>
                                        <?= $r['nama_teknisi'] ?>
                                    <?php else : ?>
                                        <span class="text-muted fst-italic">Menunggu Konfirmasi Admin</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($r['status'] == 'Menunggu') : ?>
                                        <span class="badge bg-secondary">Menunggu</span>
                                    <?php elseif ($r['status'] == 'Proses') : ?>
                                        <span class="badge bg-warning text-dark">Diproses</span>
                                    <?php elseif ($r['status'] == 'Selesai') : ?>
                                        <span class="badge bg-success">Selesai</span>
                                    <?php endif; ?>
                                </td>
                                
                                <!-- 2. INI TAMBAHAN TOMBOL BAYARNYA -->
                                <td>
                                    <?php if ($r['status'] == 'Menunggu') : ?>
                                        <a href="<?= base_url('pelanggan/bayar/' . $r['id_booking']) ?>" class="btn btn-sm btn-success shadow-sm">
                                            <i class="bi bi-wallet2"></i> Bayar
                                        </a>
                                    <?php else : ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <!-- 3. MENGUBAH COLSPAN MENJADI 7 -->
                            <td colspan="7" class="text-center">Anda belum memiliki riwayat pemesanan servis.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</section>

<?= $this->endSection() ?>