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

    include '../config/db-connect.php';

    $queyCheck = "SELECT * FROM FORM_PUSTAKA 
                join MAHASISWA ON FORM_PUSTAKA.NIM = MAHASISWA.NIM 
                WHERE FORM_PUSTAKA.NIM = ?";
    $params = array($_SESSION['noInduk']);
    $result = sqlsrv_query($conn, $queyCheck, $params);

    $data = sqlsrv_fetch_array($result);

    $isSubmitted = $data ? 'true' : 'false';

    $queryAdm = "SELECT 
                    [ADMIN].NAMA_ADM,
                    [ADMIN].EMAIL_ADM,
                    [ADMIN].NO_WA_ADM
                FROM [USER] 
                JOIN [ADMIN] ON [USER].ID_USER = [ADMIN].ID_USER
                WHERE [USER].[ROLE] = 'adm_pustaka'";
    $resultAdm = sqlsrv_query($conn, $queryAdm);

    $dataAdm = sqlsrv_fetch_array($resultAdm);
    $jabatan = "Admin Pustaka";
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
    <title>SIBETA | Sistem Bebas Tanggungan | Form Bebas Pustaka</title>
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
                <?php include '../include/adm-identitiy.php' ?>

                <div class="form">
                    <h4>Formulir Tanggungan Pustaka</h4>
                    <form action="../assets/php/upload-pustaka.php" method="post" enctype="multipart/form-data">

                        <p class="label">Jenis Karya Ilmiah</p>
                        <div class="radio-container">
                            <div class="radio">
                                <input type="radio" name="karya-ilmiah" class="radio-check" id="laporan-d2" value="Laporan Akhir (D-2)">
                                <label for="laporan-d2">Laporan Akhir (D-2)</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="karya-ilmiah" class="radio-check" id="laporan-d4" value="Skripsi (D-4)">
                                <label for="laporan-d4">Skripsi (D-4)</label>
                            </div>
                        </div>

                        <label for="judul-skripsi">Judul Karya Ilmiah (Laporan Akhir)</label>
                        <input type="text" name="judul" id="judul-skripsi">

                        <label for="tahun-skripsi">Tahun Karya Ilmiah Akhir Terbit (Laporan Akhir)</label>
                        <select id="tahun-skripsi" name="tahun-skripsi">
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
                        <div class="upload-file">
                            <label for="up-kompen" class="upload-btn">Unggah</label>
                            <input type="file" id="up-kompen" name="up-kompen">
                            <span id="kompen-name">No Choosen File.</span>
                        </div>

                        <p class="subjudul">Upload File SoftCopy Laporan Akhir</p>

                        <div class="upload">
                            <h6>Pendahuluan ( Digabung Menjadi 1 File PDF )</h6>
                            <p>Contoh Penulisan Nama File ( D4 TI_2341720170_PENDAHULUAN_2024 ) ( Tahun Menyesuaikan )</p>
                            <p class="last">( Isi Pendahuluan = Cover s.d Halaman Lampiran )</p>
                            <div class="upload-file">
                                <label for="up-pendahuluan" class="upload-btn">Unggah</label>
                                <input type="file" id="up-pendahuluan" name="up-pendahuluan">
                                <span id="pendahuluan-name">No Choosen File.</span>
                            </div>
                        </div>
                        <div class="upload">
                            <h6>ABSTRAK ( Indonesia - Inggris digabung 1 File PDF / DOC )</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_11223344_ABSTRAK_2024 ) (TAHUN MENYESUAIKAN)</p>
                            <div class="upload-file">
                                <label for="up-abstrak" class="upload-btn">Unggah</label>
                                <input type="file" id="up-abstrak" name="up-abstrak">
                                <span id="abstrak-name">No Choosen File.</span>
                            </div>
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB I - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB I_2024 ) ( Tahun Menyesuaikan )</p>
                            <div class="upload-file">
                                <label for="up-bab1" class="upload-btn">Unggah</label>
                                <input type="file" id="up-bab1" name="up-bab1">
                                <span id="bab1-name">No Choosen File.</span>
                            </div>
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB II - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB II_2024 ) ( Tahun Menyesuaikan )</p>
                            <div class="upload-file">
                                <label for="up-bab2" class="upload-btn">Unggah</label>
                                <input type="file" id="up-bab2" name="up-bab2">
                                <span id="bab2-name">No Choosen File.</span>
                            </div>
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB III - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB III_2024 ) ( Tahun Menyesuaikan )</p>
                            <div class="upload-file">
                                <label for="up-bab3" class="upload-btn">Unggah</label>
                                <input type="file" id="up-bab3" name="up-bab3">
                                <span id="bab3-name">No Choosen File.</span>
                            </div>
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB IV - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB IV_2024 ) ( Tahun Menyesuaikan )</p>
                            <div class="upload-file">
                                <label for="up-bab4" class="upload-btn">Unggah</label>
                                <input type="file" id="up-bab4" name="up-bab4">
                                <span id="bab4-name">No Choosen File.</span>
                            </div>
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB V - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB V_2024 ) ( Tahun Menyesuaikan )</p>
                            <div class="upload-file">
                                <label for="up-bab5" class="upload-btn">Unggah</label>
                                <input type="file" id="up-bab5" name="up-bab5">
                                <span id="bab5-name">No Choosen File.</span>
                            </div>
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB VI - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB VI_2024 ) ( Tahun Menyesuaikan )</p>
                            <div class="upload-file">
                                <label for="up-bab6" class="upload-btn">Unggah</label>
                                <input type="file" id="up-bab6" name="up-bab6">
                                <span id="bab6-name">No Choosen File.</span>
                            </div>
                        </div>
                        <div class="upload">
                            <h6>ISI LAPORAN BAB VII - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_BAB VII_2024 ) ( Tahun Menyesuaikan )</p>
                            <div class="upload-file">
                                <label for="up-bab7" class="upload-btn">Unggah</label>
                                <input type="file" id="up-bab7" name="up-bab7">
                                <span id="bab7-name">No Choosen File.</span>
                            </div>
                        </div>
                        <div class="upload">
                            <h6>DAFTAR PUSTAKA - PDF</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_DAFTAR PUSTAKA_2024 ) ( Tahun Menyesuaikan )</p>
                            <div class="upload-file">
                                <label for="up-dftr-pustaka" class="upload-btn">Unggah</label>
                                <input type="file" id="up-dftr-pustaka" name="up-dftr-pustaka">
                                <span id="pustaka-name">No Choosen File.</span>  
                            </div>
                        </div>
                        <div class="upload">
                            <h6>LAMPIRAN - ( PDF/DOC )</h6>
                            <p class="last">Contoh Penulisan Nama File ( D4 TI_2341720170_LAMPIRAN_2024 ) ( Tahun Menyesuaikan )</p>
                            <div class="upload-file">
                                <label for="up-lampiran" class="upload-btn">Unggah</label>
                                <input type="file" id="up-lampiran" name="up-lampiran">
                                <span id="lampiran-name">No Choosen File.</span>
                            </div>
                        </div>
                        <div class="upload">
                            <h6>KOMPILASI LAPORAN AKHIR ( 1 FILE PENUH PDF )</h6>
                            <p class="last">Softcopy Gabungan Laporan Akhir Lengkap dengan TTD, Stempel, Materai 10.000 Mulai COVER - PENDAHULUAN - ABSTRAK - BAB 1 s.d BAB 5 / 7 - DAFTAR PUSTAKA - LAMPIRAN dengan Penulisan nama File ( D4 TI_11223344_KOMPILASI_2024 ) <br>( TAHUN MENYESUAIKAN )</p>
                            <div class="upload-file">
                                <label for="up-kompilasi" class="upload-btn">Unggah</label>
                                <input type="file" id="up-kompilasi" name="up-kompilasi">
                                <span id="kompilasi-name">No Choosen File.</span>
                            </div>
                        </div>

                        <h6>LINK PUBLIKASI JURNAL</h6>
                        <p>Khusus mahasiswa D4 ( Link dimana Jurnal anda dipublikasikan sesuai alamat URL ) ( bila ada silahkan dilampirkan ) (bila tidak ada bisa dikosongkan)</p>
                        <input type="text" id="link-publikasi" name="link-publikasi">

                        <div class="upload">
                            <h6>SOFTCOPY JURNAL</h6>
                            <p class="last">Khusus Mahasiswa D4 ( Format PDF ) " Jurnal sudah di acc (paraf) oleh Dosen Pembimbing</p>
                            <div class="upload-file">
                                <label for="up-softcopy-jurnal" class="upload-btn">Unggah</label>
                                <input type="file" id="up-softcopy-jurnal" name="up-softcopy-jurnal">
                                <span id="jurnal-name">No Choosen File.</span>
                            </div>
                        </div>

                        <p class="label">Dengan ini saya memberikan ijin kepada perpustakaan polinema untuk mengolah Laporan Akhir / Tugas Akhir saya dengan ketentuan yang ada untuk kemajuan ilmu pengetahuan dan institusi.</p>
                        <div class="radio-container">
                            <div class="radio">
                                <input type="radio" name="izin" class="radio-check" id="iya" value="Diperbolehkan">
                                <label for="iya">Diperbolehkan</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="izin" class="radio-check" id="tidak" value="Tidak Diperbolehkan">
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
                                <input type="radio" name="penyerahan" class="radio-check" id="langsung" value="langsung">
                                <label for="langsung">Datang Langsung Ke Perpustakaan</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="penyerahan" class="radio-check" id="tdk-langsung" value="Tidak Langsung">
                                <label for="tdk-langsung">Dikirim Melalui Jasa Ekspedisi</label>
                            </div>
                        </div>

                        <div class="upload">
                            <h6>Unggah / Upload Bukti Resi Hard Copy Laporan Akhir/ Skripsi / Tesis Yang Dikirim Melalui Ekspedisi atau Sejenis</h6>
                            <p class="last">Lampiran Untuk Resi Bukti bahwa Hard Copy Tugas Akhir dikirim melalui Jasa Ekspedisi atau Sejenis yang dialamatkan ke <br> UPT Perpustakaan Politeknik Negeri Malang, Gedung Graha Polinema Lt 3, Jl Soekarno-Hatta No.09 Malang ( Bentuk PDF atau Gambar ). <br> Bagi yang menyerahkan langsung ke Perpustakaan Tidak Perlu Melampirkan atau Upload Bukti Kirim</p>
                            <div class="upload-file">
                                <label for="up-resi" class="upload-btn">Unggah</label>
                                <input type="file" id="up-resi" name="up-resi">
                                <span id="resi-name">No Choosen File.</span>
                            </div>
                        </div>

                        <button type="submit" id="submit-btn" data-submitted="<?= $isSubmitted?>" onclick="checkSubmit()">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const kompen = document.getElementById('up-kompen');
        const pendahuluan = document.getElementById('up-pendahuluan');
        const abstrak = document.getElementById('up-abstrak');
        const bab1 = document.getElementById('up-bab1');
        const bab2 = document.getElementById('up-bab2');
        const bab3 = document.getElementById('up-bab3');
        const bab4 = document.getElementById('up-bab4');
        const bab5 = document.getElementById('up-bab5');
        const bab6 = document.getElementById('up-bab6');
        const bab7 = document.getElementById('up-bab7');
        const pustaka = document.getElementById('up-dftr-pustaka');
        const lampiran = document.getElementById('up-lampiran');
        const kompilasi = document.getElementById('up-kompilasi');
        const jurnal = document.getElementById('up-softcopy-jurnal');
        const resi = document.getElementById('up-resi');


        
        kompen.addEventListener('change', function () {
            if (kompen.value) {
                document.getElementById('kompen-name').innerHTML = kompen.files[0].name;
            }
        });

        pendahuluan.addEventListener('change', function () {
            if (pendahuluan.value) {
                document.getElementById('pendahuluan-name').innerHTML = pendahuluan.files[0].name;
            }
        });
        abstrak.addEventListener('change', function () {
            if (abstrak.value) {
                document.getElementById('abstrak-name').innerHTML = abstrak.files[0].name;
            }
        });
        bab1.addEventListener('change', function () {
            if (bab1.value) {
                document.getElementById('bab1-name').innerHTML = bab1.files[0].name;
            }
        });
        bab2.addEventListener('change', function () {
            if (bab2.value) {
                document.getElementById('bab2-name').innerHTML = bab2.files[0].name;
            }
        });
        bab3.addEventListener('change', function () {
            if (bab3.value) {
                document.getElementById('bab3-name').innerHTML = bab3.files[0].name;
            }
        });
        bab4.addEventListener('change', function () {
            if (bab4.value) {
                document.getElementById('bab4-name').innerHTML = bab4.files[0].name;
            }
        });
        bab5.addEventListener('change', function () {
            if (bab5.value) {
                document.getElementById('bab5-name').innerHTML = bab5.files[0].name;
            }
        });
        bab6.addEventListener('change', function () {
            if (bab6.value) {
                document.getElementById('bab6-name').innerHTML = bab6.files[0].name;
            }
        });
        bab7.addEventListener('change', function () {
            if (bab7.value) {
                document.getElementById('bab7-name').innerHTML = bab7.files[0].name;
            }
        });
        pustaka.addEventListener('change', function () {
            if (pustaka.value) {
                document.getElementById('pustaka-name').innerHTML = pustaka.files[0].name;
            }
        });
        lampiran.addEventListener('change', function () {
            if (lampiran.value) {
                document.getElementById('lampiran-name').innerHTML = lampiran.files[0].name;
            }
        });
        kompilasi.addEventListener('change', function () {
            if (kompilasi.value) {
                document.getElementById('kompilasi-name').innerHTML = kompilasi.files[0].name;
            }
        });
        jurnal.addEventListener('change', function () {
            if (jurnal.value) {
                document.getElementById('jurnal-name').innerHTML = jurnal.files[0].name;
            }
        });
        resi.addEventListener('change', function () {
            if (resi.value) {
                document.getElementById('resi-name').innerHTML = resi.files[0].name;
            }
        });

        function checkSubmit() {
            const submit = document.getElementById('submit-btn');
            const isSubmited = submit.getAttribute('data-submitted') === 'true';
    
            if (isSubmited) {
                event.preventDefault();
                const message = document.createElement('p');
                message.textContent = 'Anda Sudah Mengunggah Formulir.';
                document.querySelector('.form').appendChild(message);
            }
        }
    </script>
</body>

</html>