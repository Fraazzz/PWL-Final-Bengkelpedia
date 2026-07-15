<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Profil & Absensi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('teknisi/jadwal') ?>">Home</a></li>
            <li class="breadcrumb-item active">Profil Teknisi</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-md-6">
            
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white">Status Kehadiran Hari Ini</h5>
                </div>
                <div class="card-body mt-3">
                    <div class="mb-3">
                        <label class="form-label text-muted">Nama Lengkap</label>
                        <h5><?= esc($user['nama_lengkap']) ?></h5>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Spesialisasi</label>
                        <h5>
                            <?php if($user['spesialisasi']) : ?>
                                <span class="badge bg-info text-dark"><?= esc($user['spesialisasi']) ?></span>
                            <?php else : ?>
                                <span class="text-danger fst-italic">Belum diatur oleh Admin</span>
                            <?php endif; ?>
                        </h5>
                    </div>

                    <hr>

                    <form action="<?= base_url('teknisi/update-absen') ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Update Status Kehadiran:</label>
                            <select name="status_kehadiran" class="form-select w-75">
                                <option value="Hadir" <?= ($user['status_kehadiran'] == 'Hadir') ? 'selected' : '' ?>>🟢 Hadir</option>
                                <option value="Izin" <?= ($user['status_kehadiran'] == 'Izin') ? 'selected' : '' ?>>🟡 Izin</option>
                                <option value="Sakit" <?= ($user['status_kehadiran'] == 'Sakit') ? 'selected' : '' ?>>🟠 Sakit</option>
                                <option value="Off" <?= ($user['status_kehadiran'] == 'Off') ? 'selected' : '' ?>>🔴 Off / Libur</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Kehadiran</button>
                    </form>

                </div>
            </div>
            
        </div>
    </div>
</section>

<?= $this->endSection() ?>