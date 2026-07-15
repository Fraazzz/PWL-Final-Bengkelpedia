<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Data Teknisi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
            <li class="breadcrumb-item active">Data Teknisi</li>
        </ol>
    </nav>
</div>

<section class="section">
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body mt-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">Daftar Teknisi Bengkel</h5>
                <a href="<?= base_url('admin/teknisi/tambah') ?>" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Teknisi
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover mt-2">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Spesialisasi</th>
                            <th>Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; if(!empty($teknisi)) : ?>
                            <?php foreach ($teknisi as $t) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($t['nama_lengkap']) ?></td>
                                    <td><?= esc($t['username']) ?></td>
                                    <td><?= esc($t['spesialisasi']) ? esc($t['spesialisasi']) : '-' ?></td>
                                    <td>
                                        <?php if ($t['status_kehadiran'] == 'Hadir') : ?>
                                            <span class="badge bg-success">Hadir</span>
                                        <?php elseif ($t['status_kehadiran'] == 'Izin') : ?>
                                            <span class="badge bg-warning text-dark">Izin</span>
                                        <?php elseif ($t['status_kehadiran'] == 'Sakit') : ?>
                                            <span class="badge bg-warning text-dark">Sakit</span>
                                        <?php else : ?>
                                            <span class="badge bg-danger">Off</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada staf teknisi yang terdaftar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>