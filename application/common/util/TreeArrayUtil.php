<?php


namespace app\common\util;


class TreeArrayUtil
{
    /**
     * ID名称
     * @var string
     */
    public $id = 'id';

    /**
     * 上级ID名称
     * @var string
     */
    public $parentId = 'parentId';

    /**
     * 子元素名称
     * @var string
     */
    public $children = 'children';

    /**
     * 级别名称
     * @var int
     */
    public $level = 'level';

    /**
     * 结构名称
     * @var string
     */
    public $struct = 'struct';

    /**
     * 结构符号
     * @var string
     */
    public $symbol = '├─';

    /**
     * 数组转树形组件
     * @param $array
     * @param int $parentId
     * @param null $resolve
     * @return array
     */
    public function arrayToTree($array, $parentId = 0, $resolve = null)
    {
        $arrayMap  = [];
        $treeArray = [];

        foreach ($array as $key => $item) {

            /**
             * 设置映射
             */
            $arrayMap[$item[$this->id]] = &$array[$key];
        }

        foreach ($array as $key => $item) {

            /**
             * 获取下级
             */
            if (isset($arrayMap[$item[$this->parentId]])) {
                $arrayMap[$item[$this->parentId]][$this->children][] = &$array[$key];
            }

            /**
             * 过滤上级
             */
            if ($parentId == $item[$this->parentId]) {
                $treeArray[$item[$this->id]] = &$array[$key];
            }

            /**
             * 获取级别
             */
            $array[$key][$this->level] = $this->getLevel($arrayMap, $item[$this->parentId]);

            /**
             * 回调函数
             */
            if (is_callable($resolve)) {
                $resolve($array[$key]);
            }
        }

        return $treeArray;
    }

    /**
     * 树形组件转数组
     * @param array $tree
     * @param bool $removeChild
     * @param array $result
     * @return array
     */
    public function treeToArray($tree, $removeChild = true, &$result = [])
    {
        foreach ($tree as $key => $item) {

            if (!empty($item[$this->children])) {
                $this->treeToArray($item[$this->children], $removeChild, $result);
            }

            if ($removeChild) {
                unset($item[$this->children]);
            }

            $result[] = $item;
        }

        return $result;
    }

    /**
     * 获取树形结构
     * @param $array
     * @param int $parentId
     * @param int $level
     * @param null $resolve
     * @param array $result
     * @return array
     */
    public function arrayToTreeStruct($array, $parentId = 0, $level = 1, $resolve = null, &$result = [])
    {
        foreach ($array as $key => $item) {

            if ($item[$this->parentId] == $parentId) {

                $item[$this->level]  = $level;
                $item[$this->struct] = str_repeat('　' . $this->symbol, $level - 1);

                if (is_callable($resolve)) {
                    $resolve($item, $level);
                }

                $result[] = $item;

                $this->arrayToTreeStruct($array, $item[$this->id], $level + 1, $resolve, $result);
            }
        }

        return $result;
    }

    /**
     * 获取级别
     * @param $arrayMap
     * @param $parentId
     * @param int $level
     * @return int
     */
    protected function getLevel(&$arrayMap, $parentId, $level = 1)
    {
        if (isset($arrayMap[$parentId])) {
            return $this->getLevel($arrayMap, $arrayMap[$parentId][$this->parentId], $level + 1);
        }

        return $level;
    }
}