<?php


namespace app\admin\validate;


use app\common\validate\Validate;

class SystemUploadValidate extends Validate
{
    /**
     * 验证规则
     * @var string[]
     */
    protected $rule = [
        'md5' => 'require|length:32',
    ];

    /**
     * 错误信息
     * @var string[]
     */
    protected $message = [
        'md5.require' => '文件MD5不能为空',
        'md5.length'  => '文件MD5格式错误',
    ];

    /**
     * 检测文件是否存在
     * @return SystemUploadValidate
     */
    public function sceneCheck()
    {
        return $this->only(['md5']);
    }
}