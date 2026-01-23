<?php


namespace app\common\builder;


class RelationBuilder
{
    /**
     * 数据
     * @var array
     */
    protected $listData;

    /**
     * 查询函数
     * @var callable
     */
    protected $queryFn;

    /**
     * 主表关联key
     * @var string
     */
    protected $mainKey;

    /**
     * 子表关联key
     * @var string
     */
    protected $withKey;

    /**
     * 构造函数
     * @param array $listData
     * @param $mainKey
     * @param null $withKey
     */
    public function __construct(array $listData, $mainKey, $withKey = null)
    {
        $this->listData = $listData;
        $this->mainKey  = $mainKey;
        $this->withKey  = $withKey ?: $mainKey;
    }

    /**
     * 创建构建器
     * @param array $listData
     * @param $mainKey
     * @param null $withKey
     * @return self
     */
    public static function from(array $listData, $mainKey, $withKey = null)
    {
        return new static($listData, $mainKey, $withKey);
    }

    /**
     * 查询关联数据
     * @param callable $queryFn
     * @return RelationBuilder
     */
    public function query(callable $queryFn)
    {
        $this->queryFn = $queryFn;
        return $this;
    }

    /**
     * 一对一关联
     * @param $fieldName
     * @return $this
     */
    public function withOne($fieldName)
    {
        return $this->withRelation($fieldName, function ($linkList) {

            $groupList = [];

            foreach ($linkList as $link) {
                if (!isset($groupList[$link[$this->withKey]])) {
                    $groupList[$link[$this->withKey]] = $link;
                }
            }

            return $groupList;
        });
    }

    /**
     * 一对多关联
     * @param $fieldName
     * @return $this
     */
    public function withMany($fieldName)
    {
        return $this->withRelation($fieldName, function ($linkList) {
            $groupList = [];

            foreach ($linkList as $link) {
                $groupList[$link[$this->withKey]][] = $link;
            }

            return $groupList;
        });
    }

    /**
     * 公共关联方法
     */
    protected function withRelation($fieldName, $groupBy)
    {
        if (empty($this->listData)) {
            return $this;
        }

        $linkList = call_user_func($this->queryFn, array_column($this->listData, $this->mainKey));

        if (empty($linkList)) {
            return $this;
        }

        $groupList = $groupBy($linkList);

        foreach ($this->listData as $key => $item) {

            $linkData = $groupList[$item[$this->mainKey]] ?? [];

            if (is_callable($fieldName)) {
                $fieldName($this->listData[$key], $linkData);
            } else if (!isset($this->listData[$key][$fieldName])) {
                $this->listData[$key][$fieldName] = $linkData;
            }
        }

        return $this;
    }

    /**
     * 获取结果
     */
    public function get()
    {
        return $this->listData;
    }
}