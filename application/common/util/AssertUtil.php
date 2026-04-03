<?php

namespace app\common\util;

use InvalidArgumentException;

class AssertUtil
{
    /**
     * 断言为真
     * @param mixed $value
     * @param string $message
     * @return bool
     * @throws InvalidArgumentException
     */
    public static function isTrue($value, $message = '')
    {
        if (true !== $value) {
            throw new InvalidArgumentException($message);
        }

        return true;
    }

    /**
     * 断言为假
     * @param mixed $value
     * @param string $message
     * @return bool
     * @throws InvalidArgumentException
     */
    public static function isFalse($value, $message = '')
    {
        if (false !== $value) {
            throw new InvalidArgumentException($message);
        }

        return true;
    }
}