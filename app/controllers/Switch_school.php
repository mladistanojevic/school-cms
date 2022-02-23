<?php

class Switch_school extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->schoolModel = $this->model('School');
    }

    public function index($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        if (isset($_SESSION) && $_SESSION['user']->rank == 'super_admin') {
            $this->switchTo($id);
        } else {
            $this->redirect('');
        }

        $this->redirect('/schools');
    }

    private function switchTo($id)
    {
        $school = $this->schoolModel->getSchoolById($id);
        if (!$school) {
            $this->redirect('/schools');
        }

        if ($this->userModel->updateSchool($_SESSION['user']->user_id, $school->school_id)) {
            $_SESSION['user']->school_id = $school->school_id;
            $_SESSION['user']->school = $school->school;
        } else {
            die('Something went wrong');
        }
    }
}
