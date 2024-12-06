// sidebar

const sidebarBtn = document.querySelector(".toggle-btn");
const sidebar = document.querySelector(".sidebar");
const mainContent = document.querySelector(".main-content");

sidebarBtn.addEventListener("click", () => {

    sidebar.classList.toggle("open");
    mainContent.classList.toggle("shrink");
});
