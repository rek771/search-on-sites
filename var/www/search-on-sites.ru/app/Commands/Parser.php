<?php

namespace App\Commands;

use App\Contracts\Downloader;
use App\Models\Task;

class Parser extends Command
{
    const TEMPLATE_IMG = '<a href="(.+)">';
    const TEMPLATE_HREF = '<img src="(.+)">';
    const TEMPLATE_TEXT = '(%s)';

    /**
     * @inheritdoc
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function run():void
    {
        /** @var Task $task */
        $task = $this->app->provider()->get(Task::class);
        $taskForParse = $task->select("SELECT * FROM tasks WHERE result_json is null LIMIT 1");
        if (empty($taskForParse)) {
            sleep(60); // ждем минуту чтобы сразу не перезапуститься и дать паузу для появления новых заданий
            return;
        }
        $taskForParse = $taskForParse[0];

        /** @var Downloader $downloader */
        $downloader = $this->app->provider()->get(Downloader::class);
        $downloadedPage = $downloader->download($taskForParse['url']);

        switch ($taskForParse['type']) {
            case Task::TYPE_IMG:
                preg_match(self::TEMPLATE_IMG, $downloadedPage,$matches);
                break;
            case Task::TYPE_HREF:
                preg_match(self::TEMPLATE_HREF, $downloadedPage,$matches);
                break;
            case Task::TYPE_TEXT:
                var_dump(sprintf(self::TEMPLATE_TEXT, $taskForParse['type_text']));
                preg_match(sprintf(self::TEMPLATE_TEXT, $taskForParse['type_text']), $downloadedPage,$matches);
                break;
        }

        if(empty($matches)){
            $task->execute("UPDATE tasks SET result_json = '[]', result_count = 0 WHERE id = {$taskForParse['id']}");
        }else{
            $resultCount = count($matches);
            $resultJson = json_encode($matches, JSON_HEX_QUOT);
            $task->execute("UPDATE tasks SET result_json = '{$resultJson}', result_count = {$resultCount} WHERE id = {$taskForParse['id']}");

        }
    }
}