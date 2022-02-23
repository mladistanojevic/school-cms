<?php


class ClassStudent
{

    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    public function checkIfExists($user_id, $class_id)
    {
        $stmt = $this->db->query("SELECT * FROM class_students WHERE user_id = :user_id AND class_id = :class_id");
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

    public function insert($user_id, $class_id, $school_id, $date)
    {
        $stmt = $this->db->query("INSERT INTO class_students (user_id,class_id,school_id,date) VALUES (:user_id,:class_id,:school_id,:date)");
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

    public function selectAll($id)
    {
        $stmt = $this->db->query("SELECT class_students.date,class_students.disabled,users.firstname,users.lastname,users.gender,users.rank,users.user_id,classes.class,schools.school FROM class_students JOIN users JOIN classes JOIN schools ON class_students.user_id = users.user_id AND class_students.class_id = classes.class_id AND class_students.school_id = schools.school_id WHERE class_students.class_id = :id AND class_students.disabled = 0");
        $stmt->execute(array(
            ':id' => $id
        ));
        $students = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $students;
    }

    public function findRow($user_id, $class_id)
    {
        $stmt = $this->db->query("SELECT * FROM class_students WHERE user_id = :user_id AND class_id = :class_id");
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
        $stmt = $this->db->query("UPDATE class_students SET disabled = 1 WHERE class_students_id = :id");
        if ($stmt->execute(array(
            ':id' => $row->class_students_id
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllClasses($id)
    {
        $stmt = $this->db->query("SELECT class_students.class_students_id,class_students.date,users.firstname,users.lastname,classes.class_id,classes.class,schools.school FROM class_students JOIN users JOIN classes JOIN schools ON class_students.user_id = users.user_id AND class_students.class_id = classes.class_id AND class_students.school_id = schools.school_id WHERE class_students.user_id = :id AND class_students.disabled = 0");
        $stmt->execute(array(
            ':id' => $id
        ));
        $classes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $classes;
    }

    public function studentClasses($student_id)
    {
        $stmt = $this->db->query("SELECT class_id FROM class_students WHERE user_id = :student_id");
        $stmt->execute(array(
            ':student_id' => $student_id
        ));
        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $classes;
    }
}
