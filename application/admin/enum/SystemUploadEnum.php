<?php


namespace app\admin\enum;


class SystemUploadEnum
{
    /**
     * 上传状态
     */
    const STATUS_UPLOADING = 1; // 上传中
    const STATUS_SUCCESS   = 2; // 上传失败
    const STATUS_ERROR     = 3; // 上传失败
}