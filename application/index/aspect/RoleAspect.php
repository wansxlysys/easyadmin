<?php


namespace app\index\aspect;


class RoleAspect
{
    /**
     * 前置通知
     * @param $methodName
     * @param $arguments
     * @return void
     */
    public function before($methodName, $arguments)
    {
        dump('role before');
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
        dump('role before around');
        $result = $proceed();
        dump('role after around');
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
        dump('role after');
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