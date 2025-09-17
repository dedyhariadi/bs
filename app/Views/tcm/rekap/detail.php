<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>



<main class="col-md-9 col-lg-10 px-md-4 main-content">





    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Torpedo Countermeasure</h1>
    </div>



    <div class="text-center fw-bold fs-2 mt-4 mb-3">
        <?= $jenisTcm['nama']; ?>
    </div>
    <div class="fs-3 my-3">
        <?= anchor('tcm', '< back', ['class' => 'link-success link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover']) ?>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table table-hover fs-5" style="background-color:#F7FFF7;">
                        <thead>
                            <tr class="text-center align-middle">
                                <th scope="col">#</th>
                                <th scope="col">PART NUMBER</th>
                                <th scope="col">SERIAL NUMBER</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">KONDISI</th>
                                <th scope="col">POSISI</th>
                                <th scope="col">HISTORY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($detailTcm as $index => $item): ?>
                                <tr class="text-center align-middle">
                                    <td><?= $index + 1; ?></td>
                                    <td><?= $item['partNumber']; ?></td>
                                    <td>
                                        <?= anchor('', $item['serialNumber'], ['class' => 'link-success link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#historyTcmModal' . $item['tcmId']]) ?>
                                    </td>
                                    <td><?= $item['status']; ?></td>
                                    <td><?= $item['kondisi_terakhir']; ?></td>
                                    <td><?= $item['posisi_terakhir']; ?></td>
                                    <td>


                                        <?= anchor('', '<i class="bi bi-zoom-in"></i>', ['class' => 'btn btn-outline-success', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#historyTcmModal' . $item['tcmId']]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="fs-5 my-3">
        <?= anchor('', 'Download Manualbook', ['class' => 'link-success link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover']) ?>
    </div>

    <!-- History TCM Modal -->
    <?php foreach ($detailTcm as $index => $item): ?>
        <div class="modal modal-lg" id="historyTcmModal<?= $item['tcmId'] ?>" tabindex="-1" aria-labelledby="historyTcmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="historyTcmModalLabel">History TCM</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">



                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-header">
                                        Part Number:
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $item['partNumber'] ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card bg-success text-white">
                                    <div class="card-header">
                                        Serial Number:
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $item['serialNumber'] ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card bg-warning text-dark">
                                    <div class="card-header">
                                        Status:
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $item['status'] ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card bg-info text-dark">
                                    <div class="card-header">
                                        Kondisi Terakhir:
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $item['kondisi_terakhir'] ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col fw-bold fs-5 text-start mt-3">
                                History Penempatan TCM
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th scope="col" rowspan="2">#</th>
                                            <th scope="col" colspan="2">TANGGAL</th>
                                            <th scope="col" rowspan="2">DURASI</th>
                                            <th scope="col" rowspan="2">SATKAI</th>
                                            <th scope="col" rowspan="2">KONDISI</th>
                                        </tr>
                                        <tr class="text-center align-middle">
                                            <th scope="col">DARI</th>
                                            <th scope="col">SAMPAI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">

                                        <?php
                                        $noUrut = 1;
                                        // Hitung matchingHistory sekali di luar loop
                                        $matchingHistory = [];
                                        foreach ($historyTcm as $tcm) {
                                            if ($tcm['tcmId'] == $item['tcmId']) {
                                                $matchingHistory[] = $tcm;
                                            }
                                        }
                                        // Loop untuk menampilkan
                                        for ($i = 0; $i < count($matchingHistory); $i++) {
                                            $tcm = $matchingHistory[$i];
                                            // Hitung durasi
                                            $fromDate = new DateTime($tcm['tgl_pelaksanaan']);
                                            if ($i < count($matchingHistory) - 1) {
                                                $toDate = new DateTime($matchingHistory[$i + 1]['tgl_pelaksanaan']);
                                                $toDate->modify('-1 day');
                                            } else {
                                                $toDate = new DateTime();  // Tanggal sekarang untuk record terakhir
                                            }
                                            $interval = $fromDate->diff($toDate);
                                            $durasi = $interval->days;
                                        ?>
                                            <tr>
                                                <td><?= $noUrut++; ?></td>
                                                <td><?= tampiltanggal($tcm['tgl_pelaksanaan']) ?></td>
                                                <td>
                                                    <?php
                                                    if ($i < count($matchingHistory) - 1) {
                                                        echo tampiltanggal($toDate->format('Y-m-d'));
                                                    } else {
                                                    ?>
                                                        <span class="text-success fw-medium fst-italic">Sekarang</span>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center"><?= $durasi; ?> hari</td> <!-- Tambah kolom durasi -->
                                                <td class="text-center"><?= $tcm['posisi'] ?></td>
                                                <td class="text-center"><?= $tcm['kondisi'] ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="submit" class="btn btn-primary">Simpan</button> -->
                        </div>





                    </div>
                </div>
            </div>
        </div>
    <?php
    endforeach;
    ?>









</main>



<?= $this->endSection(); ?>