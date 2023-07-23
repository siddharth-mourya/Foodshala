n=4
if(screen.width<= 380)
    n=1
else if(screen.width<= 576)
    n=2
else if(screen.width <= 767)
    n=3
var swiper = new Swiper('.swiper-container', {
    slidesPerView: n,
    spaceBetween:15,
    centeredSlides: true,
    pagination: {
         el: '.swiper-pagination',
         clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
swiper.slideTo(2,false,false);


