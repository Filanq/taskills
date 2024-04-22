import $ from 'jquery';

let wasClicked = false;
$('#favor_btn').click(function(e){
    if(wasClicked){
        return;
    }
    e.preventDefault();
    wasClicked = true;
    $.ajax({
        url: window.origin + '/profile/favorite',
        method: 'post',
        data: {
            '_token': $("#csrf").val(),
            "user_id": $("#user_id").val()
        },
        success(data){
            wasClicked = false;
            console.log(data)
            $('#favor_btn').text(data.text)
        }
    });
});
