<?php

namespace App\Controllers;

use App\Core\Response;
use App\Helpers\User;
use App\Models\Task;

class TasksController extends Controller
{
    /**
     * @inheritdoc
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function get(): Response
    {
        $userId = User::id();

        /** @var \App\Models\Task $taskModel */
        $taskModel = $this->app->provider()->get(Task::class);
        $tasks = $taskModel->select("SELECT * FROM tasks WHERE user_id = '$userId'");


        foreach ($tasks as &$task) {
            switch ($task['type']) {
                case Task::TYPE_IMG:
                    $task['type'] = 'Картинки';
                    break;
                case Task::TYPE_HREF:
                    $task['type'] = 'Ссылки';
                    break;
                case Task::TYPE_TEXT:
                    $task['type'] = 'Текст';
                    break;
            }
        }

        return $this->response->withLayouts()->view('tasks', compact('tasks'));
    }
}