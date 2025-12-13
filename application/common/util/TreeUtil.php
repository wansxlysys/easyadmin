<?php


namespace app\common\util;


class TreeUtil
{
    /**
     * ID名称
     * @var string
     */
    private $id = 'id';

    /**
     * 上级ID名称
     * @var string
     */
    private $parentId = 'parentId';

    /**
     * 子元素名称
     * @var string
     */
    private $children = 'children';

    /**
     * 级别名称
     * @var int
     */
    private $level = 'level';

    /**
     * 结构名称
     * @var string
     */
    private $struct = 'struct';

    /**
     * 结构符号
     * @var string
     */
    private $symbol = '├─';

    /**
     * 设置ID名称
     * @param string $id
     * @return void
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * 设置上级ID名称
     * @param string $parentId
     * @return void
     */
    public function setParentId(string $parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * 设置子元素名称
     * @param string $children
     * @return void
     */
    public function setChildren(string $children)
    {
        $this->children = $children;
    }

    /**
     * 设置级别名称
     * @param string $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * 设置结构名称
     * @param string $struct
     * @return void
     */
    public function setStruct(string $struct)
    {
        $this->struct = $struct;
    }

    /**
     * 设置分隔符
     * @param string $symbol
     * @return void
     */
    public function setSymbol(string $symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * 数组转树形组件
     * @param $array
     * @param int $parentId
     * @param null $resolve
     * @return array
     */
    public function toTree($array, $resolve = null, $parentId = 0)
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
    public function toArray($tree, $removeChild = true, &$result = [])
    {
        foreach ($tree as $item) {

            if (!empty($item[$this->children])) {
                $this->toArray($item[$this->children], $removeChild, $result);
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
    public function toStruct($array, $parentId = 0, $level = 1, $resolve = null, &$result = [])
    {
        foreach ($array as $item) {

            if ($item[$this->parentId] == $parentId) {

                $item[$this->level]  = $level;
                $item[$this->struct] = str_repeat('　' . $this->symbol, $level - 1);

                if (is_callable($resolve)) {
                    $resolve($item, $level);
                }

                $result[] = $item;

                $this->toStruct($array, $item[$this->id], $level + 1, $resolve, $result);
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