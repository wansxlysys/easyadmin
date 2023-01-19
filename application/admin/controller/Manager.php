<?php


namespace app\admin\controller;


use think\Request;

class Manager extends \app\common\controller\Admin
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 管理员服务类
     * @var \app\admin\service\Manager
     */
    protected $ManagerService;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->ManagerService = new \app\admin\service\Manager();
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
                'page'     => $request->get('page'),
                'limit'    => $request->get('limit'),
                'status'   => $request->get('status'),
                'nickname' => $request->get('nickname'),
            ];

            $this->success('获取成功', '', $this->ManagerService->getListWithTotal($params));
        }

        return $this->fetch();
    }

    /**
     * 添加管理员
     * @param Request $request
     * @return mixed
     */
    public function create_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'role_id'  => $request->post('role_id'),
                'avatar'   => $request->post('avatar'),
                'nickname' => $request->post('nickname'),
                'username' => $request->post('username'),
                'password' => $request->post('password'),
                'status'   => $request->post('status'),
            ];

            $ManagerValidate = new \app\admin\validate\Manager();

            if (!$ManagerValidate->scene('create')->check($params)) {
                $this->error($ManagerValidate->getError());
            }

            $result = $this->ManagerService->createRecord($params);

            if (!$result) {
                $this->error('添加失败');
            }

            $this->success('添加成功');
        }

        return $this->fetch();
    }

    /**
     * 更新管理员
     * @param Request $request
     * @return mixed
     */
    public function update_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id'       => $request->post('id'),
                'role_id'  => $request->post('role_id'),
                'avatar'   => $request->post('avatar'),
                'nickname' => $request->post('nickname'),
                'password' => $request->post('password'),
                'status'   => $request->post('status'),
            ];

            $ManagerValidate = new \app\admin\validate\Manager();

            if (!$ManagerValidate->scene('update')->check($params)) {
                $this->error($ManagerValidate->getError());
            }

            $result = $this->ManagerService->updateByParamsId($params);

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
     * 删除管理员
     * @param Request $request
     */
    public function delete_action(Request $request)
    {
        if ($request->isAjax()) {

            $params = [
                'id' => $request->post('id')
            ];

            $ManagerValidate = new \app\admin\validate\Manager();

            if (!$ManagerValidate->scene('delete')->check($params)) {
                $this->error($ManagerValidate->getError());
            }

            $result = $this->ManagerService->deleteByParamsId($params);

            if (!$result) {
                $this->error('删除失败');
            }

            $this->success('删除成功');
        }
    }

    /**
     * 头像上传
     * @param Request $request
     */
    public function upload_avatar_action(Request $request)
    {
        if ($request->isAjax()) {

            $UploadHelper = new \app\common\helper\Upload();

            $fileInfo = $UploadHelper->image('file');

            if (!$fileInfo) {
                $this->error($UploadHelper->getMessage());
            }

            $result = \think\Image::open($fileInfo['savepath'])
                ->thumb(200, 200, 5)
                ->save($fileInfo['savepath']);

            if (!$result) {
                $this->error('文件上传失败');
            }

            $this->success('上传成功', '', [
                'filepath' => $fileInfo['filepath']
            ]);
        }
    }

}