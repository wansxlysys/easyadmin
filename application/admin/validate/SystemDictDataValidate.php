<?php


namespace app\admin\validate;


use app\common\validate\Validate;

class SystemDictDataValidate extends Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'dataId'    => 'require|number',
        'label'     => 'require|max:128',
        'value'     => 'require|max:32',
        'style'     => 'max:128',
        'isDefault' => 'require|number',
        'status'    => 'require|max:1',
        'sort'      => 'require|number',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'dataId.require'    => 'ID不能为空',
        'dataId.number'     => 'ID必须为正整数',
        'label.require'     => '字典标签不能为空',
        'label.max'         => '字典标签不能超过128个字符',
        'value.require'     => '字典数据不能为空',
        'value.max'         => '字典数据不能超过128个字符',
        'style.max'         => '字典样式不能超过128个字符',
        'isDefault.require' => '是否默认不能为空',
        'isDefault.number'  => '是否默认必须为正整数',
        'status.require'    => '字典状态不能为空',
        'status.max'        => '字典状态不能超过1个字符',
        'sort.require'      => '字典排序不能为空',
        'sort.number'       => '字典排序必须为正整数',
    ];

    /**
     * 添加
     * @return SystemDictDataValidate
     */
    public function sceneCreate()
    {
        return $this->only(['label', 'value', 'style', 'isDefault', 'status', 'sort']);
    }

    /**
     * 修改
     * @return SystemDictDataValidate
     */
    public function sceneUpdate()
    {
        return $this->only(['dataId', 'label', 'value', 'style', 'isDefault', 'status', 'sort']);
    }

    /**
     * 删除
     * @return SystemDictDataValidate
     */
    public function sceneDelete()
    {
        return $this->only(['dataId']);
    }
}