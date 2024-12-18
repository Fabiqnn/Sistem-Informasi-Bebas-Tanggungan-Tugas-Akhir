<nav class="sidebar">
    <ul>
        <li class="sidebar-item header">
            <button class="toggle-btn">
                <i class="lni lni-menu-hamburger-1"></i>
                <span>Bebas Tanggungan</span>
            </button>
        </li>
        <li class="sidebar-item">
            <a href="DashboardMahasiswa.php">
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
                        <a href="../Mahasiswa/form-TA-lt7.php">
                            <span>Tanggunan Skripsi/TA</span>
                        </a>
                    </li>
                    <li>
                        <a href="../Mahasiswa/form-Prodi.php">
                            <span>Tanggunan Prodi</span>
                        </a>
                    </li>
                    <li>
                        <a href="../Mahasiswa/form-pustaka.php">
                            <span>Tanggunan Pustaka</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="sidebar-item">
            <a href="../assets/php/logout-handler.php">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</nav>
<script src="../assets/js/script-sidebar.js" defer></script>
<link rel="stylesheet" href="../assets/css/style-sidebar.css" type="text/css">
<link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css">