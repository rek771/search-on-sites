<?php
namespace App\Services;

use App\Contracts\Downloader;

class CurlDownloader implements Downloader
{
    /**
     * @inheritdoc
     */
    public function download(string $url): string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec ($ch);
        curl_close ($ch);
        return $data;
    }
}