<?php


namespace app\common\enum;


class UploadEnum
{
    /**
     * 文件保存目录
     */
    const UPLOAD_DIR = 'upload';

    /**
     * 图片大小
     */
    const IMAGE_MAX_SIZE = 2097152;

    /**
     * 图片后缀
     */
    const IMAGE_FILE_EXT = 'jpg,jpeg,png';

    /**
     * 视频大小
     */
    const VIDEO_MAX_SIZE = 10485760;

    /**
     * 视频后缀
     */
    const VIDEO_FILE_EXT = 'mp4';

    /**
     * 音频大小
     */
    const AUDIO_MAX_SIZE = 10485760;

    /**
     * 音频后缀
     */
    const AUDIO_FILE_EXT = 'mp3';

    /**
     * 文件大小
     */
    const FILE_MAX_SIZE = 10485760;

    /**
     * 文件后缀
     */
    const FILE_FILE_EXT = 'zip';

    /**
     * 切片文件大小
     */
    const SLICE_MAX_SIZE = 104857600;

    /**
     * 切片文件后缀
     */
    const SLICE_FILE_EXT = 'zip';
}