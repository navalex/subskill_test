<?php

namespace App\Service;

class FacebookFeed {

    private $fb;

    public function __construct()
    {
        $this->fb = new \Facebook\Facebook([
            'app_id' => '493172698170178',
            'app_secret' => 'dbc161faf1f73f4e1c88c1d3def33e14',
            'default_graph_version' => 'v4',
            'default_access_token' => 'd00bd39440535bb3437255310cca9533'
        ]);
    }
}
