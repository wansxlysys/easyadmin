<?php


namespace app\admin\controller;


use Exception;

use think\Request;

use app\admin\service\SystemUploadService;
use app\admin\dependency\SystemUploadDependency;

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
        $this->SystemUploadService = SystemUploadDependency::getService();
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
                'md5' => $request->post('file_md5')
            ];

            $file = $this->SystemUploadService->getFileByMd5($params['md5']);

            if (!$file) {
                $this->error('文件不存在');
            }

            $this->success('文件已存在', '', ['viewPath' => $file['path']]);
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
}