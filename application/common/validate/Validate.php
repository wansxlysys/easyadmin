<?php


namespace app\common\validate;


use Exception;

use think\Db;

use app\common\exception\ValidateException;

class Validate extends \think\Validate
{
    /**
     * 校验参数，失败抛出异常
     * @param $data
     * @param array $rules
     * @param string $scene
     * @throws ValidateException
     */
    public function verify($data, array $rules = [], $scene = '')
    {
        if (!$this->check($data, $rules, $scene)) {
            throw new ValidateException($this->getError());
        }
    }

    /**
     * 是都在某个范围
     * @param $value
     * @param $rule
     * @param array $data
     * @return bool
     */
    public function requireIn($value, $rule, $data)
    {
        list($field, $inValue) = explode(':', $rule);

        if (empty($data[$field])) {
            return true;
        }

        if ($this->in($data[$field], $inValue) && empty($value)) {
            return false;
        }

        return true;
    }

    /**
     * 是否条件唯一
     * @param $value
     * @param $rule
     * @param array $data
     * @param $field
     * @return bool
     * @throws Exception
     */
    public function single($value, $rule, $data, $field)
    {
        list($table, $primary, $query) = explode(',', $rule);

        parse_str($query, $map);

        $where[] = [$field, '=', $value];

        foreach ($map as $key => $val) {
            $where[] = [$key, '=', $val];
        }

        /**
         * 检测主键ID是否存在
         */
        if (isset($data[$primary])) {
            $where[] = [$primary, '<>', $data[$primary]];
        }

        if (Db::name($table)->where($where)->field($primary)->find()) {
            return false;
        }

        return true;
    }
}