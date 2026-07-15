<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="pagetitle">
  <h1>Pembayaran Layanan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= base_url('pelanggan/home') ?>">Home</a></li>
      <li class="breadcrumb-item"><a href="<?= base_url('pelanggan/riwayat') ?>">Riwayat Booking</a></li>
      <li class="breadcrumb-item active">Pembayaran</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row justify-content-center mt-4">
    <div class="col-lg-6">
      <div class="card text-center p-5 shadow-sm border-0">
        <div class="card-body">
          <i class="bi bi-wallet2 text-primary mb-3" style="font-size: 4rem;"></i>
          <h4 class="card-title mb-1">Selesaikan Pembayaran Anda</h4>
          <p class="text-muted">ID Booking: BENGKEL-<?= esc($id_booking) ?></p>
          
          <!-- Harga sekarang sudah dinamis mengikuti database -->
          <h2 class="text-primary fw-bold mb-4">Rp <?= number_format($harga, 0, ',', '.'); ?></h2>
          
          <p class="small text-muted mb-4">
            Silakan klik tombol di bawah ini untuk memproses pembayaran melalui sistem Midtrans yang aman.
          </p>

          <!-- Tombol Bayar -->
          <button id="pay-button" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
            <i class="bi bi-credit-card me-2"></i> Bayar Sekarang
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 1. Masukkan library JavaScript Midtrans Mode Sandbox -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= esc($clientKey) ?>"></script>

<!-- 2. Script untuk memunculkan Popup saat tombol diklik -->
<script type="text/javascript">
  document.getElementById('pay-button').onclick = function () {
    
    // Panggil snap.pay dengan snapToken yang dikirim dari controller
    snap.pay('<?= esc($snapToken) ?>', {
      
      // Callback jika pembayaran berhasil
      onSuccess: function(result){
        alert("Pembayaran Berhasil! Terima kasih."); 
        console.log(result);
        // Arahkan pelanggan kembali ke halaman riwayat setelah sukses
        window.location.href = "<?= base_url('pelanggan/riwayat') ?>";
      },
      
      // Callback jika pelanggan menggunakan metode bayar tertunda (seperti transfer bank/Indomaret)
      onPending: function(result){
        alert("Menunggu pembayaran Anda!"); 
        console.log(result);
        window.location.href = "<?= base_url('pelanggan/riwayat') ?>";
      },
      
      // Callback jika pembayaran gagal
      onError: function(result){
        alert("Maaf, pembayaran gagal. Silakan coba lagi."); 
        console.log(result);
      },
      
      // Callback jika pelanggan menutup popup tanpa melakukan apapun
      onClose: function(){
        alert("Anda menutup jendela pembayaran sebelum menyelesaikannya.");
      }
    });
  };
</script>
<?= $this->endSection() ?>