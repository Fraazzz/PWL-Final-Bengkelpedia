<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Teknisi - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <a href="<?= base_url('admin/teknisi') ?>" class="btn btn-secondary mb-3">&laquo; Kembali</a>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Form Tambah Teknisi Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="<?= base_url('admin/teknisi/simpan') ?>" method="post">
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username (Untuk Login)</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor WhatsApp/Telepon</label>
                            <input type="number" name="no_telp" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Spesialisasi</label>
                            <select name="spesialisasi" class="form-select" required>
                                <option value="">-- Pilih Spesialisasi --</option>
                                <option value="Mesin">Mesin</option>
                                <option value="Kelistrikan">Kelistrikan</option>
                                <option value="Ban & Velg">Ban & Velg</option>
                                <option value="AC & Pendingin">AC & Pendingin</option>
                                <option value="Umum">Umum</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Simpan Data Teknisi</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>