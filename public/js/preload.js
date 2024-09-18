window.addEventListener('load', () => {
    const preloader = document.querySelector('.preloader');
    const properties = document.querySelector('.properties');

    setTimeout(() => {
        preloader.style.opacity = '0';
        preloader.style.transition = 'opacity .5s ease';

        preloader.addEventListener('transitionend', () => {
            preloader.style.display = 'none';
            properties.classList.add('visible');
        });
    }, 100);
});