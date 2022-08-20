<?php


namespace app\common\helper;

use think\Validate;
use think\facade\Env;
use think\facade\Request;

class Upload extends \app\common\service\Service
{
    /**
     * 描述信息
     * @var string
     */
    protected $message = '';

    /**
     * 设置信息
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * 获取信息
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * 图片上传
     * @param string $name
     * @param string $savePath
     * @return array|bool
     */
    public function image($name = 'file', $savePath = '/uploads/images/')
    {
        $params = [
            'file' => Request::file($name)
        ];

        $rule = [
            'file' => 'require|fileExt:jpg,png|fileMime:image/jpeg,image/png|fileSize:2097152',
        ];

        $msg = [
            'file.require'  => '图片不能为空',
            'file.fileExt'  => '图片后缀必须是jpg或png',
            'file.fileMime' => '图片必须是jpg或png格式图片',
            'file.fileSize' => '图片不能超过2MB',
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            $this->setMessage((string)$Validate->getError());
            return false;
        }

        $rootPath = Env::get('root_path');

        $info = $params['file']->move($rootPath . 'public' . $savePath);

        if (!$info) {
            $this->setMessage('文件上传失败');
            return false;
        }

        $filepath = str_replace('\\', '/', $savePath . $info->getSaveName());

        return [
            'filepath' => $filepath,
            'savepath' => $info->getPathName()
        ];
    }
}