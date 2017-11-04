import 'core-js/fn/array/for-each';

import domready from 'domready';
import { init as initSlider } from './modules/slider';

domready(() => {
  initSlider();
});
