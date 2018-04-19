<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class player extends Model
{
    protected $table = 'player';
    public $warehouse = [
        11 => '小麦',
        12 => '玉米',
        13 => '胡萝卜',
        1001 => '牛饲料',
        1002 => '鸡饲料',
        2001 => '牛奶',
        2002 => '鸡蛋',
        3001 => '奶酪',

    ];
    public $dragon = [
        0 => '囚牛',
        1 => '睚眦',
        2 => '嘲风',
        3 => '蒲牢',
        4 => '狻猊',
        5 => '赑屃',
        6 => '狴犴',
        7 => '负屃',
        8 => '螭吻',
    ];
}
