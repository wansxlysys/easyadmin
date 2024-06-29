<?php


namespace app\admin\controller;


use Throwable;

use think\Request;
use think\response\Json;

use app\admin\service\EditorService;

use app\common\controller\AdminController;

class EditorController extends AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 服务类
     * @var EditorService
     */
    protected $EditorService;

    /**
     * 初始化
     * @throws Throwable
     */
    public function initialize()
    {
        parent::initialize();
        $this->EditorService = new EditorService();
    }

    /**
     * 百度富文本编辑器
     * @param Request $request
     * @return Json
     * @throws Throwable
     */
    public function ueditor_action(Request $request)
    {
        $result = [];
        $action = $request->get('action');

        if ($action == 'config') {
            $result = $this->EditorService->config();
        }

        if ($action == 'uploadImage') {
            $result = $this->EditorService->uploadImage($request->file('image'));
        }

        if ($action == 'uploadVideo') {
            $result = $this->EditorService->uploadVideo($request->file('video'));
        }

        if ($action == 'uploadAudio') {
            $result = $this->EditorService->uploadAudio($request->file('audio'));
        }

        if ($action == 'uploadFile') {
            $result = $this->EditorService->uploadFile($request->file('file'));
        }

        return json($result);
    }
}