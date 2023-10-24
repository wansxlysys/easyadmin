<?php


namespace app\admin\validate;


class SystemSettingValidate extends \app\common\validate\SystemSettingValidate
{
    /**
     * 全局配置
     * @return SystemSettingValidate
     */
    public function sceneSystem()
    {
        return $this->only(['name', 'slogan']);
    }

    /**
     * 系统设置
     * @return SystemSettingValidate
     */
    public function sceneConfig()
    {
        return $this->only(['content']);
    }
}