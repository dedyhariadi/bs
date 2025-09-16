<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>



<main class="col-md-9 col-lg-10 px-md-4 main-content">


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Torpedo Countermeasure</h1>
    </div>



    <div class="text-center fw-bold fs-2 mt-4 mb-3">
        Rekapitulasi
    </div>


    <div class="row">
        <div class="col-12">
            <table class="table table-hover fs-5" style="background-color:#F7FFF7;">
                <thead>
                    <tr class="text-center align-middle">
                        <th scope="col" rowspan="2">#</th>
                        <th scope="col" rowspan="2">ITEM</th>
                        <th scope="col" rowspan="2">JUMLAH</th>
                        <th scope="col" colspan="2">POSISI</th>
                        <th scope="col" colspan="2">KONDISI</th>
                        <th scope="col"></th>
                    </tr>
                    <tr class="text-center align-middle">
                        <th>ARSENAL</th>
                        <th>SATKAI</th>
                        <th>OK</th>
                        <th>NOT OK</th>
                        <th></th>
                    </tr>
                <tbody>
                    <?php foreach ($jenisTcm as $index => $item): ?>
                        <tr class="fs-4">
                            <td scope="row" class="text-center"><?= $index + 1; ?></td>
                            <th class="ps-5 text-uppercase"><?= $item['nama']; ?></th>
                            <td class="text-center">
                                <?php
                                $cetak = 0;
                                foreach ($jenisTcmCount as $itemTcmCount):
                                    if ($itemTcmCount['jenisId'] === $item['id']) :
                                        $cetak = $itemTcmCount['count'];
                                    endif;
                                endforeach;
                                echo $cetak;
                                ?>
                                &nbsp;Unit
                            </td>
                            <td>
<?php 
foreach ($jumlahTcmByJenisSatkai as $itemJumlah):
    if ($itemJumlah['jenisId'] === $item['id']) :
        echo $itemJumlah['jenis'] . ' (' . $itemJumlah['tcmCount'] . ')';
    endif;
?>

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>


                                <?= form_open('tcm/rekap/deleteJenisTcm', '', ['_method' => 'DELETE', 'class' => 'form-control', 'id' => $item['id']]); ?>

                                <?= anchor('tcm/rekap/detail/' . $item['id'], '<i class="bi bi-zoom-in"></i>', ['class' => 'btn btn-outline-success']); ?> &nbsp;


                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editJenisModal<?= $item['id']; ?>"> <i class="bi bi-pen-fill"></i>
                                </button>&nbsp;

                                <?= form_button([
                                    'class'   => 'btn btn-outline-danger d-inline',
                                    'type'    => 'submit',
                                    'content' => '<i class="bi bi-trash3"></i>',
                                    'onclick' => "return confirm('Apakah anda yakin menghapus ini?');"
                                ]); ?>

                                <?= form_close(); ?>



                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th scope="row"></th>
                        <td class="text-start pt-4 ps-5 fw-bold" colspan="7">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add Jenis TCM
                            </button>
                        </td>
                    </tr>
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

    <!-- Edit Jenis Modal -->
    <?php
    foreach ($jenisTcm as $item):
        // Modal untuk setiap item jika diperlukan
    ?>
        <div class="modal modal-lg" id="editJenisModal<?= $item['id']; ?>" tabindex="-1" aria-labelledby="editJenisModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editJenisModalLabel">Edit Jenis TCM</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('tcm/rekap/editJenis/' . $item['id']); ?>
                        <div class="mb-5">
                            <input type="text" class="form-control fs-2" id="editJenisNama" name="nama" value="<?= $item['nama']; ?>" required autocomplete="off">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endforeach;
    ?>







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