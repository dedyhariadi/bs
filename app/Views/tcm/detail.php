<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content fs-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h2 class="h2">Torpedo Counter Measure</h2>
    </div>

    <?= anchor('tcm', '< back', ['class' => 'link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fs-5']); ?>

    <div class="card mt-4">
        <div class="card-header">
            <h2 class="my-3 text-warning-emphasis text-uppercase fw-bold"><?= $jenis['nama']; ?></h2>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Part Number</th>
                            <th>Serial Number</th>
                            <th>Status</th>
                            <th>Posisi</th>
                            <th>Dasar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tcmList as $index => $tcm): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($tcm['partNumber']) ?></td>
                                <td><?= esc($tcm['serialNumber']) ?></td>
                                <td><?= esc($tcm['status']) ?></td>
                                <td>posisi</td>
                                <td>surat</td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <?php
                                        // Prepare the modal ID for each TCM
                                        $modalId = '#editTcmModal' . $index;
                                        ?>
                                        <?= anchor('', '<i class="bi bi-pencil-fill"></i>', [
                                            'class' => 'btn btn-warning',
                                            'type' => 'button',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => $modalId
                                        ]); ?>

                                        <?= form_open('tcm/' . $tcm['id'], '', ['_method' => 'DELETE']); ?>
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
                        <?php endforeach; ?>
                        <tr>

                            <td></td>
                            <td>
                                <?= anchor('#addTambahTcmModal', 'Tambah Data', [
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



    <br><br>




    <!-- Modal Tambah Data -->
    <div class="modal fade" id="addTambahTcmModal" tabindex="-1" aria-labelledby="addTransaksiModalLabel" aria-hidden="true">
        <div class="modal-dialog">

            <?= form_open('tcm/tambah', '', ['jenisId' => $jenis['id']]); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransaksiModalLabel">Tambah Data <?= $jenis['nama']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="partnumber" class="form-label">Part Number</label>
                        <input type="text" class="form-control fs-3" id="partnumber" name="partnumber">
                    </div>
                    <div class="mb-3">
                        <label for="serialnumber" class="form-label">Serial Number</label>
                        <input type="text" class="form-control fs-3" id="serialnumber" name="serialnumber" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <?= form_dropdown(
                            'status',
                            [
                                'Aktif' => 'Aktif',
                                'Fired' => 'Fired',
                                'Eternal Patrol' => 'Eternal Patrol'
                            ],
                            '',
                            ['class' => 'form-select fs-3', 'id' => 'status', 'required' => true]
                        ); ?>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>


    <!-- edit -->

    <?php
    foreach ($tcmList as $index => $tcm):
        // Prepare the modal ID for each TCM
        $modalId = 'editTcmModal' . $index;
    ?>
        <div class="modal fade" id="<?= $modalId; ?>" tabindex="-1" aria-labelledby="editTcmModalLabel" aria-hidden="true">
            <div class="modal-dialog">

                <?= form_open('tcm/edit/' . $tcm['id'], '', ['jenisId' => $jenis['id']]); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTcmModalLabel">Edit Data <?= $jenis['nama']; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="partnumber" class="form-label">Part Number</label>
                            <input type="text" class="form-control fs-3" id="partnumber" name="partnumber" value="<?= esc($tcm['partNumber']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="serialnumber" class="form-label">Serial Number</label>
                            <input type="text" class="form-control fs-3" id="serialnumber" name="serialnumber" value="<?= esc($tcm['serialNumber']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>


                            <?= form_dropdown(
                                'status',
                                [
                                    'Aktif' => 'Aktif',
                                    'Fired' => 'Fired',
                                    'Eternal Patrol' => 'Eternal Patrol'
                                ],
                                $tcm['status'],
                                ['class' => 'form-select fs-3', 'id' => 'status', 'required' => true]
                            ); ?>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    <?php
    endforeach;
    ?>


    <?= $this->endSection(); ?>