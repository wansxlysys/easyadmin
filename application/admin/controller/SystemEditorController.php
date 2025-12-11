<?php


namespace app\admin\controller;


use Exception;

use think\Request;
use think\response\Json;

use app\admin\service\SystemEditorService;

use app\common\dependency\Dependency;
use app\common\controller\SystemController;

class SystemEditorController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['SystemMiddleware'];

    /**
     * 服务类
     * @var SystemEditorService
     */
    protected $SystemEditorService;

    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->SystemEditorService = Dependency::getProxy(SystemEditorService::class);
    }

    /**
     * 百度富文本编辑器
     * @param Request $request
     * @return Json
     * @throws Exception
     */
    public function ueditorAction(Request $request)
    {
        $result = [];
        $action = $request->get('action');

        if ($action == 'config') {
            $result = $this->SystemEditorService->config();
        }

        if ($action == 'uploadImage') {
            $result = $this->SystemEditorService->uploadImage($request->file('image'));
        }

        if ($action == 'uploadVideo') {
            $result = $this->SystemEditorService->uploadVideo($request->file('video'));
        }

        if ($action == 'uploadAudio') {
            $result = $this->SystemEditorService->uploadAudio($request->file('audio'));
        }

        if ($action == 'uploadFile') {
            $result = $this->SystemEditorService->uploadFile($request->file('file'));
        }

        return json($result);
    }
}