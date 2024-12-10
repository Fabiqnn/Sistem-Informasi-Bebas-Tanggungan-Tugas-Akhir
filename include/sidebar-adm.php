<?php
$dashboardLink = 'error';
$verifikasiLink = 'error';

if (isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'Admin TA':
            $dashboardLink = '../admin-TA/dashboard-ta.php';
            $verifikasiLink = '../admin-TA/verifikasi-ta.php';
            break;
        case 'Admin Prodi':
            $dashboardLink = '../admin-prodi/dashboard-prodi.php';
            $verifikasiLink = '../admin-prodi/verifikasi-prodi.php';
            break;
        case 'Admin Pustaka':
            $dashboardLink = '../admin-pustaka/dashboard-pustaka.php';
            $verifikasiLink = '../admin-pustaka/verifikasi-pustaka.php';
            break;
        default:
            // Tetap gunakan fallback (error.php)
            break;
    }
}
?>
<nav class="sidebar">
    <ul>
        <li class="sidebar-item header">
            <button class="toggle-btn">
                <i class="lni lni-menu-hamburger-1"></i>
                <span>Bebas Tanggungan</span>
            </button>
        </li>
        <li class="sidebar-item">
            <a href="<?php echo $dashboardLink ?>">
                <i class="lni lni-home-2"></i>
                <span>Beranda</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="<?php echo $verifikasiLink ?>">
                <i class="lni lni-folder-1"></i>
                <span>Verifikasi</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="kelola-admin.php">
                <i class="lni lni-folder-1"></i>
                <span>Riwayat Verifikasi</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="../assets/php/logout-handler.php">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</nav>
<script src="../assets/js/script-sidebar-adm.js" defer></script>
<link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css">
<link rel="stylesheet" href="../assets/css/style-sidebar-adm.css">
