<?php


namespace app\admin\controller;


use think\Request;
use app\admin\service\SystemMenuService;
use app\admin\validate\SystemMenuValidate;

class SystemMenuController extends \app\common\controller\AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 服务类
     * @var SystemMenuService
     */
    protected $SystemMenuService;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemMenuService = new SystemMenuService();
    }

    /**
     * 首页
     * @param Request $request
     * @return mixed
     */
    public function index_action(Request $request)
    {
        if ($request->isAjax()) {

            $list = $this->SystemMenuService->getAll();

            $this->success('获取成功', '', ['list' => $list]);
        }

        return $this->fetch();
    }

    /**
     * 添加
     * @param Request $request
     * @return mixed
     */
    public function create_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'parent_id'  => $request->post('parent_id'),
                'name'       => $request->post('name'),
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

            $MenuValidate = new SystemMenuValidate();

            if (!$MenuValidate->scene('Create')->check($params)) {
                $this->error($MenuValidate->getError());
            }

            $result = $this->SystemMenuService->createMenu($params);

            if (!$result) {
                $this->error('添加失败');
            }

            $this->success('添加成功');
        }

        return $this->fetch();
    }

    /**
     * 修改
     * @param Request $request
     * @return mixed
     */
    public function update_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'         => $request->post('id'),
                'parent_id'  => $request->post('parent_id'),
                'name'       => $request->post('name'),
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

            $MenuValidate = new SystemMenuValidate();

            if (!$MenuValidate->scene('Update')->check($params)) {
                $this->error($MenuValidate->getError());
            }

            $result = $this->SystemMenuService->updateMenu($params);

            if (!$result) {
                $this->error('修改失败');
            }

            $this->success('修改成功');
        }

        $menu = $this->SystemMenuService->getById($request->get('id'));

        return $this->fetch('', [
            'menu' => $menu
        ]);
    }

    /**
     * 删除
     * @param Request $request
     */
    public function delete_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id' => $request->post('id')
            ];

            $MenuValidate = new SystemMenuValidate();

            if (!$MenuValidate->scene('Delete')->check($params)) {
                $this->error($MenuValidate->getError());
            }

            $result = $this->SystemMenuService->deleteMenu($params);

            if (!$result) {
                $this->error('删除失败');
            }

            $this->success('删除成功');
        }
    }

    /**
     * 排序
     * @param Request $request
     */
    public function sort_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'   => $request->post('id'),
                'sort' => $request->post('sort'),
            ];

            $MenuValidate = new SystemMenuValidate();

            if (!$MenuValidate->scene('Sort')->check($params)) {
                $this->error($MenuValidate->getError());
            }

            $result = $this->SystemMenuService->sortMenu($params);

            if (!$result) {
                $this->error('修改失败');
            }

            $this->success('修改成功');
        }
    }

    /**
     * 全部
     * @param Request $request
     */
    public function get_all_action(Request $request)
    {
        if ($request->isAjax()) {
            $this->success('获取成功', '', $this->SystemMenuService->getAll());
        }
    }
}