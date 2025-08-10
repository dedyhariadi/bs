<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content fs-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h2 class="h2">Torpedo Counter Measure</h2>
    </div>

    <?= anchor('tcm', '< back', ['class' => 'link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fs-5']); ?>


    <div class="accordion mt-3" id="accordionExample">

        <!-- accordian surat -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    SURAT
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card">
                        <div class="card-body">


                            <table class="table table-hover rounded-5">
                                <thead class="table-success ">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nomor Surat</th>
                                        <th scope="col">Pejabat</th>
                                        <th scope="col">Perihal</th>
                                        <th scope="col">Tanggal Surat</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($surat as $indeks => $s) :
                                    ?>
                                        <tr>
                                            <td scope="row"><?= $indeks + 1; ?></td>
                                            <td>
                                                <?= anchor('tcm/detail/' . $s['id'], $s['noSurat'], ['class' => 'link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover']); ?>
                                            </td>
                                            <td>
                                                <?= $s['pejabat']; ?>

                                            </td>
                                            <td>
                                                <?= nl2br($s['perihal']); ?>
                                            </td>
                                            <td>
                                                <?= tampilTanggal($s['tglSurat']); ?>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <?php
                                                    // Prepare the modal ID for each TCM
                                                    $modalId = '#editSuratModal' . $indeks;
                                                    ?>
                                                    <?= anchor('', '<i class="bi bi-pencil-fill"></i>', [
                                                        'class' => 'btn btn-warning',
                                                        'type' => 'button',
                                                        'data-bs-toggle' => 'modal',
                                                        'data-bs-target' => $modalId
                                                    ]); ?>

                                                    <?= form_open('tcm/hapussurat/' . $s['id'], '', ['_method' => 'DELETE']); ?>
                                                    <?= form_button([
                                                        'name'    => 'button',
                                                        'class'   => 'btn btn-danger',
                                                        'type'    => 'submit',
                                                        'content' => '<i class="bi bi-trash-fill"></i>',
                                                        'onclick' => "return confirm('Apakah anda yakin menghapus sub kegiatan?');"
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
                                            <?= anchor('#addSuratModal', 'add', [
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





    <!-- Modal Tambah Surat -->
    <div class="modal fade" id="addSuratModal" tabindex="-1" aria-labelledby="addSuratModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSuratModalLabel">Tambah Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <?= form_open('tcm/tambahsurat'); ?>
                    <div class="mb-3">
                        <label for="noSurat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control fs-3" id="noSurat" name="noSurat" required>
                    </div>

                    <div class="mb-3">
                        <label for="pejabat" class="form-label">Pejabat</label>
                        <input type="text" class="form-control fs-3" id="pejabat" name="pejabat" required>
                    </div>

                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal</label>
                        <textarea class="form-control fs-3" id="perihal" name="perihal" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tglSurat" class="form-label">Tanggal Surat</label>
                        <input type="text" class="form-control fs-3 tanggal-input" name="tglSurat" required autocomplete="off">
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




    <!-- Modal Edit Surat -->
    <?php
    foreach ($surat as $index => $s):
        // Prepare the modal ID for each TCM
        $modalId = 'editSuratModal' . $index;
    ?>
        <div class="modal fade" id="<?= $modalId; ?>" tabindex="-1" aria-labelledby="editSuratModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editSuratModalLabel">Edit Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <?= form_open('tcm/editsurat/' . $s['id']); ?>
                        <div class="mb-3">
                            <label for="noSurat" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control fs-3" id="noSurat" name="noSurat" value="<?= $s['noSurat']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="pejabat" class="form-label">Pejabat</label>
                            <input type="text" class="form-control fs-3" id="pejabat" name="pejabat" value="<?= $s['pejabat']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal</label>
                            <textarea class="form-control fs-3" id="perihal" name="perihal" rows="3" required><?= $s['perihal']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tglSurat" class="form-label">Tanggal Surat</label>
                            <input type="text" class="form-control fs-3 tanggal-input" name="tglSurat" value="<?= tampilTanggal($s['tglSurat']); ?>" required autocomplete="off">
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

    <?php
    endforeach;
    ?>



    <?= $this->endSection(); ?>