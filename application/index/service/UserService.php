<?php


namespace app\index\service;


class UserService
{
    protected TestService $TestService;

    protected DataService $DataService;

    public function getName()
    {
        return 'UserService';
    }

    public function sayName()
    {
        return $this->DataService->getName();
    }
}