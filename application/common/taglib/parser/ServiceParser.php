<?php


namespace app\common\taglib\parser;


use think\facade\App;

use app\common\dependency\Dependency;

class ServiceParser
{
    /**
     * 调用方法
     * @param array $params
     * @return mixed
     */
    public function invoke(array $params)
    {
        if (empty($layer)) {
            $params['module'] = request()->module();
        }

        $ProxyService = Dependency::getProxy(App::parseClass($params['module'], 'service', $params['class']));

        if (!is_array($params['params'])) {
            $params['params'] = [$params['params']];
        }

        if (empty($params['wrapper'])) {
            $params['params'] = [$params['params']];
        }

        return $ProxyService->{$params['method']}(...$params['params']);
    }
}