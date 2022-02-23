<?php

class Schools extends Controller
{
    public function __construct()
    {
        $this->schoolModel = $this->model('School');
    }

    public function index()
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        if (access('super_admin')) {
            $schools = $this->schoolModel->getAll();

            $crumbs[] = ['Dashboard', URLROOT . '/'];
            $crumbs[] = ['Schools', URLROOT . '/schools'];

            $data = [
                'schools' => $schools,
                'crumbs' => $crumbs
            ];

            $this->view('schools', $data);
        } else {
            $this->redirect('/access');
        }
    }

    public function add()
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        if (access('super_admin')) {
            $crumbs[] = ['Dashboard', URLROOT . '/'];
            $crumbs[] = ['Schools', URLROOT . '/schools'];
            $crumbs[] = ['Add', URLROOT . '/schools/add'];

            $data = [
                'schoolError' => '',
                'crumbs' => $crumbs
            ];

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'user_id' => $_SESSION['user']->user_id,
                    'school' => trim($_POST['school']),
                    'date' => date('Y-m-d H:i:s'),
                    'schoolError' => '',
                    'crumbs' => $crumbs
                ];

                //Validate school
                if (empty($data['school']) || !preg_match('/^[a-z A-Z]+$/', $data['school'])) {
                    $data['schoolError'] = "Only letters allowed in school name";
                }

                if (empty($data['schoolError'])) {
                    if ($this->schoolModel->insert($data)) {
                        $this->redirect('/schools');
                    }
                }
            }

            $this->view('schools.add', $data);
        } else {
            $this->redirect('/access');
        }
    }

    public function edit($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        if (access('super_admin')) {
            $school = $this->schoolModel->getSchoolById($id);

            if (!$school) {
                $this->redirect('/schools');
            }

            $crumbs[] = ['Dashboard', URLROOT . '/'];
            $crumbs[] = ['Schools', URLROOT . '/schools'];
            $crumbs[] = ['Edit', URLROOT . '/schools/edit/' . $id];

            $data = [
                'school' => $school,
                'schoolError' => '',
                'crumbs' => $crumbs
            ];

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'school' => $school,
                    'id' => $id,
                    'user_id' => $_SESSION['user']->user_id,
                    'school_name' => trim($_POST['school']),
                    'date' => date('Y-m-d H:i:s'),
                    'schoolError' => '',
                    'crumbs' => $crumbs
                ];

                //Validate school
                if (empty($data['school_name']) || !preg_match('/^[a-zA-Z]+$/', $data['school_name'])) {
                    $data['schoolError'] = "Only letters allowed in school name";
                }

                if (empty($data['schoolError'])) {
                    if ($this->schoolModel->update($data)) {
                        $this->redirect('/schools');
                    } else {
                        die('Something went wrong');
                    }
                }
            }

            $this->view('schools.edit', $data);
        } else {
            $this->redirect('/access');
        }
    }

    public function delete($id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        if (access('super_admin')) {
            $school = $this->schoolModel->getSchoolById($id);

            if (!$school) {
                $this->redirect('/schools');
            }

            if ($this->schoolModel->delete($school)) {
                $this->redirect('/schools');
            } else {
                die('Something went wrong!');
            }
        } else {
            $this->redirect('/access');
        }
    }
}
