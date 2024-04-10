<?php


namespace app\common\controller;


use Throwable;

use think\facade\Hook;

use app\admin\service\SystemMenuService;
use app\admin\behavior\SystemLogBehavior;
use app\admin\service\SystemSettingService;

use app\common\helper\SystemSettingHelper;

class AdminController extends CommonController
{
    /**
     * 初始化
     * @throws Throwable
     */
    public function initialize()
    {
        $SystemMenuService    = new SystemMenuService();
        $SystemSettingService = new SystemSettingService();

        $currentMenu   = $SystemMenuService->getCurrentMenu();
        $systemSetting = $SystemSettingService->getSetting();

        /**
         * 每个url必须设定一个菜单
         */
        if (empty($currentMenu)) {
            $this->error('系统菜单不存在');
        }

        /**
         * 设置系统设置到缓存
         */
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
            $this->assign('currentMenu', $currentMenu);
            $this->assign('systemSetting', $systemSetting);
        }
    }
}