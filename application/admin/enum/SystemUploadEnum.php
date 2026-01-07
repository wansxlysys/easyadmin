<?php


namespace app\admin\enum;


class SystemUploadEnum
{
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