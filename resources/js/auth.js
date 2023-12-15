import $ from "jquery";

const eyeFunc = (eyeId, inputId) => {
    for (let id of inputId) {
        let input = $(`${id}`)[0];
        input.type = input.type === 'password' ? 'text' : 'password';
    }
    $(`#${eyeId}`).toggleClass('pass-close');
}

const switchForm = (form) => {
    if (form !== 'register' && form !== 'login') form = 'register';
    $('.forms-container')[0].scrollTo((form === 'login') ? 500 : 0, 0);
    window.history.replaceState([], '', `${form}`);
}

switchForm(window.location.pathname.slice(1));

$('#log-password-eye').click(function(){eyeFunc(this.id, ['#log-password__input'])});
$('#reg-password-eye').click(function(){eyeFunc(this.id, ['#reg-password__input', '#reg-password-again__input'])});
$('.log-link').click((e) => {e.preventDefault();switchForm('login')});
$('.reg-link').click((e) => {e.preventDefault();switchForm('register')});
