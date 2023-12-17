const swiper = new Swiper('.swiper1', {
    speed: 500,
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
    pagination: {
        el: '.swiper2-pagination',
        clickable: true,
    },
    breakpoints: {
        1280: { slidesPerView: 6 },
        1050: { slidesPerView: 5 },
        880: { slidesPerView: 4 },
        700: { slidesPerView: 3 },
        520: { slidesPerView: 2 },
        0: { slidesPerView: 1 },
    }
});

$('.category-card').on('click', function() {
    $('.category-title').text($(this).children('span').text());
    $('.category-card').removeClass('selected-category');
    $(this).addClass('selected-category');
    /* 
    
    тут пропишешь запрос 

    $('.category-card').children('span').text() // здесь текст запроса (должность, приязанная к кнопке, на которую нажали)
    $('.wrap__dop_info--doctors_card').html( сюда вставишь ответ(карточки, как в html) );
    */
});

$('.request__input').on({
    focus: () => { if ($('.request__input').val() !== '') $('.results').addClass('show-results'); },
    blur: () => { $('.results').removeClass('show-results'); },
});

$('.request__button').on('click', () => {
    document.querySelector('.request__input').focus();
    $('.request-now').text(`Результаты поиска по запросу: ${$('.request__input').val()}`);
    /* 
    
    тут пропишешь запрос 

    $('.request__input').val() // здесь текст запроса
    $('.results-container').html( сюда вставишь ответ(карточки, как в html) );
    */
});