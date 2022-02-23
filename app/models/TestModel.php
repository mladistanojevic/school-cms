<?php

class TestModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function insert($data)
    {
        $stmt = $this->db->query("INSERT INTO class_tests (user_id,class_id,school_id,test,date,description) VALUES (:user_id,:class_id,:school_id,:test,:date,:description)");
        if ($stmt->execute(array(
            ':user_id' => $data['user_id'],
            ':class_id' => $data['class_id'],
            ':school_id' => $data['school_id'],
            ':test' => $data['test'],
            ':date' => $data['date'],
            ':description' => $data['description']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function selectByClassId($class_id)
    {
        $stmt = $this->db->query("SELECT class_tests.test_id,class_tests.user_id,class_tests.date,class_tests.test,class_tests.description,class_tests.disabled,users.firstname,users.lastname, classes.class,schools.school FROM class_tests JOIN users JOIN classes JOIN schools ON class_tests.user_id = users.user_id AND class_tests.class_id = classes.class_id AND class_tests.school_id = schools.school_id WHERE class_tests.class_id = :class_id ");
        $stmt->execute(array(
            ':class_id' => $class_id
        ));
        $tests = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $tests;
    }

    public function getTestById($id)
    {
        $stmt = $this->db->query("SELECT * FROM class_tests WHERE test_id = :id");
        $stmt->execute(array(
            ':id' => $id
        ));
        $test = $stmt->fetch(PDO::FETCH_OBJ);
        return $test;
    }

    public function update($data)
    {
        $stmt = $this->db->query("UPDATE class_tests SET test = :test, description = :description, disabled = :disabled WHERE test_id = :test_id");
        if ($stmt->execute(array(
            ':test' => $data['test'],
            ':description' => $data['description'],
            ':disabled' => $data['disabled'],
            ':test_id' => $data['test_id']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($test, $user_id)
    {
        $stmt = $this->db->query("DELETE FROM class_tests WHERE test_id = :test_id AND user_id = :user_id");
        if ($stmt->execute(array(
            ':test_id' => $test->test_id,
            ':user_id' => $user_id
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllTestsByUserId($user_id)
    {
        $stmt = $this->db->query("SELECT class_tests.test_id,class_tests.class_id,class_tests.test,class_tests.description,class_tests.disabled,users.firstname,users.lastname,users.user_id,schools.school,classes.class FROM class_tests JOIN users JOIN schools JOIN classes ON class_tests.user_id = users.user_id AND class_tests.school_id = schools.school_id AND class_tests.class_id = classes.class_id WHERE class_tests.user_id = :user_id");
        $stmt->execute(array(
            ':user_id' => $user_id
        ));
        $tests = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $tests;
    }

    public function getTestProfileById($test_id)
    {
        $stmt = $this->db->query("SELECT class_tests.test_id,class_tests.class_id,class_tests.date,class_tests.test,class_tests.description,class_tests.disabled,users.firstname,users.lastname,users.user_id, classes.class,schools.school FROM class_tests JOIN users JOIN classes JOIN schools ON class_tests.user_id = users.user_id AND class_tests.class_id = classes.class_id AND class_tests.school_id = schools.school_id WHERE class_tests.test_id = :test_id");
        $stmt->execute(array(
            ':test_id' => $test_id
        ));
        $test = $stmt->fetch(PDO::FETCH_OBJ);
        return $test;
    }

    public function getAllTestsBySchoolIdAndClasses($user, $classes)
    {
        $stmt = $this->db->query("SELECT class_tests.test_id,class_tests.class_id,class_tests.test,class_tests.description,class_tests.disabled,users.firstname,users.lastname,users.user_id,schools.school,classes.class,classes.class_id FROM class_tests JOIN users JOIN schools JOIN classes ON class_tests.user_id = users.user_id AND class_tests.school_id = schools.school_id AND class_tests.class_id = classes.class_id WHERE class_tests.school_id = :school_id AND class_tests.class_id in (:classes)");
        $stmt->execute(array(
            ':school_id' => $user->school_id,
            ':classes' => $classes
        ));
        $tests = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $tests;
    }
}
