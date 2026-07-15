<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Layanan Bengkel</h5>
        <form action="<?= base_url('admin/layanan/simpan') ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Nama Layanan</label>
                <input type="text" name="nama_layanan" class="form-control" value="<?= old('nama_layanan') ?>">
            </div>
            <div class="mb-3">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control">
            </div>
            <div class="mb-3">
                <label>Durasi (Menit)</label>
                <input type="number" name="durasi" class="form-control">
            </div>
            <div class="mb-3">
                <label>Foto Layanan</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Layanan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>