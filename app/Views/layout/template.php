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

    <link rel="stylesheet" href="assets/css/style.css">
    <!-- akhir calendar -->

    <style>
        /* Palet Warna Hutan Modern */
        :root {
            --color-primary-accent: #7CB342;
            /* Hijau Cerah/Limau */
            --color-secondary-bg: #E0EFE0;
            /* Krem Lembut/Abu-abu Kehijauan */
            --color-tertiary-sidebar: #2E7D32;
            /* Hijau Tua/Hutan, sesuai gambar Anda */
            --color-text-dark: #212529;
            --color-text-muted: #495057;
            --color-sidebar-text: #F8F9FA;
            /* Teks terang untuk sidebar gelap */
            --color-sidebar-hover-bg: rgba(255, 255, 255, 0.1);
            --color-submenu-hover-bg: rgba(255, 255, 255, 0.05);
            --color-sidebar-active-text: #9CCC65;
            /* Warna aktif/hover submenu */
        }

        body {
            min-height: 100vh;
            background-color: var(--color-secondary-bg);
            /* Latar belakang halaman */
            color: var(--color-text-muted);
            /* Warna teks default */
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--color-text-dark);
            /* Warna judul */
        }

        /* Gaya untuk Sidebar di Desktop */
        @media (min-width: 768px) {
            .sidebar-fixed {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 1040;
                padding: 48px 0 0;
                box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
                background-color: var(--color-tertiary-sidebar);
                /* Warna sidebar utama */
                overflow-y: auto;
            }

            .main-content {
                /* margin-left: 16.666667%; */
                margin-left: 36%;
                padding-top: 20px;
            }
        }

        /* Gaya untuk item navigasi umum di sidebar */
        .sidebar-nav .nav-link {
            font-weight: 400;
            color: var(--color-sidebar-text);
            /* Teks di sidebar gelap */
            padding: .75rem 1.25rem;
            display: flex;
            align-items: center;
        }

        .sidebar-nav .nav-link:hover {
            color: var(--color-sidebar-active-text);
            /* Warna teks hover/aktif */
            background-color: var(--color-sidebar-hover-bg);
            /* Latar belakang hover/aktif */
        }

        .sidebar-nav .nav-link.active {
            color: var(--color-sidebar-active-text);
            /* Warna teks aktif */
            background-color: var(--color-sidebar-hover-bg);
            /* Latar belakang aktif */
        }

        .sidebar-nav .nav-link i {
            margin-right: 8px;
        }

        /* Gaya untuk submenu (item collapse) */
        .sidebar-nav .collapse .nav-link {
            padding-left: 2.5rem;
            font-size: 0.95em;
            color: var(--color-sidebar-text);
            /* Teks submenu terang */
        }

        .sidebar-nav .collapse .nav-link:hover {
            background-color: var(--color-submenu-hover-bg);
            /* Latar belakang hover submenu */
            color: var(--color-sidebar-active-text);
            /* Warna teks hover submenu */
        }

        .sidebar-nav .nav-header {
            padding: 0.75rem 1.25rem;
            font-size: 0.875em;
            color: var(--color-sidebar-text);
            /* Warna teks header */
            text-transform: uppercase;
            /* Huruf kapital */
            font-weight: 600;
        }

        /* Gaya untuk ikon panah dropdown */
        .sidebar-nav .dropdown-arrow {
            margin-left: auto;
            transition: transform 0.2s ease-in-out;
        }

        .sidebar-nav .nav-link[aria-expanded="true"] .dropdown-arrow {
            transform: rotate(90deg);
        }

        /* Gaya untuk Offcanvas di mobile */
        .navbar.bg-light {
            /* Untuk navbar tombol Offcanvas */
            background-color: var(--color-secondary-bg) !important;
        }

        .navbar-brand {
            color: var(--color-text-dark);
        }

        .offcanvas.offcanvas-start {
            background-color: var(--color-tertiary-sidebar);
            /* Latar belakang Offcanvas */
        }

        .offcanvas-header {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .offcanvas-title {
            color: var(--color-sidebar-text);
            /* Teks judul Offcanvas */
        }

        .offcanvas-body .sidebar-nav {
            padding: 0;
        }

        /* Gaya untuk Kartu */
        .card {
            background-color: #FFFFFF;
            /* Putih bersih untuk kartu */
            border: 1px solid rgba(0, 0, 0, 0.1);
            justify-content: space-between;
        }

        /* Gaya untuk Tombol */
        .btn-primary {
            background-color: var(--color-primary-accent);
            border-color: var(--color-primary-accent);
            color: #FFFFFF;
        }

        .btn-primary:hover {
            background-color: #6AA538;
            /* Sedikit lebih gelap */
            border-color: #6AA538;
        }

        .btn-outline-primary {
            color: var(--color-primary-accent);
            border-color: var(--color-primary-accent);
        }

        .btn-outline-primary:hover {
            background-color: var(--color-primary-accent);
            color: #FFFFFF;
        }
    </style>
</head>

<body>

    <nav class="navbar fixed-top" style="background-color:#F7FFF7;">
        <div class="container-fluid">
            <a class="navbar-brand ms-5">Navbar</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="desktopSidebar" class="col-md-3 col-lg-2 d-none d-md-block sidebar-fixed">
                <div class="position-sticky">
                    <h5 class="text-white text-center mb-4 mt-n5">Blackshark</h5>
                    <ul class="nav flex-column sidebar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="bi bi-house-door"></i> Home
                            </a>
                        </li>
                        <br>
                        <li class="nav-header">MAIN</li>

                        <li class="nav-item">
                            <?= anchor('torpedo', '<i class="nav-icon bi bi-download"></i>Torpedo', ['class' => 'nav-link']); ?>
                        </li>

                        <li class="nav-item">
                            <a href="alattest" class="nav-link">
                                <i class="nav-icon bi bi-grip-horizontal"></i>
                                Alat Test
                            </a>
                        </li>
                        <br>
                        <li class="nav-header">SUPPORTS</li>
                        <li class="nav-item">
                            <a href="bukumerah" class="nav-link">
                                <i class="nav-icon bi bi-bookmark-star"></i>
                                Buku Merah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#submenuProdukDesktop" role="button" aria-expanded="false" aria-controls="submenuProdukDesktop">
                                <i class="nav-icon bi bi-book-half"></i> Manual Book
                                <i class="bi bi-chevron-right ms-auto dropdown-arrow"></i>
                            </a>
                            <div class="collapse" id="submenuProdukDesktop">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="#">Torpedo</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Alat Test</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="spareparts" class="nav-link">
                                <i class="nav-icon bi bi-tools"></i>
                                Spareparts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="jurnalharian" class="nav-link">
                                <i class="nav-icon bi bi-journals"></i>
                                Jurnal Harian
                            </a>
                        </li>

                        <li class="nav-item mt-auto"> <a class="nav-link" data-bs-toggle="collapse" href="#submenuAdminDesktop" role="button" aria-expanded="false" aria-controls="submenuAdminDesktop">
                                <i class="bi bi-person-circle"></i> Admin
                                <i class="bi bi-chevron-down ms-auto dropdown-arrow"></i>
                            </a>
                            <div class="collapse" id="submenuAdminDesktop">
                                <ul class="nav flex-column">
                                    <li class="nav-item"><a class="nav-link" href="#">Kelola Pengguna</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <div class="row g-4">
                    <div class="col-3">
                        <div class="card text-white mb-4" style="background-color: #2F4F4F;">
                            <h5 class="card-header">Next Activity</h5>
                            <div class="card-body">
                                <h1 class="card-title">Januari 2026</h1>
                                <p class="card-text">Class E Maintenance.</p>
                                <a href="#" class="btn btn-outline-light">Detail</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-white mb-4" style="background-color: #6B8E23" ;>
                            <h5 class="card-header">SOC Battery</h5>
                            <div class="card-body">
                                <h1 class="card-title">45,5%</h1>
                                <p class="card-text">Last updated at 23 Nov 2025.</p>
                                <a href="#" class="btn btn-outline-light">Detail</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-white mb-4" style="background-color: #B8860B" ;>
                            <h5 class="card-header">Critical Sucad</h5>
                            <div class="card-body">
                                <h1 class="card-title">35 items</h1>
                                <p class="card-text">dari 205 Sucad.</p>
                                <a href="#" class="btn btn-outline-light">Detail</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-white mb-4" style="background-color: #5A3E36 " ;>
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


                    <div class="col-6">
                        <div class="elegant-calencar d-md-flex">
                            <div class="wrap-header d-flex align-items-center img" style="background-image: url(assets/images/bg.jpg);">
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
                                            <th>Sun</th>
                                            <th>Mon</th>
                                            <th>Tue</th>
                                            <th>Wed</th>
                                            <th>Thu</th>
                                            <th>Fri</th>
                                            <th>Sat</th>
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

                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <!-- calendar -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- akhir calendar -->


    <!-- grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'], // Labels bulanan
                datasets: [{
                        label: 'SOC Baterai', // Label untuk garis pertama
                        data: [12, 19, 3, 5, 2, 3, 8, 11, 15, 10, 6, 4], // Data untuk garis pertama
                        borderColor: 'rgb(75, 192, 192)', // Warna garis untuk garis pertama
                        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna latar belakang untuk area di bawah garis pertama
                        borderWidth: 2, // Ketebalan garis
                        tension: 0.4 // Membuat garis mulus
                    },
                    {
                        label: 'KWH Baterai', // Label untuk garis kedua
                        data: [20, 22, 18, 25, 23, 20, 28, 26, 24, 21, 19, 17], // Data contoh untuk garis kedua
                        borderColor: 'rgb(255, 99, 132)', // Warna garis untuk garis kedua
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna latar belakang untuk area di bawah garis kedua
                        borderWidth: 2,
                        tension: 0.4 // Membuat garis mulus
                    }
                ]
            },
            options: {

                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                tension: 0.4,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#333',
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Grafik SOC Battery Bulanan',
                        color: '#333',
                        font: {
                            size: 18
                        }
                    }
                }

            }
        });
    </script>
    <!-- akhir grafik -->
</body>

</html>