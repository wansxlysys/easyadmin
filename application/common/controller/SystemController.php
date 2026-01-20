<?php


namespace app\common\controller;


use Exception;

use think\facade\Hook;

use app\admin\helper\SystemMenuHelper;
use app\admin\helper\SystemSettingHelper;
use app\admin\helper\SystemManagerHelper;
use app\admin\behavior\SystemLogBehavior;

class SystemController extends CommonController
{
    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        if ($this->request->isAjax()) {

            /**
             * 添加结束钩子
             */
            Hook::add('app_end', SystemLogBehavior::class);

        } else {

            /**
             * 赋值视图变量
             */
            $this->assign('currentMenu', SystemMenuHelper::getMenu());
            $this->assign('loginManager', SystemManagerHelper::getManager());
            $this->assign('systemSetting', SystemSettingHelper::getSystemSetting());

            /**
             * 赋值其他变量
             */
            $this->assign('request', request());
        }
    }
}