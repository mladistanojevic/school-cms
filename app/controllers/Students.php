<?php

class Students extends Controller
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

        if (access('lecturer')) {
            $school_id = $_SESSION['user']->school_id;


            $crumbs[] = ['Dashboard', URLROOT . '/'];
            $crumbs[] = ['Students', URLROOT . '/students'];

            $limit = 3;
            $this->pagerModel->index($limit);
            $offset = $this->pagerModel->offset;

            if (isset($_GET['search'])) {
                $students = $this->userModel->getAllStudentsSearch($_GET['search'], $_SESSION['user']->school_id);
                if (!$students) {
                    $students = [];
                }
            } else {
                $students = $this->userModel->getAllStudents($school_id, $limit, $offset);
            }

            $data = [
                'students' => $students,
                'crumbs' => $crumbs,
                'mode' => 'students',
                'pager' => $this->pagerModel
            ];

            $this->view('students', $data);
        } else {
            $this->redirect('/access');
        }
    }
}
