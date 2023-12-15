const eyeFunc = (eyeId, inputId) => {
    for (i = 0; i < inputId.length; i++) {
        input = $(inputId[i]);
        input.attr('type', (input.attr('type') === 'password') ? 'text' : 'password');
    }
    $(eyeId).toggleClass('pass-close');
}

const switchForm = (form) => {
    if (form !== 'reg' && form !== 'log') form = 'reg';
    document.querySelector('.forms-container').scrollTo((form === 'log') ? 500 : 0, 0);
    location.hash = form;
}

switchForm(location.hash.split('#')[1]);

window.onhashchange = () => { 
    switchForm(location.hash.split('#')[1]);
}