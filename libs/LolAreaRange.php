<?php


class LolAreaRange
{
    // 地区
    private $areaRange;

    public function __construct() {
        $this->areaRange = [
            '电信区' => [1,3,4,5,7,8,10,11,13,14,15,17,18,19,22,23,24,25,27],
            '网通区' => [2,6,9,12,16,20,26],
            '其他' => [21,30]
        ];
    }

    public function getArea($id) {
        $area = '';
        foreach ($this->areaRange as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key1 => $value1) {
                    if ($value1 == $id) {
                        $area = $key;
                    }
                }
            }
        }
        return $area;
    }
}