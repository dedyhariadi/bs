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
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($trxTcmbyKegiatan as $indeks => $t) :
                                    ?>
                                        <tr>
                                            <td scope="row"><?= $indeks + 1; ?></td>
                                            <td>
                                                <?php
                                                foreach ($jenis as $j) :
                                                    if ($j['id'] == $t['jenisId']) {
                                                        echo $j['nama'];
                                                    }
                                                endforeach;
                                                ?>
                                            </td>
                                            <td>
                                                <?= $t['partNumber']; ?>
                                            </td>
                                            <td>
                                                <?= $t['serialNumber']; ?>
                                            </td>
                                            <td>
                                                <?= $t['status']; ?>
                                            </td>
                                            <td>

                                            </td>

                                            <td>
                                                <div class="d-flex gap-2">


                                                    <?= form_open('tcm/hapussurat/' . $t['id'], '', ['_method' => 'DELETE']); ?>
                                                    <?= form_button([
                                                        'name'    => 'button',
                                                        'class'   => 'btn btn-outline-danger',
                                                        'type'    => 'submit',
                                                        'content' => '<i class="bi bi-x-lg"></i>',
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
                                        <td colspan="5">
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


                                    <?= form_open('trxtcm/' . $kegiatan['id'], '', ['tcmId' => $t['id']]); ?>

                                    <tr style="cursor:pointer;" onclick="this.closest('form').submit();">
                                        <td scope="row"><?= $indeks + 1; ?></td>
                                        <td><?= $t['partNumber']; ?></td>
                                        <td><?= $t['serialNumber']; ?></td>
                                        <td><?= $t['status']; ?></td>
                                        <td>
                                            <?= form_button([
                                                'name'    => 'button',
                                                'class'   => 'btn btn-outline-primary',
                                                'type'    => 'submit',
                                                'content' => '<i class="bi bi-plus-square-dotted"></i>',
                                                // 'onclick' => "return confirm('Apakah anda yakin menghapus sub kegiatan?');"
                                            ]); ?>
                                        </td>
                                    </tr>


                                    <?= form_close(); ?>

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










    <?= $this->endSection(); ?>