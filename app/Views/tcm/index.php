<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content fs-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h2 class="h2">Torpedo Counter Measure</h2>
    </div>




    <div class="accordion mt-3" id="accordionExample">

        <!-- 1. accordian Rekapitulasi -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    1. REKAPITULASI
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Posisi</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($jenis as $item) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td>
                                                <?= anchor('tcm/detail/' . $item['id'], $item['nama'], ['class' => 'link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover']); ?>
                                            </td>
                                            <td>
                                                <?php
                                                $count = 0;
                                                foreach ($tcm as $row) {
                                                    if ($row['jenisId'] == $item['id']) {
                                                        $count++;
                                                    }
                                                }
                                                echo $count . ' unit';
                                                ?>

                                            </td>
                                            <td>@mdo</td>
                                            <td>@mdo</td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>

                                    <tr>
                                        <th scope="row"></th>
                                        <td colspan="4">
                                            <?= anchor('#addTambahTcmModal', 'Tambah Data', [
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


        <!-- 2. accordian surat -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    2. SURAT
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
                                                <?= $s['perihal']; ?>
                                            </td>
                                            <td>
                                                <?= date('d F Y', strtotime($s['tglSurat'])); ?>
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
                                            <?= anchor('#addSuratModal', 'Tambah Data', [
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

        <!-- accordian kegiatan -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    3. KEGIATAN
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
                                        <th scope="col">Nomor Surat</th>
                                        <th scope="col">Posisi</th>
                                        <th scope="col">Tgl Pelaksanaan</th>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($trxTcm as $indeks => $t) :
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
                                                <?= $s['perihal']; ?>
                                            </td>
                                            <td>
                                                <?= date('d F Y', strtotime($s['tglSurat'])); ?>
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
                            <input type="text" class="form-control fs-3 tanggal-input" name="tglSurat" value="<?= date('d F Y', strtotime($s['tglSurat'])); ?>" required autocomplete="off">
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

    <!-- Modal kegiatan Baru -->
    <div class="modal fade" id="addKegiatanModal" tabindex="-1" aria-labelledby="addKegiatanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKegiatanModalLabel">Tambah kegiatan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open('tcm/tambahkegiatan'); ?>
                    <div class="mb-3">
                        <label for="noSurat" class="form-label">Surat</label>
                        <?= form_dropdown('noSurat', array_column($surat, 'noSurat', 'id'), '', [
                            'class' => 'form-select',
                            'id' => 'noSurat',
                            'required' => 'required'
                        ]); ?>
                    </div>
                    <div class="mb-3">
                        <label for="posisi" class="form-label">Posisi</label>
                        <?= form_dropdown('posisi', array_column($posisi, 'posisi', 'id'), '', [
                            'class' => 'form-select',
                            'id' => 'posisi',
                            'required' => 'required'
                        ]); ?>
                    </div>
                    <div class="mb-3">
                        <label for="tglPelaksanaan" class="form-label">Tgl Pelaksanaan</label>
                        <input type="text" class="form-control tanggal-input" id="tglPelaksanaan" name="tglPelaksanaan" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <?= form_dropdown('jenis', [
                            'Barang Masuk' => 'Barang Masuk',
                            'Barang Keluar' => 'Barang Keluar',
                            'PUT' => 'PUT',
                            'PUS' => 'PUS'
                        ], '', [
                            'class' => 'form-select',
                            'id' => 'jenis',
                            'required' => 'required'
                        ]); ?>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2"></textarea>
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