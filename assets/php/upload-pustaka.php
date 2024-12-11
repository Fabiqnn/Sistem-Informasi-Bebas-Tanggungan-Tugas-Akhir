<?php 
session_start();
include '../../config/db-connect.php';

if (!isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
    header("Location: ../index.php");
    exit();
} 

if ($_SESSION['role'] !== 'mahasiswa') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_user = $_SESSION['noInduk']; 
    $upload_dir = '../uploaded-file/form-pustaka/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
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

    $files = array(
        "bebas-kompen" => $_FILES['up-kompen'],
        "pendahuluan" => $_FILES['up-pendahuluan'],
        "abstrak" => $_FILES['up-abstrak'],
        "bab1" => $_FILES['up-bab1'],
        "bab2" => $_FILES['up-bab2'],
        "bab3" => $_FILES['up-bab3'],
        "bab4" => $_FILES['up-bab4'],
        "bab5" => $_FILES['up-bab5'],
        "bab6" => $_FILES['up-bab6'],
        "bab7" => $_FILES['up-bab7'],
        "daftar-pustaka" => $_FILES['up-dftr-pustaka'],
        "lampiran" => $_FILES['up-lampiran'],
        "kompilasi" => $_FILES['up-kompilasi'],
        "jurnal" => $_FILES['up-softcopy-jurnal'],
        "pengiriman-skripsi" => $_FILES['up-resi']
    );

    $filePath = array();

    foreach ($files as $key => $file) {
        $uploaded = uploadFile($file, $upload_dir, $key);
        if (!$uploaded) {
            echo "File '$key' gagal diunggah!";
        } else {
            $filePath[$key] = $uploaded;
        }
    }

    $judul = $_POST['judul'];
    $jenis = $_POST['karya-ilmiah'];
    $tahunTerbit = $_POST['tahun-skripsi'];
    $tglSkripsi = $_POST['tgl-skripsi'];
    $tglYudisium =$_POST['tgl-yudisium'];
    $linkPublik = $_POST['link-publikasi'];
    $izin = $_POST['izin'];
    $penyerahan = $_POST['penyerahan'];
    $jenisKarya = $_POST['karya-ilmiah'];

    $current_timestamp = date('Y-m-d H:i:s');

    $sql = "INSERT INTO FORM_PUSTAKA (
                NIM,
                JENIS_KARYA,
                JUDUL_KARYA_ILMIAH,
                TAHUN_KARYA_ILMIAH,
                TANGGAL_UJIAN_SKRIPSI,
                TANGGAL_YUDISIUM,
                IZIN_MENGOLAH,
                PENYERAHAN_SKRIPSI,
                LINK_JURNAL,
                FILE_PENDAHULUAN,
                FILE_BEBAS_KOMPEN,
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
                RESI_PENGIRIMAN_SKRIPSI,
                FORM_PUSTAKA_CREATED
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $params = array(
        $id_user,
        $jenisKarya,
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
        $filePath['jurnal'] ?? null,
        $filePath['pengiriman-skripsi'],
        $current_timestamp
    );

    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo $current_timestamp . " ";
        die("Gagal menyimpan data ke database: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "Data berhasil disimpan!";
        header("Location: ../../Mahasiswa/form-pustaka.php"); 
        exit();
    }
}

sqlsrv_close($conn);

?>