<?php


namespace app\admin\controller;


use Exception;

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
     * 验证器
     * @var ManagerValidate
     */
    protected $ManagerValidate;

    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->ManagerService  = new ManagerService();
        $this->ManagerValidate = new ManagerValidate();
    }

    /**
     * 首页
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function indexAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'page'     => $request->get('page'),
                'limit'    => $request->get('limit'),
                'status'   => $request->get('status'),
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
     * @throws Exception
     */
    public function createAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'roleId'   => $request->post('roleId'),
                'avatar'   => $request->post('avatar'),
                'realName' => $request->post('realName'),
                'account'  => $request->post('account'),
                'password' => $request->post('password'),
                'status'   => $request->post('status'),
            ];

            $this->ManagerValidate->scene('Create')->verify($params);
            $this->ManagerService->createManager($params);

            $this->success('添加成功');
        }

        return $this->fetch();
    }

    /**
     * 修改
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function updateAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'       => $request->post('id'),
                'roleId'   => $request->post('roleId'),
                'avatar'   => $request->post('avatar'),
                'realName' => $request->post('realName'),
                'account'  => $request->post('account'),
                'password' => $request->post('password'),
                'status'   => $request->post('status'),
            ];

            $this->ManagerValidate->scene('Update')->verify($params);
            $this->ManagerService->updateManager($params);

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
     * @throws Exception
     */
    public function deleteAction(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id' => $request->post('id')
            ];

            $this->ManagerValidate->scene('Delete')->verify($params);
            $this->ManagerService->deleteManager($params);

            $this->success('删除成功');
        }
    }

    /**
     * 头像上传
     * @param Request $request
     * @throws Exception
     */
    public function avatarAction(Request $request)
    {
        if ($request->isAjax()) {

            $UploadService = new SystemUploadService();

            $fileInfo = $UploadService->uploadImage($request->file('file'));

            Image::open($fileInfo['savePath'])->thumb(200, 200, 5)->save($fileInfo['savePath']);

            $this->success('上传成功', '', ['viewPath' => $fileInfo['viewPath']]);
        }
    }
}