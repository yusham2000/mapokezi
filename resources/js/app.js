import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const slides = Array.from(document.querySelectorAll('[data-slide]'));
    const rotator = document.querySelector('[data-rotator]');

    if (!slides.length || !rotator) {
        return;
    }

    const intervalSeconds = Number(rotator.getAttribute('data-interval') ?? 10);
    let activeIndex = 0;

    const showSlide = (nextIndex) => {
        slides.forEach((slide, index) => {
            slide.classList.toggle('hidden', index !== nextIndex);
        });

        activeIndex = nextIndex;
    };

    showSlide(activeIndex);

    window.setInterval(() => {
        const nextIndex = (activeIndex + 1) % slides.length;
        showSlide(nextIndex);
    }, intervalSeconds * 1000);
});
