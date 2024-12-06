<?php


namespace app\index\service;


class DataService
{
    protected UserService $UserService;

    protected TestService $TestService;

    protected function injectService(UserService $UserService, TestService $TestService)
    {
        $this->UserService = $UserService;
        $this->TestService = $TestService;
    }

    public function getName()
    {
        return 'DataService';
    }

    public function sayName()
    {
        return $this->TestService->getName();
    }
}