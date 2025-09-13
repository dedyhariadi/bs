<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content fs-4">




    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h2 class="h2">JURNAL HARIAN</h2>
    </div>

    <?= anchor('jurnal', '< back', ['class' => 'link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fs-4']); ?>

    <div class="card mt-3">
        <div class="card-body fs-2">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-3">
                        Hari, Tanggal
                    </div>
                    <div class="col-7">
                        : <?= tampilTanggal($jurnal['tanggal']); ?>

                    </div>
                    <div class="col-2">
                        <?= form_open('jurnal/' . $jurnal['id'], '', ['_method' => 'DELETE', 'class' => 'd-inline']); ?>
                        <?= anchor('', 'EDIT', [
                            'class' => 'btn btn-primary me-2',
                            'type' => 'button',
                            'data-bs-toggle' => 'modal',
                            'data-bs-target' => '#editJurnalModal'
                        ]); ?>
                        <?= form_button([
                            'class'   => 'btn btn-danger d-inline',
                            'type'    => 'submit',
                            'content' => 'HAPUS',
                            'onclick' => "return confirm('Apakah anda yakin menghapus jurnal ini?');"
                        ]); ?>
                        <?= form_close(); ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        Kegiatan
                    </div>
                    <div class="col-6">
                        : <?= nl2br($jurnal['kegiatan']); ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        Foto
                    </div>
                    <div class="col-6 align-top">
                        <span class="align-top">:</span>
                        <?php if ($jurnal['foto']): ?>
                            <img src="<?= base_url('uploads/jurnal/' . $jurnal['foto']); ?>" alt="Foto Jurnal" class="img-fluid" style="max-width: 100%; height: auto;">
                        <?php else: ?>
                            <span class="text-danger"> Tidak ada foto.</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- Edit jurnal modal  -->
        <div class="modal modal-lg" id="editJurnalModal" tabindex="-1" aria-labelledby="editJurnalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editJurnalModalLabel">Edit Jurnal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open_multipart('jurnal/edit/' . $jurnal['id'], '', ['giatId' => $jurnal['giatId']]); ?>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="text" class="fs-3 form-control tanggal-input" id="tanggal" name="tanggal" autocomplete="off" value="<?= tampilTanggal($jurnal['tanggal']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kegiatan</label>
                            <textarea class="fs-3 form-control" id="kegiatan" name="kegiatan" rows="7" required><?= $jurnal['kegiatan']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>

        <?= $this->endSection(); ?>

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