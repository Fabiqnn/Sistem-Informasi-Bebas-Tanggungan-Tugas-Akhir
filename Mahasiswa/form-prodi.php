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

    $queyCheck = "SELECT * FROM FORM_PRODI 
                join MAHASISWA ON FORM_PRODI.NIM = MAHASISWA.NIM 
                WHERE FORM_PRODI.NIM = ?";
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
                WHERE [USER].[ROLE] = 'adm_prodi'";

    $resultAdm = sqlsrv_query($conn, $queryAdm);

    $dataAdm = sqlsrv_fetch_array($resultAdm);
    $jabatan = "Admin Prodi";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-form-prodi.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>SIBETA | Sistem Bebas Tanggungan | Form Prodi</title>
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
                    <div class="informasi">
                        <div class="label">
                            <h5>Nama Admin</h5>
                            <h5>Email</h5>
                            <h5>No HandPhone</h5>
                            <h5>Jabatan</h5>
                        </div>
                        <div class="titik-dua">
                            <h5>:</h5>
                            <h5>:</h5>
                            <h5>:</h5>
                            <h5>:</h5>
                        </div>
                        <div class="data">
                            <p><?= $dataAdm['NAMA_ADM'] ?></p>
                            <p><?= $dataAdm['EMAIL_ADM'] ?></p>
                            <p><?= $dataAdm['NO_WA_ADM'] ?></p>
                            <p><?= $jabatan ?></p>
                        </div>
                    </div>
                </div>

                <div class="form">
                    <h4>Formulir Tanggungan Prodi</h4>
                    <form action="../assets/php/upload-prodi.php" method="post" enctype="multipart/form-data">

                        <label>Bukti Distribusi Buku Skripsi / Laporan Akhir</label>

                        <div class="upload-file">
                            <label for="up-skripsi" class="upload-btn">Unggah</label> 
                            <input type="file" name="up-skripsi" id="up-skripsi">
                            <span id="skripsi-name">No File Choosen.</span>
                        </div>
                        
                        <label>Bukti Distribusi Laporan PKL</label>
                        
                        <div class="upload-file">
                            <label for="up-pkl" class="upload-btn">Unggah</label> 
                            <input type="file" name="up-pkl" id="up-pkl">
                            <span id="pkl-name">No File Choosen.</span>
                        </div>
                        
                        <label>Bukti Bebas Kompen</label>
                        
                        <div class="upload-file">
                            <label for="up-kompen" class="upload-btn">Unggah</label> 
                            <input type="file" name="up-kompen" id="up-kompen">
                            <span id="kompen-name">No File Choosen.</span>
                        </div>
                        <button type="submit" id="submit-btn" data-submitted="<?= $isSubmitted; ?>" onclick="checkSubmit()">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const skripsiName = document.getElementById('up-skripsi');
        const pkl = document.getElementById('up-pkl');
        const kompen = document.getElementById('up-kompen');

        skripsiName.addEventListener('change', function () {
            if (skripsiName.value) {
                document.getElementById('skripsi-name').innerHTML = skripsiName.files[0].name;
            }
        });

        pkl.addEventListener('change', function () {
            if (pkl.value) {
                document.getElementById('pkl-name').innerHTML = pkl.files[0].name;
            }
        });

        kompen.addEventListener('change', function () {
            if (kompen.value) {
                document.getElementById('kompen-name').innerHTML = kompen.files[0].name;
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