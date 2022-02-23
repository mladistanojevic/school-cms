<?php

class QuestionModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insertSub($data)
    {
        $stmt = $this->db->query("INSERT INTO test_questions (test_id,user_id,question,comment,image,question_type,date) VALUES (:test_id,:user_id,:question,:comment,:image,:question_type,:date)");
        if ($stmt->execute(array(
            ':test_id' => $data['test_id'],
            ':user_id' => $data['user_id'],
            ':question' => $data['question'],
            ':comment' => $data['comment'],
            ':image' => $data['image'],
            ':question_type' => $data['questionType'],
            ':date' => $data['date']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function insertObj($data)
    {
        $stmt = $this->db->query("INSERT INTO test_questions (test_id,user_id,question,comment,correct_answer,image,question_type,date) VALUES (:test_id,:user_id,:question,:comment,:answer,:image,:question_type,:date)");
        if ($stmt->execute(array(
            ':test_id' => $data['test_id'],
            ':user_id' => $data['user_id'],
            ':question' => $data['question'],
            ':comment' => $data['comment'],
            ':answer' => $data['answer'],
            ':image' => $data['image'],
            ':question_type' => $data['questionType'],
            ':date' => $data['date']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllQuestions($test_id)
    {
        $stmt = $this->db->query("SELECT test_questions.test_questions_id,test_questions.test_id,test_questions.question,test_questions.comment,test_questions.image,test_questions.question_type,test_questions.correct_answer, test_questions.choices,test_questions.date, class_tests.test,class_tests.description,users.firstname,users.lastname FROM test_questions JOIN class_tests JOIN users ON test_questions.test_id = class_tests.test_id AND test_questions.user_id = users.user_id WHERE test_questions.test_id = :test_id");
        $stmt->execute(array(
            ':test_id' => $test_id
        ));
        $questions = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $questions;
    }

    public function getTotalQuestions($test_id)
    {
        $stmt = $this->db->query("SELECT * FROM test_questions WHERE test_id = :test_id");
        $stmt->execute(array(
            ':test_id' => $test_id
        ));
        $num = $stmt->rowCount();
        return $num;
    }

    public function getQuestionById($question_id)
    {
        $stmt = $this->db->query("SELECT * FROM test_questions WHERE test_questions_id = :question_id");
        $stmt->execute(array(
            ':question_id' => $question_id
        ));
        $question = $stmt->fetch(PDO::FETCH_OBJ);
        return $question;
    }

    public function update($data)
    {
        $stmt = $this->db->query("UPDATE test_questions SET question = :question, comment = :comment, correct_answer = :answer,image = :image WHERE test_questions_id = :question_id");
        if ($stmt->execute(array(
            ':question' => $data['question'],
            ':comment' => $data['comment'],
            ':answer' => $data['answer'],
            ':image' => $data['image'],
            ':question_id' => $data['question_id']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($question_id)
    {
        $stmt = $this->db->query("DELETE FROM test_questions WHERE test_questions_id = :question_id");
        if ($stmt->execute(array(
            ':question_id' => $question_id
        ))) {
            return true;
        } else {
            return false;
        }
    }
}
