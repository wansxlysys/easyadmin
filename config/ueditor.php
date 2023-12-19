<?php


return [
    // 图片上传
    'imageActionName'     => 'image',
    'imageFieldName'      => 'file',
    'imageMaxSize'        => 1024 * 1024 * 10,
    'imageAllowFiles'     => ['.jpg', '.png', '.jpeg'],
    'imageCompressEnable' => true,
    'imageCompressBorder' => 5000,
    'imageInsertAlign'    => 'none',
    'imageUrlPrefix'      => '',

    // 图片抓取
    'catcherLocalDomain'  => ['127.0.0.1', 'localhost',],
    'catcherActionName'   => 'catch',
    'catcherFieldName'    => 'source',
    'catcherUrlPrefix'    => '',
    'catcherMaxSize'      => 1024 * 1024 * 10,
    'catcherAllowFiles'   => ['.jpg', '.png', '.jpeg'],

    // 上传视频
    'videoActionName'     => 'video',
    'videoFieldName'      => 'file',
    'videoUrlPrefix'      => '',
    'videoMaxSize'        => 1024 * 1024 * 100,
    'videoAllowFiles'     => ['.mp4'],

    // 上传音频
    'audioActionName'     => 'audio',
    'audioFieldName'      => 'file',
    'audioUrlPrefix'      => '',
    'audioMaxSize'        => 1024 * 1024 * 100,
    'audioAllowFiles'     => ['.mp3'],

    // 上传文件
    'fileActionName'      => 'file',
    'fileFieldName'       => 'file',
    'fileUrlPrefix'       => '',
    'fileMaxSize'         => 1024 * 1024 * 100,
    'fileAllowFiles'      => ['.zip', '.pdf', '.doc', '.docx', '.xls', '.xlsx'],
];