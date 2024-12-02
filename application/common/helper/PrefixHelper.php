<?php


namespace app\common\helper;

use app\common\util\ArrayUtil;
use app\common\util\StringUtil;

class PrefixHelper
{
    /**
     * 补齐文件域名前缀
     * @param $filePath
     * @param bool $toArray
     * @param string $prefix
     * @return mixed
     */
    public static function prefix($filePath, $toArray = false, $prefix = 'system_domain')
    {
        $domain = config('system.' . $prefix);

        if (!is_array($filePath)) {
            $filePath = StringUtil::toArray($filePath);
        }

        foreach ($filePath as $key => $file) {
            $filePath[$key] = $domain . $file;
        }

        return $toArray ? $filePath : ArrayUtil::toString($filePath);
    }

    /**
     * 后端文件域名前缀
     * @param $filePath
     * @param bool $toArray
     * @return mixed
     */
    public static function system($filePath, $toArray = false)
    {
        return static::prefix($filePath, $toArray, 'system_domain');
    }
}