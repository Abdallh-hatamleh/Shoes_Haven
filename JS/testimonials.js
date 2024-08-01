
const swiperr = new Swiper('.sliderr-wrapper', {
  loop: true,
  grabCursor: true,
  spaceBetween: 30,

  // Autoplay configuration
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },

  // Pagination bullets
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
    dynamicBullets: true
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // Responsive breakpoints
  breakpoints: {
    0: {
      slidesPerView: 1
    },
    768: {
      slidesPerView: 2
    },
    1024: {
      slidesPerView: 3
    }
  }
});

// Pause autoplay on hover
const sliderWrapperr = document.querySelector('.sliderr-wrapper');

sliderWrapperr.addEventListener('mouseenter', () => {
  swiperr.autoplay.stop();
});

sliderWrapperr.addEventListener('mouseleave', () => {
  swiperr.autoplay.start();
});