document.addEventListener('DOMContentLoaded', function () {
    const slidesContainer = document.querySelectorAll('.block-slider-splide .splide__track > .acf-innerblocks-container');
    slidesContainer.forEach(container => container.classList.add('splide__list'));

    const slides = document.querySelectorAll('.block-slider-splide .splide__list>*');
    slides.forEach(slide => slide.classList.add('splide__slide'));
})