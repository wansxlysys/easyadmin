<?php


namespace app\common\controller;


use Exception;

use think\facade\Hook;

use app\admin\behavior\SystemLogBehavior;
use app\admin\dependency\SystemManagerDependency;
use app\admin\dependency\SystemMenuDependency;
use app\admin\dependency\SystemSettingDependency;
use app\admin\helper\SystemMenuHelper;
use app\admin\helper\SystemSettingHelper;
use app\admin\helper\SystemManagerHelper;

class SystemController extends CommonController
{
    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        $manager       = SystemManagerDependency::getService()->getManager();
        $currentMenu   = SystemMenuDependency::getService()->getCurrentMenu();
        $systemSetting = SystemSettingDependency::getService()->getSystemSetting();

        /**
         * 设置缓存
         */
        SystemManagerHelper::setManager($manager);
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