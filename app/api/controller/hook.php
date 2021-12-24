<?php
namespace app\api\controller;

use Co\WaitGroup;

class hook
{
    public function test() {
        echo date('Y-m-d H:i:s') . '--start..' . '<br/>';
        $result = [];
        for ($i = 1; $i <= 3; $i++) {
            $result[] = $i;
            sleep(1);
        }

        for ($n = 11; $n <= 13; $n++) {
            $result[] = $n;
            sleep(1);
        }
        echo date('Y-m-d H:i:s') . '--done..' . PHP_EOL;
        dump($result);
    }

    public function testHook()
    {
        echo date('Y-m-d H:i:s') . '--start..' . '<br/>';
        $result = [];
        $wg = new WaitGroup();
        $wg->add();
        go(function () use ($wg, &$result) {
            for ($i = 1; $i <= 3; $i++) {
                $result[] = $i;
                sleep(1);
            }
            $wg->done();
        });

        $wg->add();
        go(function () use ($wg, &$result) {
            for ($n = 11; $n <= 13; $n++) {
                $result[] = $n;
                sleep(1);
            }
            $wg->done();
        });
        $wg->wait();
        echo date('Y-m-d H:i:s') . '--done..' . PHP_EOL;
        dump($result);
    }
}