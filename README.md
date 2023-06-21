# fastposter 让海报开发更简单

云服务开发文档 https://cloud.fastposter.net/doc/guide/

## 安装

```bash
composer require fastposter/fastposter
```

## 使用
```php
include_once "vendor/autoload.php";

$client = new Fastposter\Client("ApfrIzxCoK1DwNZOEJCwlrnv6QZ0PCdv", "https://poster.prodapi.cn");

$params = [
    'title' => '我的第一个海报2'
];
$client->buildPoster("80058c79d1e2e617", $params)->save('a.png');
```