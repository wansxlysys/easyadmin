<?php


namespace app\admin\service;


use think\facade\Request;
use app\common\enum\MenuEnum;
use app\common\util\ArrayUtil;
use app\common\repository\Query;
use app\common\util\TreeArrayUtil;
use app\common\helper\ManagerHelper;
use app\common\helper\StorageHelper;
use app\common\exception\SystemException;

class SystemMenuService extends \app\common\service\SystemMenuService
{
    /**
     * 获取左侧菜单
     * @return array
     * @throws SystemException
     */
    public function getLeftMenu()
    {
        $Query = new Query();

        $Query->setOrder(['sort' => 'asc']);
        $Query->addWhere('type', 'in', '1,3');
        $Query->addWhere('id', 'in', ManagerHelper::getPermission());

        $TreeArrayUtil = new TreeArrayUtil();

        return $TreeArrayUtil->arrayToTree($this->SystemMenuRepository->getAll($Query), 0, function (&$item) {
            $item = $this->formatData($item);
        });
    }

    /**
     * 获取当前请求菜单
     * @return mixed|null
     * @throws SystemException
     */
    public function getCurrentMenu()
    {
        if (StorageHelper::has(MenuEnum::CONTAINER_MENU)) {
            return StorageHelper::get(MenuEnum::CONTAINER_MENU);
        }

        $Query = new Query();

        $Query->addWhere('module', '=', Request::module());
        $Query->addWhere('controller', '=', Request::controller());
        $Query->addWhere('action', '=', Request::action());

        StorageHelper::set(MenuEnum::CONTAINER_MENU, $this->SystemMenuRepository->getOne($Query));

        return StorageHelper::get(MenuEnum::CONTAINER_MENU);
    }

    /**
     * 获取面包屑导航
     * @param $menuId
     * @param array $breadcrumb
     * @return array
     * @throws SystemException
     */
    public function getBreadcrumbMenu($menuId, &$breadcrumb = [])
    {
        $menu = $this->SystemMenuRepository->getById($menuId);

        if ($menu) {
            $this->getBreadcrumbMenu($menu['parent_id'], $breadcrumb);
            $breadcrumb[] = $menu;
        }

        return $breadcrumb;
    }

    /**
     * 获取全部菜单
     * @return mixed
     * @throws SystemException
     */
    public function getAll()
    {
        $Query = new Query();

        $Query->setOrder(['sort' => 'asc']);

        return $this->SystemMenuRepository->getAll($Query);
    }

    /**
     * 通过ID获取菜单
     * @param $id
     * @return mixed
     * @throws SystemException
     */
    public function getById($id)
    {
        return $this->formatData($this->SystemMenuRepository->getById($id));
    }

    /**
     * 添加菜单
     * @param array $params
     * @return mixed
     * @throws SystemException
     */
    public function createMenu(array $params)
    {
        return $this->SystemMenuRepository->createRecord($this->buildData($params));
    }

    /**
     * 更新菜单
     * @param array $params
     * @return bool
     * @throws SystemException
     */
    public function updateMenu(array $params)
    {
        return $this->SystemMenuRepository->updateById($params['id'], $this->buildData($params));
    }

    /**
     * 更新排序
     * @param array $params
     * @return bool
     * @throws SystemException
     */
    public function sortMenu(array $params)
    {
        return $this->SystemMenuRepository->updateById($params['id'], ['sort' => $params['sort']]);
    }

    /**
     * 删除菜单
     * @param array $params
     * @return mixed
     * @throws SystemException
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