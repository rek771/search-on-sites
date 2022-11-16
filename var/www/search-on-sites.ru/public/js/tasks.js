// todo генерация через mix
let urlResultJsonElements = document.getElementsByClassName('url-result-json');
let foundedElementsModal = document.getElementById('founded-elements-modal');

[].forEach.call(urlResultJsonElements, function (urlResultJsonElem) {
    urlResultJsonElem.onclick = function (e) {
        console.log(555)
        let modal = new bootstrap.Modal(document.getElementById('founded-elements-modal'), {
            keyboard: false
        })
        modal.show();

        let foundedElementElem = Array.from(foundedElementsModal.getElementsByClassName('founded-element'));
        let foundedElementsBodyElem = document.getElementById('founded-elements-modal-body');

        foundedElementElem.forEach(foundedElem => {
            foundedElem.remove();
        });

        if (this.dataset.json === '[]') {
            foundedElementsBodyElem.insertAdjacentHTML('beforeend', '<h2 class="founded-element">Нет найденных элементов</h2>');
        } else {
            for (let elem in JSON.parse(this.dataset.json)) {
                foundedElementsBodyElem.insertAdjacentHTML('beforeend', `<p class="founded-element">${elem}</p>`);
            }
        }
    }
});