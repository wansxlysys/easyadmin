<?php


namespace app\admin\service;


use Exception;

use think\facade\Request;

use app\common\util\ArrayUtil;
use app\common\util\TreeArrayUtil;
use app\common\enum\SystemMenuEnum;
use app\common\helper\ManagerHelper;
use app\common\repository\Wrapper;

class SystemMenuService extends \app\common\service\SystemMenuService
{
    /**
     * 菜单列表
     * @param array $params
     * @return array
     * @throws Exception
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
     * @throws Exception
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
     * @param $id
     * @return array
     * @throws Exception
     */
    public function getById($id)
    {
        return $this->SystemMenuRepository->getById($id);
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
        return $this->SystemMenuRepository->updateById($params['id'], $this->buildData($params));
    }

    /**
     * 更新排序
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function sortMenu(array $params)
    {
        return $this->SystemMenuRepository->updateById($params['id'], ['sort' => $params['sort']]);
    }

    /**
     * 删除菜单
     * @param array $params
     * @return int
     * @throws Exception
     */
    public function deleteMenu(array $params)
    {
        return $this->SystemMenuRepository->deleteById($params['id']);
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
        if ($menu['type'] == SystemMenuEnum::TYPE_LINK) {
            return $menu['link'];
        }

        $url[] = $menu['module'];
        $url[] = $menu['controller'];
        $url[] = $menu['action'];

        return url(ArrayUtil::toString($url, '/'), $menu['params']);
    }
}