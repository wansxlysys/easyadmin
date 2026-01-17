<?php


namespace app\admin\service;


use Exception;

use app\common\util\TreeUtil;
use app\common\util\RequestUtil;
use app\common\service\Service;
use app\common\repository\Wrapper;

use app\admin\enum\SystemMenuEnum;
use app\admin\format\SystemMenuFormat;
use app\admin\helper\SystemManagerHelper;
use app\admin\repository\SystemMenuRepository;

class SystemMenuService extends Service
{
    /**
     * 存储类
     * @var SystemMenuRepository
     */
    protected SystemMenuRepository $SystemMenuRepository;

    /**
     * 菜单列表
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function getPageMenu(array $params = [])
    {
        $Wrapper = new Wrapper();

        if (!empty($params['name'])) {
            $Wrapper->addWhere('name', 'LIKE', $params['name'] . '%');
        }

        $Wrapper->setOrder(['sort' => 'asc']);

        $list = $this->SystemMenuRepository->getAll($Wrapper);

        foreach ($list as &$item) {
            SystemMenuFormat::formatIcon($item);
        }

        return ['list' => $list, 'total' => count($list)];
    }

    /**
     * 获取左侧菜单
     * @return array
     * @throws Exception
     */
    public function getLeftMenu()
    {
        $Wrapper = new Wrapper();

        $Wrapper->setOrder(['sort' => 'asc']);
        $Wrapper->addWhere('type', 'in', [SystemMenuEnum::TYPE_MENU, SystemMenuEnum::TYPE_LINK]);
        $Wrapper->addWhere('menuId', 'in', SystemManagerHelper::getPermissionMenuIds());

        $TreeArrayUtil = new TreeUtil();

        $TreeArrayUtil->setId('menuId');

        return $TreeArrayUtil->toTree($this->SystemMenuRepository->getAll($Wrapper), function (&$item) {
            SystemMenuFormat::formatUrl($item);
        });
    }

    /**
     * 获取权限编码
     * @param $permissionIds
     * @return array
     * @throws Exception
     */
    public function getPermissionCode($permissionIds)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('menuId', 'in', $permissionIds);
        $Wrapper->addField('identify');

        $menuCode = [];
        $menuList = $this->SystemMenuRepository->getAll($Wrapper);

        foreach ($menuList as $menu) {
            $menuCode[] = $menu['identify'];
        }

        return $menuCode;
    }

    /**
     * 获取当前请求菜单
     * @return array
     * @throws Exception
     */
    public function getCurrentMenu()
    {
        return $this->SystemMenuRepository->getByWhere(['url' => RequestUtil::getPath()]);
    }

    /**
     * 获取面包屑导航
     * @param $menuId
     * @param array $breadcrumb
     * @return array
     * @throws Exception
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
     * @return array
     * @throws Exception
     */
    public function getAll()
    {
        $Wrapper = new Wrapper();

        $Wrapper->setOrder(['sort' => 'asc']);

        return $this->SystemMenuRepository->getAll($Wrapper);
    }

    /**
     * 通过ID获取菜单
     * @param $menuId
     * @return array
     * @throws Exception
     */
    public function getByMenuId($menuId)
    {
        return $this->SystemMenuRepository->getById($menuId);
    }

    /**
     * 添加菜单
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function createMenu(array $params)
    {
        return $this->SystemMenuRepository->createRecord(SystemMenuFormat::buildData($params));
    }

    /**
     * 更新菜单
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function updateMenu(array $params)
    {
        return $this->SystemMenuRepository->updateById($params['menuId'], SystemMenuFormat::buildData($params));
    }

    /**
     * 更新排序
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function sortMenu(array $params)
    {
        return $this->SystemMenuRepository->updateById($params['menuId'], ['sort' => $params['sort']]);
    }

    /**
     * 删除菜单
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function deleteMenu(array $params)
    {
        return $this->SystemMenuRepository->deleteById($params['menuId']);
    }
}