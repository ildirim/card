<?php
namespace core\Services;

class CurlService
{
    public function call($url, $requestMethod, $data)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp);
    }
}