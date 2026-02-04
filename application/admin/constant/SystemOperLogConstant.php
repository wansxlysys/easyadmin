<?php


namespace app\admin\constant;


class SystemOperLogConstant
{
    /**
     * 响应状态
     */
    const STATUS_SUCCESS = 1; // 登录成功
    const STATUS_ERROR   = 2; // 登录失败

    /**
     * code转状态码
     * @param $code
     * @return int
     */
    public static function translateCode($code)
    {
        $codeMap = [
            0 => static::STATUS_ERROR,
            1 => static::STATUS_SUCCESS
        ];

        return $codeMap[$code] ?? static::STATUS_ERROR;
    }
}