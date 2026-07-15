<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Edit Layanan Bengkel</h5>
        <form action="<?= base_url('admin/layanan/update/' . $layanan['id']) ?>" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="foto_lama" value="<?= $layanan['foto'] ?>">

            <div class="mb-3">
                <label>Nama Layanan</label>
                <input type="text" name="nama_layanan" class="form-control" value="<?= esc($layanan['nama_layanan']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="<?= esc($layanan['harga']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Durasi (Menit)</label>
                <input type="number" name="durasi" class="form-control" value="<?= esc($layanan['durasi']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Foto Layanan (Biarkan kosong jika tidak ingin ganti foto)</label>
                <br>
                <img src="<?= base_url('assets/img/layanan/' . $layanan['foto']) ?>" width="100" class="mb-2 rounded">
                <input type="file" name="foto" class="form-control">
            </div>
            <a href="<?= base_url('admin/layanan') ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update Layanan</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>