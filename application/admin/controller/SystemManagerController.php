<?php


namespace app\admin\controller;


use Exception;

use think\Image;
use think\Request;

use app\admin\service\SystemUploadService;
use app\admin\service\SystemManagerService;
use app\admin\validate\SystemManagerValidate;

use app\common\dependency\Dependency;
use app\common\controller\SystemController;

class SystemManagerController extends SystemController
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['SystemMiddleware'];

    /**
     * 服务类1
     * @var SystemManagerService
     */
    protected $ManagerService;

    /**
     * 验证器
     * @var SystemManagerValidate
     */
    protected $ManagerValidate;

    /**
     * 初始化
     * @throws Exception
     */
    public function initialize()
    {
        parent::initialize();
        $this->ManagerService  = Dependency::getProxy(SystemManagerService::class);
        $this->ManagerValidate = Dependency::getProxy(SystemManagerValidate::class);
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

            $this->success('获取成功', '', $this->ManagerService->getPageManager($params));
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

            $this->ManagerValidate->scene('create')->verify($params);
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
                'managerId' => $request->post('managerId'),
                'roleId'    => $request->post('roleId'),
                'avatar'    => $request->post('avatar'),
                'realName'  => $request->post('realName'),
                'account'   => $request->post('account'),
                'password'  => $request->post('password'),
                'status'    => $request->post('status'),
            ];

            $this->ManagerValidate->scene('update')->verify($params);
            $this->ManagerService->updateManager($params);

            $this->success('修改成功');
        }

        $manager = $this->ManagerService->getByManagerId($request->get('managerId'));

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
                'managerId' => $request->post('managerId')
            ];

            $this->ManagerValidate->scene('delete')->verify($params);
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

            $fileInfo = Dependency::getProxy(SystemUploadService::class)->uploadImage($request->file('file'));

            Image::open($fileInfo['savePath'])->thumb(200, 200, 5)->save($fileInfo['savePath']);

            $this->success('上传成功', '', ['viewPath' => $fileInfo['viewPath']]);
        }
    }
}