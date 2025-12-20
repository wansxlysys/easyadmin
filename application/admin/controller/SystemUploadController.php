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
     * 文件上传
     * @param Request $request
     * @throws Exception
     */
    public function sliceAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'md5'    => $request->post('file_md5'),
                'name'   => $request->post('file_name'),
                'file'   => $request->file('file_data'),
                'size'   => $request->post('file_size'),
                'index'  => $request->post('file_index'),
                'total'  => $request->post('file_total'),
                'suffix' => $request->post('file_suffix'),
            ];

            $this->success('上传成功', '', $this->SystemUploadService->uploadSlice($params));
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
                'fileName' => $request->get('fileName'),
                'fileHash' => $request->get('fileHash')
            ];

            $this->success('文件已存在', '', $this->SystemUploadService->checkFile($params));
        }
    }

    /**
     * 文件上传
     * @param Request $request
     * @throws Exception
     */
    public function fileAction(Request $request)
    {
        if ($request->isAjax()) {

            $file = $this->SystemUploadService->uploadFile($request->file('file'));

            $this->success('上传成功', '', ['viewPath' => $file['viewPath']]);
        }
    }

    /**
     * 图片上传
     * @param Request $request
     * @throws Exception
     */
    public function imageAction(Request $request)
    {
        if ($request->isAjax()) {

            $image = $this->SystemUploadService->uploadImage($request->file('image'));

            $this->success('上传成功', '', ['viewPath' => $image['viewPath']]);
        }
    }

    public function popupAction(Request $request)
    {
        if ($request->isAjax()) {
            $this->success('获取成功', '', ['list' => [], 'total' => 0]);
        }

        return $this->fetch();
    }

    public function uploadAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'fileName'   => $request->post('fileName'),
                'fileSize'   => $request->post('fileSize'),
                'fileHash'   => $request->post('fileHash'),
                'fileChunk'  => $request->file('fileChunk'),
                'chunkIndex' => $request->post('chunkIndex'),
                'chunkTotal' => $request->post('chunkTotal'),
            ];

            $this->success('上传成功', '', $this->SystemUploadService->uploadFile($params));
        }

        return $this->fetch();
    }
}