<?php


namespace app\common\dependency;


use Throwable;

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
        $aspects = array_merge($this->aspectConfig[$methodName] ?? [], $this->aspectConfig['*'] ?? []);

        /**
         * 如果没有切面配置，直接调用目标方法
         */
        if (empty($aspects)) {
            return call_user_func_array([$this->targetObject, $methodName], $arguments);
        }

        /**
         * 定义目标方法的执行逻辑
         */
        $proceed = function () use ($methodName, $arguments) {
            return call_user_func_array([$this->targetObject, $methodName], $arguments);
        };

        /**
         * 嵌套执行切面逻辑
         */
        foreach ($aspects as $aspect) {
            $proceed = $this->wrapAspect($proceed, $aspect, $methodName, $arguments);
        }

        /**
         * 执行最终的切面逻辑
         */
        return $proceed();
    }

    /**
     * 包装切面逻辑
     * @param callable $proceed
     * @param object $aspect
     * @param string $methodName
     * @param array $arguments
     * @return callable
     */
    protected function wrapAspect($proceed, $aspect, $methodName, $arguments)
    {
        return function () use ($proceed, $aspect, $methodName, $arguments) {

            /**
             * 执行前置通知
             */
            if (method_exists($aspect, 'before')) {
                call_user_func([$aspect, 'before'], $methodName, $arguments);
            }

            /**
             * 执行环绕通知
             */
            try {

                if (method_exists($aspect, 'around')) {
                    $result = call_user_func([$aspect, 'around'], $methodName, $arguments, $proceed);
                } else {
                    $result = $proceed();
                }

            } catch (Throwable $throwable) {
                /**
                 * 执行异常通知
                 */
                if (method_exists($aspect, 'throw')) {
                    call_user_func([$aspect, 'throw'], $methodName, $arguments, $throwable);
                }

                throw $throwable;
            }

            /**
             * 执行后置通知
             */
            if (method_exists($aspect, 'after')) {
                call_user_func([$aspect, 'after'], $methodName, $arguments, $result);
            }

            return $result;
        };
    }
}