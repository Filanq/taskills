import $ from 'jquery';
import Pusher from 'pusher-js';

const data = JSON.parse($("#dataForAjax").text());

window.Echo.leave('message.' + data.sender_id);
window.Echo.channel('user.' + data.user_id + '.' + data.sender_id)
    .listen('ChatEvent', (res) => {
        chatBlock.append(`
            <div class="block__dop_info--sms--answer">
                <img class="avatar__dop_info avatar__dop_info--answer" src="${data.avatarStorage + '/' + res.avatar}" alt="Аватар">
                <p class="text__dop_info text__dop_info--answer">${res.message}</p>
            </div>
        `);
        chatBlock[0].scrollTo(0, document.body.scrollHeight);
    });

let input = $('.chat_input');
let chatBlock = $(".wrap__dop_info--sms");
chatBlock[0].scrollTo(0, document.body.scrollHeight);
$('#chatForm')[0].addEventListener("submit", function(e){
    e.preventDefault();
    if(!input.val().trim()){return}
    $.ajax({
        url: this.action,
        method: 'post',
        data: {_token: data.csrf, user_id: data.user_id, sender_id: data.sender_id, message: input.val().trim()},
        success: function(res){
            if(chatBlock[0].children[0].tagName === "P" && chatBlock[0].children.length === 1){
                chatBlock.html('');
            }
            chatBlock.append(`
                <div class="block__dop_info--sms">
                    <img class="avatar__dop_info avatar__dop_info" src="${data.avatarStorage + '/' + res.avatar}" alt="Аватар">
                    <p class="text__dop_info text__dop_info">${res.message}</p>
                </div>
            `);
            chatBlock[0].scrollTo(0, document.body.scrollHeight);
        }
    });
    input.val('')
});
