<?php


namespace app\common\controller;


use think\facade\Hook;
use app\admin\service\SystemMenuService;
use app\admin\behavior\SystemLogBehavior;
use app\admin\service\SystemSettingService;

class AdminController extends CommonController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        $MenuService = new SystemMenuService();
        $currentMenu = $MenuService->getCurrentMenu();

        /**
         * 每个url必须设定一个菜单
         */
        if (empty($currentMenu)) {
            $this->error('系统菜单不存在');
        }

        if ($this->request->isAjax()) {

            Hook::add('app_end', SystemLogBehavior::class);

        } else {

            $SettingSystemService = new SystemSettingService();

            $settingSystem  = $SettingSystemService->getSetting();
            $breadcrumbMenu = $MenuService->getBreadcrumbMenu($currentMenu['id']);

            $this->assign('currentMenu', $currentMenu);
            $this->assign('settingSystem', $settingSystem);
            $this->assign('breadcrumbMenu', $breadcrumbMenu);
        }
    }
}