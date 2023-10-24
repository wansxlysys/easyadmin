<?php


namespace app\admin\service;


use think\Validate;
use think\facade\Env;

class UploadService extends \app\common\service\UploadService
{
    /**
     * 图片上传
     * @param $file
     * @param string $savePath
     * @return array|bool
     */
    public function uploadImage($file, $savePath = '/upload/image')
    {
        $params = [
            'file' => $file
        ];

        $rule = [
            'file' => 'require|fileExt:jpg,jpeg,png|fileMime:image/jpeg,image/png|fileSize:2097152',
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

        /**
         * 通过md5检测图片是否已经存在
         */
        $fileExist = $this->getFileByMd5($file->hash('md5'));

        if ($fileExist) {
            return ['filePath' => $fileExist['path'], 'savePath' => Env::get('root_path') . 'public' . $fileExist['path']];
        }

        /**
         * 保存图片
         */
        $fileInfo = $params['file']->move(Env::get('root_path') . 'public' . $savePath);

        if (!$fileInfo) {
            return $this->setMessage('文件上传失败');
        }

        /**
         * 创建文件数据
         */
        $filePath = $this->pathReplace($savePath . '/' . $fileInfo->getSaveName());

        $fileData['md5']    = $fileInfo->hash('md5');
        $fileData['name']   = $fileInfo->getInfo('name');
        $fileData['size']   = $fileInfo->getInfo('size');
        $fileData['path']   = $filePath;
        $fileData['suffix'] = $fileInfo->getExtension();

        if (!$this->UploadRepository->createRecord($fileData)) {
            return $this->setMessage('文件保存失败');
        }

        return ['filePath' => $filePath, 'savePath' => $fileInfo->getPathName()];
    }

    /**
     * 文件上传
     * @param array $params
     * @param string $savePath
     * @return bool|string[]
     */
    public function uploadFile(array $params, $savePath = '/upload/file')
    {
        $filePath = $savePath . '/' . date('Ymd') . '/' . $params['md5'] . '.' . $params['suffix'];
        $rootPath = Env::get('root_path') . "public" . $filePath;
        $dirPath  = pathinfo($rootPath, PATHINFO_DIRNAME);
        $isDone   = $params['index'] >= $params['total'];

        try {
            /**
             * 创建文件夹
             */
            if (!is_dir($dirPath) && !mkdir($dirPath, 0777, true)) {
                throw new \RuntimeException('目录创建失败');
            }

            /**
             * 追加写入数据
             */
            if (!file_put_contents($rootPath, file_get_contents($params['file']->getRealPath()), FILE_APPEND)) {
                throw new \RuntimeException('文件写入失败');
            }

            /**
             * 检测是否上传完成
             */
            if (true === $isDone) {

                $fileData['md5']    = $params['md5'];
                $fileData['name']   = $params['name'];
                $fileData['size']   = $params['size'];
                $fileData['path']   = $filePath;
                $fileData['suffix'] = $params['suffix'];

                if (!$this->UploadRepository->createRecord($fileData)) {
                    throw new \RuntimeException('文件保存失败');
                }
            }

        } catch (\Throwable $throwable) {
            return $this->setMessage($throwable->getMessage());
        }

        return ['isDone' => $isDone, 'filePath' => $filePath, 'savePath' => $rootPath];
    }

    /**
     * 通过Md5获取文件
     * @param $md5
     * @return mixed
     */
    public function getFileByMd5($md5)
    {
        return $this->UploadRepository->getByMd5($md5);
    }

    /**
     * 路径符号转换
     * @param $filePath
     * @return string|string[]
     */
    protected function pathReplace($filePath)
    {
        return str_replace('\\', '/', $filePath);
    }
}