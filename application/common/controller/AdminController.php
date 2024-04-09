<?php


namespace app\common\controller;


use Throwable;

use think\facade\Hook;

use app\admin\service\SystemMenuService;
use app\admin\behavior\SystemLogBehavior;
use app\admin\service\SystemSettingService;

class AdminController extends CommonController
{
    /**
     * 初始化
     * @throws Throwable
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

            /**
             * 添加结束钩子
             */
            Hook::add('app_end', SystemLogBehavior::class);

        } else {

            /**
             * 初始化视图变量
             */
            $SystemSettingService = new SystemSettingService();

            $systemSetting  = $SystemSettingService->getSetting();
            $breadcrumbMenu = $MenuService->getBreadcrumbMenu($currentMenu['id']);

            $this->assign('currentMenu', $currentMenu);
            $this->assign('systemSetting', $systemSetting);
            $this->assign('breadcrumbMenu', $breadcrumbMenu);
        }
    }
}