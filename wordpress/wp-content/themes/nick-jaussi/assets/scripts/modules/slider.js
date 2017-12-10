const ACTIVE_CLASS = 'story-detail-slide--active';

const init = () => {
  const slider = document.getElementsByClassName('js-slider')[0];
  const canvas = slider && slider.getElementsByClassName('js-slider-canvas')[0];
  const slides = slider && [
    ...slider.getElementsByClassName('js-slider-slide')
  ];

  let lastScrolled = 0;

  if (!slider || !canvas || !slides) {
    return;
  }

  const findActiveSlide = () =>
    slides.find(_ => _.classList.contains(ACTIVE_CLASS));

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
    const currentTime = new Date().getTime();

    if (lastScrolled + 1100 > currentTime) {
      return false;
    }

    const activeSlide = findActiveSlide();
    const nextSlide =
      event.deltaY > 0 ? slideAfter(activeSlide) : slideBefore(activeSlide);

    if (nextSlide) {
      scrollToSlide(nextSlide);
      lastScrolled = currentTime;
    }

    return true;
  };

  document.addEventListener('wheel', onScroll);
  document.addEventListener('mousewheel', onScroll);
};

const destroy = () => {
  document.removeEventListener('wheel');
};

export { init, destroy };
