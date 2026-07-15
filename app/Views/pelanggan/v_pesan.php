<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Pesan Layanan Bengkel</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('pelanggan/home') ?>">Home</a></li>
            <li class="breadcrumb-item active">Pesan Layanan</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body mt-3">
                    <h5 class="card-title">Formulir Booking Servis</h5>
                    
                    <form action="<?= base_url('pelanggan/simpan-pesan') ?>" method="post">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Layanan</label>
                            <select name="id_layanan" class="form-select" required>
                                <option value="">-- Silakan Pilih Layanan --</option>
                                <?php foreach ($layanan as $l) : ?>
                                    <option value="<?= $l['id'] ?>">
                                        <?= $l['nama_layanan'] ?> - Rp <?= number_format($l['harga'], 0, ',', '.') ?> (Est: <?= $l['durasi'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tanggal Booking</label>
                                <input type="date" name="tanggal_booking" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jam Kedatangan</label>
                                <input type="time" name="jam_booking" class="form-control" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">Kirim Pesanan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>