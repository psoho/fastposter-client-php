<?php

namespace Fastposter;

require_once("Utils.php");

/**
 * 海报客户端（云服务）
 */
class CloudClient
{
    private $apiUrl;
    private $appKey;
    private $appSecret;

    /**
     * @param $appKey AppKey
     * @param $appSecret AppSecret
     */
    public function __construct($appKey, $appSecret)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->apiUrl = ENDPOINT . "/v1/build/poster";
    }

    public function buildPoster($uuid, $params = [], $type = "png")
    {
        if (empty($params)) {
            $params = ["t" => ""];
        }
        $timestamp = time();
        $nonce = getRandStr();
        $payload = json_encode($params);
        // 加密签名
        $sign = md5($payload . $timestamp . $nonce . $this->appSecret);
        // 组装数据
        $data = [
            'uuid' => $uuid,
            'appKey' => $this->appKey,
            'timestamp' => $timestamp,
            'nonce' => $nonce,
            'payload' => $payload,
            'sign' => $sign,
            'type' => $type
        ];
        return new Poster($uuid . "." . $type, http_post($this->apiUrl, $data));
    }

}