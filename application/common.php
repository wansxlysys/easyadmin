<?php


if (!function_exists('register_static')) {
    /**
     * 引入静态文件并加入版本号
     * @param $url
     * @return string
     */
    function register_static($url)
    {
        return config('system.static_path') . $url . '?v=' . config('system.version');
    }
}

if (!function_exists('array_to_base64')) {
    /**
     * 数组转base64输出
     * @param array $data
     * @return bool|mixed
     */
    function array_to_base64(array $data)
    {
        return base64_encode(json_encode($data));
    }
}

if (!function_exists('file_prefix')) {
    /**
     * 补齐文件域名前缀
     * @param $filePath
     * @param bool $toArray
     * @param string $perfix
     * @return mixed
     */
    function file_prefix($filePath, $toArray = false, $perfix = 'system_domain')
    {
        if (empty($filePath)) {
            return $filePath;
        }

        $domain = config('system.' . $perfix);

        if (!is_array($filePath)) {
            $filePath = explode(',', $filePath);
        }

        foreach ($filePath as $key => $file) {
            $filePath[$key] = $domain . $file;
        }

        return $toArray ? $filePath : implode(',', $filePath);
    }
}

if (!function_exists('system_prefix')) {
    /**
     * 后端文件域名前缀
     * @param $filePath
     * @param bool $toArray
     * @return mixed
     */
    function system_prefix($filePath, $toArray = false)
    {
        return file_prefix($filePath, $toArray, 'system_domain');
    }
}

if (!function_exists('empty_image')) {
    /**
     * 输出展位图片
     * @param $image
     * @param $default
     * @return bool|mixed
     */
    function empty_image($image, $default)
    {
        if (empty($image)) {
            return $default;
        }

        return $image;
    }
}