<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content fs-4">

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
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-hover rounded-5">
                                <thead class="table-success ">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Hari, Tanggal</th>
                                        <th scope="col">Kegiatan</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($jurnal as $indeks => $j) :
                                    ?>
                                        <tr>
                                            <td scope="row"><?= $indeks + 1; ?></td>
                                            <td>
                                                <?php



                                                ?>
                                                <?= date('d F Y', strtotime($j['tanggal'])); ?>
                                            </td>
                                            <td>

                                                <?= nl2br($j['kegiatan']); ?>
                                            </td>

                                            <td>
                                                <div class="d-flex gap-2">
                                                    <?php
                                                    // Prepare the modal ID for each TCM
                                                    $modalId = '#eduJurnalModal' . $indeks;
                                                    ?>
                                                    <?= anchor('', '<i class="bi bi-pencil-fill"></i>', [
                                                        'class' => 'btn btn-warning',
                                                        'type' => 'button',
                                                        'data-bs-toggle' => 'modal',
                                                        'data-bs-target' => $modalId
                                                    ]); ?>

                                                    <?= form_open('jurnal' . $j['id'], '', ['_method' => 'DELETE']); ?>
                                                    <?= form_button([
                                                        'name'    => 'button',
                                                        'class'   => 'btn btn-danger',
                                                        'type'    => 'submit',
                                                        'content' => '<i class="bi bi-trash-fill"></i>',
                                                        'onclick' => "return confirm('Apakah anda yakin menghapus jurnal ini?');"
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
                                            <?= anchor('#addJurnalModal', 'add Jurnal', [
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


        <!-- accordian khusus -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    2. KHUSUS
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-hover rounded-5">
                                <thead class="table-success ">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Hari, Tanggal</th>
                                        <th scope="col">Kegiatan</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($jurnal as $indeks => $j) :
                                    ?>
                                        <tr>
                                            <td scope="row"><?= $indeks + 1; ?></td>
                                            <td>
                                                <?= date('d F Y', strtotime($j['tanggal'])); ?>
                                            </td>
                                            <td>
                                                <?= $j['kegiatan']; ?>
                                            </td>

                                            <td>
                                                <div class="d-flex gap-2">
                                                    <?php

                                                    $modalId = '#eduJurnalModal' . $indeks;
                                                    ?>
                                                    <?= anchor('', '<i class="bi bi-pencil-fill"></i>', [
                                                        'class' => 'btn btn-warning',
                                                        'type' => 'button',
                                                        'data-bs-toggle' => 'modal',
                                                        'data-bs-target' => $modalId
                                                    ]); ?>

                                                    <?= form_open('jurnal' . $j['id'], '', ['_method' => 'DELETE']); ?>
                                                    <?= form_button([
                                                        'name'    => 'button',
                                                        'class'   => 'btn btn-danger',
                                                        'type'    => 'submit',
                                                        'content' => '<i class="bi bi-trash-fill"></i>',
                                                        'onclick' => "return confirm('Apakah anda yakin menghapus jurnal ini?');"
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
                                            <?= anchor('#addJurnalModal', 'add Jurnal', [
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
    <div class="modal fade" id="addJurnalModal" tabindex="-1" aria-labelledby="addJurnalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJurnalModalLabel">Tambah Jurnal Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open('jurnal/tambah'); ?>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="text" class="form-control tanggal-input" id="tanggal" name="tanggal" autocomplete="off" required>
                    </div>

                    <div class="mb-3">
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                        <textarea class="form-control" id="kegiatan" name="kegiatan" rows="2" required></textarea>
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