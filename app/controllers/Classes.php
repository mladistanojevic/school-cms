<?php


class Classes extends Controller
{

    public function __construct()
    {
        $this->classModel = $this->model('ClassModel');
    }

    public function index()
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        if (isset($_GET['search'])) {
            $classes = $this->classModel->getAllClassesSearch($_GET['search'], $_SESSION['user']->school_id);
        } else {
            $classes = $this->classModel->getAllClasses($_SESSION['user']->school_id);
        }



        $crumbs[] = ['Dashboard', URLROOT . '/'];
        $crumbs[] = ['Classes', URLROOT . '/classes'];
        $data = [
            'crumbs' => $crumbs,
            'classes' => $classes
        ];
        $this->view('classes', $data);
    }

    public function add()
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $crumbs[] = ['Dashboard', URLROOT . '/'];
        $crumbs[] = ['Classes', URLROOT . '/classes'];
        $crumbs[] = ['Add', URLROOT . '/classes/add'];

        $data = [
            'classError' => '',
            'crumbs' => $crumbs
        ];


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user']->user_id,
                'school_id' => $_SESSION['user']->school_id,
                'class' => trim($_POST['class']),
                'date' => date('Y-m-d H:i:s'),
                'classError' => '',
                'crumbs' => $crumbs
            ];

            //Validate class
            if (empty($data['class']) || !preg_match('/^[a-z A-Z0-9]+$/', $data['class'])) {
                $data['classError'] = "Only letters & numbers allowed in class name";
            }

            if (empty($data['classError'])) {
                if ($this->classModel->insert($data)) {
                    $this->redirect('/classes');
                } else {
                    die('Something went wrong');
                }
            }
        }

        $this->view('classes.add', $data);
    }

    public function edit($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        if (access('lecturer')) {
            $class = $this->classModel->getClassById($id);

            if (!$class) {
                $this->redirect('/classes');
            }

            $crumbs[] = ['Dashboard', URLROOT . '/'];
            $crumbs[] = ['Classes', URLROOT . '/classes'];
            $crumbs[] = ['Edit', URLROOT . '/classes/edit/' . $id];

            $data = [
                'class' => $class,
                'classError' => '',
                'crumbs' => $crumbs
            ];

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'class' => $class,
                    'id' => $id,
                    'class_name' => trim($_POST['class']),
                    'classError' => '',
                    'crumbs' => $crumbs
                ];

                //Validate class
                if (empty($data['class_name']) || !preg_match('/^[a-z A-Z0-9]+$/', $data['class_name'])) {
                    $data['classError'] = "Only letters & numbers allowed in class name";
                }

                if (empty($data['classError'])) {
                    if ($this->classModel->update($data)) {
                        $this->redirect('/classes');
                    } else {
                        die('Something went wrong');
                    }
                }
            }

            $this->view('classes.edit', $data);
        } else {
            $this->redirect('/access');
        }
    }

    public function delete($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        if (access('lecturer')) {
            $class = $this->classModel->getClassById($id);
            if (!$class) {
                $this->redirect('/classes');
            }

            if ($this->classModel->delete($class)) {
                $this->redirect('/classes');
            } else {
                die('Something went wrong!');
            }
        } else {
            $this->redirect('/access');
        }
    }
}
