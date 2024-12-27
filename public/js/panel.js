document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const menuButton = document.getElementById('mobile-menu-button');
    const backdrop = document.getElementById('sidebar-backdrop');
    
    function openSidebar() {
        if (sidebar && backdrop) {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Предотвращаем прокрутку
        }
    }

    function closeSidebar() {
        if (sidebar && backdrop) {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
            document.body.style.overflow = ''; // Возвращаем прокрутку
        }
    }

    // Открытие сайдбара по кнопке в хедере
    menuButton?.addEventListener('click', openSidebar);

    // Закрытие при клике на затемнённый фон
    backdrop?.addEventListener('click', closeSidebar);

    // Закрытие по Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeSidebar();
    });

    // Закрытие при изменении размера экрана
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            closeSidebar();
        }, 250);
    });
});