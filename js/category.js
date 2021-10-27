$(function () {
  if ($(".gallery-wrapper").length) {
    var galleryThumbs = new Swiper(
      ".gallery-wrapper .content .gallery.thumb .swiper-container",
      {
        speed: 900,
        effect: "slide",
        spaceBetween: 0,
        grabCursor: true,
        simulateTouch: true,
        loop: false,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        autoHeight: true,
        navigation: {
          nextEl:
            ".gallery-wrapper .content .gallery.thumb .swiper-next-button",
          prevEl:
            ".gallery-wrapper .content .gallery.thumb .swiper-prev-button",
        },
        breakpoints: {
          320: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          414: {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          768: {
            slidesPerView: 5,
            spaceBetween: 10,
          },
          1024: {
            slidesPerView: 7,
            spaceBetween: 10,
          },
        },
        on: {
          init: function () {
            let containerThumbWidth = $(
              ".gallery-wrapper .content .gallery.thumb"
            ).outerWidth();

            let totalThumbWidth = 0;

            $(
              ".gallery.thumb .swiper-container .swiper-wrapper .swiper-slide"
            ).each(function () {
              let thumbWidth = $(this).outerWidth();
              totalThumbWidth += thumbWidth;
            });

            if (totalThumbWidth < containerThumbWidth) {
              $(
                ".gallery.thumb .swiper-next-button, .gallery.thumb .swiper-prev-button"
              ).addClass("hide");
            } else {
              $(
                ".gallery.thumb .swiper-next-button, .gallery.thumb .swiper-prev-button"
              ).removeClass("hide");
            }
          },
        },
      }
    );

    var galleryFull = new Swiper(
      ".gallery-wrapper .content .gallery.full .swiper-container",
      {
        speed: 900,
        effect: "slider",
        slidesPerView: 3,
        spaceBetween: 0,
        centeredSlides: true,
        autoplay: false,
        keyboard: {
          enabled: true,
        },
        grabCursor: true,
        simulateTouch: true,
        loop: true,
        navigation: {
          nextEl: ".gallery-wrapper .content .gallery.full .swiper-next-button",
          prevEl: ".gallery-wrapper .content .gallery.full .swiper-prev-button",
        },
        thumbs: {
          swiper: galleryThumbs,
        },
        on: {
          slideChangeTransitionStart: function () {
            $(
              ".gallery-wrapper .content .gallery.full .swiper-slide h1"
            ).removeClass("show");
          },
          slideChangeTransitionEnd: function () {
            $(
              ".gallery-wrapper .content .gallery.full .swiper-slide-active h1"
            ).addClass("show");
          },
        },
      }
    );
  }
});