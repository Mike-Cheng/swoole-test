<?php
// 应用公共文件
function request_curl( $url , $data = null ,$method = ''){
    //第1步：初始化curl，创建虚拟的浏览器
    $ch = curl_init();
    //第2步: 配置curl
    #设置要请求的地址，url来自函数的参数
    curl_setopt($ch, CURLOPT_URL, $url);
    //如果data不为empty那么就代表有数据包进行了传递，因此把curl的虚拟浏览器设置为post提交
    if( !empty($data) )
    {
        #是否使用post方式进行请求,如果需要设置为post提交必须设置为1而不是true
        #如果设置为true那么提交上传是永远不会成功的，如果当前是提交上传的话，那么php会抛出一个@上传建议
        #@上传建议，这个建议不是错误也不是警告，为了屏蔽该建议，所以我们需要用@符号来对curl_setopt进行临时屏蔽
        @curl_setopt($ch, CURLOPT_POST, 1);
        #POST请求时需要post的数据包
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    if($method == 'JSON')
        curl_setopt($ch, CURLOPT_HTTPHEADER,['Content-Type: application/json; charset=utf-8','Content-Length:' . strlen($data)]);
    #设置请求的返回为字符串形式
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    #禁止请求的服务器验证https中ssl证书
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //第3步:发出请求
    $str  = curl_exec($ch);
    //第4步:关闭curl
    curl_close($ch);
    //把请求的返回结果进行return
    return $str;
}