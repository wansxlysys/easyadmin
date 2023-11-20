<?php


namespace app\common\util;


class TreeArrayUtil
{
    /**
     * ID标识
     * @var string
     */
    public $id = 'id';

    /**
     * 上级ID
     * @var string
     */
    public $parentId = 'parent_id';

    /**
     * 子元素标识
     * @var string
     */
    public $children = 'children';

    /**
     * 结构符号
     * @var string
     */
    public $struct = '├─';

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
             * 调用函数
             */
            if (is_callable($resolve)) {
                $resolve($array[$key]);
            }

            /**
             * 设置映射
             */
            $arrayMap[$item[$this->id]] = &$array[$key];
        }

        foreach ($array as $key => $item) {

            /**
             * 过滤上级
             */
            if ($parentId == $item[$this->parentId]) {
                $treeArray[$item[$this->id]] = &$array[$key];
            }

            /**
             * 生成上级
             */
            if (isset($arrayMap[$item[$this->parentId]])) {
                $parent                    = &$arrayMap[$item[$this->parentId]];
                $parent[$this->children][] = &$array[$key];
            }
        }

        return $treeArray;
    }

    /**
     * 树形组件转数组
     * @param array $tree 树形数组
     * @param bool $removeChild 是否删除子级
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
     * @param int $id
     * @param int $level
     * @param null $resolve
     * @param array $result
     * @return array
     */
    public function arrayToTreeStruct($array, $id = 0, $level = 1, $resolve = null, &$result = [])
    {
        foreach ($array as $key => $item) {

            if ($item[$this->parentId] == $id) {

                $item['level']  = $level;
                $item['struct'] = str_repeat('　' . $this->struct, $level - 1);

                if (is_callable($resolve)) {
                    $resolve($item, $level);
                }

                $result[] = $item;

                $this->arrayToTreeStruct($array, $item[$this->id], $level + 1, $resolve, $result);
            }
        }

        return $result;
    }
}