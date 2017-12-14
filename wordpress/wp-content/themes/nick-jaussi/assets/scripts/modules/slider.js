const ACTIVE_CLASS = 'story-detail-slide--active';

const init = () => {
  const slider = document.getElementsByClassName('js-slider')[0];
  const canvas = slider && slider.getElementsByClassName('js-slider-canvas')[0];
  const slides = slider && [
    ...slider.getElementsByClassName('js-slider-slide')
  ];

  let lastScrolled = 0;

  if (!slider || !canvas || !slides || slides.length === 1) {
    return;
  }

  const findActiveSlide = () => {
    const active = slides.find(_ => _.classList.contains(ACTIVE_CLASS));

    if (!active) {
      return slides[0];
    }

    return active;
  };

  const findSlideByTitle = (title) =>
    slides.find(_ => _.classList.dataset.title === title);

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
    let value;

    if (offsetTop !== 0) {
      value = `translateY(${-offsetTop}px)`;
    } else {
       value = 'none';
    }

    canvas.style.transform = value;

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

  const onKeyDown = event => {
    const { keyCode } = event;
    const activeSlide = findActiveSlide();
    let nextSlide;

    switch(keyCode) {
      case 40:
      case 39:
        nextSlide = slideAfter(activeSlide);
        break;

      case 38:
      case 37:
        nextSlide = slideBefore(activeSlide);
        break;
    }

    if (nextSlide) {
      scrollToSlide(nextSlide);
      lastScrolled = currentTime;
    }
  };

  document.addEventListener('wheel', onScroll);
  document.addEventListener('mousewheel', onScroll);
  document.addEventListener('keydown', onKeyDown);
};

const destroy = () => {
  document.removeEventListener('wheel');
};

export { init, destroy };
