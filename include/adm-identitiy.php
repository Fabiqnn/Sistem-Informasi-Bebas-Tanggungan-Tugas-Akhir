<style>
    .informasi-admin h4 {
    text-align: left;
    color: #14AE5C;
    margin-bottom: 0;
    }

    .informasi-admin h5 {
        font-weight: 400;
        font-size: 14px;
    }

    .informasi-admin hr {
        margin: 0 0 15px 0;
        opacity: .25;
    }

    .form-container .informasi-admin {
        border: 1px solid rgba(0, 0, 0, 0.3);
        padding: 20px;
    }

    .informasi {
        display: flex;
        gap: 10px;
    }

    .informasi .data {
        font-size: 14px;
    }
</style>

<?php 
if (isset($_GET['adm'])) {
    
        if ($_GET['adm'] === '1') {
            $dataAdm = getDataAdm($conn, 'adm_lt7');
            $jabatan = "Admin TA";
            ?>
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
            <?php
        } else if ($_GET['adm'] === '2') {
            $dataAdm = getDataAdm($conn, 'adm_prodi');
            $jabatan = "Admin Prodi";
            ?>
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
            <?php
        } else if ($_GET['adm'] === '3') {
            $dataAdm = getDataAdm($conn, 'adm_pustaka');
            $jabatan = "Admin Pustaka";
            ?>
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
            <?php
        }
        
} else {
    echo 'Inisialisasikan variable Get adm';
}

function getDataAdm($conn, $jabatan) {
    $queryAdm = "SELECT 
                    [ADMIN].NAMA_ADM,
                    [ADMIN].EMAIL_ADM,
                    [ADMIN].NO_WA_ADM
                FROM [USER] 
                JOIN [ADMIN] ON [USER].ID_USER = [ADMIN].ID_USER
                WHERE [USER].[ROLE] = '$jabatan'";
    $resultAdm = sqlsrv_query($conn, $queryAdm);

    if ($resultAdm === false) {
        die("error sql query" . print_r(sqlsrv_errors(), true));
    } else {
        return $data = sqlsrv_fetch_array($resultAdm);
    }    
}
    
?>