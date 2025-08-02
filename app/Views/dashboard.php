<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main class="col-md-9 col-lg-10 px-md-4 main-content">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
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
    <div class="row g-2">


        <div class="col-4">

            <div class="card rounded-4">
                <div class="elegant-calencar d-md-flex">
                    <div class="border border-primary wrap-header m-0 p-0 d-flex align-items-center img" style="background-image: url(assets/images/bg.jpg);">
                        <p id="reset">Today</p>
                        <div id="header" class="p-0">
                            <!-- <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div> -->
                            <div class="head-info">
                                <div class="head-month"></div>
                                <div class="head-day"></div>
                            </div>
                            <!-- <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div> -->
                        </div>
                    </div>
                    <div class="calendar-wrap">
                        <div class="w-100 button-wrap">
                            <div class="pre-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-left"></i></div>
                            <div class="next-button d-flex align-items-center justify-content-center"><i class="fa fa-chevron-right"></i></div>
                        </div>
                        <table id="calendar">
                            <thead>
                                <tr>
                                    <th>Min</th>
                                    <th>Sen</th>
                                    <th>Sel</th>
                                    <th>Rab</th>
                                    <th>Kam</th>
                                    <th>Jum</th>
                                    <th>Sab</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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

        <div class="col-4">
            <?php
            $tandaGrafik = true; //untuk aktifasi script_tag di template.php
            ?>
            <div class="card rounded-4">
                <div class="card-body">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>



</main>

<?= $this->endSection(); ?>