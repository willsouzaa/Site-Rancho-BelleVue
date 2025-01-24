// Smooth scrolling for navbar links
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let carouselElement = document.querySelector('#carouselComodidades');
    let carouselInstance = new bootstrap.Carousel(carouselElement);

    // Avança para a próxima imagem ao clicar na imagem grande
    document.querySelectorAll('.carousel-img').forEach(img => {
        img.addEventListener('click', function () {
            carouselInstance.next();
        });
    });

    // Destacar a miniatura ativa ao mudar de slide
    carouselElement.addEventListener('slid.bs.carousel', function () {
        let activeIndex = document.querySelector('.carousel-inner .active').getAttribute('data-bs-slide-to');
        document.querySelectorAll('.thumb-indicator').forEach((thumb, index) => {
            thumb.classList.toggle('active', index == activeIndex);
        });
    });

    // Alterar slide ao clicar na miniatura
    document.querySelectorAll('.thumb-indicator').forEach((thumb, index) => {
        thumb.addEventListener('click', function () {
            carouselInstance.to(index);
        });
    });
});
