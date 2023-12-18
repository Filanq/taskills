import { Swiper } from "swiper";
import { Navigation, Pagination, Autoplay } from "swiper/modules";
import $ from 'jquery';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

$('.category-card').on('click', function() {
    $('.category-title').text($(this).children('span').text());
    $('.category-card').removeClass('selected-category');
    $(this).addClass('selected-category');
    $('.wrap__dop_info--doctors_card').html('');
    Array.from($('#block-' + $(this)[0].id)[0].children).forEach(e => {
        // $('.category-card').children('span').text(e.textContent)
        $('.wrap__dop_info--doctors_card').append(`
            <a class="swiper-slide block__dop_info--doctors_card" href="${window.origin + '/profile/' + e.dataset.id}">
                <div><img class="avatat__dop_info--doctor" src="${window.origin + '/img/avatars/' + e.dataset.avatar}" alt="doctor_photo"></div>
                <span>${e.textContent}</span>
            </a>
        `);
    });
});
$('.selected-category').click()

$('.request__input').on({
    focus: () => { if ($('.request__input').val() !== '') $('.results').addClass('show-results'); },
    // blur: () => { $('.results').removeClass('show-results'); },
});
$('body').click(function(e){
    if(e.target != $('.results-container')[0]){
        $('.results').removeClass('show-results');
    }
});

$('#search-form').on('submit', (e) => {
    e.preventDefault();
    document.querySelector('.request__input').focus();
    $('.request-now').text(`Результаты поиска по запросу: ${$('.request__input').val()}`);

    $.ajax({
        url: window.origin + '/search',
        method: 'post',
        data: {
            '_token' : $('#csrf').val(),
            'query': $('.request__input').val()
        },
        success(data){
            $('.results-container').html('');

            data.forEach(e => {
                $('.results-container').append(`
                    <a href="${window.origin + '/profile/' + e.id}">
                        <div><img src="${window.origin + '/img/avatars/' + e.avatar}" alt="doctor_photo"></div>
                        <div>
                            <span>${e.name}</span>
                            <span>${e.specialization}</span>
                        </div>
                    </a>
                `);
            });
            $('.results').addClass('show-results');
        }
    });

});

window.addEventListener('DOMContentLoaded', function(){
    new Swiper('.swiper1', {
        modules: [Navigation, Pagination, Autoplay],
        speed: 500,
        autoplay: {
            delay: 7000,
        },
        spaceBetween: 10,
        pagination: {
            el: '.pag1',
            clickable: true,
            enabled: true
        },
    });
    new Swiper(".swiper2", {
        modules: [Navigation, Pagination, Autoplay],
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
});
