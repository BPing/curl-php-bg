<?php

/**
 * curl
 *
 * @param $url    string
 * @param $data    array
 * @param $method    string
 * @param $header    array
 * @return mix $document
 */
function curlrequest($url, $data, $method = 'post', $header = array())
{
    $ch = curl_init(); //初始化CURL句柄

//	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);//连接超时
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);     //接收数据超时
    curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式

    $header[] = "X-HTTP-Method-Override: $method";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //设置HTTP头信息
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //设置提交的字符串
    //   curl_setopt($ch, CURLOPT_INFILESIZE, 60*1024*1024); //设置提交的字符串
//
    curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC); //代理认证模式
    curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1"); //代理服务器地址
    curl_setopt($ch, CURLOPT_PROXYPORT, 8888); //代理服务器端口
// //    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式

    $document = curl_exec($ch); //执行预定义的CURL
    if (curl_errno($ch)) {
        $info = curl_error($ch);
        log_message("info", $info);
    } else {
    }
    curl_close($ch);

    return $document;
}


/**
 * api curl
 * @param $url
 * @param $data
 * @param $method
 * @param $pkg
 * @return mixed
 */
function api_curl($url, $data, $method)
{
    $method = strtoupper($method);
    if ($method == 'GET' && !empty($data)) {
        $url = $url . "?" . http_build_query($data);
        $data = array();
    }
    return curlrequest($url, $data, $method);
}
