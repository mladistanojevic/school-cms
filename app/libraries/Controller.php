<?php

class Controller
{

    protected function view($view, $data = [])
    {
        extract($data);
        if (file_exists('../app/views/' . $view . '.view.php')) {
            require_once '../app/views/' . $view . '.view.php';
        } else {
            require_once '../app/views/404.view.php';
        }
    }

    protected function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }


    protected function redirect($link)
    {
        header('location:' . URLROOT . $link);
        return;
    }
}
