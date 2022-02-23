<?php

class Profile extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->classStudentModel = $this->model('ClassStudent');
        $this->classLecturerModel = $this->model('ClassLecturer');
        $this->testModel = $this->model('TestModel');
    }

    public function index($id)
    {

        $user = $this->userModel->getUserById($id);
        if (!$user) {
            $this->redirect('/users');
        }


        $crumbs[] = ['Dashboard', URLROOT . '/'];
        $crumbs[] = ['Stuff', URLROOT . '/users'];
        $crumbs[] = [$user->firstname, URLROOT . '/profile/' . $id];

        $page_tab = 'info';


        $data = [
            'user' => $user,
            'crumbs' => $crumbs,
            'page_tab' => $page_tab
        ];

        $this->view('profile', $data);
    }

    public function classes($id)
    {
        $user = $this->userModel->getUserById($id);
        if (!$user) {
            $this->redirect('/users');
        }
        $classes = [];

        if ($user->rank == 'lecturer') {
            $classes = $this->classLecturerModel->getAllClasses($id);
        }

        if ($user->rank == 'student') {
            $classes = $this->classStudentModel->getAllClasses($id);
        }


        $crumbs[] = ['Dashboard', URLROOT . '/'];
        $crumbs[] = ['Stuff', URLROOT . '/users'];
        $crumbs[] = [$user->firstname, URLROOT . '/profile/' . $id];

        $page_tab = 'classes';

        $data = [
            'user' => $user,
            'crumbs' => $crumbs,
            'page_tab' => $page_tab,
            'classes' => $classes
        ];

        $this->view('profile', $data);
    }

    public function tests($id)
    {
        $user = $this->userModel->getUserById($id);
        if (!$user) {
            $this->redirect('/users');
        }

        $crumbs[] = ['Dashboard', URLROOT . '/'];
        $crumbs[] = ['Stuff', URLROOT . '/users'];
        $crumbs[] = [$user->firstname, URLROOT . '/profile/' . $id];


        $classes = $this->classStudentModel->studentClasses($id);
        $classesArr = [];
        foreach ($classes as $class) {
            array_push($classesArr, (int)$class['class_id']);
        }
        $classesArr = is_array($classesArr) ? implode(',', $classesArr) : '';



        $page_tab = 'tests';
        $tests = $this->testModel->getAllTestsBySchoolIdAndClasses($user, $classesArr);

        $data = [
            'user' => $user,
            'crumbs' => $crumbs,
            'page_tab' => $page_tab,
            'tests' => $tests
        ];

        $this->view('profile', $data);
    }

    public function edit($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $user = $this->userModel->getUserById($id);

        if (!$user) {
            $this->redirect('/students');
        }

        if (access('admin') || $_SESSION['user']->user_id == $user->user_id) {

            $data = [
                'user' => $user,
                'firstnameError' => '',
                'lastnameError' => '',
            ];

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'user' => $user,
                    'firstname' => trim($_POST['firstname']),
                    'lastname' => trim($_POST['lastname']),
                    'gender' => trim($_POST['gender']),
                    'destination' => $user->image,
                    'firstnameError' => '',
                    'lastnameError' => ''
                ];

                //Validate firstname
                if (empty($data['firstname']) || !preg_match('/^[a-zA-Z]+$/', $data['firstname'])) {
                    $data['firstnameError'] = 'Only letters allowed in first name';
                }

                //Lastname validation
                if (empty($data['lastname']) || !preg_match('/^[a-zA-Z]+$/', $data['lastname'])) {
                    $data['lastnameError'] = "Only letters allowed in last name";
                }

                if (empty($data['firstnameError']) && empty($data['lastnameError'])) {

                    $allowed[] = 'image/jpeg';
                    $allowed[] = 'image/png';
                    //Check for files
                    if (count($_FILES) > 0) {
                        if ($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed)) {
                            $folder = 'uploads/';
                            if (!file_exists($folder)) {
                                mkdir($folder, 0777, true);
                            }
                            $destination = $folder . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                            $data['destination'] = $destination;
                        }
                    }

                    if ($this->userModel->update($data)) {
                        $this->redirect('/profile/' . $data['user']->user_id);
                    } else {
                        die('Something went wrong!');
                    }
                }
            }


            $this->view('profile.edit', $data);
        } else {
            $this->redirect('/access');
        }
    }
}
