import domready from 'domready';
import { lory } from 'lory.js';

domready(() => {
  const slider = document.querySelector('.js-slider');

  lory(slider, {
    classNameFrame: 'story-detail__frame',
    classNameSlideContainer: 'story-detail__slides',
    enableMouseEvents: true,
  });
});
