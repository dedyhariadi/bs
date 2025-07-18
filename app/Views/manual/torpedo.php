<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Manual Torpedo</h1>
    </div>

    <div class="row g-4">
        <div class="col-3">
            <div class="card text-white rounded-4 mb-4" style="background-color: #2F4F4F;">
                <h5 class="card-header">Next Activity</h5>
                <div class="card-body">
                    <h1 class="card-title">Januari 2026</h1>
                    <p class="card-text">Class E Maintenance.</p>
                    <a href="#" class="btn btn-outline-light">Detail</a>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card text-white rounded-4 mb-4" style="background-color: #6B8E23" ;>
                <h5 class="card-header">SOC Battery</h5>
                <div class="card-body">
                    <h1 class="card-title">45,5%</h1>
                    <p class="card-text">Last updated at 23 Nov 2025.</p>
                    <a href="#" class="btn btn-outline-light">Detail</a>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card rounded-4 text-white mb-4" style="background-color: #B8860B" ;>
                <h5 class="card-header">Critical Sucad</h5>
                <div class="card-body">
                    <h1 class="card-title">35 items</h1>
                    <p class="card-text">dari 205 Sucad.</p>
                    <a href="#" class="btn btn-outline-light">Detail</a>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card rounded-4 text-white mb-4" style="background-color: #5A3E36 " ;>
                <h5 class="card-header">Penembakan</h5>
                <div class="card-body">
                    <h1 class="card-title">4 kali</h1>
                    <p class="card-text">Last Firing at 23 Des 2024.</p>
                    <a href="#" class="btn btn-outline-light">Detail</a>
                </div>
            </div>
        </div>

    </div>
    <br>




</main>

<?= $this->endSection(); ?>