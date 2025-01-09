<?php


namespace app\common\dependency;


class DependencyProxy
{
    /**
     * 代理目标对象
     * @var object
     */
    public $targetObject;

    /**
     * 切点配置
     * @var array
     */
    public $aspectConfig;

    /**
     * 初始化
     * @param $targetObject
     * @param $aspectConfig
     */
    public function __construct($targetObject, $aspectConfig)
    {
        $this->targetObject = $targetObject;
        $this->aspectConfig = $aspectConfig;
    }

    /**
     * 基于魔术方法实现动态代理
     * @param $methodName
     * @param $arguments
     * @return mixed
     */
    public function __call($methodName, $arguments)
    {
        /**
         * 加载目标方法的切点
         */
        $aspect = $this->aspectConfig[$methodName] ?? [];

        /**
         * 执行前置通知
         */
        if (isset($aspect['before'])) {
            call_user_func($aspect['before'], $methodName, $arguments);
        }

        /**
         * 执行环绕通知
         */
        if (isset($aspect['around'])) {

            $proceed = function () use ($methodName, $arguments) {
                return call_user_func_array([$this->targetObject, $methodName], $arguments);
            };

            $result = call_user_func($aspect['around'], $methodName, $arguments, $proceed);

        } else {

            /**
             * 直接调用目标方法
             */
            $result = call_user_func_array([$this->targetObject, $methodName], $arguments);
        }

        /**
         * 执行后置通知
         */
        if (isset($aspect['after'])) {
            call_user_func($aspect['after'], $methodName, $arguments, $result);
        }

        return $result;
    }
}