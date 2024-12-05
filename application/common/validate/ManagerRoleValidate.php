<?php


namespace app\common\validate;


class ManagerRoleValidate extends Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'id'         => 'require|number',
        'name'       => 'require|max:32|single:ManagerRole,isDelete=2',
        'identify'   => 'require|max:32|single:ManagerRole,isDelete=2',
        'permission' => 'require',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'id.require'         => 'ID不能为空',
        'id.number'          => 'ID必须为正整数',
        'name.require'       => '角色名不能为空',
        'name.max'           => '角色名不能超过32个字符',
        'name.single'        => '角色名已存在',
        'identify.require'   => '角色标识不能为空',
        'identify.max'       => '角色标识最长不能超过32个字符',
        'identify.single'    => '角色标识已存在',
        'permission.require' => '权限不能为空',
    ];
}