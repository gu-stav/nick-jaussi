import { lory } from 'lory.js';

const init = () => {
  const slider = document.querySelector('.js-slider');
  const slides = slider.querySelectorAll('.js-slide');
  const sliderInstance = lory(slider, {
    classNameFrame: 'story-detail__frame',
    classNameSlideContainer: 'story-detail__slides',
    enableMouseEvents: true,
    rewind: true,
  });

  const handleKeys = (event) => {
    const { keyCode } = event;

    switch(keyCode) {
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

  const updateURLParts = (event) => {
    const { currentSlide } = event.detail;
    const { slideTitle } = slides[currentSlide].dataset || {};

    if (slideTitle) {
      window.location.hash = slideTitle;
    } else {
      window.location.hash = '';
    }
  };

  const updateInitialSlide = () => {
    const title = window.location.hash.substr(1);

    slides.forEach((slide, index) => {
      const { slideTitle } = slide.dataset;

      if (slideTitle === title) {
        sliderInstance.slideTo(index);
      }
    });
  };

  document.addEventListener('keydown', handleKeys);

  slider.addEventListener('after.lory.slide', updateURLParts);

  slider.addEventListener('click', (event) => {
    const { target } = event;

    // Controls
    if (target.matches('.js-slider-control')) {
      event.preventDefault();

      const { direction } = target.dataset;

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

  updateInitialSlide();
};

export { init };
