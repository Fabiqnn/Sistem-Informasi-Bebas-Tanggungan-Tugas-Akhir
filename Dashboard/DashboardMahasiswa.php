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
        <nav id="sidebar">
            <ul>
                <li class="sidebar-item">
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

        <div class="banner">
            <div class="img-container">
                <div class="filter"></div>
            </div>
            <div class="judul">
                <h1>Sistem Bebas Tanggungan</h1>
            </div>
        </div>

        <div class="profile">

        </div>
    </div>

    <!-- <div class="footer"></div> -->

    <script src="script.js"></script>
</body>

</html>