<?php


namespace app\common\helper;


class EncryptionHelper
{
    /**
     * 加密
     * @param $content
     * @return string
     */
    public static function encrypt($content)
    {
        return md5($content);
    }
}