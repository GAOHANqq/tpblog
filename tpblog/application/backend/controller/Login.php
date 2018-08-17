<?php
namespace app\backend\controller;

use think\Controller;

class Login extends Controller
{
    public function login()
    {
        return $this->fetch('login/login');
    }
}
