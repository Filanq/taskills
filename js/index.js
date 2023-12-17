const swiper = new Swiper('.swiper1', {
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
const swiper2 = new Swiper(".swiper2", {
    speed: 500,
    slidesPerView: 5,
    spaceBetween: 20,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        1280: { slidesPerView: 5 },
        1050: { slidesPerView: 4 },
        880: { slidesPerView: 3 },
        700: { slidesPerView: 2 },
        520: { slidesPerView: 1 },
        0: { slidesPerView: 1 },
    }
});

$('.category-card').on('click', function() {
    $('.category-title').text($(this).children('span').text());
    $('.category-card').removeClass('selected-category');
    $(this).addClass('selected-category');
});