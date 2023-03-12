<?php


namespace app\admin\service;


use think\facade\Env;

class Upload extends \app\common\service\Upload
{
    /**
     * 系统配置存储类
     * @var \app\admin\model\Upload
     */
    protected $UploadRepository;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->UploadRepository = new \app\admin\model\Upload();
    }

    /**
     * 文件上传
     * @param array $params
     * @return bool|string[]
     */
    public function uploadFile(array $params)
    {
        $nowDate = date('Ymd');

        // 文件位置
        $filePath = "/uploads/bigfile/{$nowDate}/{$params['md5']}.{$params['suffix']}";
        $rootPath = Env::get('root_path') . "public" . $filePath;

        $isDone   = $params['index'] == $params['total'];
        $dirPath  = pathinfo($rootPath, PATHINFO_DIRNAME);
        $tempPath = $params['file']->getRealPath();

        try {

            // 创建保存位置文件夹
            if (!is_dir($dirPath) && !@mkdir($dirPath, 0777, true)) {
                throw new \RuntimeException('目录创建失败');
            }

            // 写入数据
            if (!file_put_contents($rootPath, file_get_contents($tempPath), FILE_APPEND)) {
                throw new \RuntimeException('文件写入失败');
            }

            // 检测是否上传完成
            if ($isDone) {

                $data['md5']    = $params['md5'];
                $data['name']   = $params['name'];
                $data['size']   = $params['size'];
                $data['path']   = $filePath;
                $data['suffix'] = $params['suffix'];

                if (!$this->createRecord($data)) {
                    throw new \RuntimeException('文件保存失败');
                }
            }

        } catch (\Exception $exception) {
            return $this->setMessage($exception->getMessage());
        }

        return ['isDone' => $isDone, 'filePath' => $filePath];
    }

    /**
     * 检查文件是否存在
     * @param array $params
     * @return bool
     */
    public function checkFileExist(array $params)
    {
        return $this->UploadRepository->getByMd5($params['md5']);
    }

    /**
     * 创建
     * @param array $params
     * @return mixed
     */
    public function createRecord(array $params)
    {
        return $this->UploadRepository->createRecord($params);
    }
}