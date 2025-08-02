<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kas Testbench</h1>
    </div>

    <!-- ========== table components start ========== -->
    <div class="container-fluid">
        <table class="col-md-12 border">
            <thead>
                <th style="width: 5%;">No</th>
                <th>Uraian</th>
                <th>Uang Masuk</th>
                <th>Uang Keluar</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Beli Nasi Padang</td>
                    <td></td>
                    <td>Rp 75.000,-</td>
                    <td>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <!-- BARIS KEDUA YANG DITAMBAHKAN DAN DIPERBAIKI -->
                <tr>
                    <td>2</td>
                    <td>Jual Sparepart</td>
                    <td>Rp 150.000,-</td>
                    <td></td>
                    <td>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <!-- Anda bisa menambahkan baris lain di sini -->
            </tbody>
        </table>
    </div>
    <!-- ========== table components end ========== -->

</main>

<?= $this->endSection(); ?>