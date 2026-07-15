<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="pagetitle">
    <h1>Jadwal Tugas Teknisi</h1>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Daftar Service Hari Ini</h5>
            
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Jam</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Aksi</th> </tr>
                </thead>
               <tbody>
                <?php if (!empty($jadwal)) : ?>
                    <?php foreach ($jadwal as $j) : ?>
                        <tr>
                            <td><?= date('H:i', strtotime($j['jam_booking'])) ?> WIB</td>
                            <td><?= esc($j['nama_pelanggan']) ?></td>
                            <td><?= esc($j['nama_layanan']) ?></td>
                            <td>
                                <?php if ($j['status'] == 'Menunggu') : ?>
                                    <span class="badge bg-secondary">Menunggu</span>
                                <?php elseif ($j['status'] == 'Proses') : ?>
                                    <span class="badge bg-warning text-dark">Proses</span>
                                <?php elseif ($j['status'] == 'Selesai') : ?>
                                    <span class="badge bg-success">Selesai</span>
                                <?php endif; ?>
                            </td>
                            
                            <td>
                                <?php if ($j['status'] == 'Menunggu') : ?>
                                    <form action="<?= base_url('teknisi/kerjakan/' . $j['id']) ?>" method="post">
                                        <button type="submit" class="btn btn-sm btn-primary">Mulai Kerjakan</button>
                                    </form>

                                <?php elseif ($j['status'] == 'Proses') : ?>
                                    <form action="<?= base_url('teknisi/selesai/' . $j['id']) ?>" method="post">
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Apakah pekerjaan ini sudah selesai?');">
                                            Selesaikan
                                        </button>
                                    </form>

                                <?php else : ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada jadwal tugas untuk hari ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
            </table>
        </div>
    </div>
</section>
<?= $this->endSection() ?>