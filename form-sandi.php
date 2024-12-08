<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style-form-sandi.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css" />


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
                <p>Masukkan Password Baru</p>
            </div>

            <form action="" method="post" id="form-sandi">
                <div class="input-form">
                    <input type="password" name="pass" id="pass" placeholder="Password Baru">
                    <i class="lni lni-locked-1"></i>
                </div>
                <div class="input-form">
                    <input type="password" name="pass-confirm" id="pass-confirm" placeholder="Konfirmasi Password">
                    <i class="lni lni-locked-1"></i>
                </div>
                <div class="open-pass">
                    <input type="checkbox" onchange="passOpen()" id="show-pass">
                    <label for="show-pass">Tampilkan Password</label>
                </div>

                <button type="submit">Konfirmasi</button>
            </form>
        </div>
    </div>

    <Script defer>
        function passOpen() {
            var pass = document.getElementById('pass');
            var checkbox = document.querySelector('.open-pass input');
            var passConfirm = document.getElementById('pass-confirm');

            if (checkbox.checked) {
                pass.setAttribute("type", "text");
                pass.nextElementSibling.setAttribute("class", "lni lni-eye");
                passConfirm.setAttribute("type", "text");
                passConfirm.nextElementSibling.setAttribute("class", "lni lni-eye");
            } else {
                pass.setAttribute("type", "password");
                pass.nextElementSibling.setAttribute("class", "lni lni-locked-1");
                passConfirm.setAttribute("type", "password");
                passConfirm.nextElementSibling.setAttribute("class", "lni lni-locked-1");
            }
        }

        document.getElementById("form-sandi").addEventListener("submit", validation);

        function validation() {
            event.preventDefault();

            var pass = document.getElementById('pass');
            var passConfirm = document.getElementById('pass-confirm');

            var passParent = pass.parentElement;
            var passConfirmParent = passConfirm.parentElement;

            passParent.classList.remove("empty-input");
            passConfirmParent.classList.remove("empty-input");

            if (pass.value === "") {
                passParent.classList.add("empty-input");
                pass.setAttribute("placeholder", "Password Tidak Boleh Kosong");
            }
            
            if (passConfirm.value === "") { 
                passConfirmParent.classList.add("empty-input");
                passConfirm.setAttribute("placeholder", "Password Tidak Boleh Kosong");
            }

            if (pass.value !== "" && passConfirm.value !== "") {
                event.target.submit();
            }
        }
    </Script>
</body>
</html>