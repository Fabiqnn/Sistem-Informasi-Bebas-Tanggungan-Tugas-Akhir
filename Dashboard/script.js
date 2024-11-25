// sidebar

const dropdownBtnSidebar = document.querySelectorAll(".dropdown-btn");
const toggleBtn = document.querySelector(".toggle-btn");
const sidebar = document.querySelector(".sidebar");
const mainContent = document.querySelector(".main-content");

toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    mainContent.classList.toggle("shrink");
});

dropdownBtnSidebar.forEach(btn => {
    btn.addEventListener("click", () => {
        const parent =  btn.parentElement;
        parent.classList.toggle("open");
    });
});

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


