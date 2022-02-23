<?php

class Single_class extends Controller
{

    public function __construct()
    {
        $this->classModel = $this->model('ClassModel');
        $this->classLecturerModel = $this->model('ClassLecturer');
        $this->classStudentModel = $this->model('ClassStudent');
        $this->userModel = $this->model('User');
        $this->testModel = $this->model('TestModel');
    }

    public function index($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }


        $results = false;
        $lecturers = false;
        $lecturerExistsError = '';
        $searchError = '';
        $page_tab =  'lecturers';

        $class = $this->classModel->getClassProfile($id);


        $lecturers = $this->classLecturerModel->selectAll($id);

        $data = [
            'class' => $class,
            'page_tab' => $page_tab,
            'results' => $results,
            'lecturers' => $lecturers,
            'lecturerExistsError' => $lecturerExistsError,
            'searchError' => $searchError
        ];


        $this->view('single_class', $data);
    }

    public function students($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $students = $this->classStudentModel->selectAll($id);
        $class = $this->classModel->getClassProfile($id);
        $page_tab = 'students';

        $data = [
            'class' => $class,
            'page_tab' => $page_tab,
            'students' => $students
        ];

        $this->view('single_class', $data);
    }

    public function lectureradd($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }


        $results = false;
        $lecturerExistsError = '';
        $searchError = '';
        $page_tab = 'lecturer-add';

        $class = $this->classModel->getClassProfile($id);

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {
                //Find Lecturer
                if (!empty(trim($_POST['name']))) {
                    $name = "%" . trim($_POST['name']) . "%";
                    $results = $this->userModel->search($name, $_SESSION['user']->school_id);
                } else {
                    $searchError = "Please type name to find";
                }
            } else {
                if (isset($_POST['selected'])) {
                    if ($page_tab == 'lecturer-add') {
                        //Add lecturer
                        $selected = $this->userModel->getUserById($_POST['selected']);
                        if (!$this->classLecturerModel->checkIfExists($selected->user_id, $id)) {
                            $date = date('Y-m-d H:i:s');
                            if ($this->classLecturerModel->insert($selected->user_id, $id, $selected->school_id, $date)) {
                                $this->redirect('/single_class/' . $id);
                            }
                        } else {
                            $lecturerExistsError = 'Lecturor already added!';
                        }
                    }
                }
            }
        }

        $data = [
            'class' => $class,
            'page_tab' => $page_tab,
            'results' => $results,
            'lecturerExistsError' => $lecturerExistsError,
            'searchError' => $searchError
        ];


        $this->view('single_class', $data);
    }

    public function studentadd($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $searchError = '';
        $studentExistsError = '';
        $results = false;
        $page_tab = 'student-add';
        $class = $this->classModel->getClassProfile($id);

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {
                //Find Lecturer
                if (!empty(trim($_POST['name']))) {
                    $name = "%" . trim($_POST['name']) . "%";
                    $results = $this->userModel->searchStudent($name, $_SESSION['user']->school_id);
                } else {
                    $searchError = "Please type name to find";
                }
            } else {
                if (isset($_POST['selected'])) {
                    //Add student
                    $selected = $this->userModel->getUserById($_POST['selected']);
                    if (!$this->classStudentModel->checkIfExists($selected->user_id, $id)) {
                        $date = date('Y-m-d H:i:s');
                        if ($this->classStudentModel->insert($selected->user_id, $id, $selected->school_id, $date)) {
                            $this->redirect('/single_class/students/' . $id);
                        }
                    } else {
                        $studentExistsError = 'Student already added!';
                    }
                }
            }
        }

        $data = [
            'page_tab' => $page_tab,
            'class' => $class,
            'results' => $results,
            'searchError' => $searchError,
            'studentExistsError' => $studentExistsError
        ];

        $this->view('single_class', $data);
    }

    public function lecturerremove($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }


        $results = false;
        $lecturers = false;
        $lecturerExistsError = '';
        $searchError = '';
        $page_tab = 'lecturer-remove';

        $class = $this->classModel->getClassProfile($id);

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {
                //Find Lecturer
                if (!empty(trim($_POST['name']))) {
                    $name = "%" . trim($_POST['name']) . "%";
                    $results = $this->userModel->search($name, $_SESSION['user']->school_id);
                } else {
                    $searchError = "Please type name to find";
                }
            } else {
                if (isset($_POST['selected'])) {
                    $selected = $this->userModel->getUserById($_POST['selected']);
                    $classRow = $this->classLecturerModel->findRow($selected->user_id, $id);
                    if ($classRow) {
                        if ($this->classLecturerModel->update($classRow)) {
                            $this->redirect('/single_class/' . $id . '?tab=lecturers');
                        }
                    }
                }
            }
        }

        $data = [
            'class' => $class,
            'page_tab' => $page_tab,
            'results' => $results,
            'lecturers' => $lecturers,
            'lecturerExistsError' => $lecturerExistsError,
            'searchError' => $searchError
        ];


        $this->view('single_class', $data);
    }

    public function studentremove($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }


        $results = false;
        $lecturers = false;
        $searchError = '';
        $page_tab = 'student-remove';

        $class = $this->classModel->getClassProfile($id);

        if (count($_POST) > 0) {
            if (isset($_POST['search'])) {
                //Find Student
                if (!empty(trim($_POST['name']))) {
                    $name = "%" . trim($_POST['name']) . "%";
                    $results = $this->userModel->searchStudent($name, $_SESSION['user']->school_id);
                } else {
                    $searchError = "Please type name to find";
                }
            } else {
                if (isset($_POST['selected'])) {
                    $selected = $this->userModel->getUserById($_POST['selected']);
                    $classRow = $this->classStudentModel->findRow($selected->user_id, $id);
                    if ($classRow) {
                        if ($this->classStudentModel->update($classRow)) {
                            $this->redirect('/single_class/students/' . $id);
                        }
                    }
                }
            }
        }

        $data = [
            'class' => $class,
            'page_tab' => $page_tab,
            'results' => $results,
            'lecturers' => $lecturers,
            'searchError' => $searchError
        ];


        $this->view('single_class', $data);
    }

    public function tests($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $tests = $this->testModel->selectByClassId($id);
        $class = $this->classModel->getClassProfile($id);
        $page_tab = 'tests';

        $data = [
            'class' => $class,
            'page_tab' => $page_tab,
            'tests' => $tests
        ];

        $this->view('single_class', $data);
    }

    public function testadd($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $class = $this->classModel->getClassProfile($id);
        $page_tab = 'test-add';
        $testError = '';

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'test' => trim($_POST['test']),
                'description' => trim($_POST['description']),
                'user_id' => $_SESSION['user']->user_id,
                'class_id' => $id,
                'school_id' => $_SESSION['user']->school_id,
                'date' => date('Y-m-d H:i:s'),
                'testError' => $testError
            ];

            //Validate test name
            if (empty($data['test'])) {
                $testError = 'Enter test name!';
            }

            //Check if testError is empty
            if (empty($testError)) {
                if ($this->testModel->insert($data)) {
                    $this->redirect('/single_class/tests/' . $id);
                } else {
                    die('Something went wrong');
                }
            }
        }

        $data = [
            'page_tab' => $page_tab,
            'class' => $class,
            'testError' => $testError
        ];

        $this->view('single_class', $data);
    }

    public function testedit($test_id, $class_id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $class = $this->classModel->getClassProfile($class_id);
        $test = $this->testModel->getTestById($test_id);
        $page_tab = 'test-edit';
        $testError = '';

        if (!$test) {
            $this->redirect('/single_class/tests/' . $class_id);
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'page_tab' => $page_tab,
                'test' => trim($_POST['test']),
                'description' => trim($_POST['description']),
                'disabled' => $_POST['disabled'],
                'class_id' => $class_id,
                'test_id' => $test_id,
                'testError' => $testError
            ];

            //Validate test
            if (empty($data['test'])) {
                $testError = "Please enter test name";
            }

            if (empty($testError)) {
                if ($this->testModel->update($data)) {
                    $this->redirect('/single_class/tests/' . $class_id);
                } else {
                    die('Something went wrong');
                }
            }
        }


        $data = [
            'page_tab' => $page_tab,
            'class' => $class,
            'test' => $test,
            'testError' => $testError
        ];
        $this->view('single_class', $data);
    }

    public function testdelete($test_id, $class_id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $test = $this->testModel->getTestById($test_id);
        if (!$test) {
            $this->redirect('/single_class/tests/' . $class_id);
        }

        if ($this->testModel->delete($test, $_SESSION['user']->user_id)) {
            $this->redirect('/single_class/tests/' . $class_id);
        } else {
            die('Something went wrong');
        }
    }
}
