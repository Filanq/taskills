import $ from "jquery";

const toggleModalNewFile = () => {
    for (const el of [['.darker', 'show-darker'], ['.modal-new-file', 'show-modal-new-file']]) $(el[0]).toggleClass(el[1]);
}
const newFile = type => {
    $('#inputFile').attr('name', (type === 'type1') ? 'disease' : 'certificate'); // name="disease" - диагноз     name="certificate" - справка
    if(type === 'type1'){
        $('.modal-new-file').html(`
            <form method="post" action="${window.origin + '/profile/logs-add'}">
                <h2>Добавить диагноз</h2>
                <label class="input-file">
                    <input value="${$('#csrf').val()}" type="hidden" name="_token">
                    <input value="${$('#user_id').val()}" type="hidden" name="user_id">
                    <input style="width: 100%; margin: 10px 0;" type="text" name="title" placeholder="Заголовок" required>
                </label>
                <input class="input-file-submit" type="submit" value="Отправить">
            </form>
        `);
    }
    else{
        $('.modal-new-file').html(`
            <form method="post" action="${window.origin + '/profile/certificate-add'}" enctype="multipart/form-data">
            <h2>Добавить справку</h2>
            <label class="input-file">
                <input value="${$('#csrf').val()}" type="hidden" name="_token">
                <input value="${$('#user_id').val()}" type="hidden" name="user_id">
                <input style="width: 100%; margin: 10px 0;" type="text" name="title" placeholder="Заголовок" required>
                <input style="width: 100%; margin: 10px 0;" name="file" type="file" required>
                <span class="selectedFile"></span>
            </label>
            <input class="input-file-submit" type="submit" value="Отправить">
        </form>
        `);
    }
    toggleModalNewFile();
}
document.querySelector('.darker').onclick = ()=>{
    toggleModalNewFile();
};
document.querySelector('#logAddBtn').onclick = ()=>{
    newFile('type1');
};
document.querySelector('#certAddBtn').onclick = ()=>{
    newFile('type2');
};
