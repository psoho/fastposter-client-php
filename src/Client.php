<?php

namespace Fastposter;

require_once("Utils.php");

/**
 * 海报客户端（云服务）
 */
class Client
{
    private $apiUrl;

    private $token;

    /**
     * @param $token token<必传>
     * @param $endpoint 接入点<可选>
     */
    public function __construct($token, $endpoint = ENDPOINT)
    {
        $this->token = $token;
        $this->apiUrl = ($endpoint . "/v1/build/poster");
    }

    /**
     *
     * 生成海报
     *
     * @param $uuid 海报UUID
     * @param $params  海报动态参数
     * @param $type 生成的海报类型<png,jpeg,jpg,webp,pdf>
     * @return Poster
     */
    public function buildPoster($uuid, $params = [], $type = "png"): Poster
    {
        if (empty($params)) {
            $params = ["t" => ""];
        }
        $timestamp = time();
        $payload = json_encode($params);
        // 组装数据
        $data = [
            'uuid' => $uuid,
            'timestamp' => $timestamp,
            'payload' => $payload,
            'type' => $type
        ];
        $headers = ["token:" . $this->token];
        return new Poster($uuid . "." . $type, http_post($this->apiUrl, $data, $headers));
    }
}