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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-form-pustaka.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Form Bebas Pustaka</title>
</head>

<body>
    <?php
    include '../include/header.php';
    ?>

    <div class="body">
        <?php
        include '../include/sidebar.php';
        ?>

        <div class="main-content">
            <?php
            include '../include/banner.php';
            ?>

            <div class="form-container">
                <h3>Bebas Tanggungan Jurusan Teknologi Informasi</h3>
                <div class="informasi-admin">
                    <h4>Informasi Admin</h4>
                    <hr>
                    <h5>Nama Admin : </h5>
                    <h5>Email : </h5>
                    <h5>No HandPhone : </h5>
                    <h5>Jabatan : </h5>
                </div>

                <div class="form">
                    <h4>Formulir Tanggungan Pustaka</h4>
                    <form action="" method="post" enctype="multipart/form-data">

                        <p class="label">Jenjang Pendidikan</p>
                        <div class="radio-container">
                            <div class="radio">
                                <input type="radio" name="jenjang" class="radio-check" id="d-2">
                                <label for="d-2">D-2</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="jenjang" class="radio-check" id="d-4">
                                <label for="d-4">D-4</label>
                            </div>
                        </div>

                        <p class="label">Jenis Karya Ilmiah</p>
                        <div class="radio-container">
                            <div class="radio">
                                <input type="radio" name="karya-ilmiah" class="radio-check" id="laporan-d2">
                                <label for="laporan-d2">Laporan Akhir (D-2)</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="karya-ilmiah" class="radio-check" id="laporan-d4">
                                <label for="laporan-d4">Skripsi (D-4)</label>
                            </div>
                        </div>

                        <label for="judul-skripsi">Judul Karya Ilmiah (Laporan Akhir)</label>
                        <input type="text" name="judul" id="judul-skripsi">

                        <label for="prodi">Program Studi</label>
                        <select id="prodi">
                            <option value="D2 Pengembangan Perangkat (Piranti) Lunak Situs ( D2 - PPL )">D2 Pengembangan Perangkat (Piranti) Lunak Situs ( D2 - PPL )</option>
                            <option value="D4 Teknik Informatika ( D4 - SKL )">D4 Teknik Informatika ( D4 - SKL )</option>
                            <option value="D4 Sistem Informasi Bisnis ( D4 - SIB )">D4 Sistem Informasi Bisnis ( D4 - SIB )</option>
                        </select>


                        <label for="tahun-skripsi">Tahun Karya Ilmiah Akhir Terbit (Laporan Akhir)</label>
                        <select id="tahun-skripsi">
                            <option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>

                        <label for="tgl-skripsi">Tanggal, Bulan, Tahun Ujian Tugas Akhir / Skripsi</label>
                        <input type="date" name="tgl-skripsi" id="tgl-skripsi">

                        <label for="tgl-yudisium">Tanggal, Bulan, Tahun Yudisium</label>
                        <input type="date" name="tgl-yudisium" id="tgl-yudisium">

                        <p>Bukti Bebas Kompen</p>
                        <label for="up-kompen" class="upload-btn">Upload</label>
                        <input type="file" id="up-kompen">

                        <p class="subjudul">Upload File SoftCopy Laporan Akhir</p>

                        <div class="upload">
                            <h6>Pendahuluan ( Digabung Menjadi 1 File PDF )</h6>
                            <p>Contoh Penulisan Nama File ( D4 TI_2341720170_PENDAHULUAN_2024 ) ( Tahun Menyesuaikan )</p>
                            <p class="last">( Isi Pendahuluan = Cover s.d Halaman Lampiran )</p>
                            <label for="up-pendahuluan" class="upload-btn">Unggah</label>
                            <input type="file" id="up-pendahuluan">
                        </div>
                        <div class="upload">
                            <h6>ABSTRAK ( Indonesia - Inggris digabung 1 File PDF / DOC )</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_11223344_ABSTRAK_2024 ) (TAHUN MENYESUAIKAN)</p>
                            <label for="up-abstrak" class="upload-btn">Unggah</label>
                            <input type="file" id="up-abstrak">
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB I - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB I_2024 ) ( Tahun Menyesuaikan )</p>
                            <label for="up-bab1" class="upload-btn">Unggah</label>
                            <input type="file" id="up-bab1">
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB II - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB II_2024 ) ( Tahun Menyesuaikan )</p>
                            <label for="up-bab2" class="upload-btn">Unggah</label>
                            <input type="file" id="up-bab2">
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB III - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB III_2024 ) ( Tahun Menyesuaikan )</p>
                            <label for="up-bab3" class="upload-btn">Unggah</label>
                            <input type="file" id="up-bab3">
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB IV - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB IV_2024 ) ( Tahun Menyesuaikan )</p>
                            <label for="up-bab4" class="upload-btn">Unggah</label>
                            <input type="file" id="up-bab4">
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB V - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB V_2024 ) ( Tahun Menyesuaikan )</p>
                            <label for="up-bab5" class="upload-btn">Unggah</label>
                            <input type="file" id="up-bab5">
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB VI - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB VI_2024 ) ( Tahun Menyesuaikan )</p>
                            <label for="up-bab6" class="upload-btn">Unggah</label>
                            <input type="file" id="up-bab6">
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB VII - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB VII_2024 ) ( Tahun Menyesuaikan )</p>
                            <label for="up-bab7" class="upload-btn">Unggah</label>
                            <input type="file" id="up-bab7">
                        </div>
                        <div class="upload">
                            <h6>DAFTAR PUSTAKA - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_DAFTAR PUSTAKA_2024 ) ( Tahun Menyesuaikan )</p>
                            <label for="up-dftr-pustaka" class="upload-btn">Unggah</label>
                            <input type="file" id="up-dftr-pustaka">
                        </div>
                        <div class="upload">
                            <h6>LAMPIRAN - ( PDF/DOC )</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_LAMPIRAN_2024 ) ( Tahun Menyesuaikan )</p>
                            <label for="up-lampiran" class="upload-btn">Unggah</label>
                            <input type="file" id="up-lampiran">
                        </div>
                        <div class="upload">
                            <h6>KOMPILASI LAPORAN AKHIR ( 1 FILE PENUH PDF )</h6>
                            <p class="last">Softcopy Gabungan Laporan Akhir Lengkap dengan TTD, Stempel, Materai 10.000 Mulai COVER - PENDAHULUAN - ABSTRAK - BAB 1 s.d BAB 5 / 7 - DAFTAR PUSTAKA - LAMPIRAN dengan Penulisan nama File ( D4 TI_11223344_KOMPILASI_2024 ) ( TAHUN MENYESUAIKAN )</p>
                            <label for="up-kompilasi" class="upload-btn">Unggah</label>
                            <input type="file" id="up-kompilasi">
                        </div>

                        <h6>LINK PUBLIKASI JURNAL</h6>
                        <p>Khusus mahasiswa D4 ( Link dimana Jurnal anda dipublikasikan sesuai alamat URL ) ( bila ada silahkan dilampirkan ) (bila tidak ada bisa dikosongkan)</p>
                        <input type="text" id="link-publikasi">

                        <div class="upload">
                            <h6>SOFTCOPY JURNAL</h6>
                            <p class="last">Khusus Mahasiswa D4 ( Format PDF ) " Jurnal sudah di acc (paraf) oleh Dosen Pembimbing</p>
                            <label for="up-softcopy-jurnal" class="upload-btn">Unggah</label>
                            <input type="file" id="up-softcopy-jurnal">
                        </div>

                        <p class="label">Dengan ini saya memberikan ijin kepada perpustakaan polinema untuk mengolah Laporan Akhir / Tugas Akhir saya dengan ketentuan yang ada untuk kemajuan ilmu pengetahuan dan institusi.</p>
                        <div class="radio-container">
                            <div class="radio">
                                <input type="radio" name="izin" class="radio-check" id="iya">
                                <label for="iya">Diperbolehkan</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="izin" class="radio-check" id="tidak">
                                <label for="tidak">Tidak Diperbolehkan</label>
                            </div>
                        </div>

                        <div class="upload">
                            <h6>Ketentuan Hard Copy</h6>
                            <p>1. Hardcopy yang dikumpulkan harus sesuai dengan softcopy yang diupload <br>
                                2. Lembar Pengesahan Wajib Sudah lengkap dengan TTD dan Stempel ( BERWARNA ) ( Lembar Asli ) <br>
                                3. Lembar Pernyataan Keaslian Penulisan / bebas plagiasi Wajib Sudah Lengkap dengan TTD dan
                                Materai 10.000 ( BERWARNA ) ( Lembar Asli )</p>
                        </div>

                        <p class="label">Hard Copy Laporan Akhir/ Skripsi/ Tesis Diserahkan Secara</p>
                        <div class="radio-container">
                            <div class="radio">
                                <input type="radio" name="penyerahan" class="radio-check" id="langsung">
                                <label for="langsung">Datang Langsung Ke Perpustakaan</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="penyerahan" class="radio-check" id="tdk-langsung">
                                <label for="tdk-langsung">Dikirim Melalui Jasa Ekspedisi</label>
                            </div>
                        </div>

                        <div class="upload">
                            <h6>Unggah / Upload Bukti Resi Hard Copy Laporan Akhir/ Skripsi / Tesis Yang Dikirim Melalui Ekspedisi atau Sejenis</h6>
                            <p class="last">Lampiran Untuk Resi Bukti bahwa Hard Copy Tugas Akhir dikirim melalui Jasa Ekspedisi atau Sejenis yang dialamatkan ke <br> UPT Perpustakaan Politeknik Negeri Malang, Gedung Graha Polinema Lt 3, Jl Soekarno-Hatta No.09 Malang ( Bentuk PDF atau Gambar ). <br> Bagi yang menyerahkan langsung ke Perpustakaan Tidak Perlu Melampirkan atau Upload Bukti Kirim</p>
                            <label for="up-resi" class="upload-btn">Unggah</label>
                            <input type="file" id="up-resi">
                        </div>

                        <button type="submit" id="submit-btn">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/script-form-pustaka.js"></script>
</body>

</html>