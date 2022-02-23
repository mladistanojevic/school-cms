<?php

class Login extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {

        $data = [
            'email' => '',
            'password' => '',
            'emailError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => ''
            ];

            //Email validation
            if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = "Email is not valid";
            }

            //Password validation
            if (strlen($data['password']) < 8) {
                $data['passwordError'] = "Password must be at least 8 characters long";
            }

            if (empty($data['emailError']) && empty($data['passwordError'])) {
                $loggedUser = $this->userModel->login($data);
                if ($loggedUser) {
                    //Create session
                    $this->createSession($loggedUser);
                } else {
                    $data['passwordError'] = 'Wrong email or password!';
                }
            }
        }

        $this->view('login', $data);
    }

    public function createSession($user)
    {
        $_SESSION['user'] = $user;
        $this->redirect('');
    }
}
