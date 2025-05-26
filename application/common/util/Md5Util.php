<?php


namespace app\common\util;


class Md5Util
{
    /**
     * 不可逆加密
     * @param $content
     * @return string
     */
    public static function encrypt($content)
    {
        return md5($content);
    }

    /**
     * 检测是否相等
     * @param string $origin 加密前密码
     * @param string $encrypt 加密后密码
     * @return bool
     */
    public static function equals($origin, $encrypt)
    {
        return static::encrypt($origin) === $encrypt;
    }
}