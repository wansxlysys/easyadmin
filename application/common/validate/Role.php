<?php


namespace app\common\validate;


class Role extends \app\common\validate\Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'id'         => 'require|integer',
        'title'      => 'require|max:32',
        'name'       => 'require|max:32',
        'permission' => 'require',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'id.require'         => 'ID不能为空',
        'id.integer'         => 'ID必须为数字',
        'title.require'      => '角色名不能为空',
        'title.max'          => '角色名不能超过32个字符',
        'name.require'       => '角色标识不能为空',
        'name.max'           => '角色标识不能超过32个字符',
        'permission.require' => '角色权限不能为空',
    ];
}