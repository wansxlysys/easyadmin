<?php


namespace app\admin\service;


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
        $ManagerHelper = new \app\admin\helper\Manager();

        $permission = $ManagerHelper->getPermission();

        $Query = new \app\common\repository\Query();

        $Query->order   = ['sort' => 'asc'];
        $Query->where[] = ['type', 'in', '1,3'];
        $Query->where[] = ['id', 'in', $permission];

        $menu = $this->MenuRepository->getAll($Query);

        $resolve = function (&$item) {
            $item = $this->formatData($item);
        };

        $TreeArray = new \helper\TreeArray();

        return $TreeArray->arrayToTree($menu, '', 0, $resolve);
    }

    /**
     * 获取当前请求菜单
     * @return mixed|null
     */
    public function getCurrentMenu()
    {
        static $currentMenu = null;

        if ($currentMenu) {
            return $currentMenu;
        }

        $Query = new \app\common\repository\Query();

        $Query->where[] = ['module', '=', request()->module()];
        $Query->where[] = ['controller', '=', request()->controller()];
        $Query->where[] = ['action', '=', request()->action()];

        $currentMenu = $this->MenuRepository->getOne($Query);

        return $currentMenu;
    }

    /**
     * 获取面包屑导航
     * @param $menuId
     * @param array $breadcrumb
     * @return array
     */
    public function getBreadcrumb($menuId, &$breadcrumb = [])
    {
        $Query = new \app\common\repository\Query();

        $Query->where[] = ['id', '=', $menuId];

        $menu = $this->MenuRepository->getOne($Query);

        if ($menu) {
            $breadcrumb[] = $menu;
            $this->getBreadcrumb($menu['parent_id'], $breadcrumb);
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

        $Query->order = ['sort' => 'asc'];

        return $this->MenuRepository->getAll($Query);
    }

    /**
     * 通过ID获取菜单
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $Query = new \app\common\repository\Query();

        $Query->where[] = ['id', '=', $id];

        $data = $this->MenuRepository->getOne($Query);

        return $this->formatData($data);
    }

    /**
     * 获取全部菜单树
     * @param array $checked
     * @return array
     */
    public function getAllTree(array $checked = [])
    {
        $menuList  = $this->getAll();
        $TreeArray = new \helper\TreeArray();

        $resolve = function (&$item) use ($checked) {
            $item['selected'] = in_array($item['id'], $checked);
            $item['checked']  = in_array($item['id'], $checked) && empty($item['children']);
        };

        return $TreeArray->arrayToTree($menuList, 0, 0, $resolve);
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

        return $this->MenuRepository->updateById($params);
    }

    /**
     * 删除菜单
     * @param array $params
     * @return mixed
     */
    public function deleteByParamsId(array $params)
    {
        $Query = new \app\common\repository\Query();

        $Query->where[] = ['id', '=', $params['id']];

        return $this->MenuRepository->deleteRecord($Query);
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
        // 检测是否为外部链接
        if ($menu['type'] == 3) {
            return $menu['link'];
        }

        $params = [];

        $url[] = $menu['module'];
        $url[] = $menu['controller'];
        $url[] = $menu['action'];

        if (!empty($menu['params'])) {
            $params = $menu['params'];
        }

        return url(implode('/', $url), $params);
    }
}