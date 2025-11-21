<?php


namespace app\index\service;


class DataService
{
    protected UserService $UserService;

    protected TestService $TestService;

    public function getName()
    {
        return 'DataService';
    }

    public function sayName()
    {
        return $this->TestService->getName();
    }
}