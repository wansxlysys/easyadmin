<?php


namespace app\index\aspect;


class UserAspect
{
    /**
     * 前置通知
     * @param $methodName
     * @param $arguments
     * @return void
     */
    public function before($methodName, $arguments)
    {
        dump('before');
        var_dump($methodName, $arguments);
    }

    /**
     * 环绕通知
     * @param $methodName
     * @param $arguments
     * @param $proceed
     * @return void
     */
    public function around($methodName, $arguments, $proceed)
    {
        dump('before around');
        $result = $proceed();
        dump('after around');
        var_dump($methodName, $arguments);
        return $result;
    }

    /**
     * 后置通知
     * @param $methodName
     * @param $arguments
     * @param $result
     * @return void
     */
    public function after($methodName, $arguments, $result)
    {
        dump('after');
        var_dump($methodName, $arguments);
    }

    /**
     * 异常通知
     * @param $methodName
     * @param $arguments
     * @param $throwable
     * @return void
     */
    public function throw($methodName, $arguments, $throwable)
    {
        echo $throwable->getMessage();
    }
}