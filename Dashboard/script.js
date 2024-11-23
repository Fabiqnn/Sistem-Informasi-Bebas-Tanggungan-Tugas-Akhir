const dropdownBtn = document.querySelectorAll(".dropdown-btn");
const toggleBtn = document.querySelector(".toggle-btn");
const sidebar = document.querySelector(".sidebar");
const mainContent = document.querySelector(".main-content");

toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    mainContent.classList.toggle("shrink");
});

dropdownBtn.forEach(btn => {
    btn.addEventListener("click", () => {
        const parent =  btn.parentElement;
        parent.classList.toggle("open");
    });
});