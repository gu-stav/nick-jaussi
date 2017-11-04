import { lory } from 'lory.js';

const init = () => {
  const slider = document.querySelector('.js-slider');
  const slides = slider && slider.querySelectorAll('.js-slide');

  // no slider present on the page
  if (!slider || !slides) {
    return;
  }

  const sliderInstance = lory(slider, {
    classNameFrame: 'story-detail__frame',
    classNameSlideContainer: 'story-detail__slides',
    enableMouseEvents: true,
    rewind: true
  });

  const handleKeys = event => {
    const { keyCode } = event;

    // eslint-disable-next-line default-case
    switch (keyCode) {
      case 39:
      case 40:
        sliderInstance.next();
        break;

      case 37:
      case 38:
        sliderInstance.prev();
        break;
    }
  };

  const preloadNextImages = event => {
    const { nextSlide } = event.detail;

    const preloadImages = slide => {
      const { slideImage } = slide.dataset;

      if (!slide.querySelector('img')) {
        // eslint-disable-next-line no-param-reassign
        slide.innerHTML = slideImage + slide.innerHTML;
      }
    };

    if (nextSlide) {
      // eslint-disable-next-line no-plusplus
      for (let i = 0; i <= 2; ++i) {
        const slideIndex = Math.min(nextSlide + i - 1, slides.length);
        const moreSlide = slides[slideIndex];

        if (moreSlide) {
          preloadImages(moreSlide);
        }
      }
    }
  };

  const updateSliderArrows = event => {
    let { currentSlide } = (event && event.detail) || {};

    if (!currentSlide) {
      currentSlide = 0;
    }

    const isFirst = currentSlide === 0;
    const isLast = currentSlide === slides.length;

    slider.classList.toggle('story-detail--no-prev', isFirst);
    slider.classList.toggle('story-detail--no-next', isLast);
  };

  document.addEventListener('keydown', handleKeys);

  slider.addEventListener('before.lory.slide', preloadNextImages);
  slider.addEventListener('after.lory.slide', updateSliderArrows);

  slider.addEventListener('click', event => {
    const { target } = event;

    // Controls
    if (target.matches('.js-slider-control')) {
      event.preventDefault();

      const { direction } = target.dataset;

      // eslint-disable-next-line default-case
      switch (direction) {
        case 'previous':
          sliderInstance.prev();
          break;
        case 'next':
          sliderInstance.next();
          break;
      }
    }
  });

  updateSliderArrows();
};

export { init };
