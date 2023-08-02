<?php


namespace app\common\controller;


use think\facade\Hook;
use app\admin\behavior\LogBehavior;
use app\admin\service\MenuService;
use app\admin\service\SettingSystemService;

class AdminController extends CommonController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        $MenuService = new MenuService();
        $currentMenu = $MenuService->getCurrentMenu();

        /**
         * 每个url必须设定一个菜单
         */
        if (empty($currentMenu)) {
            $this->error('系统菜单不存在');
        }

        if ($this->request->isAjax()) {

            Hook::add('app_end', LogBehavior::class);

        } else {

            $SettingSystemService = new SettingSystemService();

            $settingSystem  = $SettingSystemService->getSetting();
            $breadcrumbMenu = $MenuService->getBreadcrumbMenu($currentMenu['id']);

            $this->assign('currentMenu', $currentMenu);
            $this->assign('settingSystem', $settingSystem);
            $this->assign('breadcrumbMenu', $breadcrumbMenu);
        }
    }
}