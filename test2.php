<?php

include_once "vendor/autoload.php";

$client = new Fastposter\CloudClient("166f703676bb42ab", "6cda907657854eb3858269c76c2c5118");
$params = [
    'name' => '我的第一个海报'
];
$client->buildPoster("2ef32fb23c6d458b", $params)->save();


