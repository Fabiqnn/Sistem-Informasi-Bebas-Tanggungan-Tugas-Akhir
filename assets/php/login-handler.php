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
                switch ($row['ROLE']) {
                    case 'mahasiswa':
                        $_SESSION['nama'] = $rowMhs['NAMA_MHS'];
                        $_SESSION['noInduk'] = $rowMhs['NIM'];
                        $_SESSION['prodi'] = $rowMhs['PRODI'];
                        $_SESSION['angkatan'] = $rowMhs['ANGKATAN'];
                        $_SESSION['profil'] = $rowMhs['FOTO_MHS'];
                        $_SESSION['noTelp'] = $rowMhs['NO_WA_MHS'];
                        $_SESSION['email'] = $rowMhs['EMAIL_MHS'];
                        $_SESSION['role'] = $row['ROLE'];
                        header("Location: ../../Mahasiswa/DashboardMahasiswa.php");
                        break;

                    case 'adm_lt7':
                        $_SESSION['nama'] = $rowAdm['NAMA_ADM'];
                        $_SESSION['noInduk'] = $rowAdm['NIP'];
                        $_SESSION['profil'] = $rowAdm['PATH_FOTO_PROFIL'];
                        $_SESSION['noTelp'] = $rowAdm['NOWA_ADMIN'];
                        $_SESSION['email'] = $rowAdm['EMAIL'];
                        $_SESSION['role'] = "Admin TA";
                        header("Location: ../../admin-TA/dashboard-ta.php");
                        break;

                    case 'super_adm':
                        $_SESSION['nama'] = $rowAdm['NAMA_ADM'];
                        $_SESSION['noInduk'] = $rowAdm['NIP'];
                        $_SESSION['profil'] = $rowAdm['FOTO_ADM'];
                        $_SESSION['noTelp'] = $rowAdm['NO_WA_ADM'];
                        $_SESSION['email'] = $rowAdm['EMAIL_ADM'];
                        $_SESSION['role'] = "Super Admin";
                        header("Location: ../../super-admin/super-admin-dashboard.php");
                        break;
                        
                    case 'adm_prodi':
                        $_SESSION['nama'] = $rowAdm['NAMA_ADM'];
                        $_SESSION['noInduk'] = $rowAdm['NIP'];
                        $_SESSION['profil'] = $rowAdm['FOTO_ADM'];
                        $_SESSION['noTelp'] = $rowAdm['NO_WA_ADM'];
                        $_SESSION['email'] = $rowAdm['EMAIL_ADM'];
                        $_SESSION['role'] = "Admin Prodi";
                        header("Location: ../../admin-prodi/dashboard-prodi.php");
                        break;
                        
                    case 'adm_pustaka':
                        $_SESSION['nama'] = $rowAdm['NAMA_ADM'];
                        $_SESSION['noInduk'] = $rowAdm['NIP'];
                        $_SESSION['profil'] = $rowAdm['FOTO_ADM'];
                        $_SESSION['noTelp'] = $rowAdm['NO_WA_ADM'];
                        $_SESSION['email'] = $rowAdm['EMAIL_ADM'];
                        $_SESSION['role'] = "Admin Pustaka";
                        header("Location: ../../admin-pustaka/dashboard-pustaka.php");
                        break;
                    
                    default:
                        # code...
                        break;
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