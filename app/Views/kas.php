<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">KAS Testbench</h1>
    </div>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransaksiModal">
        add Transaksi
    </button>
    <br><br>
    <?php d($masukan); ?>
    <div class="row">
        <div class="col-12">
            <table class="table table-hover" style="background-color:#F7FFF7;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Uraian</th>
                        <th scope="col">Pemasukan</th>
                        <th scope="col">Pengeluaran</th>
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
                            <td><?= $k['tanggal']; ?></td>
                            <td><?= $k['keterangan']; ?></td>
                            <td><?= $k['pemasukan']; ?></td>
                            <td><?= $k['pengeluaran']; ?></td>
                            <td><i class="bi bi-pencil-fill"></i>&nbsp;<i class="bi bi-trash-fill"></i></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    <tr class="fw-bold">
                        <th scope="row"></th>
                        <td></td>
                        <td class="text-end pe-5">JUMLAH</td>
                        <td>Rp 25.000,-</td>
                        <td>Rp 36.000,-</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


</main>

<div class="modal fade" id="addTransaksiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= form_open(''); ?>
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Transaksi Baru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <label for="Uraian" class="form-label">Uraian</label>
                <input class="form-control form-control-lg" type="text" id="uraian" name="uraian" placeholder="Masukkan uraian transaksi">
                <br>

                <!-- <label for="jenisTransaksi" class="form-label">Jenis Transaksi</label> -->
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

<?= $this->endSection(); ?>