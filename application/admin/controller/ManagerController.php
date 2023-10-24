<?php


namespace app\admin\controller;


use think\Image;
use think\Request;
use app\admin\service\SystemUploadService;
use app\admin\service\ManagerService;
use app\admin\validate\ManagerValidate;

class ManagerController extends \app\common\controller\AdminController
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
     */
    public function index_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'page'      => $request->get('page'),
                'limit'     => $request->get('limit'),
                'status'    => $request->get('status'),
                'role_id'   => $request->get('role_id'),
                'real_name' => $request->get('real_name'),
            ];

            $this->success('获取成功', '', $this->ManagerService->getListWithTotal($params));
        }

        return $this->fetch();
    }

    /**
     * 添加
     * @param Request $request
     * @return mixed
     */
    public function create_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'role_id'   => $request->post('role_id'),
                'avatar'    => $request->post('avatar'),
                'real_name' => $request->post('real_name'),
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
     */
    public function update_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'        => $request->post('id'),
                'role_id'   => $request->post('role_id'),
                'avatar'    => $request->post('avatar'),
                'real_name' => $request->post('real_name'),
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
                'filePath' => $fileInfo['filePath']
            ]);
        }
    }

}