<?php

class AnswerModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert($answer, $user_id, $test_id, $question_id, $date)
    {
        $stmt = $this->db->query("INSERT INTO answers (answer,user_id,test_id,question_id,date) VALUES (:answer,:user_id,:test_id,:question_id,:date)");
        $stmt->execute(array(
            ':answer' => $answer,
            ':user_id' => $user_id,
            ':test_id' => $test_id,
            ':question_id' => $question_id,
            ':date' => $date
        ));
    }

    public function checkIfExists($user_id, $test_id, $question_id)
    {
        $stmt = $this->db->query("SELECT answer_id FROM answers WHERE user_id = :user_id AND test_id = :test_id AND question_id = :question_id");
        $stmt->execute(array(
            ':user_id' => $user_id,
            ':test_id' => $test_id,
            ':question_id' => $question_id
        ));
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if ($row) {
            return $row;
        } else {
            return false;
        }
    }

    public function getAnswersByUserId($user_id)
    {
        $stmt = $this->db->query("SELECT test_id FROM answers WHERE user_id = :user_id");
        $stmt->execute(array(
            ':user_id' => $user_id
        ));
        $test_id = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $test_id;
    }
}
