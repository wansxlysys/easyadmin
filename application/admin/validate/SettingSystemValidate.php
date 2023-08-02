<?php


namespace app\admin\validate;


class SettingSystemValidate extends \app\common\validate\SettingSystemValidate
{
    /**
     * 修改配置
     * @return SettingSystemValidate
     */
    public function sceneSystem()
    {
        return $this->only(['name', 'slogan']);
    }
}