<?php

namespace App\Contracts;

interface Downloader
{
    /**
     * Скачивает сайт по ссылке и передает обратно
     * @param string $url
     * @return string
     */
    public function download(string $url): string;
}