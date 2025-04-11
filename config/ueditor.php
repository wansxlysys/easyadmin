<?php


use app\admin\enum\UploadEnum;

return [
    // 图片上传
    'imageActionName'     => 'uploadImage',
    'imageFieldName'      => 'image',
    'imageMaxSize'        => UploadEnum::IMAGE_MAX_SIZE,
    'imageAllowFiles'     => ['.jpg', '.png', '.jpeg'],
    'imageCompressEnable' => true,
    'imageCompressBorder' => 5000,
    'imageInsertAlign'    => 'none',
    'imageUrlPrefix'      => '',

    // 上传视频
    'videoActionName'     => 'uploadVideo',
    'videoFieldName'      => 'video',
    'videoUrlPrefix'      => '',
    'videoMaxSize'        => UploadEnum::VIDEO_MAX_SIZE,
    'videoAllowFiles'     => ['.mp4'],

    // 上传音频
    'audioActionName'     => 'uploadAudio',
    'audioFieldName'      => 'audio',
    'audioUrlPrefix'      => '',
    'audioMaxSize'        => UploadEnum::AUDIO_MAX_SIZE,
    'audioAllowFiles'     => ['.mp3'],

    // 上传文件
    'fileActionName'      => 'uploadFile',
    'fileFieldName'       => 'file',
    'fileUrlPrefix'       => '',
    'fileMaxSize'         => UploadEnum::FILE_MAX_SIZE,
    'fileAllowFiles'      => ['.zip', '.pdf', '.doc', '.docx', '.xls', '.xlsx'],
];