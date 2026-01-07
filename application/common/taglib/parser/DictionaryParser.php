<?php


namespace app\common\taglib\parser;


use Exception;

use think\Db;

use app\common\enum\YesnoEnum;

class DictionaryParser
{
    /**
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function getList(array $params)
    {
        $where[] = ['dict.status', '=', YesnoEnum::YES];
        $where[] = ['type.status', '=', YesnoEnum::YES];
        $where[] = ['type.identify', '=', $params['identify']];

        if (isset($params['value'])) {
            $where[] = ['dict.value', '=', $params['value']];
        }

        return Db::name('system_dict_data')
            ->alias('dict')
            ->join('system_dict_type type', 'type.dictId = dict.dictId')
            ->where($where)
            ->order('type.sort')
            ->select();
    }
}