<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemUploadService;

use app\common\dependency\Dependency;
use app\common\controller\SystemController;

class SystemUploadController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['SystemMiddleware'];

    /**
     * 服务类
     * @var SystemUploadService
     */
    protected $SystemUploadService;

    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemUploadService = Dependency::getProxy(SystemUploadService::class);
    }

    /**
     * 文件弹窗
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function listAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'name'  => $request->get('name'),
                'type'  => $request->get('type'),
                'page'  => $request->get('page'),
                'limit' => $request->get('limit'),
            ];

            $this->success('获取成功', '', $this->SystemUploadService->getPageSystemUpload($params));
        }

        return $this->fetch();
    }

    /**
     * 文件改名
     * @param Request $request
     * @throws Exception
     */
    public function renameAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'fileId' => $request->post('fileId'),
                'name'   => $request->post('fileName'),
            ];

            $this->SystemUploadService->updateFile($params);

            $this->success('修改成功');
        }
    }

    /**
     * 文件检测
     * @param Request $request
     * @throws Exception
     */
    public function checkAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'name' => $request->get('fileName'),
                'hash' => $request->get('fileHash'),
                'size' => $request->get('fileSize'),
                'type' => $request->get('fileType'),
            ];

            $this->success('文件已存在', '', $this->SystemUploadService->checkFile($params));
        }
    }

    /**
     * 文件上传
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function uploadAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'name'  => $request->post('fileName'),
                'size'  => $request->post('fileSize'),
                'hash'  => $request->post('fileHash'),
                'chunk' => $request->file('fileChunk'),
                'index' => $request->post('chunkIndex'),
                'total' => $request->post('chunkTotal'),
            ];

            $this->success('上传成功', '', $this->SystemUploadService->uploadFile($params));
        }

        return $this->fetch();
    }
}