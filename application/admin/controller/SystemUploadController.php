<?php


namespace app\admin\controller;


use think\Request;
use app\common\exception\SystemException;
use app\admin\service\SystemUploadService;
use app\admin\validate\SystemUploadValidate;

class SystemUploadController extends \app\common\controller\AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 服务类
     * @var SystemUploadService
     */
    protected $SystemUploadService;

    /**
     * 初始化
     * @throws SystemException
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemUploadService = new SystemUploadService();
    }

    /**
     * 文件检测
     * @param Request $request
     * @throws SystemException
     */
    public function check_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'md5' => $request->post('file_md5'),
            ];

            $SystemUploadValidate = new SystemUploadValidate();

            if (!$SystemUploadValidate->scene('Check')->check($params)) {
                $this->error($SystemUploadValidate->getError());
            }

            $file = $this->SystemUploadService->getFileByMd5($params['md5']);

            if (!$file) {
                $this->error('文件不存在');
            }

            $this->success('文件已存在', '', ['filePath' => $file['path']]);
        }
    }

    /**
     * 文件上传
     * @param Request $request
     */
    public function file_action(Request $request)
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

            $result = $this->SystemUploadService->uploadFile($params);

            if (!$result) {
                $this->error($this->SystemUploadService->getMessage());
            }

            $this->success('上传成功', '', $result);
        }
    }

    /**
     * 图片上传
     * @param Request $request
     * @throws SystemException
     */
    public function image_action(Request $request)
    {
        if ($request->isAjax()) {

            $file = $this->SystemUploadService->uploadImage($request->file('file'));

            if (!$file) {
                $this->error($this->SystemUploadService->getMessage());
            }

            $this->success('上传成功', '', [
                'filePath' => $file['filePath']
            ]);
        }
    }
}