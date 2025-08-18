<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content fs-4">

    <!-- awal toast (informasi sukses dari halaman sebelumnya) -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="toast align-items-center border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">Sukses</strong>
                <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= session()->getFlashdata('success'); ?>
            </div>
        </div>
    <?php elseif (session()->getFlashdata('hapus')): ?>
        <div class="toast align-items-center border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Berhasil</strong>
                <button type="button" class="btn-close btn-close-white ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?= session()->getFlashdata('hapus'); ?>
            </div>
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
        <h2 class="h2">JURNAL</h2>
    </div>

    <div class="accordion mt-3" id="accordionExample">
        <!-- 1. accordian harian -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    1. HARIAN
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered rounded-5">
                                <thead class="table-success ">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 5%;">#</th>
                                        <th scope="col" class="col-3 text-center">Hari, Tanggal</th>
                                        <th scope="col" class="col-7 text-start">Kegiatan</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($jurnal as $indeks => $j) :
                                    ?>
                                        <tr>
                                            <td scope="row" class="text-center"><?= $indeks + 1; ?></td>
                                            <td>
                                                <?= tampilTanggal($j['tanggal']); ?>
                                            </td>
                                            <td>
                                                <?= nl2br($j['kegiatan']); ?>
                                            </td>
                                            <td class="text-center">
                                                <?= anchor('jurnal/' . $j['id'], 'Detail', ['class' => 'btn btn-outline-success']); ?>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                    <tr>
                                        <th scope="row"></th>
                                        <td colspan="2">
                                            <?= anchor('#addJurnalModal', 'add Jurnal', [
                                                'class' => 'link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover',
                                                'data-bs-toggle' => 'modal'
                                            ]); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- accordian khusus -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    2. KHUSUS
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover rounded-5">
                                <thead class="table-success ">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kegiatan</th>
                                        <th scope="col">Durasi</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($giatJurnal as $indeks => $j) :
                                    ?>
                                        <tr>
                                            <td scope="row"><?= $indeks + 1; ?></td>
                                            <td>

                                                <?= anchor('jurnal/khusus/' . $j['id'], $j['kegiatan'], [
                                                    'class' => 'link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover',
                                                    'title' => 'Lihat Kegiatan'
                                                ]); ?>

                                            </td>
                                            <td>
                                                <?php
                                                foreach ($durasiPerGiatJurnal as $durasi) :
                                                    if ($durasi['id'] == $j['id']) {
                                                        echo $durasi['totalDurasi'];
                                                    }
                                                endforeach;
                                                ?>
                                            </td>

                                            <td>
                                                <div class="d-flex gap-2">
                                                    <?php
                                                    $modalId = '#editGiatJurnalModal' . $indeks;
                                                    ?>
                                                    <?= anchor('', '<i class="bi bi-pencil-fill"></i>', [
                                                        'class' => 'btn btn-warning',
                                                        'type' => 'button',
                                                        'data-bs-toggle' => 'modal',
                                                        'data-bs-target' => $modalId
                                                    ]); ?>

                                                    <?= form_open('jurnal/hapusGiat/' . $j['id'], '', ['_method' => 'DELETE']); ?>
                                                    <?= form_button([
                                                        'name'     => 'button',
                                                        'class'    => 'btn btn-danger',
                                                        'type'     => 'submit',
                                                        'content'  => '<i class="bi bi-trash-fill"></i>',
                                                        'onclick'  => "return confirm('Apakah anda yakin menghapus jurnal ini?');"
                                                    ]); ?>
                                                    <?= form_close(); ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                    <tr>
                                        <th scope="row"></th>
                                        <td colspan="4">
                                            <?= anchor('#addKegiatanModal', 'add Kegiatan', [
                                                'class' => 'link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover',
                                                'data-bs-toggle' => 'modal'
                                            ]); ?>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal jurnal Baru -->
    <div class="modal modal-lg" id="addJurnalModal" tabindex="-1" aria-labelledby="addJurnalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJurnalModalLabel">Tambah Jurnal Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open_multipart('jurnal/tambah', '', ['giatId' => '1']); ?>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="text" class="fs-3 form-control tanggal-input" id="tanggal" name="tanggal" autocomplete="off" required>
                    </div>

                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                        <textarea class="form-control fs-3" id="kegiatan" name="kegiatan" rows="7" required></textarea>
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


    <!-- Modal Giat Jurnal Baru -->
    <div class="modal modal-lg" id="addKegiatanModal" tabindex="-1" aria-labelledby="addKegiatanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKegiatanModalLabel">Tambah Kegiatan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open('jurnal/tambahGiat', '', ['giatId' => '1']); ?>

                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                        <textarea class="form-control fs-3" id="kegiatan" name="kegiatan" rows="7"></textarea>
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

    <!-- Modal Edit Kegiatan  -->
    <?php
    foreach ($giatJurnal as $indeks => $j) :
        $modalId = 'editGiatJurnalModal' . $indeks;
    ?>
        <div class="modal modal-lg" id="<?= $modalId; ?>" tabindex="-1" aria-labelledby="editGiatJurnalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGiatJurnalModalLabel">Tambah Kegiatan Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('jurnal/editGiat/' . $j['id'], '', ['giatId' => '1']); ?>

                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kegiatan</label>
                            <textarea class="form-control fs-3" id="kegiatan" name="kegiatan" rows="7"><?= $j['kegiatan']; ?></textarea>
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
    <?php endforeach; ?>
</main>
<?= $this->endSection(); ?>