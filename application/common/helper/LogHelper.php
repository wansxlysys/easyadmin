<?php


namespace app\common\helper;


use Monolog\Logger;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\FormattableHandlerInterface;

/**
 * @method static void log($level, $message, array $context = [])
 * @method static void debug($message, array $context = [])
 * @method static void info($message, array $context = [])
 * @method static void notice($message, array $context = [])
 * @method static void warning($message, array $context = [])
 * @method static void error($message, array $context = [])
 * @method static void critical($message, array $context = [])
 * @method static void alert($message, array $context = [])
 * @method static void emergency($message, array $context = [])
 */
class LogHelper
{
    /**
     * @var array
     */
    protected static $instance = [];

    /**
     * Channel.
     * @param string $name
     * @return Logger
     */
    public static function channel(string $name = 'default'): Logger
    {
        if (!isset(static::$instance[$name])) {
            $config                  = config('monolog.')[$name];
            $handlers                = self::handlers($config);
            $processors              = self::processors($config);
            static::$instance[$name] = new Logger($name, $handlers, $processors);
        }

        return static::$instance[$name];
    }

    /**
     * Handlers.
     * @param array $config
     * @return array
     */
    protected static function handlers(array $config): array
    {
        $handlers       = [];
        $handlerConfigs = $config['handlers'] ?? [[]];

        foreach ($handlerConfigs as $value) {
            $class           = $value['class'] ?? [];
            $constructor     = $value['constructor'] ?? [];
            $formatterConfig = $value['formatter'] ?? [];

            if ($class) {
                $handlers[] = self::handler($class, $constructor, $formatterConfig);
            }
        }

        return $handlers;
    }

    /**
     * Handler.
     * @param string $class
     * @param array $constructor
     * @param array $formatterConfig
     * @return HandlerInterface
     */
    protected static function handler(string $class, array $constructor, array $formatterConfig): HandlerInterface
    {
        $handler = new $class(... array_values($constructor));

        if ($handler instanceof FormattableHandlerInterface && $formatterConfig) {
            $formatterClass       = $formatterConfig['class'];
            $formatterConstructor = $formatterConfig['constructor'];

            $formatter = new $formatterClass(... array_values($formatterConstructor));

            $handler->setFormatter($formatter);
        }

        return $handler;
    }

    /**
     * Processors.
     * @param array $config
     * @return array
     */
    protected static function processors(array $config): array
    {
        $result = [];

        if (!isset($config['processors']) && isset($config['processor'])) {
            $config['processors'] = [$config['processor']];
        }

        foreach ($config['processors'] ?? [] as $value) {
            if (is_array($value) && isset($value['class'])) {
                $value = new $value['class'](... array_values($value['constructor'] ?? []));
            }

            $result[] = $value;
        }

        return $result;
    }

    /**
     * __callStatic
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        return static::channel()->{$name}(... $arguments);
    }
}
