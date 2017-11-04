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

  const preloadNextImages = (event) => {
    const { nextSlide } = event.detail;

    const preloadImages = slide => {
      const { slideImage } = slide.dataset;

      if (!slide.querySelector('img')) {
        slide.innerHTML = slideImage + slide.innerHTML;
      }
    };

    if (nextSlide) {
      // preload next slides
      for(let i = 0; i <= 2; ++i) {
        const slideIndex = Math.min(nextSlide + i - 1, slides.length);
        const moreSlide = slides[slideIndex];

        if (moreSlide) {
          preloadImages(moreSlide);
        }
      }
    }
  };

  document.addEventListener('keydown', handleKeys);

  slider.addEventListener('before.lory.slide', preloadNextImages);

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
};

export { init };
