<?php


class LolServer
{

    // lol 服务器状态查询地址
    private $serverUrl = 'https://serverstatus.native.qq.com/a20150326dqpd/a20150326dqpd/RetObj';
    // 返回结果
    private $result;
    // 缓存文件名称
    private $cacheFileName = 'lol_server_status.txt';
    // 从缓存中读取
    private $_readCache = false;

    /**
     * 是否从缓存中读取
     * @param bool $cache
     */
    public function readCache($cache = false) {
        $this->_readCache = $cache;
    }

    public function getStatusForName($name) {
        include_once dirname(__FILE__) . '/LolServerInfo.php';
        $lolServerInfo = new LolServerInfo();
        $id = $lolServerInfo->getId($name);

        $this->_getResult();
        $data = [];
        $resultArr = $this->resultToArray();

        if (!empty($resultArr) && $resultArr['status'] == 0) {
            include_once dirname(__FILE__) . '/LolServerStatus.php';
            $lolServerStatus = new LolServerStatus();

            include_once dirname(__FILE__) . '/LolAreaRange.php';
            $lolAreaRange = new LolAreaRange();

            foreach ($resultArr['msg'][0] as $key => $value) {
                if ($key == $id) {
                    $data = [
                        'serverId' => $key,
                        'serverName' => $lolServerInfo->getName($key),
                        'serverStatus' => $lolServerStatus->getStatus($value),
                        'serverArea' => $lolAreaRange->getArea($key)
                    ];
                    break;
                }
            }
        }
        return $data;
    }

    /**
     * lol服务器获取原始数据
     */
    private function _getResult() {
        if ($this->_readCache) {
            $this->getCache();
        } else {
            $this->getLolServerStatus();
        }
    }

    /**
     * 获取所有服务器状态
     * @return array
     */
    public function getAllStatus() {
        $this->_getResult();
        $data = [];
        $resultArr = $this->resultToArray();
        if (!empty($resultArr) && $resultArr['status'] == 0) {
            include_once dirname(__FILE__) . '/LolServerStatus.php';
            $lolServerStatus = new LolServerStatus();

            include_once dirname(__FILE__) . '/LolServerInfo.php';
            $lolServerInfo = new LolServerInfo();

            include_once dirname(__FILE__) . '/LolAreaRange.php';
            $lolAreaRange = new LolAreaRange();

            foreach ($resultArr['msg'][0] as $key => $value) {
                $data[] = [
                    'serverId' => $key,
                    'serverName' => $lolServerInfo->getName($key),
                    'serverStatus' => $lolServerStatus->getStatus($value),
                    'serverArea' => $lolAreaRange->getArea($key)
                ];
            }

        }
        return $data;
    }

    private function resultToArray() {
        if (!empty($this->result)) {
            preg_match('/RetObj=({*.+})/', $this->result, $data);
            if (!empty($data) && isset($data[1])) {
                return json_decode($data[1], true);
            }
        }
    }

    /**
     * 从LOl官网获取服务器状态
     */
    private function getLolServerStatus() {
        $this->result = file_get_contents($this->serverUrl);
        $this->writeCache();
    }

    /**
     * 写入缓存
     */
    private function writeCache() {
        if (!empty($this->result)) {
            file_put_contents($this->cacheFileName, $this->result . '_request date:' . date('Y-m-d H:i:s'));
        }
    }

    /**
     * 读取缓存
     */
    private function getCache() {
        if (is_file($this->cacheFileName)) {
            $this->result = file_get_contents($this->cacheFileName);
        } else {
            $this->getLolServerStatus();
        }
    }
}