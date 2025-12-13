<?php


namespace app\admin\format;


use think\facade\Url;

use app\common\util\ArrayUtil;
use app\admin\enum\SystemMenuEnum;

class SystemMenuFormat
{
    /**
     * 构建数据
     * @param $data
     * @return mixed
     */
    public static function buildData(&$data)
    {
        if ($data['type'] == SystemMenuEnum::TYPE_LINK) {
            $data['link'] = '';
        }

        return $data;
    }

    /**
     * 格式化url
     * @param $data
     * @return mixed|string
     */
    public static function formatUrl(&$data)
    {
        if ($data['type'] == SystemMenuEnum::TYPE_LINK) {
            $data['url'] = $data['link'];
        } else {

            $url[] = $data['module'];
            $url[] = $data['controller'];
            $url[] = $data['action'];

            $data['url'] = Url::build(ArrayUtil::toString($url, '/'), $data['params']);
        }

        return $data;
    }

    /**
     * 格式化图标
     * @param $data
     * @return mixed|string
     */
    public static function formatIcon(&$data)
    {
        if (!empty($data['icon'])) {
            $data['icon'] = "<i class='fa fa-fw {$data['icon']}'></i>";
        }

        return $data;
    }
}