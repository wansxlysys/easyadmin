<?php


namespace app\common\controller;


use think\facade\Hook;

class Admin extends \think\Controller
{
    /**
     * 初始化
     */
    public function initialize()
    {
        $MenuService = new \app\admin\service\Menu();
        $currentMenu = $MenuService->getCurrentMenu();

        if ($this->request->isAjax()) {

            Hook::add('app_end', \app\admin\behavior\Log::class);

        } else {

            $SettingSystemService = new \app\admin\service\SettingSystem();

            $settingSystem = $SettingSystemService->getSetting();
            $breadcrumb    = $MenuService->getBreadcrumb($currentMenu['id']);

            $this->assign('breadcrumb', $breadcrumb);
            $this->assign('currentMenu', $currentMenu);
            $this->assign('settingSystem', $settingSystem);
        }
    }
}