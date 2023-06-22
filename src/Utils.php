<?php

namespace Fastposter;

// 定义常量 客户端HTTP请求头
define("FASTPOSETER_CLIENT_HEADERS", [
    "Content-type:application/json",
    "Client-Type:php",
    "Client-Version:1.2.0"
]);

// 定义常量 接入点
define("ENDPOINT", "https://api.fastposter.net");
//define("ENDPOINT", "https://poster.prodapi.cn");

function getRandStr(int $len = 16): string
{
    $chars = array(
        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",
        "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",
        "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",
        "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
        "3", "4", "5", "6", "7", "8", "9"
    );
    $charsLen = count($chars) - 1;
    shuffle($chars);
    $output = "";
    for ($i = 0; $i <= $len; $i++) {
        $output .= $chars[mt_rand(0, $charsLen)];
    }
    return $output;
}

function http_post($url, $data = [], $headers = [])
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($headers)) {
        $headers = array_merge(FASTPOSETER_CLIENT_HEADERS, $headers);
    } else {
        $headers = FASTPOSETER_CLIENT_HEADERS;
    }
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    $result = curl_exec($curl);
//    $info = curl_getinfo($curl);
//    print(json_encode($info, JSON_PRETTY_PRINT));
    curl_close($curl);
    return $result;
}