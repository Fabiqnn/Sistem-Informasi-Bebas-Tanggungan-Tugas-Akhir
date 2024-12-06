<?php
    session_start();
    include '../../config/db-connect.php';

    if (isset($_POST['noInduk']) && isset($_POST['pass'])) {
        $noInduk = $_POST['noInduk'];
        $pass = $_POST['pass'];

        $query = "SELECT * FROM [USER] WHERE ID_USER = ? AND PASS = ? ";
        $queryMhs = "SELECT * FROM MAHASISWA WHERE ID_USER = ?";
        $queryAdm = "SELECT * FROM ADMIN WHERE ID_USER = ?";

        $params = array($noInduk, $pass);
        $paramsUser = array($noInduk);

        $result = sqlsrv_query($conn, $query, $params);
        $resultMhs = sqlsrv_query($conn, $queryMhs, $paramsUser);
        $resultAdm = sqlsrv_query($conn, $queryAdm, $paramsUser);

        if ($result && $resultMhs && $resultAdm) {
            $row = sqlsrv_fetch_array($result);
            $rowMhs = sqlsrv_fetch_array($resultMhs);
            $rowAdm = sqlsrv_fetch_array($resultAdm);

            if ($row) {
                $_SESSION['logged-in'] = true;
                if ($row['ROLE'] === "mahasiswa") {
                    $_SESSION['nama'] = $rowMhs['NAMA_MHS'];
                    $_SESSION['noInduk'] = $rowMhs['NIM'];
                    $_SESSION['prodi'] = $rowMhs['PRODI'];
                    $_SESSION['angkatan'] = $rowMhs['ANGKATAN'];
                    $_SESSION['profil'] = $rowMhs['PATH_PROFIL_MHS'];
                    $_SESSION['role'] = $row['ROLE'];
                    header("Location: ../../Mahasiswa/DashboardMahasiswa.php");
                    exit();
                } else if ($row['ROLE'] !== "mahasiswa") {
                    $_SESSION['nama'] = $rowAdm['NAMA'];
                    $_SESSION['noInduk'] = $rowAdm['NIP'];
                    $_SESSION['profil'] = $rowAdm['PATH_FOTO_PROFIL'];
                    $_SESSION['role'] = $row['ROLE'];
                    header("Location: ../../super-admin/super-admin-dashboard.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "No Induk Atau Kata Sandi Salah";
                header("Location: ../../index.php");
                exit();
            }
        } else {
           die("Terjadi Kesalahan Dengan Query" . sqlsrv_errors());
        }   
    }
?>