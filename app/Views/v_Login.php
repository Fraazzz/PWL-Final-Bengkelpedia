<?= $this->extend('layout_clear') ?>

<?= $this->section('content') ?>
<?php
// Mendefinisikan atribut input menggunakan array yang bersih
$username_input = [
    'name'        => 'username',
    'id'          => 'yourUsername',
    'class'       => 'form-control',
    'required'    => 'required',
    'placeholder' => 'Username'
];

$password_input = [
    'name'        => 'password',
    'id'          => 'yourPassword',
    'class'       => 'form-control',
    'required'    => 'required',
    'placeholder' => 'Password'
];
?>

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="#" class="logo d-flex align-items-center w-auto">
                        <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
                        <span class="d-none d-lg-block">Bengkelpedia</span>
                    </a>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                            <p class="text-center small">Enter your username & password to login</p>
                        </div>

                        <!-- Menampilkan Pesan Error jika Login Gagal -->
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <small><?= session()->getFlashdata('error') ?></small>
                                <button type="button" class="btn-close" data-bs-close="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Form Open -->
                        <?= form_open('login', ['class' => 'row g-3 needs-validation']) ?>

                        <div class="col-12">
                            <label for="yourUsername" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                <?= form_input($username_input) ?>
                                <div class="invalid-feedback">Please enter your username.</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="yourPassword" class="form-label">Password</label>
                            <?= form_password($password_input) ?>
                            <div class="invalid-feedback">Please enter your password!</div>
                        </div>

                        <div class="col-12 mt-4">
                            <!-- Tombol Login -->
                            <button class="btn btn-primary w-100" type="submit">Login</button>
                        </div>

                        <?= form_close() ?>

                    </div>
                </div>
                <div class="text-center mt-3">
    <span class="text-muted">Belum punya akun? </span>
    <a href="<?= base_url('register') ?>" class="text-decoration-none">Daftar di sini</a>
</div>

                <div class="credits">
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>

            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>