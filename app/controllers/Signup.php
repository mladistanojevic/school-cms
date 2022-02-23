<?php

class Signup extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        if (access('reception')) {
            $mode = isset($_GET['mode']) ? $_GET['mode'] : 'users';
            $data = [
                'firstname' => '',
                'lastname' => '',
                'email' => '',
                'password' => '',
                'password2' => '',
                'firstnameError' => '',
                'lastnameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'password2Error' => '',
                'mode' => $mode
            ];

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'firstname' => trim($_POST['firstname']),
                    'lastname' => trim($_POST['lastname']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'password2' => trim($_POST['password2']),
                    'gender' => trim($_POST['gender']),
                    'school_id' => $_SESSION['user']->school_id,
                    'rank' => trim($_POST['rank']),
                    'date' => date('Y-m-d H:i:s'),
                    'firstnameError' => '',
                    'lastnameError' => '',
                    'emailError' => '',
                    'passwordError' => '',
                    'password2Error' => '',
                    'mode' => $mode
                ];

                //Firstname validation
                if (empty($data['firstname']) || !preg_match('/^[a-zA-Z]+$/', $data['firstname'])) {
                    $data['firstnameError'] = 'Only letters allowed in first name';
                }

                //Lastname validation
                if (empty($data['lastname']) || !preg_match('/^[a-zA-Z]+$/', $data['lastname'])) {
                    $data['lastnameError'] = "Only letters allowed in last name";
                }

                //Email validation
                if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $data['emailError'] = "Email is not valid";
                }

                //Check if email already exists
                if ($this->userModel->getUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email already exists!';
                }

                //Password validation
                if (strlen($data['password']) < 8) {
                    $data['passwordError'] = "Password must be at least 8 characters long";
                }

                //Password 2 validation
                if ($data['password'] != $data['password2']) {
                    $data['password2Error'] = 'Passwords do not match!';
                }


                if (empty($data['firstnameError']) && empty($data['lastnameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['password2Error'])) {

                    $data['password'] = $this->hashPassword($data['password']);
                    $data['school_id'] = $this->make_school_id();
                    if ($this->userModel->insert($data)) {
                        //ALWAYS REDIRECT TO /users  FIX THIS
                        if ($mode == 'users') {
                            $this->redirect('/users');
                        } else {
                            $this->redirect('/students');
                        }
                    } else {
                        die('Something went wrong');
                    }
                }
            }

            $this->view('signup', $data);
        } else {
            $this->redirect('/access');
        }
    }

    private function hashPassword($pass)
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    private function make_school_id()
    {
        if (isset($_SESSION['user']->school_id)) {
            $school_id = $_SESSION['user']->school_id;
            return $school_id;
        }
        return $school_id = '';
    }
}
