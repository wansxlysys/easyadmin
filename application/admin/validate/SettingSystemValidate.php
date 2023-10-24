<?php


namespace app\admin\validate;


class SettingSystemValidate extends \app\common\validate\SettingSystemValidate
{
    /**
     * 全局配置
     * @return SettingSystemValidate
     */
    public function sceneSystem()
    {
        return $this->only(['name', 'slogan']);
    }

    /**
     * 系统设置
     * @return SettingSystemValidate
     */
    public function sceneConfig()
    {
        return $this->only(['content']);
    }
}