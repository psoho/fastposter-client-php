<?php

namespace Fastposter;

/**
 * 海报返回对象
 */
class Poster
{
    public $result;
    public $name;
    public $msg;
    public $code = 0;

    public function __construct($name, $result)
    {
        $this->result = $result;
        $this->name = $name;
        // 判断第一个字符为'{'，说明海报生成失败!
        if ($result[0] == '{') {
            $x = json_decode($result);
            $this->msg = $x->msg;
            $this->code = $x->code;
            printf("海报生成失败: \n" . $result . "\n");
        }
    }

    public function save($filename = '')
    {
        if ($this->code != 0) {
            return null;
        }
        if ($filename == '') {
            $filename = $this->name;
        }
        file_put_contents($filename, $this->result);
        return $filename;
    }

}