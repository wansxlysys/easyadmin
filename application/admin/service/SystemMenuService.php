<?php


namespace app\admin\service;


use Throwable;

use think\facade\Request;
use app\common\enum\MenuEnum;
use app\common\util\ArrayUtil;
use app\common\util\TreeArrayUtil;
use app\common\helper\ManagerHelper;
use app\common\helper\StoreHelper;
use app\common\repository\Wrapper;

class SystemMenuService extends \app\common\service\SystemMenuService
{
    /**
     * 菜单列表
     * @param array $params
     * @return array
     * @throws Throwable
     */
    public function listMenu(array $params = [])
    {
        $Wrapper = new Wrapper();

        $Wrapper->setOrder(['sort' => 'asc']);

        if (!empty($params['name'])) {
            $Wrapper->addWhere('name', 'LIKE', $params['name'] . '%');
        }

        $list  = $this->SystemMenuRepository->getAll($Wrapper);
        $total = $this->SystemMenuRepository->getTotal($Wrapper);

        foreach ($list as $key => $item) {
            $list[$key]['icon'] = "<i class='fa fa-fw {$item['icon']}'></i>";
        }

        return ['list' => $list, 'total' => $total];
    }

    /**
     * 获取左侧菜单
     * @return array
     * @throws Throwable
     */
    public function getLeftMenu()
    {
        $Wrapper = new Wrapper();

        $Wrapper->setOrder(['sort' => 'asc']);
        $Wrapper->addWhere('type', 'in', '1,3');
        $Wrapper->addWhere('id', 'in', ManagerHelper::getPermission());

        $TreeArrayUtil = new TreeArrayUtil();

        return $TreeArrayUtil->arrayToTree($this->SystemMenuRepository->getAll($Wrapper), 0, function (&$item) {
            $item = $this->formatData($item);
        });
    }

    /**
     * 获取当前请求菜单
     * @return mixed|null
     * @throws Throwable
     */
    public function getCurrentMenu()
    {
        if (StoreHelper::has(MenuEnum::CONTAINER_MENU)) {
            return StoreHelper::get(MenuEnum::CONTAINER_MENU);
        }

        $Wrapper = new Wrapper();

        $Wrapper->addWhere('module', '=', Request::module());
        $Wrapper->addWhere('controller', '=', Request::controller());
        $Wrapper->addWhere('action', '=', Request::action());

        $currentMenu = $this->SystemMenuRepository->getOne($Wrapper);

        StoreHelper::set(MenuEnum::CONTAINER_MENU, $currentMenu);

        return $currentMenu;
    }

    /**
     * 获取面包屑导航
     * @param $menuId
     * @param array $breadcrumb
     * @return array
     * @throws Throwable
     */
    public function getBreadcrumbMenu($menuId, &$breadcrumb = [])
    {
        $menu = $this->SystemMenuRepository->getById($menuId);

        if ($menu) {
            $this->getBreadcrumbMenu($menu['parentId'], $breadcrumb);
            $breadcrumb[] = $menu;
        }

        return $breadcrumb;
    }

    /**
     * 获取全部菜单
     * @return mixed
     * @throws Throwable
     */
    public function getAll()
    {
        $Wrapper = new Wrapper();

        $Wrapper->setOrder(['sort' => 'asc']);

        return $this->SystemMenuRepository->getAll($Wrapper);
    }

    /**
     * 通过ID获取菜单
     * @param $id
     * @return mixed
     * @throws Throwable
     */
    public function getById($id)
    {
        return $this->SystemMenuRepository->getById($id);
    }

    /**
     * 添加菜单
     * @param array $params
     * @return mixed
     * @throws Throwable
     */
    public function createMenu(array $params)
    {
        return $this->SystemMenuRepository->createRecord($this->buildData($params));
    }

    /**
     * 更新菜单
     * @param array $params
     * @return bool
     * @throws Throwable
     */
    public function updateMenu(array $params)
    {
        return $this->SystemMenuRepository->updateById($params['id'], $this->buildData($params));
    }

    /**
     * 更新排序
     * @param array $params
     * @return bool
     * @throws Throwable
     */
    public function sortMenu(array $params)
    {
        return $this->SystemMenuRepository->updateById($params['id'], ['sort' => $params['sort']]);
    }

    /**
     * 删除菜单
     * @param array $params
     * @return mixed
     * @throws Throwable
     */
    public function deleteMenu(array $params)
    {
        return $this->SystemMenuRepository->deleteById($params['id']);
    }

    /**
     * 构建储存数据
     * @param $params
     * @return mixed
     */
    protected function buildData($params)
    {
        /**
         * 如果不是外链则清空链接地址
         */
        if ($params['type'] != MenuEnum::TYPE_LINK) {
            $params['link'] = '';
        }

        return $params;
    }

    /**
     * 格式化数据
     * @param $data
     * @return mixed
     */
    protected function formatData($data)
    {
        if (!empty($data['module'])) {
            $data['url'] = $this->buildUrl($data);
        }

        return $data;
    }

    /**
     * 构建菜单url
     * @param $menu
     * @return string
     */
    protected function buildUrl($menu)
    {
        if ($menu['type'] == MenuEnum::TYPE_LINK) {
            return $menu['link'];
        }

        $url[] = $menu['module'];
        $url[] = $menu['controller'];
        $url[] = $menu['action'];

        return url(ArrayUtil::toString($url, '/'), $menu['params']);
    }
}