<div class="container">
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Id задания</th>
                <th scope="col">Сайт</th>
                <th scope="col">Тип поиска</th>
                <th scope="col">Количество элементов</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tasks as $task) : ?>
                <tr>
                    <th scope="row"><?= $task['id'] ?></th>
                    <td>
                        <a href="#"
                           class="url-result-json"
                           data-json="<?= $task['result_json'] ?>">
                            <?= $task['url'] ?>
                        </a>
                    </td>
                    <td><?= $task['type'] ?></td>
                    <td><?= $task['result_count'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal" id="founded-elements-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Список найденных элементов</h5>
            </div>
            <div id="founded-elements-modal-body" class="modal-body">
                <p class="founded-element">Some text</p>
                <p class="founded-element">Some text</p>
                <p class="founded-element">Some text</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<script src="/../js/tasks.js">