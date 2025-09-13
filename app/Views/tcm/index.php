<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard TCM</h1>
    </div>

    <!-- awal toast (informasi sukses dari halaman sebelumnya) -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="toast align-items-center border-0 show position-fixed top-50 start-50 translate-middle" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1050;">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">Sukses</strong>
                <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= session()->getFlashdata('success'); ?>
            </div>
        </div>

    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="toast align-items-center border-0 show position-fixed top-50 start-50 translate-middle" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1050;">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Gagal</strong>
                <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= session()->getFlashdata('error'); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Konten dashboard TCM -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Sistem TCM</h5>
                </div>
                <div class="card-body">
                    <p>Sistem manajemen inventaris TCM (Tinta Cetak Mesin) telah siap digunakan.</p>
                    <p>Gunakan menu navigasi untuk mengakses fitur-fitur berikut:</p>
                    <ul>
                        <li><a href="<?= base_url('tcm-dashboard/kegiatan'); ?>">Kelola Kegiatan</a></li>
                        <li><a href="<?= base_url('tcm-dashboard/rekap'); ?>">Rekap Data</a></li>
                        <li><a href="<?= base_url('tcm-dashboard/laporan'); ?>">Laporan</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Dark backdrop for toast focus -->
<div id="toast-backdrop" class="position-fixed top-0 start-0 w-100 h-100 bg-dark opacity-50 d-none" style="z-index: 1040;"></div>

<script>
// Handle toast backdrop
document.addEventListener('DOMContentLoaded', function() {
    const toastElement = document.querySelector('.toast');
    const backdrop = document.getElementById('toast-backdrop');
    
    if (toastElement) {
        // Show backdrop when toast is shown
        toastElement.addEventListener('show.bs.toast', function() {
            backdrop.classList.remove('d-none');
        });
        
        // Hide backdrop when toast is hidden
        toastElement.addEventListener('hidden.bs.toast', function() {
            backdrop.classList.add('d-none');
        });
        
        // Auto-hide toast after 5 seconds and hide backdrop
        setTimeout(function() {
            const bsToast = new bootstrap.Toast(toastElement);
            bsToast.hide();
        }, 5000);
    }
});
</script>

<?= $this->endSection(); ?>
