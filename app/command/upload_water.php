<?php
declare (strict_types = 1);

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

class upload_water extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('upload_water')
            ->setDescription('the upload_water command');
    }

    protected function execute(Input $input, Output $output)
    {
        $text = file_get_contents('public/backup.txt');
        $imgList = explode("\r\n", $text);
        $url = 'http://try.mama.cn/cli/ShowTrial/testImgWatermark';
        $failText = '';
        foreach ($imgList as $img){
            $data['img'] = $img;
            $result = request_curl($url, $data);
            if (strstr($result, 'success')) {
                $tips = '  成功';
            }else{
                $tips = '  失败';
            }
            file_put_contents('public/water.txt', $img . $tips . "\n", FILE_APPEND);
        }
    }
}
