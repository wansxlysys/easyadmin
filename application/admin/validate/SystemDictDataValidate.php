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
        'name'  => 'require|max:32',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'dataId.require'    => 'ID不能为空',
        'dataId.number'     => 'ID必须为正整数',
        'name.require'  => '名称不能为空',
        'name.max'      => '名称不能超过32个字符',
    ];

    /**
     * 添加
     * @return SystemDictDataValidate
     */
    public function sceneCreate()
    {
        return $this->only(['name']);
    }

    /**
     * 修改
     * @return SystemDictDataValidate
     */
    public function sceneUpdate()
    {
        return $this->only(['dataId', 'name']);
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