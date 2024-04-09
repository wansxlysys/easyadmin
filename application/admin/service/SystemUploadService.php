<?php


namespace app\admin\service;


use Throwable;

use think\File;
use think\Validate;
use app\common\util\FileUtil;
use app\common\enum\UploadEnum;

class SystemUploadService extends \app\common\service\SystemUploadService
{
    /**
     * 图片上传
     * @param $image
     * @param string $fileType
     * @return array|bool
     * @throws Throwable
     */
    public function uploadImage(File $image, $fileType = 'image')
    {
        $params = [
            'image' => $image
        ];

        $rule = [
            'image' => 'require|fileExt:' . UploadEnum::IMAGE_FILE_EXT . '|fileSize:' . UploadEnum::IMAGE_MAX_SIZE,
        ];

        $msg = [
            'image.require'  => '图片不能为空',
            'image.fileExt'  => '图片格式必须' . UploadEnum::IMAGE_FILE_EXT,
            'image.fileSize' => '图片不能超过' . FileUtil::formatBytes(UploadEnum::IMAGE_MAX_SIZE),
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            return $this->setMessage($Validate->getError());
        }

        return $this->saveFile($image, $fileType);
    }

    /**
     * 视频上传
     * @param $video
     * @param string $fileType
     * @return array|bool
     * @throws Throwable
     */
    public function uploadVideo(File $video, $fileType = 'video')
    {
        $params = [
            'video' => $video
        ];

        $rule = [
            'video' => 'require|fileExt:' . UploadEnum::VIDEO_FILE_EXT . '|fileSize:' . UploadEnum::VIDEO_MAX_SIZE,
        ];

        $msg = [
            'video.require'  => '视频不能为空',
            'video.fileExt'  => '视频格式必须' . UploadEnum::IMAGE_FILE_EXT,
            'video.fileSize' => '视频不能超过' . FileUtil::formatBytes(UploadEnum::VIDEO_MAX_SIZE),
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            return $this->setMessage($Validate->getError());
        }

        return $this->saveFile($video, $fileType);
    }

    /**
     * 音频上传
     * @param $audio
     * @param string $fileType
     * @return array|bool
     * @throws Throwable
     */
    public function uploadAudio(File $audio, $fileType = 'audio')
    {
        $params = [
            'audio' => $audio
        ];

        $rule = [
            'audio' => 'require|fileExt:' . UploadEnum::AUDIO_FILE_EXT . '|fileSize:' . UploadEnum::AUDIO_MAX_SIZE,
        ];

        $msg = [
            'audio.require'  => '音频不能为空',
            'audio.fileExt'  => '音频格式必须' . UploadEnum::IMAGE_FILE_EXT,
            'audio.fileSize' => '音频不能超过' . FileUtil::formatBytes(UploadEnum::AUDIO_MAX_SIZE),
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            return $this->setMessage($Validate->getError());
        }

        return $this->saveFile($audio, $fileType);
    }

    /**
     * 文件上传
     * @param $file
     * @param string $fileType
     * @return array|bool
     * @throws Throwable
     */
    public function uploadFile(File $file, $fileType = 'file')
    {
        $params = [
            'file' => $file
        ];

        $rule = [
            'file' => 'require|fileExt:' . UploadEnum::FILE_FILE_EXT . '|fileSize:' . UploadEnum::FILE_MAX_SIZE,
        ];

        $msg = [
            'file.require'  => '文件不能为空',
            'file.fileExt'  => '文件格式必须' . UploadEnum::FILE_FILE_EXT,
            'file.fileSize' => '文件不能超过' . FileUtil::formatBytes(UploadEnum::FILE_MAX_SIZE),
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            return $this->setMessage($Validate->getError());
        }

        return $this->saveFile($file, $fileType);
    }

    /**
     * 文件上传
     * @param array $params
     * @param string $fileType
     * @return mixed
     * @throws Throwable
     */
    public function uploadSlice(array $params, $fileType = 'file')
    {
        $rule = [
            'size'   => 'require|elt:' . UploadEnum::SLICE_MAX_SIZE,
            'suffix' => 'require|in:' . UploadEnum::SLICE_FILE_EXT,
        ];

        $msg = [
            'size.require'   => '文件大小不能为空',
            'size.elt'       => '文件大小不能大于' . FileUtil::formatBytes(UploadEnum::SLICE_MAX_SIZE),
            'suffix.require' => '文件格式不能为空',
            'suffix.in'      => '文件格式必须' . UploadEnum::SLICE_FILE_EXT,
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            return $this->setMessage($Validate->getError());
        }

        return $this->saveSlice($params, $fileType);
    }
}