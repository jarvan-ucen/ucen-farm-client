<?php

namespace App\Http\Controllers\v1;

use app\Helper\common;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\player;

class testController extends Controller
{

    protected $connection = 'mongodb';

    public function test()
    {

        /*
        //加密值在加密期间都会经过序列化函数 serialize 进行处理，从而允许对对象和数组的加密。因此，非 PHP 客户端接收的加密数据需要进行 unserialize 反序列化
        echo encrypt('hello world!');
        $str = 'eyJpdiI6IkJiUDZRcURHUGJwcnhialFHdytLV2c9PSIsInZhbHVlIjoiTzc2Tnlpd1ZJcnFyXC9Ydjcyem5adXc9PSIsIm1hYyI6IjUyYzViMzYxMTNiNmM2MWMyNzU2YWEzNjk3MGEyOGVmZDQyNGViMDIwNjgwMzdiM2MyMWE5YmQ3NmZjODY5YzYifQ==';
        echo '<br>';


        try {
            $decrypted = decrypt($str);
            echo $decrypted;
        } catch (DecryptException $e) {
            echo $e->getMessage();
        }
        echo '<br>';





        //加密和解密数据时不进行序列化操作，可以使用 Crypt 门面提供的 encryptString 和 decryptString 方法
        $encrypted = Crypt::encryptString('hello world!');
        echo $encrypted;
        echo '<br>';
        $decrypted = Crypt::decryptString($encrypted);
        echo $decrypted;
        echo '<br>';
        */


//        $player = DB::collection('player')->where(['population'=>['$gt'=>1000]])->select(['account','population'])->get()->toarray();

        $a = player::where('population', '>', 1)
            ->orWhere('gold', '>', 99999)
//            ->where('account', 'like', '%ar%')
            ->select(['_id', 'account', 'population', 'gold'])
            ->take(20)
//            ->distinct()
//            ->get(['_id'])
            ->get()
            ->toarray();
        echo '<pre>';
        var_dump($a);
//        var_dump($users);
//    $user = DB::collection('farm_1')->where('name', 'John')->first();
    }

    public function test1()
    {
        $account = 'jarvan';
        $serverId = 1;
        $candy = -1000;
        $play = -100;

        $urlGetToken = sprintf(config('config.getToken'), config('config.TCPAddr'), config('config.account'), config('config.pwd'));
        $getToken = common::http_request($urlGetToken);
        $json = json_decode($getToken);
        $token = $json->token;
        var_dump($token);
        $urlChange = sprintf(config('config.chargeByWeb'),config('config.TCPAddr'),$serverId,$account,$candy,$play,$token);
        var_dump($urlChange);
        echo '<br>';
        $json = common::http_request($urlChange);
        $data = json_decode($json);
        var_dump($data);
    }
}