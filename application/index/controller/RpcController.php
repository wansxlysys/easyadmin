<?php


namespace app\index\controller;


use Throwable;

use think\Request;
use think\facade\Config;
use think\response\Json;

use app\rpc\RpcServer;
use app\rpc\client\DemoClient;
use app\rpc\server\DemoServer;

class RpcController
{
    /**
     * rpc服务
     * @param Request $request
     * @return Json
     */
    public function server_action(Request $request)
    {
        try {

            $RpcServer = new RpcServer();

            /**
             * 服务配置
             */
            $RpcServer->addServer('DemoServer', DemoServer::class);
            // 更多服务....

            /**
             * 本地配置
             */
            $RpcServer->setRpckey(Config::get('rpc.key'));

            /**
             * 请求传入
             */
            $RpcServer->setParams($request->post());
            $RpcServer->setReqkey($request->get('reqkey'));
            $RpcServer->setTarget($request->get('target'));
            $RpcServer->setMethod($request->get('method'));

            return json($RpcServer->dispatch(), 200);

        } catch (Throwable $throwable) {
            return json($throwable->getMessage(), 400);
        }
    }

    /**
     * rpc测试
     * @param Request $request
     * @throws Throwable
     */
    public function client_action(Request $request)
    {
        $DemoClient = new DemoClient();

        $data['key'] = 10;
        $data['sex'] = 11;
        $data['age'] = 18;

        dump($DemoClient->getInfo(1, $data));
    }
}