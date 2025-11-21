<?php


namespace app\admin\service;


use Exception;

use think\facade\Request;

use app\common\repository\Wrapper;
use app\common\util\ArrayUtil;
use app\common\util\TreeArrayUtil;

use app\admin\enum\SystemMenuEnum;
use app\admin\helper\SystemManagerHelper;
use app\admin\repository\SystemMenuRepository;

class SystemMenuService
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

        foreach ($list as $key => $item) {
            $list[$key]['icon'] = "<i class='fa fa-fw {$item['icon']}'></i>";
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
        $Wrapper->addWhere('menuId', 'in', SystemManagerHelper::getPermission());

        $TreeArrayUtil = new TreeArrayUtil();

        $TreeArrayUtil->setId('menuId');

        return $TreeArrayUtil->arrayToTree($this->SystemMenuRepository->getAll($Wrapper), function (&$item) {
            $item = $this->formatData($item);
        });
    }

    /**
     * 获取当前请求菜单
     * @return array
     * @throws Exception
     */
    public function getCurrentMenu()
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('module', '=', Request::module());
        $Wrapper->addWhere('controller', '=', Request::controller());
        $Wrapper->addWhere('action', '=', Request::action());

        return $this->SystemMenuRepository->getOne($Wrapper);
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
        return $this->SystemMenuRepository->createRecord($this->buildData($params));
    }

    /**
     * 更新菜单
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function updateMenu(array $params)
    {
        return $this->SystemMenuRepository->updateById($params['menuId'], $this->buildData($params));
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

    /**
     * 构建储存数据
     * @param array $data
     * @return array
     */
    public function buildData(array $data)
    {
        /**
         * 如果不是外链则清空链接地址
         */
        if ($data['type'] != SystemMenuEnum::TYPE_LINK) {
            $data['link'] = '';
        }

        return $data;
    }

    /**
     * 格式化数据
     * @param array $data
     * @return array
     */
    public function formatData(array $data)
    {
        if (empty($data['module'])) {
            $data['url'] = '';
        } else {
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
        if ($menu['type'] == SystemMenuEnum::TYPE_LINK) {
            return $menu['link'];
        }

        $url[] = $menu['module'];
        $url[] = $menu['controller'];
        $url[] = $menu['action'];

        return url(ArrayUtil::toString($url, '/'), $menu['params']);
    }
}