<?php


namespace app\admin\service;


use think\facade\Request;
use app\common\helper\Storage;

class Menu extends \app\common\service\Menu
{

    /**
     * 菜单存储类
     * @var \app\admin\repository\Menu
     */
    protected $MenuRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->MenuRepository = new \app\admin\repository\Menu();
    }

    /**
     * 获取左侧菜单
     * @return array
     */
    public function getLeftMenu()
    {
        $Query = new \app\common\repository\Query();

        $Query->setOrder(['sort' => 'asc']);
        $Query->addWhere(['type', 'in', '1,3']);
        $Query->addWhere(['id', 'in', \app\common\helper\Manager::getPermission()]);

        $TreeArray = new \app\common\helper\TreeArray();

        return $TreeArray->arrayToTree($this->MenuRepository->getAll($Query), 0, 1, function (&$item) {
            $item = $this->formatData($item);
        });
    }

    /**
     * 获取当前请求菜单
     * @return mixed|null
     */
    public function getCurrentMenu()
    {
        $currentMenu = 'currentMenu';

        if (Storage::has($currentMenu)) {
            return Storage::get($currentMenu);
        }

        $Query = new \app\common\repository\Query();

        $Query->addWhere(['module', '=', Request::module()]);
        $Query->addWhere(['controller', '=', Request::controller()]);
        $Query->addWhere(['action', '=', Request::action()]);

        Storage::set($currentMenu, $this->MenuRepository->getOne($Query));

        return Storage::get($currentMenu);
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
            $breadcrumb[] = $menu;
            $this->getBreadcrumbMenu($menu['parent_id'], $breadcrumb);
        }

        return array_reverse($breadcrumb);
    }

    /**
     * 获取全部菜单
     * @return mixed
     */
    public function getAll()
    {
        $Query = new \app\common\repository\Query();

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
    public function createRecord(array $params)
    {
        $params = $this->buildData($params);

        return $this->MenuRepository->createRecord($params);
    }

    /**
     * 通过ID更新数据
     * @param array $params
     * @return bool
     */
    public function updateByParamsId(array $params)
    {
        $params = $this->buildData($params);

        return $this->MenuRepository->updateById($params['id'], $params);
    }

    /**
     * 删除菜单
     * @param array $params
     * @return mixed
     */
    public function deleteByParamsId(array $params)
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
        // 如果不是外链则清空链接地址
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
        if ($menu['type'] == \app\common\constant\Menu::TYPE_LINK) {
            return $menu['link'];
        }

        $url[] = $menu['module'];
        $url[] = $menu['controller'];
        $url[] = $menu['action'];

        return url(implode('/', $url), $menu['params']);
    }
}