function modulo(number, mod) {
    let result = number % mod;
    if (result < 0) {
      result += mod;
    }
    return result;
}

function setUpCarousel(carousel) {
    function handleNext() {
        currentSlide = modulo(currentSlide + 1, numSlides);
        changeSlide(currentSlide);
    }

    function handlePrevious() {
        currentSlide = modulo(currentSlide - 1, numSlides);
        changeSlide(currentSlide);
    }

    function changeSlide(slideNumber) {
        slides.forEach(slide => {
            slide.style.display = 'none';
        });
        slides[slideNumber].style.display = 'block';
    }

    const buttonPrevious = carousel.querySelector('[data-carousel-button-previous]');
    const buttonNext = carousel.querySelector('[data-carousel-button-next]');
    const slidesContainer = carousel.querySelector('[data-carousel-slides-container]');
    const slides = slidesContainer.querySelectorAll('.slide');

    let currentSlide = 0;
    const numSlides = slides.length;

    buttonPrevious.addEventListener('click', handlePrevious);
    buttonNext.addEventListener('click', handleNext);
    changeSlide(currentSlide);
}

const carousels = document.querySelectorAll('[data-carousel]');
carousels.forEach(setUpCarousel);


