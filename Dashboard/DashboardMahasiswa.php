<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleMahasiwa.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css" />
    <title>Dashboard Mahasiswa</title>
</head>

<body>
    <header></header>

    <div class="body">
        <nav class="sidebar">
            <ul>
                <li class="sidebar-item header">
                    <button class="toggle-btn">
                        <i class="lni lni-menu-hamburger-1"></i>
                        <span>Bebas Tanggungan</span>
                    </button>
                </li>
                <li class="sidebar-item">
                    <a href="#">
                        <i class="lni lni-home-2"></i>
                        <span>Beranda</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#">
                        <i class="lni lni-bulb-4"></i>
                        <span>Informasi Tanggungan</span>
                    </a>
                </li>
                <li class="sidebar-item dropdown"> <!--ini dropdown-->
                    <Button class="dropdown-btn">
                        <i class="lni lni-folder-1"></i>
                        <span>Form Bebas Tanggungan</span>
                        <i class="lni lni-chevron-left dropdown-icon"></i>
                    </Button>
                    <div class="dropdown-content">
                        <ul>
                            <li>
                                <a href="#">
                                    <span>Tanggunan Skripsi/TA</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span>Tanggunan Prodi</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span>Tanggunan Pustaka</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-item">
                    <a href="#">
                        <i class="lni lni-exit"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="main-content">
            <div class="banner">
                <div id="img-container1">
                    <div class="filter"></div>
                </div>
                <div class="judul">
                    <h1>Sistem Bebas Tanggungan</h1>
                </div>
            </div>

            <div class="card-container">
                <h3>SELAMAT DATANG</h3>
                <hr id="hr-1">
                <div class="profile">
                    <div id="img-container2">
                        <img src="jurica-koletic-7YVZYZeITc8-unsplash.jpg" alt="profile picture">
                    </div>
                    <div id="credential">
                        <h4 id="h4-1">Hai' </h4> <h4 id="h4-2">Fabian Hasbillah</h4>
                        <hr id="hr-2">
                        <h5>No Induk : 2341720170</h5>
                        <h5>Jurusan  : Teknik Informatika</h5>
                        <h5>Prodi    : D4</h5>
                    </div>
                </div>

                <h3>Riwayat Permintaan</h3>
                <div class="request">
                    <button class="riwayat-btn" id="ta-btn">Bebas Tanggungan/TA
                        <i class="lni lni-chevron-left dropdown-icon"></i>
                    </button>

                    <div class="verifikasi">
                        <p>halo</p>
                        <!-- kontainer table -->
                    </div>

                    <button class="riwayat-btn" id="prodi-btn">Bebas Tanggungan Prodi TI
                        <i class="lni lni-chevron-left dropdown-icon"></i>
                    </button>

                    <div class="verifikasi">
                        <p>halo</p>
                         <!-- kontainer table -->
                    </div>

                    <button class="riwayat-btn" id="perpus-btn">Bebas Tanggungan Perpustakaan
                        <i class="lni lni-chevron-left dropdown-icon"></i>
                    </button>
                        
                    <div class="verifikasi">
                        <p>halo</p>
                         <!-- kontainer table -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="footer"></div> -->

    <script src="script.js"></script>
</body>

</html>