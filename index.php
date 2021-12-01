<?php
/**
 * 获取lol服务器状态
 * date: 2021-12-02
 * author: chenwei
 * email: chenwei_gd@qq.com
 */
include_once dirname(__FILE__) . '/libs/LolServer.php';

$lolServer = new LolServer();
// 缓存中读取
$lolServer->readCache(true);
// 获取所有大区的状态
//print_r($lolServer->getAllStatus());
// 通过服务器名字获取状态
print_r($lolServer->getStatusForName('黑色玫瑰'));
?>