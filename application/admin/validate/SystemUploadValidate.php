<?php


namespace app\admin\validate;


class SystemUploadValidate extends \app\common\validate\SystemUploadValidate
{
    /**
     * 检测文件是否存在
     * @return SystemUploadValidate
     */
    public function sceneCheck()
    {
        return $this->only(['md5']);
    }
}