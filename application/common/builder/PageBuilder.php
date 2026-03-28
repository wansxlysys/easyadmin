<?php


namespace app\common\builder;


use think\db\Query;
use think\exception\DbException;

class PageBuilder
{
    /**
     * 构建分页
     * @param Query $query
     * @param $pageNum
     * @param $pageSize
     * @return array
     * @throws DbException
     */
    public static function build(Query $query, $pageNum = 1, $pageSize = 15)
    {
        $page = $query->paginate([
            'page'      => $pageNum,
            'list_rows' => $pageSize,
        ]);

        return ['list' => $page->items(), 'total' => $page->total()];
    }
}