<?php

namespace App\Controllers;

use App\Core\Response;
use App\Helpers\User;
use App\Models\Task;

class IndexController extends Controller
{
    /**
     * @inheritdoc
     */
    public function get(): Response
    {
        return $this->response->withLayouts()->view('index');
    }

    /**
     * @inheritdoc
     * @return \App\Core\Response
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function post(): Response
    {
        $siteUrl = $this->request->get('site') ?? null;

        if (empty($siteUrl)) {
            return $this->response->code(400)->body('Поле "Сайт" не заполнено.');
        }

        $findType = $this->request->get('type') ?? null;
        $textForFind = null;
        if ($findType == 3) {
            $textForFind = $this->request->get('textForFind') ?? null;

            if (empty($textForFind)) {
                return $this->response->code(400)->body('Поле "Текст для поиска" не заполнено, хотя указан тип поиска "Текст".');
            }
        }

        $userId = User::id();

        /** @var Task $task */
        $task = $this->app->provider()->get(Task::class);

        if (!empty($textForFind)) {
            $task->insert("user_id, url, type, type_text", "$userId, $siteUrl, $findType, $textForFind");
        }else{
            $task->insert("user_id, url, type", "'$userId', '$siteUrl', $findType");
        }

        return $this->response->code(200)->body('OK');
    }
}