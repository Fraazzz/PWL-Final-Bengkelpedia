<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Daftar Layanan Bengkel</h1>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">
            Data Layanan 
            <a href="<?= base_url('admin/layanan/tambah') ?>" class="btn btn-primary btn-sm float-end">+ Tambah Layanan</a>
        </h5>
        
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Layanan</th>
                    <th>Harga</th>
                    <th>Durasi</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($layanan)) : ?>
                    <?php foreach ($layanan as $l) : ?>
                    <tr>
                        <td><?= esc($l['nama_layanan']) ?></td>
                        <td>Rp <?= number_format($l['harga'], 0, ',', '.') ?></td>
                        <td><?= esc($l['durasi']) ?> Menit</td>
                        <td><img src="<?= base_url('assets/img/layanan/' . $l['foto']) ?>" width="50" class="rounded"></td>
                        
                        <td>
                            <a href="<?= base_url('admin/layanan/edit/' . $l['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= base_url('admin/layanan/hapus/' . $l['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus layanan ini?')">Hapus</a>
                        </td>
                        
                    </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data layanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>