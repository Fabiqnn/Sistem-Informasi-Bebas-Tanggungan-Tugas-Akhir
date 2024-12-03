// validasi

document.getElementById('form-add-admin').addEventListener('submit', validation);

function validation() {
    event.preventDefault();

    let nama = document.getElementById('name');
    let role = document.getElementById('role');
    let nip = document.getElementById('nip');
    let pass = document.getElementById('pass');

    if (nama.value === "") {
        nama.classList.add("empty-input");
        nama.setAttribute("placeholder", "Tidak Boleh Kosong!");
    }
    if (role.value === "") {
        role.classList.add("empty-input");
        role.setAttribute("placeholder", "Tidak Boleh Kosong!");
    }
    if (nip.value === "") {
        nip.classList.add("empty-input");
        nip.setAttribute("placeholder", "Tidak Boleh Kosong!");
    }
    if (pass.value === "") {
        pass.classList.add("empty-input");
        pass.setAttribute("placeholder", "Tidak Boleh Kosong!");
    }

    if (nama.value !== "" && role.value !== "" && nip.value !== "" && pass.value !== "") {
        event.target.submit();
    }
}