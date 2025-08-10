<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content fs-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h2 class="h2">Torpedo Counter Measure</h2>
    </div>

    <?= anchor('tcm', '< back', ['class' => 'link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover fs-5']); ?>



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
    <?php endif; ?>

    <!-- akhir toast -->




    <div class="accordion mt-3" id="accordionExample">

        <!-- accordian trxtcm -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    List TCM
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col text-start">
                                    <div class="p-3 border bg-light rounded-3">Jenis Giat :
                                        <br>
                                        <span class="fw-bold text-primary">
                                            <?= $kegiatan['jenisGiat']; ?></span>
                                    </div>
                                </div>

                                <div class="col text-start">
                                    <div class="p-3 border bg-light rounded-3">Posisi :
                                        <br>
                                        <span class="fw-bold text-primary">
                                            <?php
                                            foreach ($posisi as $p) {
                                                if ($p['id'] == $kegiatan['posisiId']) {
                                                    echo $p['posisi'];
                                                }
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="col text-start">
                                    <div class="p-3 border bg-light rounded-3">No Surat :
                                        <br>
                                        <span class="fw-bold text-primary">
                                            <?php
                                            foreach ($surat as $s) {
                                                if ($s['id'] == $kegiatan['suratId']) {
                                                    echo $s['noSurat'];
                                                }
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="col text-start">
                                    <div class="p-3 border bg-light rounded-3">Tgl Pelaksanaan :
                                        <br>
                                        <span class="fw-bold text-primary">
                                            <?= tampilTanggal($kegiatan['tglPelaksanaan']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-hover fs-4">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Part Number</th>
                                        <th scope="col">Serial Number</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($trxTcmbyKegiatan as $indeks => $t) :
                                    ?>
                                        <tr>
                                            <td scope="row"><?= $indeks + 1; ?></td>
                                            <td>
                                                <?= $t['item']; ?>

                                            </td>
                                            <td>
                                            </td>
                                            <td>

                                            </td>

                                            <td>
                                                <div class="d-flex gap-2">
                                                    <?php
                                                    // Prepare the modal ID for each TCM
                                                    $modalId = '#editTrxTcmModal' . $indeks;
                                                    ?>
                                                    <?= anchor('', '<i class="bi bi-pencil-fill"></i>', [
                                                        'class' => 'btn btn-warning',
                                                        'type' => 'button',
                                                        'data-bs-toggle' => 'modal',
                                                        'data-bs-target' => $modalId
                                                    ]); ?>

                                                    <?= form_open('tcm/hapussurat/' . $t['id'], '', ['_method' => 'DELETE']); ?>
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
                                            <?= anchor('#addTrxTcmModal', 'add', [
                                                'class' => 'link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover',
                                                'data-bs-toggle' => 'modal'
                                            ]); ?>

                                        </td>

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





    <!-- Modal Tambah Transaksi -->
    <div class="modal fade" id="addTrxTcmModal" tabindex="-1" aria-labelledby="addTrxTcmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTrxTcmModalLabel">Tambah Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table class="table table-hover fs-4">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <!-- <th scope="col">Item</th> -->
                                    <th scope="col">Part Number</th>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $lastJenisId = null;
                                foreach ($tcm as $indeks => $t) :
                                    if ($t['jenisId'] !== $lastJenisId) { ?>
                                        <!-- Judul jenis baru -->

                                        <tr class="table-success m-5 ">
                                            <td colspan="5" class="fw-bold">
                                                <?php
                                                foreach ($jenis as $j) :
                                                    if ($j['id'] == $t['jenisId']) {
                                                        echo $j['nama'];
                                                    }
                                                endforeach;
                                                ?>

                                            </td>
                                        </tr>
                                    <?php
                                        $lastJenisId = $t['jenisId'];
                                    }
                                    ?>
                                    <tr>
                                        <td scope="row"><?= $indeks + 1; ?></td>
                                        <td><?= $t['partNumber']; ?></td>
                                        <td><?= $t['serialNumber']; ?></td>
                                        <td><?= $t['status']; ?></td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <!-- Modal Edit Surat -->
    <?php
    foreach ($surat as $index => $s):
        // Prepare the modal ID for each TCM
        $modalId = 'editTrxTcmModal' . $index;
    ?>
        <div class="modal fade" id="<?= $modalId; ?>" tabindex="-1" aria-labelledby="editTrxTcmLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTrxTcmLabel">Edit Transaksi</h5>
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