<?php


class LolServerStatus
{
    // 服务器状态
    private $serverStatus;

    public function __construct() {
        $this->serverStatus = [
            'G' => '正常',
            'Y' => '拥挤',
            'R' => '满载',
            'S' => '维护',
        ];
    }

    public function getStatus($tag) {
        $status = '';
        foreach ($this->serverStatus as $key => $value) {
           if ($tag == $key) {
               $status = $value;
               break;
           }
        }
        return $status;
    }

}