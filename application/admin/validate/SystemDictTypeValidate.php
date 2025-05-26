<?php


namespace app\admin\validate;


use app\common\validate\Validate;

class SystemDictTypeValidate extends Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'dictId'   => 'require|number',
        'name'     => 'require|max:128',
        'identify' => 'require|max:128',
        'status'   => 'require|number',
        'sort'     => 'require|number',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'dictId.require'   => 'ID不能为空',
        'dictId.number'    => 'ID必须为正整数',
        'name.require'     => '字典名称不能为空',
        'name.max'         => '字典名称不能超过128个字符',
        'identify.require' => '字典标识不能为空',
        'identify.max'     => '字典标识不能超过128个字符',
        'status.require'   => '字典状态不能为空',
        'status.number'    => '字典状态必须为正整数',
        'sort.require'     => '字典排序不能为空',
        'sort.number'      => '字典排序必须为正整数',
    ];

    /**
     * 添加
     * @return SystemDictTypeValidate
     */
    public function sceneCreate()
    {
        return $this->only(['name', 'identify', 'status', 'sort']);
    }

    /**
     * 修改
     * @return SystemDictTypeValidate
     */
    public function sceneUpdate()
    {
        return $this->only(['dictId', 'name', 'identify', 'status', 'sort']);
    }

    /**
     * 删除
     * @return SystemDictTypeValidate
     */
    public function sceneDelete()
    {
        return $this->only(['dictId']);
    }
}