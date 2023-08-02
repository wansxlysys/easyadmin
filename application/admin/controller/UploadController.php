<?php

namespace app\admin\controller;


use think\Request;
use app\admin\service\UploadService;

class UploadController extends \app\common\controller\Admin
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

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

            $UploadService = new UploadService();

            $result = $UploadService->uploadFile($params);

            if (!$result) {
                $this->error('上传失败');
            }

            $this->success('上传成功', '', $result);
        }
    }

    /**
     * 文件检测
     * @param Request $request
     */
    public function check_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'md5'  => $request->post('file_md5'),
                'name' => $request->post('file_name'),
            ];

            $UploadService = new UploadService();

            $file = $UploadService->getFileByMd5($params['md5']);

            if (!$file) {
                $this->error('文件不存在');
            }

            $this->success('文件已存在', '', ['filePath' => $file['path']]);
        }
    }

    /**
     * 图片上传
     * @param Request $request
     */
    public function image_action(Request $request)
    {
        if ($request->isAjax()) {

            $UploadService = new UploadService();

            $file = $UploadService->uploadImage($request->file('file'));

            if (!$file) {
                $this->error($UploadService->getMessage());
            }

            $this->success('上传成功', '', [
                'filePath' => $file['filePath']
            ]);
        }
    }
}