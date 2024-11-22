// Mendapatkan elemen sidebar dan toggle button
const sidebar = document.getElementById('sidebar');
const toggleButton = document.querySelector('.toggle-btn');

// Menambahkan event listener untuk toggle button
toggleButton.addEventListener('click', () => {
    // Toggle class 'closed' pada sidebar untuk membuka/menutup
    sidebar.classList.toggle('closed');
});

// Mengatur dropdown menu
document.querySelectorAll('.dropdown-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
        const dropdown = btn.parentElement;
        dropdown.classList.toggle('open');
    });
});
