<?php


namespace app\common\controller;


use Exception;

use think\facade\Hook;

use app\admin\behavior\SystemLogBehavior;
use app\admin\dependency\ManagerDependency;
use app\admin\dependency\SystemMenuDependency;
use app\admin\dependency\SystemSettingDependency;

use app\common\helper\ManagerHelper;
use app\common\helper\SystemMenuHelper;
use app\common\helper\SystemSettingHelper;

class SystemController extends CommonController
{
    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        $manager       = ManagerDependency::getService()->getManager();
        $currentMenu   = SystemMenuDependency::getService()->getCurrentMenu();
        $systemSetting = SystemSettingDependency::getService()->getSystemSetting();

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