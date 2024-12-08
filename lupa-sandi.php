<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style-lupa-sandi.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>SIBETA | Sistem Bebas Tanggungan | Lupa Sandi</title>
</head>
<body>
    <header>
        <h1>
            <div class="logo">
                <img src="assets/images/Logo Fiks.png" alt="logo">
            </div>
            SIBETA
        </h1>
    </header>
    
    <div class="body">
        <div class="login-card">
            <div class="card-logo">
                <img src="assets/images/Logo Fiks.png" alt="logo SIBETA">
            </div>

            <div class=instruction>
                <p>Masukkan NIM dan Email</p>
                <p>Untuk Memulihkan Akun Anda</p>
            </div>

            <form action="" method="post" id="lupa-sandi">
                <div class="input-form">
                    <input type="text" name="nim" id="nim" placeholder="Masukkan NIM Anda">
                </div>
                <div class="input-form">
                    <input type="email" name="email" id="email" placeholder="Masukkan Email Anda yang Terdaftar">
                </div>

                <button type="submit">Lanjut</button>
            </form>
        </div>
    </div>

    <Script>
        // validate

        
        document.getElementById("lupa-sandi").addEventListener("submit", validation);

        function validation() {
            event.preventDefault();

            let nim = document.getElementById("nim");
            let email = document.getElementById("email");

            nim.classList.remove("empty-input");
            email.classList.remove("empty-input");

            if (nim.value === "") {
                nim.classList.add("empty-input");
                nim.setAttribute("placeholder", "NIM Tidak Boleh Kosong");
            }
            
            if (email.value === "") { 
                email.classList.add("empty-input");
                email.setAttribute("placeholder", "Email Tidak Boleh Kosong");
            }

            if (nim.value !== "" && email.value !== "") {
                event.target.submit();
            }
        }
    </Script>
</body>
</html>