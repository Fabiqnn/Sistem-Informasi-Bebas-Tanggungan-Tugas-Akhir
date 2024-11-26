// sidebar

const dropdownBtnSidebar = document.querySelector(".dropdown-btn");
const sidebarBtn = document.querySelector(".toggle-btn");
const sidebar = document.querySelector(".sidebar");
const mainContent = document.querySelector(".main-content");

sidebarBtn.addEventListener("click", () => {
    const dropdownParent = dropdownBtnSidebar.parentElement;
    if (dropdownParent.classList.contains("open")) {
        dropdownParent.classList.toggle("open");
    }

    sidebar.classList.toggle("open");
    mainContent.classList.toggle("shrink");
});

dropdownBtnSidebar.addEventListener("click", () => {
    if (!sidebar.classList.contains("open")) {
        sidebar.classList.toggle("open");
        mainContent.classList.toggle("shrink");
    }

    const parentElement = dropdownBtnSidebar.parentElement;
    parentElement.classList.toggle("open");
});

// ---------------------
// mainContent


