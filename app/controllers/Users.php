<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->pagerModel = $this->model('Pager');
    }

    public function index()
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        if (access('reception')) {
            $school_id = $_SESSION['user']->school_id;

            $limit = 3;
            $this->pagerModel->index($limit);
            $offset = $this->pagerModel->offset;

            if (isset($_GET['search'])) {
                $users = $this->userModel->getAllStuffSearch($_GET['search'], $_SESSION['user']->school_id);
            } else {
                $users = $this->userModel->getAll($school_id, $limit, $offset);
            }

            $crumbs[] = ['Dashboard', URLROOT . '/'];
            $crumbs[] = ['Stuff', URLROOT . '/users'];

            $data = [
                'users' => $users,
                'crumbs' => $crumbs,
                'pager' => $this->pagerModel
            ];
            $this->view('users', $data);
        } else {
            $this->redirect('/access');
        }
    }
}
