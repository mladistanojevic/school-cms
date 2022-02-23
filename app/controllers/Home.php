<?php

class Home extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $this->view('home/index');
    }
}
