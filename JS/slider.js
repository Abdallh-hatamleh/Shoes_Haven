const swiper = new Swiper('.slider-wrapper', {
  loop: true,
  grabCursor: true,
  spaceBetween: 30,

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
    1100: {
      slidesPerView: 3
    },
    1500: {
      slidesPerView: 4
    }
  }
});

 const cards = document.querySelectorAll(".card-item");
cards.forEach(element => {
  element.addEventListener("click", ()=> {
    window.location.href = `product-view.php?id=${element.id}`;
  })
});