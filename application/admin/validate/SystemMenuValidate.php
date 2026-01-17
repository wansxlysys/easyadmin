<?php


namespace app\admin\validate;


use app\common\validate\Validate;

class SystemMenuValidate extends Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'menuId'   => 'require|number',
        'parentId' => 'number',
        'name'     => 'require|max:32',
        'icon'     => 'require|max:32',
        'url'      => 'max:32',
        'identify' => 'max:512',
        'type'     => 'require|number',
        'link'     => 'requireIf:type,3|max:256',
        'target'   => 'require|number',
        'record'   => 'require|max:1',
        'sort'     => 'require|number',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'id.require'      => 'ID不能为空',
        'id.number'       => 'ID必须为正整数',
        'parentId.number' => '上级菜单必须为正整数',
        'name.require'    => '菜单名称不能为空',
        'name.max'        => '菜单名称不能超过32个字符',
        'icon.number'     => '图标不能为空',
        'icon.max'        => '图标不能超过32个字符',
        'url.max'         => '模块不能超过32个字符',
        'identify.max'    => '参数不能超过512个字符',
        'type.require'    => '菜单类型不能为空',
        'type.number'     => '菜单类型必须为正整数',
        'link.requireIf'  => '外链地址不能为空',
        'link.max'        => '外链地址必须为正整数',
        'target.require'  => '打开方式不能为空',
        'target.number'   => '打开方式必须为正整数',
        'record.require'  => '日志记录不能为空',
        'record.max'      => '日志记录不能超过1个字符',
        'sort.require'    => '排序不能为空',
        'sort.number'     => '排序必须是整数',
    ];

    /**
     * 添加
     * @return SystemMenuValidate
     */
    public function sceneCreate()
    {
        return $this->only([
            'parentId', 'name', 'icon', 'url', 'identify', 'type', 'link', 'target', 'record', 'sort'
        ]);
    }

    /**
     * 修改
     * @return SystemMenuValidate
     */
    public function sceneUpdate()
    {
        return $this->only([
            'menuId', 'parentId', 'name', 'icon', 'url', 'identify', 'type', 'link', 'target', 'record', 'sort'
        ]);
    }

    /**
     * 删除
     * @return SystemMenuValidate
     */
    public function sceneDelete()
    {
        return $this->only(['menuId']);
    }

    /**
     * 排序
     * @return SystemMenuValidate
     */
    public function sceneSort()
    {
        return $this->only(['menuId', 'sort']);
    }
}