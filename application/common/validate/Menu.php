<?php


namespace app\common\validate;


class Menu extends \app\common\validate\Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'id'         => 'require|integer',
        'parent_id'  => 'integer',
        'title'      => 'require|max:32',
        'icon'       => 'require|max:32',
        'module'     => 'require|max:32',
        'controller' => 'max:32',
        'action'     => 'max:32',
        'params'     => 'max:512',
        'type'       => 'require|integer',
        'link'       => 'requireIf:type,3|max:256',
        'target'     => 'require|integer',
        'sort'       => 'require|integer',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'id.require'        => 'ID不能为空',
        'id.integer'        => 'ID必须为整数',
        'parent_id.integer' => '上级节点必须为整数',
        'title.require'     => '节点名称不能为空',
        'title.max'         => '节点名称不能超过32个字符',
        'icon.integer'      => '图标不能为空',
        'icon.max'          => '图标不能超过32个字符',
        'module.integer'    => '模块不能为空',
        'module.max'        => '模块不能超过32个字符',
        'controller.max'    => '控制器不能超过32个字符',
        'action.max'        => '操作不能超过32个字符',
        'params.max'        => '参数不能超过512个字符',
        'type.require'      => '菜单类型不能为空',
        'type.integer'      => '菜单类型必须为整数',
        'link.requireIf'    => '外链地址不能为空',
        'link.max'          => '外链地址必须为整数',
        'target.require'    => '打开方式不能为空',
        'target.integer'    => '打开方式必须为整数',
        'sort.require'      => '排序不能为空',
        'sort.integer'      => '排序必须是整数',
    ];

}
