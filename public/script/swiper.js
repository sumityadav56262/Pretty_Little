import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs';

// Initialize Swiper
const swiper = new Swiper('.slide-wrapper', {
    slidesPerView: 3,
    slidesPerColumn: 3,
    slidesPerGroup :1,
    spaceBetween: 20,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
     },
    // Autoplay configuration
    autoplay: {
        delay: 2000, // Delay in milliseconds (1000ms = 1s)
        disableOnInteraction: false, // Continue autoplay after interaction
    },
    on: {
      init: function () {},
      orientationchange: function(){},
      beforeResize: function(){
        let vw = window.innerWidth;
        if(vw > 1200){
            swiper.params.slidesPerView = 4
            swiper.params.slidesPerColumn = 3
            swiper.params.slidesPerGroup = 1;
        } else if(vw>900) {
            swiper.params.slidesPerView = 2
            swiper.params.slidesPerColumn = 1
            swiper.params.slidesPerGroup =1;
        }else if(vw>600) {
            swiper.params.slidesPerView = 2
            swiper.params.slidesPerColumn = 1
            swiper.params.slidesPerGroup =1;
        }
        else{
          swiper.params.slidesPerView = 1
          swiper.params.slidesPerColumn = 1
          swiper.params.slidesPerGroup =1;
      }
        swiper.init();
      },
    },
    
});