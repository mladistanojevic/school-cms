<?php


class Tests extends Controller
{

    public function __construct()
    {
        $this->testModel = $this->model('TestModel');
        $this->userModel = $this->model('User');
        $this->classStudentModel = $this->model('ClassStudent');
    }

    public function index()
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }


        $tests = $this->testModel->getAllTestsByUserId($_SESSION['user']->user_id);

        if ($_SESSION['user']->rank == 'student') {



            $user = $this->userModel->getUserById($_SESSION['user']->user_id);

            $classes = $this->classStudentModel->studentClasses($user->user_id);
            $classesArr = [];
            foreach ($classes as $class) {
                array_push($classesArr, (int)$class['class_id']);
            }
            $classesArr = is_array($classesArr) ? implode(',', $classesArr) : '';

            $tests = $this->testModel->getAllTestsBySchoolIdAndClasses($user, $classesArr);
        }



        $crumbs[] = ['Dashboard', URLROOT . '/'];
        $crumbs[] = ['Tests', URLROOT . '/tests'];
        $data = [
            'crumbs' => $crumbs,
            'tests' => $tests
        ];
        $this->view('tests', $data);
    }
}
