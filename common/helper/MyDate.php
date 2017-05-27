<?php
namespace common\helper;

class MyDate
{
    public function todayTime ($format = true) {
        return $format ? date('Y-m-d H:i:s') : date('Ymd');
    }
}