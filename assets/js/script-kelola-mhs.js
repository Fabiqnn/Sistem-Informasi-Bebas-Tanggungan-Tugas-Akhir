// validasi

document.getElementById('form-add-mhs').addEventListener('submit', validation);

function validation() {
    event.preventDefault();

    let nama = document.getElementById('name');
    let angkatan = document.getElementById('angkatan');
    let nim = document.getElementById('nim');
    let pass = document.getElementById('pass');

    if (nama.value === "") {
        nama.classList.add("empty-input");
        nama.setAttribute("placeholder", "Tidak Boleh Kosong!");
    }
    if (angkatan.value === "") {
        angkatan.classList.add("empty-input");
        angkatan.setAttribute("placeholder", "Tidak Boleh Kosong!");
    }
    if (nim.value === "") {
        nim.classList.add("empty-input");
        nim.setAttribute("placeholder", "Tidak Boleh Kosong!");
    }
    if (pass.value === "") {
        pass.classList.add("empty-input");
        pass.setAttribute("placeholder", "Tidak Boleh Kosong!");
    }

    if (nama.value !== "" && angkatan.value !== "" && nim.value !== "" && pass.value !== "") {
        event.target.submit();
    }
}

var updateBtn = document.querySelectorAll('.update-btn');

updateBtn.forEach(function(button) {
    button.addEventListener('click', function () { 
        var nama = button.getAttribute('data-nama');
        var nip = button.getAttribute('data-nim');
        var pass = button.getAttribute('data-pass');
        var angkatan = button.getAttribute('data-angkatan');
        var prodi = button.getAttribute('data-prodi');

        document.getElementById('name-edit').value = nama;
        document.getElementById('nim-edit').value = nip;
        document.getElementById('pass-edit').value = pass;
        document.getElementById('angkatan-edit').value = angkatan;
        document.getElementById('prodi-edit').value = prodi;
    }); 
});