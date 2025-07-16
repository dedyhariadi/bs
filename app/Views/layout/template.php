<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Testbench - TPO Blackshark</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- calender -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <?= link_tag('assets/css/style.css'); ?>
    <!-- akhir calendar -->

    <?= link_tag('assets/css/style2.css'); ?>

</head>

<body>

    <?= $this->include('layout/navbar'); ?>

    <div class="container-fluid">
        <div class="row">

            <?= $this->include('layout/sidebar'); ?>

            <?= $this->renderSection('content'); ?>


        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>


    <!-- awal kalender -->
    <?php
    echo script_tag('assets/js/jquery.min.js');
    echo script_tag('assets/js/popper.js');
    echo script_tag('assets/js/bootstrap.min.js');
    echo script_tag('assets/js/main.js');
    ?>
    <!-- akhir calendar -->


    <!-- grafik -->


    <?php

    echo script_tag('https://cdn.jsdelivr.net/npm/chart.js');
    echo script_tag('assets/js/skripku.js');

    ?>


    <!-- akhir grafik -->
</body>

</html>