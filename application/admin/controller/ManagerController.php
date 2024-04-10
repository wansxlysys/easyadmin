<?php


namespace app\admin\controller;


use Throwable;

use think\Image;
use think\Request;

use app\admin\service\ManagerService;
use app\admin\validate\ManagerValidate;
use app\admin\service\SystemUploadService;

use app\common\controller\AdminController;

class ManagerController extends AdminController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['System'];

    /**
     * 服务类
     * @var ManagerService
     */
    protected $ManagerService;

    /**
     * 初始化
     * @throws Throwable
     */
    public function initialize()
    {
        parent::initialize();
        $this->ManagerService = new ManagerService();
    }

    /**
     * 首页
     * @param Request $request
     * @return mixed
     * @throws Throwable
     */
    public function index_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'page'      => $request->get('page'),
                'limit'     => $request->get('limit'),
                'status'    => $request->get('status'),
                'roleId'   => $request->get('roleId'),
                'realName' => $request->get('realName'),
            ];

            $this->success('获取成功', '', $this->ManagerService->listManager($params));
        }

        return $this->fetch();
    }

    /**
     * 添加
     * @param Request $request
     * @return mixed
     * @throws Throwable
     */
    public function create_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'roleId'   => $request->post('roleId'),
                'avatar'    => $request->post('avatar'),
                'realName' => $request->post('realName'),
                'account'   => $request->post('account'),
                'password'  => $request->post('password'),
                'status'    => $request->post('status'),
            ];

            $ManagerValidate = new ManagerValidate();

            if (!$ManagerValidate->scene('Create')->check($params)) {
                $this->error($ManagerValidate->getError());
            }

            $result = $this->ManagerService->createManager($params);

            if (!$result) {
                $this->error('添加失败');
            }

            $this->success('添加成功');
        }

        return $this->fetch();
    }

    /**
     * 修改
     * @param Request $request
     * @return mixed
     * @throws Throwable
     */
    public function update_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'        => $request->post('id'),
                'roleId'   => $request->post('roleId'),
                'avatar'    => $request->post('avatar'),
                'realName' => $request->post('realName'),
                'account'   => $request->post('account'),
                'password'  => $request->post('password'),
                'status'    => $request->post('status'),
            ];

            $ManagerValidate = new ManagerValidate();

            if (!$ManagerValidate->scene('Update')->check($params)) {
                $this->error($ManagerValidate->getError());
            }

            $result = $this->ManagerService->updateManager($params);

            if (!$result) {
                $this->error('修改失败');
            }

            $this->success('修改成功');
        }

        $manager = $this->ManagerService->getById($request->get('id'));

        return $this->fetch('', [
            'manager' => $manager
        ]);
    }

    /**
     * 删除
     * @param Request $request
     * @throws Throwable
     */
    public function delete_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id' => $request->post('id')
            ];

            $ManagerValidate = new ManagerValidate();

            if (!$ManagerValidate->scene('Delete')->check($params)) {
                $this->error($ManagerValidate->getError());
            }

            $result = $this->ManagerService->deleteManager($params);

            if (!$result) {
                $this->error($this->ManagerService->getMessage());
            }

            $this->success('删除成功');
        }
    }

    /**
     * 头像上传
     * @param Request $request
     * @throws Throwable
     */
    public function avatar_action(Request $request)
    {
        if ($request->isAjax()) {

            $UploadService = new SystemUploadService();

            $fileInfo = $UploadService->uploadImage($request->file('file'));

            if (!$fileInfo) {
                $this->error($UploadService->getMessage());
            }

            $result = Image::open($fileInfo['savePath'])->thumb(200, 200, 5)->save($fileInfo['savePath']);

            if (!$result) {
                $this->error('文件上传失败');
            }

            $this->success('上传成功', '', [
                'viewPath' => $fileInfo['viewPath']
            ]);
        }
    }
}