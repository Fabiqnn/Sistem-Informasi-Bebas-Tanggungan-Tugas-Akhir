<?php
    session_start();

    if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
        header("Location: ../index.php");
        exit();
    } 
    
    if ($_SESSION['role'] !== 'mahasiswa') {
        header("Location: ../index.php");
        exit();
    }

    if (!isset($_GET['adm'])) {
        header("Location: ../../Mahasiswa/DashboardMahasiswa.php?error=1");
        exit();
    }

    include '../../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['noInduk']; 
    $current_timestamp = date('Y-m-d H:i:s');

    if ($_GETp['adm' === '1']) {
        $upload_dir = '../uploaded-file/form-ta/';
        $delete_dir = '../uploaded-file/delete-ta/';
        
        if (!is_dir($delete_dir)) {
            mkdir($delete_dir, 077, true);
        }

        $sqlGetName = "SELECT
                        FILE_LAPORAN_TA,
                        PROGRAM_TA,
                        PUBLIKASI
                    FROM FORM_TA
                    WHERE NIM = ?";
        $paramsGet = array($id_user);
        $result = sqlsrv_query($conn, $sqlGetName, $paramsGet);
    
        if ($result === false) {
            die("error query GetName" . print_r(sqlsrv_errors(), true));
            exit();
        }
        
        $getName = sqlsrv_fetch_array($result);
        $file_laporan_ta = $getName['FILE_LAPORAN_TA'];
        $file_program = $getName['PROGRAM_TA'];
        $file_publikasi = $getName['PUBLIKASI'];

        if ($_FILES['up-laporan-ta']['error'] !== UPLOAD_ERR_NO_FILE) {
            recycleBin($getName['FILE_LAPORAN_TA'], $upload_dir, $delete_dir);
            $file_laporan_ta = uploadFile($_FILES['up-laporan-ta'], $upload_dir, 'Laporan TA');
        } 

        if ($_FILES['up-program']['error'] !== UPLOAD_ERR_NO_FILE) {
            recycleBin($getName['PROGRAM_TA'], $upload_dir, $delete_dir);
            $file_program = uploadFile($_FILES['up-program'], $upload_dir, 'Program TA');
        }

        if ($_FILES['up-publikasi']['error'] !== UPLOAD_ERR_NO_FILE) {
            $file_publikasi = uploadFile($_FILES['up-publikasi'], $upload_dir, 'Publikasi File');
        }
    
        $sql = "UPDATE FORM_TA 
                SET FILE_LAPORAN_TA = ?,
                    PROGRAM_TA = ?,
                    PUBLIKASI = ?,
                    FORM_TA_UPDATED = ?
                WHERE NIM = ?";
    
        $params = array(
            $file_laporan_ta,
            $file_program,
            $file_publikasi,
            $current_timestamp,
            $id_user
        );
    
        $stmt = sqlsrv_query($conn, $sql, $params);
    
        if ($stmt === false) {
            die("error update database " . print_r(sqlsrv_errors(), true));
        } else {
            header("Location: ../../Mahasiswa/form-edit-ta.php?adm=1");
            exit();
        }

    } else if ($_GET['adm'] === '2') {
                // Ambil data file lama dari database
        $sqlGetName = "SELECT
                            BUKU_SKRIPSI,
                            LAPORAN_PKL,
                            BEBAS_KOMPEN
                        FROM FORM_PRODI
                        WHERE NIM = ?";
        $paramsGet = array($id_user);
        $result = sqlsrv_query($conn, $sqlGetName, $paramsGet);

        if ($result === false) {
            die("error query GetName" . print_r(sqlsrv_errors(), true));
            exit();
        }

        $getName = sqlsrv_fetch_array($result);

        // Variabel untuk menyimpan nama file yang akan diupdate
        $file_buku_skripsi = $getName['BUKU_SKRIPSI']; // Default: file lama
        $file_laporan_pkl = $getName['LAPORAN_PKL'];   // Default: file lama
        $file_bukti_bebas_kompen = $getName['BEBAS_KOMPEN']; // Default: file lama

        // Cek jika file baru diunggah
        if ($_FILES['up-skripsi']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Hapus file lama
            recycleBin($getName['BUKU_SKRIPSI'], $upload_dir, $delete_dir);
            // Unggah file baru
            $file_buku_skripsi = uploadFile($_FILES['up-skripsi'], $upload_dir, 'Buku Skripsi');
        }

        if ($_FILES['up-pkl']['error'] !== UPLOAD_ERR_NO_FILE) {
            recycleBin($getName['LAPORAN_PKL'], $upload_dir, $delete_dir);
            $file_laporan_pkl = uploadFile($_FILES['up-pkl'], $upload_dir, 'Laporan PKL');
        }

        if ($_FILES['up-kompen']['error'] !== UPLOAD_ERR_NO_FILE) {
            recycleBin($getName['BEBAS_KOMPEN'], $upload_dir, $delete_dir);
            $file_bukti_bebas_kompen = uploadFile($_FILES['up-kompen'], $upload_dir, 'Bukti Bebas Kompen');
        }

        // Update database
        $sql = "UPDATE FORM_PRODI
                SET BUKU_SKRIPSI = ?,
                    LAPORAN_PKL = ?,
                    BEBAS_KOMPEN = ?,
                    FORM_PRODI_UPDATED = ?
                WHERE NIM = ?";
        $params = array(
                    $file_buku_skripsi,
                    $file_laporan_pkl,
                    $file_bukti_bebas_kompen,
                    $current_timestamp,
                    $id_user
                );
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            die("error update database " . print_r(sqlsrv_errors(), true));
            exit();
        } else {
            header("Location: ../../Mahasiswa/form-edit-prodi.php?adm=2");
            exit();
        }

    } else if ($_GET['adm'] === '3') {
        $upload_dir = '../uploaded-file/form-pustaka/';
        $delete_dir = '../uploaded-file/delete-pustaka/';
        
        if (!is_dir($delete_dir)) {
            mkdir($delete_dir, 0777, true); // Ubah 077 menjadi 0777 untuk izin penuh
        }
        
        // Ambil data file lama dari database
        $sqlGetName = "SELECT
                            FILE_BEBAS_KOMPEN,
                            FILE_PENDAHULUAN,
                            FILE_ABSTRAK,
                            BAB_1,
                            BAB_2,
                            BAB_3,
                            BAB_4,
                            BAB_5,
                            BAB_6,
                            BAB_7,
                            FILE_DAFTAR_PUSTAKA,
                            FILE_LAMPIRAN,
                            FILE_KOMPILASI_LAPORAN_AKHIR,
                            FILE_SOFTCOPY_JURNAL,
                            RESI_PENGIRIMAN_SKRIPSI
                        FROM FORM_PUSTAKA
                        WHERE NIM = ?";
        $paramsGet = array($id_user);
        $result = sqlsrv_query($conn, $sqlGetName, $paramsGet);
        
        if ($result === false) {
            die("error query GetName" . print_r(sqlsrv_errors(), true));
            exit();
        }
        
        $getName = sqlsrv_fetch_array($result);
        
        // Array untuk menyimpan path file final yang akan diupdate ke database
        $filePath = array(
            "bebas-kompen" => $getName['FILE_BEBAS_KOMPEN'],
            "pendahuluan" => $getName['FILE_PENDAHULUAN'],
            "abstrak" => $getName['FILE_ABSTRAK'],
            "bab1" => $getName['BAB_1'],
            "bab2" => $getName['BAB_2'],
            "bab3" => $getName['BAB_3'],
            "bab4" => $getName['BAB_4'],
            "bab5" => $getName['BAB_5'],
            "bab6" => $getName['BAB_6'],
            "bab7" => $getName['BAB_7'],
            "daftar-pustaka" => $getName['FILE_DAFTAR_PUSTAKA'],
            "lampiran" => $getName['FILE_LAMPIRAN'],
            "kompilasi" => $getName['FILE_KOMPILASI_LAPORAN_AKHIR'],
            "jurnal" => $getName['FILE_SOFTCOPY_JURNAL'],
            "pengiriman-skripsi" => $getName['RESI_PENGIRIMAN_SKRIPSI'],
        );
        
        // Proses file upload
        foreach ($files as $key => $file) {
            if ($file['error'] !== UPLOAD_ERR_NO_FILE) {
                // Jika ada file baru yang diunggah, hapus file lama
                recycleBin($filePath[$key], $upload_dir, $delete_dir);
                // Unggah file baru
                $uploaded = uploadFile($file, $upload_dir, $key);
        
                if (!$uploaded) {
                    echo "File '$key' gagal diunggah!";
                } else {
                    $filePath[$key] = $uploaded; // Simpan path file baru ke array
                }
            }
        }
        
        // Data tambahan dari form
        $judul = $_POST['judul'];
        $jenis = $_POST['karya-ilmiah'];
        $tahunTerbit = $_POST['tahun-skripsi'];
        $tglSkripsi = $_POST['tgl-skripsi'];
        $tglYudisium = $_POST['tgl-yudisium'];
        $linkPublik = $_POST['link-publikasi'];
        $izin = $_POST['izin'];
        $penyerahan = $_POST['penyerahan'];
        
        // Query untuk update database
        $sql = "UPDATE FORM_PUSTAKA
                SET 
                    JENIS_KARYA = ?,
                    JUDUL_KARYA_ILMIAH = ?,
                    TAHUN_KARYA_ILMIAH = ?,
                    TANGGAL_UJIAN_SKRIPSI = ?,
                    TANGGAL_YUDISIUM = ?,
                    IZIN_MENGOLAH = ?,
                    PENYERAHAN_SKRIPSI = ?,
                    LINK_JURNAL = ?,
                    FILE_PENDAHULUAN = ?,
                    FILE_BEBAS_KOMPEN = ?,
                    FILE_ABSTRAK = ?,
                    BAB_1 = ?,
                    BAB_2 = ?,
                    BAB_3 = ?,
                    BAB_4 = ?,
                    BAB_5 = ?,
                    BAB_6 = ?,
                    BAB_7 = ?,
                    FILE_DAFTAR_PUSTAKA = ?,
                    FILE_LAMPIRAN = ?,
                    FILE_KOMPILASI_LAPORAN_AKHIR = ?,
                    FILE_SOFTCOPY_JURNAL = ?,
                    RESI_PENGIRIMAN_SKRIPSI = ?,
                    FORM_PUSTAKA_CREATED = ?
                WHERE NIM = ?";
        $params = array(
            $jenis,
            $judul,
            $tahunTerbit,
            $tglSkripsi,
            $tglYudisium,
            $izin,
            $penyerahan,
            $linkPublik,
            $filePath['pendahuluan'],
            $filePath['bebas-kompen'],
            $filePath['abstrak'],
            $filePath['bab1'],
            $filePath['bab2'],
            $filePath['bab3'],
            $filePath['bab4'],
            $filePath['bab5'],
            $filePath['bab6'],
            $filePath['bab7'],
            $filePath['daftar-pustaka'],
            $filePath['lampiran'],
            $filePath['kompilasi'],
            $filePath['jurnal'],
            $filePath['pengiriman-skripsi'],
            $current_timestamp,
            $id_user
        );
        $stmt = sqlsrv_query($conn, $sql, $params);
        
        if ($stmt === false) {
            die("error update database " . print_r(sqlsrv_errors(), true));
            exit();
        } else {
            header("Location: ../../Mahasiswa/form-edit-prodi.php?adm=2");
            exit();
        }        
    } else {
        header('Location: ../../Mahasiswa/DashboardMahasiswa.php?error=InisialisasikanVarAdm');
    }
}

function uploadFile($file, $upload_dir, $field_name) {
    if (isset($file['name']) && $file['error'] === 0) {
        $filename = basename($file['name']);
        $unique_filename = time() . '_' . $filename; 
        $target_path = $upload_dir . $unique_filename;
        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            return $unique_filename; 
        } else {
            die("Gagal mengunggah file $field_name.");
        }
    }
    return null;
}

function recycleBin($filename, $upload_dir, $delete_dir) {
    $sourcePath = $upload_dir . $filename;
    $deletePath = $delete_dir . $filename;

    if (file_exists($sourcePath)) {
        rename($sourcePath, $deletePath);
    } else {
        echo "Tidak Menemukan FIle yang dimaksud";
    }
}

sqlsrv_close($conn);
?>