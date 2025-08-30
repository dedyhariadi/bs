<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content fs-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h2 class="h2">Torpedo Counter Measure</h2>
    </div>


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

    <div class="accordion mt-3" id="accordionExample">

        <!-- 1. accordian Rekapitulasi -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    1. REKAPITULASI
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
                                            <td>
                                                <?php
                                                $lastTcm = null;
                                                foreach ($tcm as $row) {
                                                    if ($row['jenisId'] == $item['id']) {
                                                        $lastTcm = $row;
                                                    }
                                                }
                                                // app/Views/tcm/index.php
                                                if ($lastTcm) {
                                                    echo isset($lastTcm['posisi']) ? $lastTcm['posisi'] : '-';
                                                    // atau: echo $lastTcm['posisi'] ?? '-';
                                                } else {
                                                    echo '-';
                                                }

                                                ?>


                                            </td>
                                            <td>
                                                <?php
                                                foreach ($trxTcm as $trx) {
                                                    if ($trx['tcmId'] == $item['id']) {
                                                        // echo $trx['tanggal'];
                                                    }
                                                }
                                                ?>


                                            </td>
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


        <!-- accordian kegiatan -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-medium fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    2. KEGIATAN
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
                                        <th scope="col">Nomor Surat</th>
                                        <th scope="col">Dari</th>
                                        <th scope="col">Ke</th>
                                        <th scope="col">Tgl Pelaksanaan</th>
                                        <th scope="col">Jenis Giat</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($kegiatan as $indeks => $k) :
                                    ?>
                                        <tr>
                                            <td scope="row"><?= $indeks + 1; ?></td>
                                            <td>

                                                <?php
                                                $noSurat = '';
                                                foreach ($surat as $s) {
                                                    if ($s['id'] == $k['suratId']) {
                                                        $noSurat = $s['noSurat'];
                                                        break;
                                                    }
                                                }
                                                // echo esc($noSurat);
                                                ?>

                                                <?= anchor('tcm/surat', esc($noSurat), ['class' => 'link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover']); ?>
                                            </td>
                                            <td>
                                                <?php
                                                $namaSatkai = '';
                                                foreach ($satkai as $p) {
                                                    if ($p['id'] == $k['transferDariId']) {
                                                        $namaSatkai = $p['satkai'];
                                                        break;
                                                    }
                                                }
                                                echo esc($namaSatkai);
                                                ?>

                                            </td>
                                            <td>
                                                <?php
                                                $namaSatkai = '';
                                                foreach ($satkai as $p) {
                                                    if ($p['id'] == $k['transferKeId']) {
                                                        $namaSatkai = $p['satkai'];
                                                        break;
                                                    }
                                                }
                                                echo esc($namaSatkai);
                                                ?>

                                            </td>
                                            <td>
                                                <?= tampilTanggal($k['tglPelaksanaan']); ?>

                                            </td>
                                            <td>

                                                <?= $k['jenisGiat']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                // echo anchor('trxtcm/' . $k['id'], '<i class="bi bi-plus-square"></i>', ['class' => 'btn btn-outline-success']);
                                                ?>

                                                <?php
                                                $countTrx = 0;
                                                foreach ($trxTcm as $trx) {
                                                    if ($trx['kegiatanId'] == $k['id']) {
                                                        $countTrx++;
                                                    }
                                                }

                                                if ($countTrx > 0):
                                                    echo anchor('trxtcm/' . $k['id'], $countTrx . ' Unit', [
                                                        'class' => 'link link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover'
                                                    ]);
                                                else:
                                                    echo anchor('trxtcm/' . $k['id'], '<i class="bi bi-plus-square"></i>', [
                                                        'class' => 'btn btn-outline-primary',
                                                    ]);
                                                endif;

                                                // echo $countTrx;
                                                ?>
                                            </td>
                                            <td>
                                                <?= nl2br($k['keterangan']); ?>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <?php
                                                    // Prepare the modal ID for each TCM
                                                    $modalId = '#editKegiatanModal' . $indeks;

                                                    echo anchor('', '<i class="bi bi-pencil-fill"></i>', [
                                                        'class' => 'btn btn-outline-warning',
                                                        'type' => 'button',
                                                        'data-bs-toggle' => 'modal',
                                                        'data-bs-target' => $modalId
                                                    ]);

                                                    echo form_open('tcm/kegiatan/' . $k['id'], '', ['_method' => 'DELETE']);
                                                    echo form_button([
                                                        'name'    => 'button',
                                                        'class'   => 'btn btn-outline-danger',
                                                        'type'    => 'submit',
                                                        'content' => '<i class="bi bi-trash-fill"></i>',
                                                        'onclick' => "return confirm('Apakah anda yakin menghapus kegiatan ini?');"
                                                    ]);
                                                    echo form_close();
                                                    ?>
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


    <!-- Modal kegiatan Baru -->
    <div class="modal fade" id="addKegiatanModal" tabindex="-1" aria-labelledby="addKegiatanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKegiatanModalLabel">Tambah kegiatan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open('tcm/tambahkegiatan'); ?>
                    <div class="mb-3">
                        <label for="noSurat" class="form-label">Surat <?= anchor('tcm/surat', 'add', ['class' => 'link fs']); ?></label>
                        <?= form_dropdown('noSurat', array_column($surat, 'noSurat', 'id'), '', [
                            'class' => 'form-select fs-3',
                            'id' => 'noSurat',
                            'required' => 'required'
                        ]); ?>
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <?= form_dropdown('jenis', [
                            'Barang Masuk' => 'Barang Masuk',
                            'Barang Keluar' => 'Barang Keluar',
                            'PUT' => 'PUT',
                            'PUS' => 'PUS'
                        ], '', [
                            'class' => 'form-select fs-3',
                            'id' => 'jenis',
                            'required' => 'required'
                        ]); ?>
                    </div>
                    <div class="mb-3">
                        <label for="transferDariId" class="form-label">Dari</label>
                        <?= form_dropdown('transferDariId', array_column($satkai, 'satkai', 'id'), '', [
                            'class' => 'form-select fs-3',
                            'id' => 'transferDariId',
                            'required' => 'required'
                        ]); ?>
                    </div>
                    <div class="mb-3">
                        <label for="transferKeId" class="form-label">Ke</label>
                        <?= form_dropdown('transferKeId', array_column($satkai, 'satkai', 'id'), '', [
                            'class' => 'form-select fs-3',
                            'id' => 'transferKeId',
                            'required' => 'required'
                        ]); ?>
                    </div>
                    <div class="mb-3">
                        <label for="tglPelaksanaan" class="form-label">Tgl Pelaksanaan</label>
                        <input type="text" class="form-control tanggal-input fs-3" id="tglPelaksanaan" name="tglPelaksanaan" autocomplete="off" required>
                    </div>


                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control fs-3" id="keterangan" name="keterangan" rows="2"></textarea>
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


    <!-- Modal kegiatan Edit -->

    <?php
    foreach ($kegiatan as $indeks => $k) :
        // Cari nilai default untuk dropdown dan input
        $selectedSurat = $k['suratId'] ?? '';
        $selectedTransferDariId = $k['transferDariId'] ?? '';
        $selectedTransferKeId = $k['transferKeId'] ?? '';
        $selectedJenis = $k['jenisGiat'] ?? '';
        $tglPelaksanaan = $k['tglPelaksanaan'] ?? '';
        $keterangan = $k['keterangan'] ?? '';
    ?>
        <div class="modal fade" id="editKegiatanModal<?= $indeks; ?>" tabindex="-1" aria-labelledby="editKegiatanModalLabel<?= $indeks; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editKegiatanModalLabel<?= $indeks; ?>">Edit Kegiatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= form_open('tcm/kegiatan/' . $k['id']); ?>
                        <div class="mb-3">
                            <label for="noSurat<?= $indeks; ?>" class="form-label">Surat <?= anchor('tcm/surat', 'add', ['class' => 'link fs']); ?></label>
                            <?= form_dropdown('noSurat', array_column($surat, 'noSurat', 'id'), $selectedSurat, [
                                'class' => 'form-select fs-3',
                                'id' => 'noSurat' . $indeks,
                                'required' => 'required'
                            ]); ?>
                        </div>
                        <div class="mb-3">
                            <label for="transferDariId" class="form-label">Dari</label>
                            <?= form_dropdown('transferDariId', array_column($satkai, 'satkai', 'id'), $selectedTransferDariId, [
                                'class' => 'form-select fs-3',
                                'id' => 'transferDariId',
                                'required' => 'required'
                            ]); ?>
                        </div>
                        <div class="mb-3">
                            <label for="transferKeId" class="form-label">Ke</label>
                            <?= form_dropdown('transferKeId', array_column($satkai, 'satkai', 'id'), $selectedTransferKeId, [
                                'class' => 'form-select fs-3',
                                'id' => 'transferKeId',
                                'required' => 'required'
                            ]); ?>
                        </div>
                        <div class="mb-3">
                            <label for="tglPelaksanaan<?= $indeks; ?>" class="form-label">Tgl Pelaksanaan</label>
                            <input type="text" class="form-control tanggal-input fs-3" id="tglPelaksanaan<?= $indeks; ?>" name="tglPelaksanaan" value="<?= tampilTanggal(esc($tglPelaksanaan)); ?>" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis<?= $indeks; ?>" class="form-label">Jenis</label>
                            <?= form_dropdown('jenis', [
                                'Barang Masuk' => 'Barang Masuk',
                                'Barang Keluar' => 'Barang Keluar',
                                'PUT' => 'PUT',
                                'PUS' => 'PUS'
                            ], $selectedJenis, [
                                'class' => 'form-select fs-3',
                                'id' => 'jenis' . $indeks,
                                'required' => 'required'
                            ]); ?>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan<?= $indeks; ?>" class="form-label">Keterangan</label>
                            <textarea class="form-control fs-3" id="keterangan<?= $indeks; ?>" name="keterangan" rows="2"><?= esc($keterangan); ?></textarea>
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


    </div>


    <?= $this->endSection(); ?>