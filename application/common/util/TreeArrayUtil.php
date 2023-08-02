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
     * @param $data
     * @param int $parentId
     * @param int $level
     * @param null $resolve
     * @return array
     */
    public function arrayToTree($data, $parentId = 0, $level = 1, $resolve = null)
    {
        $result = [];
        foreach ($data as $key => $item) {
            if ($item[$this->parentId] == $parentId) {

                $item[$this->children] = $this->arrayToTree($data, $item[$this->id], $level + 1, $resolve);

                if (is_callable($resolve)) {
                    $resolve($item, $level);
                }

                $result[] = $item;
            }
        }
        return $result;
    }

    /**
     * 树形组件转数组
     * @param array $data 树形数组
     * @param bool $removeChild 是否删除子级
     * @param array $result
     * @return array
     */
    public function treeToArray($data, $removeChild = true, &$result = [])
    {
        foreach ($data as $key => $item) {

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
     * @param $data
     * @param int $id
     * @param int $level
     * @param null $resolve
     * @param array $result
     * @return array
     */
    public function arrayToTreeStruct($data, $id = 0, $level = 1, $resolve = null, &$result = [])
    {
        foreach ($data as $key => $item) {
            if ($item[$this->parentId] == $id) {

                $item['level']  = $level;
                $item['struct'] = $this->getStruct($level);

                if (is_callable($resolve)) {
                    $resolve($item, $level);
                }

                $result[] = $item;

                $this->arrayToTreeStruct($data, $item[$this->id], $level + 1, $resolve, $result);
            }
        }

        return $result;
    }

    /**
     * 获取结构
     * @param int $level
     * @return string
     */
    protected function getStruct($level = 1)
    {
        return str_repeat('　' . $this->struct, $level - 1);
    }
}