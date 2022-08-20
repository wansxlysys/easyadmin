<?php


namespace app\admin\controller;


use think\Request;
use think\Db;
use think\facade\Env;
use think\response\Json;

class Home extends \app\common\controller\Admin
{
    /**
     * 中间件
     * @var array
     */
    protected $middleware = ['Permission'];

    /**
     * 控制台
     * @return mixed
     */
    public function console_action()
    {
        return $this->fetch();
    }

    /**
     * 仪表板
     * @return mixed
     */
    public function dashboard_action()
    {
        return $this->fetch();
    }

    /**
     * ui组件
     * @return mixed
     */
    public function components_action()
    {
        return $this->fetch();
    }

    /**
     * 文件上传
     * @param Request $request
     */
    public function upload_action(Request $request)
    {
        $params = [
            'md5'    => $request->post('file_md5'),
            'name'   => $request->post('file_name'),
            'file'   => $request->file('file_data'),
            'size'   => $request->post('file_size'),
            'index'  => $request->post('file_index'),
            'total'  => $request->post('file_total'),
            'suffix' => $request->post('file_suffix'),
        ];

        $UploadService = new \app\admin\service\Upload();

        $result = $UploadService->uploadFile($params);

        if (!$result) {
            $this->result([], 1104, '上传失败', 'json');
        }

        $this->result($result, 200, '上传成功', 'json');
    }

    /**
     * 文件检测
     * @param Request $request
     */
    public function check_action(Request $request)
    {
        $params = [
            'md5'  => $request->post('file_md5'),
            'name' => $request->post('file_name'),
        ];

        $UploadService = new \app\admin\service\Upload();

        $file = $UploadService->checkFileExist($params);

        if ($file) {
            $this->result(['filePath' => $file['path']], 1101, '文件已存在', 'json');
        }

        $this->result([], 200, '文件不存在', 'json');
    }
}