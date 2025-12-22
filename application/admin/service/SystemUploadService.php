<?php


namespace app\admin\service;


use Exception;

use app\common\service\Service;
use app\common\helper\FileHelper;
use app\common\repository\Wrapper;
use app\common\exception\ServiceException;

use app\admin\enum\SystemUploadEnum;
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
            $Wrapper->addWhere('type', 'in', $params['type']);
        }

        if (!empty($params['name'])) {
            $Wrapper->addWhere('name', 'like', "%{$params['name']}%");
        }

        $Wrapper->addWhere('status', '=', SystemUploadEnum::STATUS_SUCCESS);

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);

        $Wrapper->addOrder('updateTime', 'desc');

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
        $result['fileInfo'] = $fileInfo;

        if ($fileInfo) {

            /**
             * 检测本地文件是否存在
             */
            $savePath = FileHelper::getRootPath($fileInfo['path']);

            if (file_exists($savePath)) {

                if ($fileInfo['status'] == SystemUploadEnum::STATUS_UPLOADING) {
                    $result['chunkIndex'] = $fileInfo['index'];
                }

                if ($fileInfo['status'] == SystemUploadEnum::STATUS_SUCCESS) {
                    $result['isExists'] = true;
                }

                $this->SystemUploadRepository->updateById($fileInfo['fileId']);

            } else {
                $this->SystemUploadRepository->deleteById($fileInfo['fileId']);
            }

        } else {

            $fileInfo['name'] = $params['name'];
            $fileInfo['hash'] = $params['hash'];
            $fileInfo['size'] = $params['size'];
            $fileInfo['type'] = FileHelper::getFileType($params['type']);
            $fileInfo['path'] = FileHelper::getSavePath($params['name']);

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

        /**
         * 追加文件内容
         */
        FileHelper::putContent($fileInfo['path'], $params['chunk']->getRealPath());

        /**
         * 检测是否上传完成
         */
        $fileData['index'] = $params['index'];

        if ($params['index'] + 1 == $params['total']) {
            $fileData['status'] = SystemUploadEnum::STATUS_SUCCESS;
        }

        $this->SystemUploadRepository->updateById($fileInfo['fileId'], $fileData);

        return $fileInfo;
    }
}