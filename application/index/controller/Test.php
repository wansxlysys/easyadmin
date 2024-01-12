<?php


namespace app\index\controller;


class Test
{
    public function getUserInfo()
    {
        return ['name' => '张三'];
    }

    public function getUserById($id)
    {
        return ['id' => $id, 'name' => '李四'];
    }
}