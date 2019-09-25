<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class TwitterFeed
{
    public function getFeed()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', "https://rss.app/feeds/6t9stPYPXp7FMKVt.xml");
        return simplexml_load_string($response->getContent());
    }
}
