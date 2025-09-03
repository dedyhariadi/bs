<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>



<main class="col-md-9 col-lg-10 px-md-4 main-content">


    <!-- awal toast (informasi sukses dari halaman sebelumnya) -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="toast align-items-center border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">Sukses</strong>
                <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= session()->getFlashdata('success'); ?>
            </div>s
        </div>

    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="toast align-items-center border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Gagal</strong>
                <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= session()->getFlashdata('error'); ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- akhir toast -->


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Torpedo Countermeasure</h1>
    </div>



    <div class="text-center fw-bold fs-2 mt-4 mb-3">
        <?= $jenisTcm['nama']; ?>
    </div>
    <div class="fs-3 my-3">
        <?= anchor('tcm', '< back', ['class' => 'link-success link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover']) ?>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-hover fs-5" style="background-color:#F7FFF7;">
                <thead>
                    <tr class="text-center align-middle">
                        <th scope="col" rowspan="2">#</th>
                        <th scope="col" rowspan="2">PART NUMBER</th>
                        <th scope="col" rowspan="2">SERIAL NUMBER</th>
                        <th scope="col" colspan="2">STATUS</th>
                        <th scope="col" colspan="2">KONDISI</th>
                        <th scope="col">POSISI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detailTcm as $index => $item): ?>
                        <tr class="text-center align-middle">
                            <td><?= $index + 1; ?></td>
                            <td><?= $item['part_number']; ?></td>
                            <td><?= $item['serial_number']; ?></td>
                            <td><?= $item['status']; ?></td>
                            <td><?= $item['kondisi']; ?></td>
                            <td><?= $item['posisi']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Jenis Modal -->
    <div class="modal modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jenis TCM</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open('tcm/rekap/addJenis'); ?>
                    <div class="mb-5">
                        <input type="text" class="form-control fs-2" id="jenisTcm" name="nama" required autocomplete="off">
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>









</main>



<?= $this->endSection(); ?>