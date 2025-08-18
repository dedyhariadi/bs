<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content">


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
        <h1 class="h2">KAS Testbench</h1>
    </div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransaksiModal">
        add Transaksi
    </button>
    <br><br>



    <div class="row">
        <div class="col-12">
            <table class="table table-hover fs-5" style="background-color:#F7FFF7;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">HARI, TANGGAL</th>
                        <th scope="col">URAIAN</th>
                        <th scope="col" class="text-end">PEMASUKAN</th>
                        <th scope="col" class="text-end">PENGELUARAN</th>
                        <th scope="col" class="text-end">SALDO</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($kas as $k):
                    ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td>
                                <?= tampilTanggal($k['tanggal']); ?>
                            </td>
                            <td><?= $k['keterangan']; ?></td>
                            <td class="text-end"><?= number_format($k['pemasukan'], 0, ",", "."); ?></td>
                            <td class="text-end"><?= number_format($k['pengeluaran'], 0, ",", "."); ?></td>
                            <td class="text-end">
                                <?php
                                // Hitung saldo sampai baris ini
                                static $saldo = 0;
                                $saldo += $k['pemasukan'] - $k['pengeluaran'];
                                echo number_format($saldo, 0, ",", ".");
                                ?>
                            </td>
                            <td class="text-center">
                                <?php
                                $data = [
                                    'type'    => 'button',
                                    'class'  => 'btn btn-outline-warning border-0',
                                    'data-bs-toggle' => 'modal',
                                    'data-bs-target' => '#editTransaksiModal' . $k['id'],
                                    'content' => '<i class="bi bi-pencil"></i>',
                                ];
                                echo form_button($data);
                                ?>

                                <?= form_open('kas/' . $k['id'], ['class' => 'd-inline'], ['_method' => 'DELETE']); ?>

                                <button type="submit" class="btn btn-outline-danger border-0" onclick="return confirm('apakah anda yakin menghapusnya?');"><i class="bi bi-x-square "></i></button>

                                <?= form_close(); ?>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td class="text-end pe-5 fw-bold">JUMLAH</td>
                        <td class="text-end">
                            <?php
                            echo number_format(array_sum(array_column($kas, 'pemasukan')), 0, ",", ".");
                            ?>
                        </td>
                        <td class="text-end">
                            <?php
                            echo number_format(array_sum(array_column($kas, 'pengeluaran')), 0, ",", ".");
                            ?>
                        </td>
                        <td class="text-end fw-bold">
                            <?php
                            echo number_format(array_sum(array_column($kas, 'pemasukan')) - array_sum(array_column($kas, 'pengeluaran')), 0, ",", ".");
                            ?>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-12 text-start ms-5">
            <h4>Saldo Akhir:
                <span class="fw-bold">
                    <?php
                    $saldoAkhir = array_sum(array_column($kas, 'pemasukan')) - array_sum(array_column($kas, 'pengeluaran'));
                    echo number_format($saldoAkhir, 0, ",", ".");
                    ?>
                    <br>
                    <h5 class="text-capitalize fst-italic"> <?= terbilang($saldoAkhir) . " rupiah"; ?></h5>
                    <?php
                    if ($saldoAkhir < 0) {
                        echo '<span class="text-danger">Saldo Negatif</span>';
                    } elseif ($saldoAkhir > 0) {
                        echo '<span class="text-success">Saldo Positif</span>';
                    } else {
                        echo '<span class="text-secondary">Saldo Nol</span>';
                    }
                    ?>
                </span>
            </h4>
        </div>
    </div>

</main>

<!-- modal tambah transaksi -->
<div class="modal modal-lg" id="addTransaksiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= form_open(''); ?>
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Transaksi Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <label for="tanggal" class="form-label">Tanggal</label>
                <input class="form-control form-control-lg tanggal-input" type="text" name="tanggal" autocomplete="off" required>
                <br>

                <label for="Uraian" class="form-label">Uraian</label>
                <input class="form-control form-control-lg" type="text" id="uraian" name="uraian">
                <br>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenisTransaksi" id="radioDefault1" value="pemasukan">
                    <label class="form-check-label" for="radioDefault1">
                        Pemasukan
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenisTransaksi" id="radioDefault2" value="pengeluaran" checked>
                    <label class="form-check-label" for="radioDefault2">
                        Pengeluaran
                    </label>
                </div>
                <br>
                <label for="jumlah" class="form-label">Jumlah</label>
                <input class="form-control form-control-lg" type="text" id="jumlah" name="jumlah">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<!-- akhir modal tambah transaksi -->

<!-- modal EDIT transaksi -->
<?php foreach ($kas as $k): ?>
    <div class="modal modal-lg" id="<?= 'editTransaksiModal' . $k['id']; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?= form_open('kas/edit/' . $k['id']); ?>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Transaksi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input class="form-control form-control-lg tanggal-input" type="text" name="tanggal" value="<?= tampilTanggal($k['tanggal']); ?>" autocomplete="off" required>
                    <br>

                    <label for="Uraian" class="form-label">Uraian</label>
                    <input class="form-control form-control-lg" type="text" id="uraian" name="uraian" placeholder="Masukkan uraian transaksi" value="<?= $k['keterangan']; ?>">
                    <br>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenisTransaksi" id="radioDefault1" value="pemasukan" <?= $k['pemasukan'] > 0 ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="radioDefault1">
                            Pemasukan
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenisTransaksi" id="radioDefault2" value="pengeluaran" <?= $k['pengeluaran'] > 0 ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="radioDefault2">
                            Pengeluaran
                        </label>
                    </div>
                    <br>
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input class="form-control form-control-lg" type="text" id="jumlah" name="jumlah" value="<?= $k['pemasukan'] > 0 ? $k['pemasukan'] : $k['pengeluaran']; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- akhir modal EDIT transaksi -->



<?= $this->endSection(); ?>