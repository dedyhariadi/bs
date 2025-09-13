<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPO Blackshark</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- jquery -->
    <?= link_tag('assets/css/jquery-ui.css', 'stylesheet'); ?>

    <!-- css ku -->
    <?= link_tag('assets/css/style.css'); ?>

    <!-- Favicon icon -->
    <?= link_tag('assets/images/apple-touch-icon.png', 'apple-touch-icon'); ?>
    <?= link_tag('assets/images/favicon-32x32.png', 'icon', 'image/png'); ?>
    <?= link_tag('assets/images/favicon-16x16.png', 'icon', 'image/png'); ?>


</head>

<body>

    <?= $this->include('layout/navbar'); ?>

    <div class="container-fluid">
        <!-- <div class="container"> -->
        <div class="row">

            <?= $this->include('layout/sidebar'); ?>

            <?= $this->renderSection('content'); ?>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <!--jquery -->
    <?= script_tag('assets/js/jquery-3.7.1.min.js'); ?>
    <?= script_tag('assets/js/jquery-ui.min.js'); ?>


    <!-- awal grafik -->
    <?= script_tag('https://cdn.jsdelivr.net/npm/chart.js'); ?>
    <?= script_tag('assets/js/skripGrafik.js'); ?>
    <!-- akhir grafik -->

    <!-- skripku -->
    <?= script_tag('assets/js/myscript.js'); ?>

    <script>
        // Fungsi global untuk menangani semua form submit dan mencegah double-click
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Script global loaded'); // Tambahkan ini untuk cek
            document.addEventListener('submit', function(event) {
                console.log('Form submitted:', event.target); // Tambahkan ini untuk cek submit
                const form = event.target;
                const submitButton = form.querySelector('button[type="submit"]');
                if (submitButton) {
                    console.log('Button found, disabling...'); // Tambahkan ini
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
                }
            });

            // Opsional: Reset tombol jika modal ditutup tanpa submit (untuk UX)
            document.addEventListener('hidden.bs.modal', function(event) {
                const modal = event.target;
                const form = modal.querySelector('form');
                if (form) {
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.innerHTML = 'Simpan'; // Reset teks
                    }
                }
            });
        });
    </script>
</body>

</html>