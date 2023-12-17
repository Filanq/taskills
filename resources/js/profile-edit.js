import $ from 'jquery';

$('#password-form')[0].addEventListener('submit', function(e){
    e.preventDefault();
    $.ajax({
        type:'post',
        url: this.action,
        data: {
            'old_password': $('#old_password').val(),
            'new_password': $('#new_password').val(),
            '_token': $('#csrf').val()
        },
        success:function(data){
            $('#old_password').val('');
            $('#new_password').val('');
            alert("Данные сохранены");
        },
        error: function(data){
            alert(data.responseText);
        }
    });
});
//
// // const password_form_data = {
// //     'old_password': $('#old_password').val(),
// //     'new_password': $('#new_password').val(),
// //     '_token': $('#_token').val()
// // };
