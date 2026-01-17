<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemMenuService;
use app\admin\validate\SystemMenuValidate;

use app\common\controller\SystemController;

class SystemMenuController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['SystemMiddleware'];

    /**
     * 服务类
     * @var SystemMenuService
     */
    protected SystemMenuService $SystemMenuService;

    /**
     * 验证器
     * @var SystemMenuValidate
     */
    protected SystemMenuValidate $SystemMenuValidate;

    /**
     * 首页
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function indexAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'name' => $request->get('name')
            ];

            $this->success('获取成功', '', $this->SystemMenuService->getPageMenu($params));
        }

        return $this->fetch();
    }

    /**
     * 添加
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function createAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'parentId' => $request->post('parentId'),
                'name'     => $request->post('name'),
                'icon'     => $request->post('icon'),
                'url'      => $request->post('url'),
                'params'   => $request->post('params'),
                'type'     => $request->post('type'),
                'link'     => $request->post('link'),
                'target'   => $request->post('target'),
                'record'   => $request->post('record'),
                'sort'     => $request->post('sort'),
            ];

            $this->SystemMenuValidate->scene('create')->verify($params);
            $this->SystemMenuService->createMenu($params);

            $this->success('添加成功');
        }

        return $this->fetch();
    }

    /**
     * 修改
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function updateAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'menuId'   => $request->post('menuId'),
                'parentId' => $request->post('parentId'),
                'name'     => $request->post('name'),
                'icon'     => $request->post('icon'),
                'url'      => $request->post('url'),
                'params'   => $request->post('params'),
                'type'     => $request->post('type'),
                'link'     => $request->post('link'),
                'target'   => $request->post('target'),
                'record'   => $request->post('record'),
                'sort'     => $request->post('sort'),
            ];

            $this->SystemMenuValidate->scene('update')->verify($params);
            $this->SystemMenuService->updateMenu($params);

            $this->success('修改成功');
        }

        $menu = $this->SystemMenuService->getByMenuId($request->get('menuId'));

        return $this->fetch('', [
            'menu' => $menu
        ]);
    }

    /**
     * 删除
     * @param Request $request
     * @throws Exception
     */
    public function deleteAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'menuId' => $request->post('menuId')
            ];

            $this->SystemMenuValidate->scene('delete')->verify($params);
            $this->SystemMenuService->deleteMenu($params);

            $this->success('删除成功');
        }
    }

    /**
     * 排序
     * @param Request $request
     * @throws Exception
     */
    public function sortAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'menuId' => $request->post('menuId'),
                'sort'   => $request->post('sort'),
            ];

            $this->SystemMenuValidate->scene('sort')->verify($params);
            $this->SystemMenuService->sortMenu($params);

            $this->success('修改成功');
        }
    }

    /**
     * 全部
     * @param Request $request
     * @throws Exception
     */
    public function getAllAction(Request $request)
    {
        if ($request->isAjax()) {
            $this->success('获取成功', '', $this->SystemMenuService->getAll());
        }
    }
}