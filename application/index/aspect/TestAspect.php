<?php


namespace app\index\aspect;


class TestAspect
{
    /**
     * 前置通知
     * @param $methodName
     * @param $arguments
     * @return void
     */
    public function before($methodName, $arguments)
    {
        dump('test before');
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
        dump('test before around');
        $result = $proceed();
        dump('test after around');
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
        dump('test after');
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