<?php


namespace app\admin\service;


use app\admin\enum\SystemUploadEnum;
use app\common\util\DateTimeUtil;
use Exception;

use think\facade\Env;
use think\File;
use think\Validate;

use app\common\util\FileUtil;
use app\common\service\Service;
use app\common\helper\FileHelper;
use app\common\repository\Wrapper;
use app\common\exception\ServiceException;
use app\common\exception\ValidateException;

use app\admin\enum\UploadEnum;
use app\admin\repository\SystemUploadRepository;

class SystemUploadService extends Service
{
    /**
     * 存储类
     * @var SystemUploadRepository
     */
    protected SystemUploadRepository $SystemUploadRepository;

    /**
     * 获取列表
     * @throws Exception
     */
    public function getPageSystemUpload(array $params)
    {
        $Wrapper = new Wrapper();

        if (!empty($params['type'])) {
            $Wrapper->addWhere('type', '=', $params['type']);
        }

        if (!empty($params['name'])) {
            $Wrapper->addWhere('name', 'like', "%{$params['name']}%");
        }

        $Wrapper->addWhere('status', '=', SystemUploadEnum::STATUS_SUCCESS);

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);

        $Wrapper->addOrder('uploadTime', 'desc');

        $page = $this->SystemUploadRepository->getPage($Wrapper);

        return ['list' => $page->items(), 'total' => $page->total()];
    }

    /**
     * 检查文件
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function checkFile(array $params)
    {
        $fileInfo = $this->SystemUploadRepository->getByWhere([
            'hash' => $params['hash'],
            'name' => $params['name'],
        ]);

        $result['isExists'] = false;

        if ($fileInfo) {

            /**
             * 检测本地文件是否存在
             */
            $savePath = Env::get('root_path') . 'public' . $fileInfo['path'];

            if (file_exists($savePath)) {

                if ($fileInfo['status'] == SystemUploadEnum::STATUS_UPLOADING) {
                    $result['isExists']   = false;
                    $result['chunkIndex'] = $fileInfo['index'];
                }

                if ($fileInfo['status'] == SystemUploadEnum::STATUS_SUCCESS) {
                    $result['isExists'] = true;
                    $result['fileInfo'] = $fileInfo;
                }

            } else {
                $this->SystemUploadRepository->deleteById($fileInfo['fileId']);
            }

        } else {

            $tempPath = '/upload/temp/' . md5($params['hash'] . uniqid(true));

            $fileInfo['path'] = $tempPath;
            $fileInfo['ext']  = pathinfo($params['ext'], PATHINFO_EXTENSION);
            $fileInfo['name'] = $params['name'];
            $fileInfo['hash'] = $params['hash'];
            $fileInfo['type'] = $params['type'];
            $fileInfo['size'] = $params['size'];

            $this->SystemUploadRepository->createRecord($fileInfo);
        }

        return $result;
    }

    /**
     * 文件上传
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function uploadFile(array $params)
    {
        $fileInfo = $this->SystemUploadRepository->getByWhere([
            'hash' => $params['hash'],
            'name' => $params['name'],
        ]);

        if (empty($fileInfo)) {
            throw new ServiceException('文件不存在');
        }

        $tempPath = Env::get('root_path') . 'public' . $fileInfo['path'];

        /**
         * 创建文件夹
         */
        FileHelper::makePath($tempPath);

        if (!file_put_contents($tempPath, file_get_contents($params['chunk']->getRealPath()), FILE_APPEND)) {
            throw new ServiceException('文件写入失败');
        }

        /**
         * 检测是否上传完成
         */
        if ($params['index'] + 1 == $params['total']) {

            $saveName = FileHelper::makeName(md5($params['hash'] . $params['name']), pathinfo($params['name'], PATHINFO_EXTENSION));
            $viewPath = FileHelper::buildViewPath('file') . $saveName;
            $savePath = FileHelper::getFilePath($viewPath);

            /**
             * 创建文件夹
             */
            FileHelper::makePath($savePath);

            /**
             * 移动到上传目录
             */
            FileHelper::moveFile($tempPath, $savePath);

            $fileData['path']       = $viewPath;
            $fileData['index']      = $params['index'];
            $fileData['status']     = SystemUploadEnum::STATUS_SUCCESS;
            $fileData['uploadTime'] = DateTimeUtil::dateTime();

            $this->SystemUploadRepository->updateById($fileInfo['fileId'], $fileData);

        } else {

            $this->SystemUploadRepository->updateById($fileInfo['fileId'], [
                'index' => $params['index']
            ]);
        }

        return $fileInfo;
    }
}