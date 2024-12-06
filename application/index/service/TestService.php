<?php


namespace app\index\service;


class TestService
{
    protected UserService $UserService;

    protected DataService $DataService;

    protected function injectService(UserService $UserService, DataService $DataService)
    {
        $this->UserService = $UserService;
        $this->DataService = $DataService;
    }

    public function getName()
    {
        return 'TestService';
    }

    public function sayName()
    {
        return $this->UserService->getName();
    }
}