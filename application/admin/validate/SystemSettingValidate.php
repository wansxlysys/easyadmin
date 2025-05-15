<?php


namespace app\admin\validate;


use app\common\validate\Validate;

class SystemSettingValidate extends Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'settingId' => 'require|number',
        'type'      => 'require|max:32',
        'name'      => 'require|max:32',
        'identify'  => 'require|max:64',
        'value'     => 'require',
        'remark'    => 'require',
        'sort'      => 'require|number',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'settingId.require' => '设置ID不能为空',
        'settingId.number'  => '设置ID必须为正整数',
        'type.require'      => '设置分类不能为空',
        'type.max'          => '设置分类不能超过32个字符',
        'name.require'      => '设置名称不能为空',
        'name.max'          => '设置名称不能超过32个字符',
        'identify.require'  => '设置标识不能为空',
        'identify.max'      => '设置标识不能超过64个字符',
        'value.require'     => '设置键值不能为空',
        'sort.require'      => '设置排序不能为空',
        'sort.number'       => '设置排序必须为正整数',
    ];

    /**
     * 设置添加
     * @return SystemSettingValidate
     */
    public function sceneCreate()
    {
        return $this->only(['type', 'name', 'identify', 'value', 'sort']);
    }

    /**
     * 设置更新
     * @return SystemSettingValidate
     */
    public function sceneUpdate()
    {
        return $this->only(['settingId', 'type', 'name', 'identify', 'value', 'sort']);
    }

    /**
     * 设置删除
     * @return SystemSettingValidate
     */
    public function sceneDelete()
    {
        return $this->only(['settingId']);
    }
}