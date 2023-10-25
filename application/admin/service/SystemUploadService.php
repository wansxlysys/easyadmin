<?php


namespace app\admin\service;


use Throwable;
use think\Validate;
use think\facade\Env;
use RuntimeException;
use app\common\util\FileUtil;

class SystemUploadService extends \app\common\service\SystemUploadService
{
    /**
     * 保存目录
     * @var string
     */
    protected $saveDir = 'upload';

    /**
     * 图片后缀
     * @var string
     */
    protected $imageFileExt = 'jpg,jpeg,png';

    /**
     * 图片大小
     * @var int
     */
    protected $imageMaxSize = 2097152;

    /**
     * 图片上传
     * @param $image
     * @param string $subDir
     * @return array|bool
     */
    public function uploadImage($image, $subDir = 'image')
    {
        $params = [
            'image' => $image
        ];

        $rule = [
            'image' => 'require|fileExt:' . $this->imageFileExt . '|fileSize:' . $this->imageMaxSize,
        ];

        $msg = [
            'image.require'  => '图片不能为空',
            'image.fileExt'  => '图片格式必须' . $this->imageFileExt,
            'image.fileSize' => '图片不能超过' . FileUtil::formatBytes($this->imageMaxSize),
        ];

        $Validate = Validate::make($rule, $msg);

        if (!$Validate->check($params)) {
            return $this->setMessage($Validate->getError());
        }

        /**
         * 通过md5检测图片是否已经存在
         */
        $imageInfo = $this->getFileByMd5($image->hash('md5'));

        if ($imageInfo) {
            return ['filePath' => $imageInfo['path'], 'savePath' => $this->buildFullPath($imageInfo['path'])];
        }

        /**
         * 保存图片
         */
        $imageInfo = $image->move($this->buildSavePath($subDir));

        if (!$imageInfo) {
            return $this->setMessage('执行错误，文件上传失败');
        }

        /**
         * 创建文件信息
         */
        $filePath = $this->buildViewPath($subDir, $imageInfo->getSaveName());

        $fileData['md5']  = $imageInfo->hash('md5');
        $fileData['ext']  = $imageInfo->getExtension();
        $fileData['name'] = $imageInfo->getInfo('name');
        $fileData['size'] = $imageInfo->getInfo('size');
        $fileData['path'] = $filePath;

        if (!$this->SystemUploadRepository->createRecord($fileData)) {
            return $this->setMessage('执行错误，文件保存失败');
        }

        return ['filePath' => $filePath, 'savePath' => $this->buildFullPath($filePath)];
    }

    /**
     * 文件上传
     * @param array $params
     * @param string $savePath
     * @return bool|string[]
     */
    public function uploadFile(array $params, $savePath = 'file')
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
                throw new RuntimeException('目录创建失败');
            }

            /**
             * 追加写入数据
             */
            if (!file_put_contents($rootPath, file_get_contents($params['file']->getRealPath()), FILE_APPEND)) {
                throw new RuntimeException('文件写入失败');
            }

            /**
             * 检测是否上传完成
             */
            if (true === $isDone) {

                $fileData['md5']  = $params['md5'];
                $fileData['ext']  = $params['ext'];
                $fileData['name'] = $params['name'];
                $fileData['size'] = $params['size'];
                $fileData['path'] = $filePath;

                if (!$this->SystemUploadRepository->createRecord($fileData)) {
                    throw new RuntimeException('文件保存失败');
                }
            }

        } catch (Throwable $throwable) {
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
        $file = $this->SystemUploadRepository->getByMd5($md5);

        if (!$file) {
            return false;
        }

        /**
         * 检测文件在本地是否真实存在
         */
        if (file_exists($this->buildFullPath($file['path']))) {
            return $file;
        }

        /**
         * 文件不存在则删除文件信息
         */
        $this->SystemUploadRepository->deleteById($file['id']);

        return false;
    }

    /**
     * 绝对路径
     * @param $viewPath
     * @return string
     */
    public function buildFullPath($viewPath)
    {
        return $this->formatPath(Env::get('root_path') . 'public' . '/' . substr($viewPath, 1));
    }

    /**
     * 构建访问路径
     * @param $subDir
     * @param $saveName
     * @return string
     */
    protected function buildViewPath($subDir, $saveName)
    {
        return $this->formatPath('/' . $this->saveDir . '/' . $subDir . '/' . $saveName);
    }

    /**
     * 构建保存路径
     * @param $subDir
     * @return string
     */
    protected function buildSavePath($subDir)
    {
        return $this->formatPath(Env::get('root_path') . 'public' . '/' . $this->saveDir . '/' . $subDir);
    }

    /**
     * 路径符号转换
     * @param $filePath
     * @return string|string[]
     */
    protected function formatPath($filePath)
    {
        return str_replace('\\', '/', $filePath);
    }
}