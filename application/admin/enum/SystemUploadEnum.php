<?php


namespace app\admin\enum;


class SystemUploadEnum
{
    /**
     * 上传状态
     */
    const STATUS_UPLOADING = 1; // 上传中
    const STATUS_SUCCESS   = 2; // 上传成功
    const STATUS_ERROR     = 3; // 上传失败

    /**
     * 文件保存目录
     */
    const UPLOAD_DIR = '/upload';

    /**
     * 允许上传文件类型
     */
    const FILE_TYPE = [
        'video/mp4'  => 'video',
        'audio/mp3'  => 'audio',
        'image/jpg'  => 'image',
        'image/png'  => 'image',
        'image/gif'  => 'image',
        'image/jpeg' => 'image',
    ];
}