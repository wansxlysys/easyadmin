<?php


namespace app\common\taglib\parser;


use Exception;

use think\Db;

class SettingParser
{
    /**
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function getValue(array $params)
    {
        return Db::name('system_setting')
            ->where('type', $params['type'])
            ->where('identify', $params['identify'])
            ->value('value');
    }
}