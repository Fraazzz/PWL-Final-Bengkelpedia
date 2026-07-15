<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Kelola Daftar Booking</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Daftar Booking</li>
        </ol>
    </nav>
</div>

<section class="section">
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('pesan') ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body mt-3">
            <h5 class="card-title">Semua Pesanan Masuk</h5>

            <table class="table table-bordered table-hover mt-2">
                <thead class="table-light">
                    <tr>
                        <th>Tgl & Jam</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Teknisi Bertugas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($booking)) : ?>
                        <?php foreach ($booking as $b) : ?>
                            <tr>
                                <td>
                                    <?= date('d/m/Y', strtotime($b['tanggal_booking'])) ?> <br>
                                    <small class="fw-bold"><?= date('H:i', strtotime($b['jam_booking'])) ?> WIB</small>
                                </td>
                                <td><?= $b['nama_pelanggan'] ?></td>
                                <td><?= $b['nama_layanan'] ?></td>
                                <td>
                                    <?php if ($b['status'] == 'Menunggu') : ?>
                                        <span class="badge bg-secondary">Menunggu</span>
                                    <?php elseif ($b['status'] == 'Proses') : ?>
                                        <span class="badge bg-warning text-dark">Diproses</span>
                                    <?php elseif ($b['status'] == 'Selesai') : ?>
                                        <span class="badge bg-success">Selesai</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(empty($b['id_teknisi'])) : ?>
                                        <form action="<?= base_url('admin/booking/assign/' . $b['id']) ?>" method="post" class="d-flex gap-2">
                                            <select name="id_teknisi" class="form-select form-select-sm" required>
                                                <option value="">-- Pilih Teknisi --</option>
                                                <?php foreach($teknisi as $t) : ?>
                                                    <option value="<?= $t['id'] ?>"><?= $t['nama_lengkap'] ?> (<?= $t['status_kehadiran'] ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">Tugaskan</button>
                                        </form>
                                    <?php else : ?>
                                        <span class="fw-bold text-primary"><i class="bi bi-person-check-fill"></i> <?= $b['nama_teknisi'] ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pesanan masuk.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</section>

<?= $this->endSection() ?>