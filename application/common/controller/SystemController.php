<?php


namespace app\common\controller;


use Exception;

use think\facade\Hook;

use app\common\dependency\Dependency;

use app\admin\helper\SystemMenuHelper;
use app\admin\helper\SystemSettingHelper;
use app\admin\helper\SystemManagerHelper;
use app\admin\service\SystemMenuService;
use app\admin\service\SystemManagerService;
use app\admin\service\SystemSettingService;
use app\admin\behavior\SystemLogBehavior;

class SystemController extends CommonController
{
    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        $currentMenu   = Dependency::getProxy(SystemMenuService::class)->getCurrentMenu();
        $loginManager  = Dependency::getProxy(SystemManagerService::class)->getManager();
        $systemSetting = Dependency::getProxy(SystemSettingService::class)->getSystemSetting();

        /**
         * 设置缓存
         */
        SystemManagerHelper::setManager($loginManager);
        SystemMenuHelper::setCurrentMenu($currentMenu);
        SystemSettingHelper::setSystemSetting($systemSetting);

        if ($this->request->isAjax()) {

            /**
             * 添加结束钩子
             */
            Hook::add('app_end', SystemLogBehavior::class);

        } else {

            /**
             * 赋值视图变量
             */
            $this->assign('currentMenu', $currentMenu);
            $this->assign('loginManager', $loginManager);
            $this->assign('systemSetting', $systemSetting);

            /**
             * 赋值其他变量
             */
            $this->assign('request', request());
        }
    }
}