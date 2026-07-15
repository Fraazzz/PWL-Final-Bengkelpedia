<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <?php $role = session()->get('role'); ?>

        <?php if ($role == 'admin') : ?>
            <li class="nav-heading">Manajemen Bengkel</li>
            
            <li class="nav-item">
                <a class="nav-link <?= (url_is('admin/dashboard')) ? '' : 'collapsed' ?>" href="<?= base_url('admin/dashboard') ?>">
                    <i class="bi bi-grid"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (url_is('admin/layanan*')) ? '' : 'collapsed' ?>" href="<?= base_url('admin/layanan') ?>">
                    <i class="bi bi-tools"></i><span>Kelola Layanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (url_is('admin/teknisi*')) ? '' : 'collapsed' ?>" href="<?= base_url('admin/teknisi') ?>">
                    <i class="bi bi-people"></i><span>Data Teknisi</span>
                </a>
            </li>
    
            <li class="nav-item">
                <a class="nav-link <?= (url_is('admin/booking*')) ? '' : 'collapsed' ?>" href="<?= base_url('admin/booking') ?>">
                    <i class="bi bi-card-list"></i><span>Daftar Booking</span>
                </a>
            </li>

        <?php elseif ($role == 'teknisi') : ?>
            <li class="nav-heading">Area Teknisi</li>
            
            <li class="nav-item">
                <a class="nav-link <?= (url_is('teknisi/jadwal*')) ? '' : 'collapsed' ?>" href="<?= base_url('teknisi/jadwal') ?>">
                    <i class="bi bi-calendar-event"></i><span>Jadwal Tugas Harian</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= (url_is('teknisi/profil*')) ? '' : 'collapsed' ?>" href="<?= base_url('teknisi/profil') ?>">
                    <i class="bi bi-person-badge"></i><span>Profil & Absensi</span>
                </a>
            </li>

        <?php elseif ($role == 'pelanggan') : ?>
            <li class="nav-heading">Layanan Pelanggan</li>
            
            <li class="nav-item">
                <a class="nav-link <?= (url_is('pelanggan/home')) ? '' : 'collapsed' ?>" href="<?= base_url('pelanggan/home') ?>">
                    <i class="bi bi-house"></i><span>Halaman Utama</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= (url_is('pelanggan/pesan*')) ? '' : 'collapsed' ?>" href="<?= base_url('pelanggan/pesan') ?>">
                    <i class="bi bi-cart-plus"></i><span>Pesan Layanan</span>
                </a>
            </li>
            
           <li class="nav-item">
                <a class="nav-link <?= (url_is('pelanggan/riwayat*')) ? '' : 'collapsed' ?>" href="<?= base_url('pelanggan/riwayat') ?>">
                    <i class="bi bi-clock-history"></i><span>Riwayat Booking</span>
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-heading">Sistem</li>
        <li class="nav-item">
            <a class="nav-link collapsed text-danger" href="<?= base_url('logout') ?>">
                <i class="bi bi-box-arrow-right text-danger"></i><span>Logout</span>
            </a>
        </li>

    </ul>
</aside>