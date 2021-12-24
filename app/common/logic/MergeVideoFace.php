<?php
namespace app\common\logic;

use AlibabaCloud\SDK\Videoenhan\V20200320\Videoenhan;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Videoenhan\V20200320\Models\MergeVideoFaceRequest;
use AlibabaCloud\SDK\Videoenhan\V20200320\Models\GetAsyncJobResultRequest;
use AlibabaCloud\SDK\ViapiUtils\ViapiUtils;

class MergeVideoFace {

    const ACCESS_KEY_ID = 'LTAI4FzMsNg84i2X2TVArGUU';
    const ACCESS_SECRET = 'T8zFGZkpxeaDQdjZ8Aha2bCRNqiI0T';
    /**
     * 使用AK&SK初始化账号Client
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @return Videoenhan Client
     */
    public static function createClient($accessKeyId, $accessKeySecret){
        $config = new Config([]);
        // 您的AccessKey ID
        $config->accessKeyId = $accessKeyId;
        // 您的AccessKey Secret
        $config->accessKeySecret = $accessKeySecret;
        // 访问的域名
        $config->endpoint = "videoenhan.cn-shanghai.aliyuncs.com";
        return new Videoenhan($config);
    }

    /**
     * 融合视频人脸
     * @param $args
     * @return array
     */
    public static function MergeVideoFace($args){
        $client = self::createClient(self::ACCESS_KEY_ID, self::ACCESS_SECRET);
        $mergeVideoFaceRequest = new MergeVideoFaceRequest($args);
        $result = $client->mergeVideoFace($mergeVideoFaceRequest);
        return $result->toMap();
    }

    /**
     * 获取异步任务结果
     * @param $args
     * @return array
     */
    public static function GetAsyncJobResult($args){
        $client = self::createClient(self::ACCESS_KEY_ID, self::ACCESS_SECRET);
        $getAsyncJobResultRequest = new GetAsyncJobResultRequest($args);
        $result = $client->getAsyncJobResult($getAsyncJobResultRequest);
        return $result->toMap();
    }

    /**
     * 上传临时文件
     * @param $url
     * @return string
     * @throws \Exception
     */
    public static function uploadTempFile($url){
        // 您的AccessKeyID
        $accessKeyId = self::ACCESS_KEY_ID;
        // 您的AccessKeySecret
        $accessKeySecret = self::ACCESS_SECRET;
        // 要上传的文件路径，url 或 filePath
        $fileUrl = $url;
        // 上传成功后，返回上传后的文件地址
        return ViapiUtils::upload($accessKeyId, $accessKeySecret, $fileUrl);
    }
}
