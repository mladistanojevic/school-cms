<?php

class Test extends Controller
{

    public function __construct()
    {
        $this->testModel = $this->model('TestModel');
        $this->questionModel = $this->model('QuestionModel');
    }

    public function index($test_id)
    {

        if (!isLogged()) {
            $this->redirect('/login');
        }

        if (access('lecturer')) {
            $test = $this->testModel->getTestProfileById($test_id);
            $page_tab = 'view';
            $qusetion_number = $this->questionModel->getTotalQuestions($test_id);
            $questions = $this->questionModel->getAllQuestions($test_id);



            $data = [
                'test' => $test,
                'page_tab' => $page_tab,
                'questions' => $questions,
                'qusetion_number' => $qusetion_number
            ];

            $this->view('single_test', $data);
        } else {
            $this->redirect('/access');
        }
    }


    public function addquestion($test_id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $test = $this->testModel->getTestProfileById($test_id);

        if ($test->user_id != $_SESSION['user']->user_id) {
            $this->redirect('');
        }
        $questionType = 'subjective';
        $questionError = '';
        $page_tab = 'add-subjective';


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'question' => trim($_POST['question']),
                'comment' => trim($_POST['comment']),
                'test' => $test,
                'image' => '',
                'user_id' => $_SESSION['user']->user_id,
                'test_id' => $test_id,
                'questionType' => $questionType,
                'date' => date('Y-m-d H:i:s')
            ];

            if (empty($data['question'])) {
                $questionError = 'Please enter a question';
            }

            if (empty($questionError)) {
                $allowed[] = 'image/jpeg';
                $allowed[] = 'image/png';
                if (count($_FILES) > 0) {
                    if ($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed)) {
                        $folder = 'uploads/';
                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true);
                        }
                        $destination = $folder . time() . "_" . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                        $data['image'] = $destination;
                    }
                }
                if ($this->questionModel->insertSub($data)) {
                    $this->redirect('/test/' . $test_id);
                } else {
                    die('Something went wrong');
                }
            }
        }


        $data = [
            'page_tab' => $page_tab,
            'test' => $test,
            'questionError' => $questionError
        ];

        $this->view('single_test', $data);
    }

    public function addquestion_objective($test_id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $test = $this->testModel->getTestProfileById($test_id);

        if ($test->user_id != $_SESSION['user']->user_id) {
            $this->redirect('');
        }

        $page_tab = 'add-objective';
        $questionType = 'objective';
        $questionError = '';
        $answerError = '';

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'question' => trim($_POST['question']),
                'comment' => trim($_POST['comment']),
                'answer' => trim($_POST['answer']),
                'test' => $test,
                'image' => '',
                'user_id' => $_SESSION['user']->user_id,
                'test_id' => $test_id,
                'questionType' => $questionType,
                'date' => date('Y-m-d H:i:s')

            ];

            if (empty($data['question'])) {
                $questionError = 'Please enter a question';
            }

            if (empty($data['answer'])) {
                $answerError = 'Please enter an answer';
            }

            if (empty($questionError) && empty($answerError)) {
                $allowed[] = 'image/jpeg';
                $allowed[] = 'image/png';
                if (count($_FILES) > 0) {
                    if ($_FILES['image']['error'] == 0 && in_array($_FILES['image']['type'], $allowed)) {
                        $folder = 'uploads/';
                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true);
                        }
                        $destination = $folder . time() . "_" . $_FILES['image']['name'];
                        move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                        $data['image'] = $destination;
                    }
                }
                if ($this->questionModel->insertObj($data)) {
                    $this->redirect('/test/' . $test_id);
                } else {
                    die('Something went wrong!');
                }
            }
        }

        $data = [
            'page_tab' => $page_tab,
            'test' => $test,
            'questionError' => $questionError,
            'answerError' => $answerError
        ];

        $this->view('single_test', $data);
    }



    public function editquestion($test_id, $question_id)
    {

        if (!isLogged()) {
            $this->redirect('/login');
        }

        $test = $this->testModel->getTestProfileById($test_id);

        if ($test->user_id != $_SESSION['user']->user_id) {
            $this->redirect('');
        }

        $question = $this->questionModel->getQuestionById($question_id);
        $questionError = '';
        $answerError = '';
        $page_tab = 'edit';

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'question' => trim($_POST['question']),
                'comment' => trim($_POST['comment']),
                'image' => $question->image,
                'test' => $test,
                'question_id' => $question->test_questions_id
            ];

            if (isset($_POST['answer'])) {
                $data['answer'] =  trim($_POST['answer']);
            } else {
                $data['answer'] = 'NULL';
            }

            if (empty($data['question'])) {
                $questionError = 'Please enter a question';
            }

            if (empty($data['answer'])) {
                $answerError = 'Please enter an answer';
            }
            show($data);

            if (empty($questionError) && empty($answerError)) {
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
                        $data['image'] = $destination;
                    }
                }

                if ($this->questionModel->update($data)) {
                    $this->redirect('/test/' . $test_id);
                } else {
                    die('Something went wrong');
                }
            }
        }



        $data = [
            'test' => $test,
            'question' => $question,
            'page_tab' => $page_tab,
            'questionError' => $questionError,
            'answerError' => $answerError
        ];

        $this->view('single_test', $data);
    }

    public function deletequestion($test_id, $question_id)
    {
        if (!isLogged()) {
            $this->redirect('/login');
        }

        $test = $this->testModel->getTestProfileById($test_id);

        if ($test->user_id != $_SESSION['user']->user_id) {
            $this->redirect('');
        }

        if ($this->questionModel->delete($question_id)) {
            $this->redirect('/test/' . $test_id);
        } else {
            die('Something went wrong!');
        }
    }
}
