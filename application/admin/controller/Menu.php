<?php


namespace app\admin\controller;


use think\Request;

class Menu extends \app\common\controller\Admin
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 菜单服务类
     * @var \app\admin\service\Menu
     */
    protected $MenuService;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->MenuService = new \app\admin\service\Menu();
    }

    /**
     * 菜单首页
     * @param Request $request
     * @return mixed
     */
    public function index_action(Request $request)
    {
        if ($request->isAjax()) {

            $list = $this->MenuService->getAll();

            $this->success('获取成功', '', ['list' => $list]);
        }

        return $this->fetch();
    }

    /**
     * 获取全部菜单
     * @param Request $request
     */
    public function get_all_action(Request $request)
    {
        if ($request->isAjax()) {

            $this->success('获取成功', '', $this->MenuService->getAll());

        }
    }

    /**
     * 创建菜单
     * @param Request $request
     * @return mixed
     */
    public function create_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'parent_id'  => $request->post('parent_id'),
                'title'      => $request->post('title'),
                'icon'       => $request->post('icon'),
                'module'     => $request->post('module'),
                'controller' => $request->post('controller'),
                'action'     => $request->post('action'),
                'params'     => $request->post('params'),
                'type'       => $request->post('type'),
                'link'       => $request->post('link'),
                'target'     => $request->post('target'),
                'sort'       => $request->post('sort'),
            ];

            $MenuValidate = new \app\admin\validate\Menu();

            if (!$MenuValidate->scene('Create')->check($params)) {
                $this->error($MenuValidate->getError());
            }

            $result = $this->MenuService->createMenu($params);

            if (!$result) {
                $this->error('添加失败');
            }

            $this->success('添加成功');
        }

        return $this->fetch();
    }

    /**
     * 更新菜单
     * @param Request $request
     * @return mixed
     */
    public function update_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'         => $request->post('id'),
                'parent_id'  => $request->post('parent_id'),
                'title'      => $request->post('title'),
                'icon'       => $request->post('icon'),
                'module'     => $request->post('module'),
                'controller' => $request->post('controller'),
                'action'     => $request->post('action'),
                'params'     => $request->post('params'),
                'type'       => $request->post('type'),
                'link'       => $request->post('link'),
                'target'     => $request->post('target'),
                'sort'       => $request->post('sort'),
            ];

            $MenuValidate = new \app\admin\validate\Menu();

            if (!$MenuValidate->scene('Update')->check($params)) {
                $this->error($MenuValidate->getError());
            }

            $result = $this->MenuService->updateMenu($params);

            if (!$result) {
                $this->error('修改失败');
            }

            $this->success('修改成功');
        }

        $menu = $this->MenuService->getById($request->get('id'));

        return $this->fetch('', [
            'menu' => $menu
        ]);
    }

    /**
     * 菜单删除
     * @param Request $request
     */
    public function delete_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id' => $request->post('id')
            ];

            $MenuValidate = new \app\admin\validate\Menu();

            if (!$MenuValidate->scene('Delete')->check($params)) {
                $this->error($MenuValidate->getError());
            }

            $result = $this->MenuService->deleteMenu($params);

            if (!$result) {
                $this->error('删除失败');
            }

            $this->success('删除成功');
        }
    }

    /**
     * 菜单排序
     * @param Request $request
     */
    public function sort_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'   => $request->post('id'),
                'sort' => $request->post('sort'),
            ];

            $MenuValidate = new \app\admin\validate\Menu();

            if (!$MenuValidate->scene('Sort')->check($params)) {
                $this->error($MenuValidate->getError());
            }

            $result = $this->MenuService->updateMenu($params);

            if (!$result) {
                $this->error('修改失败');
            }

            $this->success('修改成功');
        }
    }
}