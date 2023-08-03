<?php


namespace app\admin\service;


use think\facade\Request;
use app\common\repository\Query;
use app\common\util\TreeArrayUtil;
use app\common\helper\ManagerHelper;
use app\common\helper\StorageHelper;
use app\admin\repository\MenuRepository;

class MenuService extends \app\common\service\MenuService
{
    /**
     * 菜单存储类
     * @var MenuRepository
     */
    protected $MenuRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->MenuRepository = new MenuRepository();
    }

    /**
     * 获取左侧菜单
     * @return array
     */
    public function getLeftMenu()
    {
        $Query = new Query();

        $Query->setOrder(['sort' => 'asc']);
        $Query->addWhere('type', 'in', '1,3');
        $Query->addWhere('id', 'in', ManagerHelper::getPermission());

        $TreeArrayUtil = new TreeArrayUtil();

        return $TreeArrayUtil->arrayToTree($this->MenuRepository->getAll($Query), 0, 1, function (&$item) {
            $item = $this->formatData($item);
        });
    }

    /**
     * 获取当前请求菜单
     * @return mixed|null
     */
    public function getCurrentMenu()
    {
        if (StorageHelper::has(static::CONTAINER_MENU)) {
            return StorageHelper::get(static::CONTAINER_MENU);
        }

        $Query = new Query();

        $Query->addWhere('module', '=', Request::module());
        $Query->addWhere('controller', '=', Request::controller());
        $Query->addWhere('action', '=', Request::action());

        StorageHelper::set(static::CONTAINER_MENU, $this->MenuRepository->getOne($Query));

        return StorageHelper::get(static::CONTAINER_MENU);
    }

    /**
     * 获取面包屑导航
     * @param $menuId
     * @param array $breadcrumb
     * @return array
     */
    public function getBreadcrumbMenu($menuId, &$breadcrumb = [])
    {
        $menu = $this->MenuRepository->getById($menuId);

        if ($menu) {
            $this->getBreadcrumbMenu($menu['parent_id'], $breadcrumb);
            $breadcrumb[] = $menu;
        }

        return $breadcrumb;
    }

    /**
     * 获取全部菜单
     * @return mixed
     */
    public function getAll()
    {
        $Query = new Query();

        $Query->setOrder(['sort' => 'asc']);

        return $this->MenuRepository->getAll($Query);
    }

    /**
     * 通过ID获取菜单
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->formatData($this->MenuRepository->getById($id));
    }

    /**
     * 添加菜单
     * @param array $params
     * @return mixed
     */
    public function createMenu(array $params)
    {
        return $this->MenuRepository->createRecord($this->buildData($params));
    }

    /**
     * 通过ID更新数据
     * @param array $params
     * @return bool
     */
    public function updateMenu(array $params)
    {
        return $this->MenuRepository->updateById($params['id'], $this->buildData($params));
    }

    /**
     * 删除菜单
     * @param array $params
     * @return mixed
     */
    public function deleteMenu(array $params)
    {
        return $this->MenuRepository->deleteById($params['id']);
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
        if (!empty($params['type']) && $params['type'] != 3) {
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
        if ($menu['type'] == static::TYPE_LINK) {
            return $menu['link'];
        }

        $url[] = $menu['module'];
        $url[] = $menu['controller'];
        $url[] = $menu['action'];

        return url(implode('/', $url), $menu['params']);
    }
}