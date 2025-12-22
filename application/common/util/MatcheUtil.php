<?php


namespace app\common\util;


class MatcheUtil
{
    /**
     * 检查URL是否匹配任意模式
     *
     * @param array $patterns 正则表达式模式数组
     * @param string $url 要检查的URL
     * @return bool
     */
    public static function matchesAny(array $patterns, string $url)
    {
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url)) {
                return true;
            }
        }
        return false;
    }

    /**
     * 检查URL是否匹配所有模式
     *
     * @param array $patterns 正则表达式模式数组
     * @param string $url 要检查的URL
     * @return bool
     */
    public static function matchesAll(array $patterns, string $url)
    {
        foreach ($patterns as $pattern) {
            if (!preg_match($pattern, $url)) {
                return false;
            }
        }
        return true;
    }
}