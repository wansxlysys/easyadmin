<?php


namespace app\common\controller;


use Exception;

use think\facade\Hook;

use app\admin\service\ManagerService;
use app\admin\service\SystemMenuService;
use app\admin\behavior\SystemLogBehavior;
use app\admin\service\SystemSettingService;

use app\common\helper\ManagerHelper;
use app\common\helper\SystemMenuHelper;
use app\common\helper\SystemSettingHelper;

class AdminController extends CommonController
{
    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        $ManagerService       = new ManagerService();
        $SystemMenuService    = new SystemMenuService();
        $SystemSettingService = new SystemSettingService();

        $manager       = $ManagerService->getManager();
        $currentMenu   = $SystemMenuService->getCurrentMenu();
        $systemSetting = $SystemSettingService->getSystemSetting();

        /**
         * 设置缓存
         */
        ManagerHelper::setManager($manager);
        SystemMenuHelper::setCurrentMenu($currentMenu);
        SystemSettingHelper::setSystemSetting($systemSetting);

        if ($this->request->isAjax()) {

            /**
             * 添加结束钩子
             */
            Hook::add('app_end', SystemLogBehavior::class);

        } else {

            /**
             * 初始化视图变量
             */
            $this->assign('manager', $manager);
            $this->assign('currentMenu', $currentMenu);
            $this->assign('systemSetting', $systemSetting);
        }
    }
}