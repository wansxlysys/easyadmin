<?php


namespace app\admin\validate;


class SettingSystem extends \app\common\validate\SettingSystem
{
    /**
     * 修改配置
     * @return SettingSystem
     */
    public function sceneSystem()
    {
        return $this->only(['name', 'slogan']);
    }
}