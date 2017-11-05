import debounce from 'debounce';

const ACTIVE_CLASS = 'story-detail-slide--active';

const init = () => {
  const slider = document.querySelector('.js-slider');
  const canvas = slider && slider.querySelector('.story-detail__canvas');
  const slides = slider && [...slider.querySelectorAll('.js-slide')];

  const findActiveSlide = () => {
    const slide = slides.find(_ => _.classList.contains(ACTIVE_CLASS));

    return slide || slides[0];
  };

  const slideAfter = nextSlide => {
    const index = slides.findIndex(_ => _ === nextSlide);

    if (index + 1 <= slides.length) {
      return slides[index + 1];
    }

    return null;
  };

  const slideBefore = nextSlide => {
    const index = slides.findIndex(_ => _ === nextSlide);

    if (index - 1 >= 0) {
      return slides[index - 1];
    }

    return null;
  };

  const scrollToSlide = slide => {
    const { offsetTop } = slide;

    canvas.style.transform = `translateY(${-offsetTop}px)`;
    slides.forEach(_ => _.classList.toggle(ACTIVE_CLASS, _ === slide));
  };

  const onScroll = event => {
    const activeSlide = findActiveSlide();
    const nextSlide =
      event.deltaY > 0 ? slideAfter(activeSlide) : slideBefore(activeSlide);

    if (nextSlide) {
      scrollToSlide(nextSlide);
    }
  };

  document.addEventListener('wheel', debounce(onScroll, 35));
};

export { init };
