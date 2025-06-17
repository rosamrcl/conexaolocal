document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.querySelector('#menu-bar');
    const navbar = document.querySelector('.navbar');

    menuBtn.addEventListener('click', function() {
        menuBtn.classList.toggle('fa-times'); // Alterna o ícone (☰ → ✕)
        navbar.classList.toggle('active');     // Mostra/esconde o menu
    });

    // Fecha o menu ao rolar a página
    window.onscroll = () => {
        menuBtn.classList.remove('fa-times');
        navbar.classList.remove('active');
    };
});


