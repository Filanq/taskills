const swiper = new Swiper('.swiper', {
    speed: 500,
    loop: true,
    autoplay: {
        delay: 7000,
    },
    spaceBetween: 10,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});
const swiper2 = new Swiper('.swiper2', {
    speed: 500,
    spaceBetween: 10,
    pagination: {
        el: '.swiper2-pagination',
        clickable: true,
    },
});