<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css">
    <link rel="stylesheet" href="../assets/css/style-kelola-adm.css" type="text/css">
    <title>Akun Admin</title>
</head>
<body>
    <?php include '../include/header.php';?>

    <div class="body">
        <?php include '../include/sidebar-super-adm.php';?>
        
        <div class="main-content">
            <?php include '../include/banner.php' ?>

            <div class="card-container">
                <h3>SELAMAT DATANG</h3>
                <hr id="hr-1">

                <div class="table">
                    <div class="table-header">
                        <button>
                            <i class="lni lni-plus"></i>
                            Add Admin User
                        </button>
                    </div>
                    <div class="table-content">
                        <table>
                            <tr>
                                <th>Nama Pengguna</th>
                                <th>Jabatan</th>
                                <th>NIP</th>
                                <th>Password</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="../assets/js/script-kelola-admin.js"></script>
</body>
</html>