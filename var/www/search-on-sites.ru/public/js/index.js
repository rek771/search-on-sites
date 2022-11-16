// todo генерация через mix
let sendNewTask = document.getElementById('send-new-task');
let typeSearchElem = document.getElementById('type-search');
let blockTextForFindElem = document.getElementById('block-text-for-find');

typeSearchElem.onchange = function (){
    if (typeSearchElem.value === "3"){
        blockTextForFindElem.style.display = 'block';
    }else{
        blockTextForFindElem.style.display = 'none';

    }
}
sendNewTask.onclick = function () {
    let siteElem = document.getElementById('site-url');
    let textForFindElem = document.getElementById('text-for-find');

    let goodInformer = document.getElementById('alert-success');
    let badInformer = document.getElementById('alert-danger');

    goodInformer.style.display = 'none';
    badInformer.style.display = 'none';

    if (siteElem.value.length <=0){
        badInformer.innerText = 'Ошибка: Поле "Сайт" не заполнено.';
        badInformer.style.display = 'block';
        throw new Error('Ошибка: Поле "Сайт" не заполнено.');

    }

    if (typeSearchElem.value === "3" && textForFindElem.value.length<=0){
        badInformer.innerText = 'Ошибка: Поле "Текст для поиска" не заполнено, хотя указан тип поиска "Текст".';
        badInformer.style.display = 'block';
        throw new Error('Ошибка: Поле "Текст для поиска" не заполнено, хотя указан тип поиска "Текст".');
    }

    let body = {
        'site': siteElem.value,
        'type': typeSearchElem.value,
        'textForFind': textForFindElem.value,
    }

    jQuery.ajax({
        type: 'POST',
        url: '/',
        data: body,
        success: function () {
            goodInformer.innerText = 'Успешно отправлено';
            goodInformer.style.display = 'block';

            siteElem.value = ''
            textForFindElem.value = ''
        },
        error: function(request) {
            badInformer.innerText = 'Ошибка: ' + request.responseText;
            badInformer.style.display = 'block';
        }
    })
};