<?php


namespace app\index\service;


class TestService
{
    protected UserService $UserService;

    protected DataService $DataService;

    public function getName()
    {
        return 'TestService';
    }

    public function sayName()
    {
        return $this->UserService->getName();
    }
}