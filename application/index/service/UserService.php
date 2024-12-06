<?php


namespace app\index\service;


class UserService
{
    protected TestService $TestService;

    protected DataService $DataService;

    protected function injectService(TestService $TestService, DataService $DataService)
    {
        $this->TestService = $TestService;
        $this->DataService = $DataService;
    }

    public function getName()
    {
        return 'UserService';
    }

    public function sayName()
    {
        return $this->DataService->getName();
    }
}