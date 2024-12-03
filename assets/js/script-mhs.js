// ---------------------
// mainContent

const dropdownBtnRiwayat = document.querySelectorAll(".riwayat-btn");

dropdownBtnRiwayat.forEach((button, index) => {
    button.addEventListener("click", () => {
        const correspondingDiv = button.nextElementSibling;
        button.classList.toggle("open");

        if (correspondingDiv && correspondingDiv.classList.contains("verifikasi")) {
            correspondingDiv.classList.toggle("open");
        }
    });
});


