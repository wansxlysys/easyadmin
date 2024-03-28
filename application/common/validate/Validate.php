<?php


namespace app\common\validate;


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
    public function verify($data, $rules = [], $scene = '')
    {
        if (!$this->check($data, $rules, $scene)) {
            throw new ValidateException($this->getError());
        }
    }
}