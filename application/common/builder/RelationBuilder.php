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
    public function __construct(array &$listData, $mainKey, $withKey = null)
    {
        $this->listData = &$listData;
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
    public static function from(array &$listData, $mainKey, $withKey = null)
    {
        return new static($listData, $mainKey, $withKey);
    }

    /**
     * 创建构建器
     * @param array $listData
     * @param $mainKey
     * @param null $withKey
     * @return self
     */
    public static function of(array $listData, $mainKey, $withKey = null)
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
        $linkList = call_user_func($this->queryFn, array_column($this->listData, $this->mainKey));

        if (empty($linkList)) {
            return $this;
        }

        $groupList = [];

        foreach ($linkList as $link) {
            $groupList[$link[$this->withKey]] = $link;
        }

        return $this->withRelation($fieldName, function ($data) use ($groupList) {

            $linkData = [];

            if (isset($groupList[$data[$this->mainKey]])) {
                $linkData = $groupList[$data[$this->mainKey]];
            }

            return $linkData;
        });
    }

    /**
     * 一对多关联
     * @param $fieldName
     * @param bool $mainKeyIsMany
     * @return $this
     */
    public function withMany($fieldName, $mainKeyIsMany = false)
    {
        $linkList = call_user_func($this->queryFn, array_column($this->listData, $this->mainKey));

        if (empty($linkList)) {
            return $this;
        }

        $groupList = [];

        foreach ($linkList as $link) {
            if ($mainKeyIsMany) {
                $groupList[$link[$this->withKey]] = $link;
            } else {
                $groupList[$link[$this->withKey]][] = $link;
            }
        }

        return $this->withRelation($fieldName, function ($data) use ($groupList, $mainKeyIsMany) {

            $linkData = [];

            if ($mainKeyIsMany) {

                if (is_array($data[$this->mainKey])) {
                    $mainKeys = $data[$this->mainKey];
                } else {
                    $mainKeys = explode(',', $data[$this->mainKey]);
                }

                foreach ($mainKeys as $mainKey) {
                    if (isset($groupList[$mainKey])) {
                        $linkData[] = $groupList[$mainKey];
                    }
                }

            } else {
                $linkData = $groupList[$data[$this->mainKey]];
            }

            return $linkData;
        });
    }

    /**
     * 公共关联方法
     */
    protected function withRelation($fieldName, callable $resolve)
    {
        if (empty($this->listData)) {
            return $this;
        }

        foreach ($this->listData as $key => $data) {
            if (is_callable($fieldName)) {
                $fieldName($this->listData[$key], $resolve($data));
            } else if (!isset($this->listData[$key][$fieldName])) {
                $this->listData[$key][$fieldName] = $resolve($data);
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