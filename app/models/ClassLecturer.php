<?php

class ClassLecturer
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function selectAll($id)
    {
        $stmt = $this->db->query("SELECT class_lecturers.date,class_lecturers.disabled,users.firstname,users.lastname,users.gender,users.rank,users.user_id,classes.class,schools.school FROM class_lecturers JOIN users JOIN classes JOIN schools ON class_lecturers.user_id = users.user_id AND class_lecturers.class_id = classes.class_id AND class_lecturers.school_id = schools.school_id WHERE class_lecturers.class_id = :id AND class_lecturers.disabled = 0");
        $stmt->execute(array(
            ':id' => $id
        ));
        $lecturers = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $lecturers;
    }


    public function insert($user_id, $class_id, $school_id, $date)
    {
        $stmt = $this->db->query("INSERT INTO class_lecturers (user_id,class_id,school_id,date) VALUES (:user_id,:class_id,:school_id,:date)");
        if ($stmt->execute(array(
            ':user_id' => $user_id,
            ':class_id' => $class_id,
            ':school_id' => $school_id,
            ':date' => $date
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfExists($user_id, $class_id)
    {
        $stmt = $this->db->query("SELECT * FROM class_lecturers WHERE user_id = :user_id AND class_id = :class_id");
        $stmt->execute(array(
            ':user_id' => $user_id,
            ':class_id' => $class_id
        ));
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function findRow($user_id, $class_id)
    {
        $stmt = $this->db->query("SELECT * FROM class_lecturers WHERE user_id = :user_id AND class_id = :class_id");
        $stmt->execute(array(
            ':user_id' => $user_id,
            ':class_id' => $class_id
        ));
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if ($row) {
            return $row;
        } else {
            return false;
        }
    }

    public function update($row)
    {
        $stmt = $this->db->query("UPDATE class_lecturers SET disabled = 1 WHERE class_lecturers_id = :id");
        if ($stmt->execute(array(
            ':id' => $row->class_lecturers_id
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllClasses($id)
    {
        $stmt = $this->db->query("SELECT class_lecturers.class_lecturers_id,class_lecturers.date,users.firstname,users.lastname,classes.class_id,classes.class,schools.school FROM class_lecturers JOIN users JOIN classes JOIN schools ON class_lecturers.user_id = users.user_id AND class_lecturers.class_id = classes.class_id AND class_lecturers.school_id = schools.school_id WHERE class_lecturers.user_id = :id AND class_lecturers.disabled = 0");
        $stmt->execute(array(
            ':id' => $id
        ));
        $classes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $classes;
    }
}
