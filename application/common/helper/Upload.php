<?php


namespace app\common\helper;

use think\Validate;
use think\facade\Env;
use think\facade\Request;

class Upload extends \app\common\service\Service
{
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
            return $this->setMessage($Validate->getError());
        }

        $info = $params['file']->move(Env::get('root_path') . 'public' . $savePath);

        if (!$info) {
            return $this->setMessage('文件上传失败');
        }

        $filePath = str_replace('\\', '/', $savePath . $info->getSaveName());

        return [
            'filePath' => $filePath,
            'savePath' => $info->getPathName()
        ];
    }
}