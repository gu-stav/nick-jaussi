import debounce from 'debounce'
import domready from 'domready';
import { init as initSlider, destroy as destroySlider } from './modules/slider';

const createScreenAwareSlider = () => {
  if (window.innerWidth > 800) {
    initSlider();
  } else {
    destroySlider();
  }
};

domready(() => {
  createScreenAwareSlider();

  window.addEventListener('resize', debounce(() => createScreenAwareSlider(), 100));
});
