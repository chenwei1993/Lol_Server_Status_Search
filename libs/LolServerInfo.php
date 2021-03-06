<?php


class LolServerInfo
{
    // 服务器信息
    private $serverInfo;

    public function __construct() {
        $this->serverInfo = [
            '1' => '艾欧尼亚',
            '2' => '比尔吉沃特',
            '14' => '黑色玫瑰',
            '4' => '诺克萨斯',
            '5' => '班德尔城',
            '6' => '德玛西亚',
            '7' => '皮尔特沃夫',
            '8' => '战争学院',
            '9' => '弗雷尔卓德',
            '10' => '巨神峰',
            '11' => '雷瑟守备',
            '12' => '无畏先锋',
            '13' => '裁决之地',
            '3' => '祖安',
            '15' => '暗影岛',
            '16' => '恕瑞玛',
            '17' => '钢铁烈阳',
            '18' => '水晶之痕',
            '19' => '均衡教派',
            '20' => '扭曲丛林',
            '21' => '教育网专区',
            '22' => '影流',
            '23' => '守望之海',
            '24' => '征服之海',
            '25' => '卡拉曼达',
            '26' => '巨龙之巢',
            '27' => '皮城警备',
            '30' => '男爵领域',
        ];
    }

    public function getName($id) {
        $name = '';
        foreach ($this->serverInfo as $key => $value) {
            if ($id == $key) {
                $name = $value;
                break;
            }
        }
        return $name;
    }

    public function getId($name) {
        $id = 0;
        foreach ($this->serverInfo as $key => $value) {
            if ($name == $value) {
                $id = $key;
                break;
            }
        }
        return $id;
    }
}