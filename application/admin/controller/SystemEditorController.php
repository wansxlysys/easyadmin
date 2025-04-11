<?php


namespace app\admin\controller;


use Exception;

use think\Request;
use think\response\Json;

use app\admin\service\SystemEditorService;
use app\admin\dependency\SystemEditorDependency;

use app\common\controller\SystemController;

class SystemEditorController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 服务类
     * @var SystemEditorService
     */
    protected $EditorService;

    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->EditorService = SystemEditorDependency::getService();
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