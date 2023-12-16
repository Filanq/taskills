const toggleBurger = () => {
    for (const el of [['.header-menu__nav', 'open-menu__nav'], ['.dark-fone', 'show-dark-fone'], ['.header-burger', 'open-menu__burger']]) $(el[0]).toggleClass(el[1]);
}
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