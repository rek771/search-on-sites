<div class="container">
    <div class="row">
        <div id="alert-danger" class="alert alert-danger" role="alert" style="display: none"></div>
        <div id="alert-success" class="alert alert-success"
             role="alert" style="display: none"></div>
        <form action="javascript:void(0);">
            <div class="mb-3">
                <label for="site-url">Сайт</label>
                <input type="text" class="form-control" id="site-url">
                <div class="form-text">Введите адрес сайта, который нужно спарсить.</div>
            </div>
            <div class="mb-3">
                <label for="type-search" class="form-label">Тип поиска</label>
                <select class="form-select" id="type-search">
                    <option selected value="1">Картинки</option>
                    <option value="2">Ссылки</option>
                    <option value="3">Текст</option>
                </select>
                <div class="form-text">Выберите необходимый тип поиска.</div>
            </div>
            <div id="block-text-for-find" class="mb-3" style="display: none">
                <label for="text-for-find" class="form-label">Текст для поиска</label>
                <input type="text" class="form-control" id="text-for-find">
                <div class="form-text">Введите текст, по которому будет осуществляться поиск.</div>
            </div>
            <button id="send-new-task" class="btn btn-primary">Отправить</button>
        </form>
    </div>
</div>
<script src="/js/index.js">
