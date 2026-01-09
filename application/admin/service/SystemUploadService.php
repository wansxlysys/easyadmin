<?php


namespace app\admin\service;


use Exception;

use app\common\enum\YesnoEnum;
use app\common\service\Service;
use app\common\helper\UploadHelper;
use app\common\repository\Wrapper;
use app\common\exception\ServiceException;

use app\admin\helper\SystemManagerHelper;
use app\admin\repository\SystemUploadRepository;

class SystemUploadService extends Service
{
    /**
     * 存储类
     * @var SystemUploadRepository
     */
    protected SystemUploadRepository $SystemUploadRepository;

    /**
     * 系统字典服务类
     * @var SystemDictDataService
     */
    protected SystemDictDataService $SystemDictDataService;

    /**
     * 系统设置服务类
     * @var SystemSettingService
     */
    protected SystemSettingService $SystemSettingService;

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

        $Wrapper->addWhere('status', '=', YesnoEnum::YES);
        $Wrapper->addWhere('managerId', '=', SystemManagerHelper::getManagerId());

        $Wrapper->setPage($params['page']);
        $Wrapper->setLimit($params['limit']);

        $Wrapper->addOrder('updateTime', 'desc');

        $page = $this->SystemUploadRepository->getPage($Wrapper);

        return ['list' => $page->items(), 'total' => $page->total()];
    }

    /**
     * 更新文件
     * @param array $params
     * @return void
     * @throws Exception
     */
    public function renameFile(array $params)
    {
        $Wrapper = new Wrapper();

        $Wrapper->addWhere('hash', '=', $params['hash']);
        $Wrapper->addWhere('fileId', '<>', $params['fileId']);
        $Wrapper->addWhere('managerId', '=', SystemManagerHelper::getManagerId());

        $fileInfo = $this->SystemUploadRepository->getOne($Wrapper);

        if ($fileInfo['name'] == $params['name']) {
            throw new ServiceException('文件名称已存在');
        }

        $this->SystemUploadRepository->updateById($params['fileId'], $params);
    }

    /**
     * 检查文件
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function checkFile(array $params)
    {
        /**
         * 检测文件类型
         */
        $fileType = $this->SystemDictDataService->getSystemDictDataValue('system.upload.type', $params['type']);

        if (empty($fileType)) {
            throw new ServiceException('禁止上传文件类型');
        }

        /**
         * 检测文件大小
         */
        $uploadLimit = $this->SystemSettingService->getSystemSettingValue('upload', 'limit', 'intval');

        if ($uploadLimit && UploadHelper::fileSizeToMb($params['size']) > $uploadLimit) {
            throw new ServiceException('文件大小超出限制');
        }

        /**
         * 检测文件是否存在
         */
        $fileInfo = $this->getFileInfo($params);

        $fileExist = false;

        $result['isFinish'] = false;
        $result['fileInfo'] = $fileInfo;

        if ($fileInfo) {

            /**
             * 检测本地文件是否存在
             */
            $rootPath = UploadHelper::getRootPath($fileInfo['path']);

            if (file_exists($rootPath)) {

                $fileExist = true;

                if ($fileInfo['status'] == YesnoEnum::NO) {
                    $result['chunkIndex'] = $fileInfo['index'];
                }

                if ($fileInfo['status'] == YesnoEnum::YES) {
                    $result['isFinish'] = true;
                }

                $this->SystemUploadRepository->updateById($fileInfo['fileId']);

            } else {

                /**
                 * 删除数据库记录
                 */
                $this->SystemUploadRepository->deleteById($fileInfo['fileId']);
            }
        }

        if (!$fileExist) {

            /**
             * 创建文件信息
             */
            $savePath = UploadHelper::getSavePath($fileType, $params['name']);

            $saveInfo['type']      = $fileType;
            $saveInfo['path']      = $savePath;
            $saveInfo['name']      = $params['name'];
            $saveInfo['hash']      = $params['hash'];
            $saveInfo['size']      = $params['size'];
            $saveInfo['managerId'] = SystemManagerHelper::getManagerId();

            $this->SystemUploadRepository->createRecord($saveInfo);
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
        $fileInfo = $this->getFileInfo($params);

        if (empty($fileInfo)) {
            throw new ServiceException('文件不存在');
        }

        /**
         * 追加文件内容
         */
        UploadHelper::putContent($fileInfo['path'], $params['chunk']->getRealPath());

        $fileData['index'] = $params['index'];

        /**
         * 检测是否上传完成
         */
        if ($params['index'] + 1 == $params['total']) {
            $fileData['status'] = YesnoEnum::YES;
        }

        $this->SystemUploadRepository->updateById($fileInfo['fileId'], $fileData);

        return $fileInfo;
    }

    /**
     * 获取文件信息
     * @param array $params
     * @return array
     * @throws Exception
     */
    protected function getFileInfo(array $params)
    {
        return $this->SystemUploadRepository->getByWhere([
            'hash'      => $params['hash'],
            'name'      => $params['name'],
            'managerId' => SystemManagerHelper::getManagerId()
        ]);
    }
}