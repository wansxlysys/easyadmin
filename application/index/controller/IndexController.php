<?php


namespace app\index\controller;


use Throwable;
use think\Request;
use app\index\rpc\UserRpc;
use app\common\rpc\JsonServer;

class IndexController
{
    public function index_action()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    public function server_action(Request $request)
    {
        if ($request->header('Secret-Key') != 'A8FB327026A9C5B769A63C9C534DB042') {
            return json(['data' => 'Secret-Key Error']);
        }

        $JsonServer = new JsonServer();

        $JsonServer->addServer('test', Test::class);
        $JsonServer->setTarget($request->get('target'));
        $JsonServer->setMethod($request->get('method'));
        $JsonServer->setParams($request->post());

        return json($JsonServer->dispatch());
    }

    /**
     * @param Request $request
     * @throws Throwable
     */
    public function client_action(Request $request)
    {
        $UserRpc = new UserRpc();

        $user1 = $UserRpc->getUserById(1);
        $user2 = $UserRpc->getUserInfo();

        dump($user1);
        dump($user2);
    }
}
