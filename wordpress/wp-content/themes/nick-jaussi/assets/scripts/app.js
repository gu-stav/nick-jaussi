import debounce from 'debounce';
import domready from 'domready';
import { init as initSlider, destroy as destroySlider } from './modules/slider';

const createSlider = () => {
  if (window.innerWidth > 760) {
    initSlider();
  } else {
    destroySlider();
  }
};

domready(() => {
  createSlider();

  window.addEventListener(
    'resize',
    debounce(() => createSlider(), 100)
  );
});
