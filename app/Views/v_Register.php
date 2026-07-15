<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Booking Bengkel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 p-4">
                <div class="text-center mb-4">
                    <h3 class="text-primary fw-bold">Buat Akun Baru</h3>
                    <p class="text-muted">Daftar untuk mulai memesan layanan kami</p>
                </div>

                <form action="<?= base_url('register/process') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Nomor WhatsApp/Telepon</label>
                        <input type="number" name="no_telp" class="form-control" placeholder="Contoh: 08123456789" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Pilih username" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Buat password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">Daftar Sekarang</button>
                    
                    <div class="text-center">
                        <span class="text-muted">Sudah punya akun? </span>
                        <a href="<?= base_url('login') ?>" class="text-decoration-none">Login di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>