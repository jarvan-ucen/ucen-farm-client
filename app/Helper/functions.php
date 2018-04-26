<?php

namespace app\Helper;

class common
{

    /**
     * curl模拟请求方法
     * @param $url
     * @param $cookie
     * @param array $data
     * @param $method
     * @param array $headers
     * @return mixed
     */
    static function http_request($url, $data = array(), $method = 'GET', $headers = array())
    {
        $curl = curl_init();
        if (count($data) && $method == "GET") {
            $data = array_filter($data);
            $url .= "?" . http_build_query($data);
            $url = str_replace(array('%5B0%5D'), array('[]'), $url);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (count($headers)) {
            $head = array();
            foreach ($headers as $name => $value) {
                $head[] = $name . ":" . $value;
            }
            curl_setopt($curl, CURLOPT_HTTPHEADER, $head);
        }
        $method = strtoupper($method);
        switch ($method) {
            case 'GET':
                break;
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case 'PUT':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case 'DELETE':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }
        if (!empty($cookie)) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}