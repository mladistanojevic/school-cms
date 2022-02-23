<?php

class ClassModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllClasses($school_id)
    {
        $stmt = $this->db->query("SELECT classes.class_id,classes.user_id,classes.class,classes.date,users.firstname,users.lastname,schools.school FROM classes JOIN users JOIN schools ON classes.user_id = users.user_id AND classes.school_id = schools.school_id WHERE classes.school_id = :school_id ORDER BY class_id DESC");
        $stmt->execute(array(
            ':school_id' => $school_id
        ));
        $classes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $classes;
    }

    public function getAllClassesSearch($search, $school_id)
    {
        $stmt = $this->db->query("SELECT classes.class_id,classes.user_id,classes.class,classes.date,users.firstname,users.lastname,schools.school FROM classes JOIN users JOIN schools ON classes.user_id = users.user_id AND classes.school_id = schools.school_id WHERE classes.class like '%$search%' AND classes.school_id = :school_id ORDER BY class_id DESC");
        $stmt->execute(array(
            ':school_id' => $school_id
        ));
        $classes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $classes;
    }

    public function insert($data)
    {
        $stmt = $this->db->query("INSERT INTO classes (class,date,user_id,school_id) VALUES (:class,:date,:user_id,:school_id)");
        if ($stmt->execute(array(
            ':class' => $data['class'],
            ':date' => $data['date'],
            ':user_id' => $data['user_id'],
            ':school_id' => $data['school_id']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function getClassById($id)
    {
        $stmt = $this->db->query("SELECT * FROM classes WHERE class_id = :id");
        $stmt->execute(array(
            ':id' => $id
        ));
        $class = $stmt->fetch(PDO::FETCH_OBJ);
        return $class;
    }

    public function getClassProfile($id)
    {
        $stmt = $this->db->query("SELECT classes.class_id,classes.class,classes.date,users.firstname,users.lastname FROM classes JOIN users ON classes.user_id = users.user_id WHERE class_id = :id");
        $stmt->execute(array(
            ':id' => $id
        ));
        $class = $stmt->fetch(PDO::FETCH_OBJ);
        return $class;
    }

    public function update($data)
    {
        $stmt = $this->db->query("UPDATE classes SET class = :class WHERE class_id = :id");
        if ($stmt->execute(array(
            ':class' => $data['class_name'],
            ':id' => $data['id']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($class)
    {
        $stmt = $this->db->query("DELETE FROM classes WHERE class_id = :id");
        if ($stmt->execute(array(
            ':id' => $class->class_id
        ))) {
            return true;
        } else {
            return false;
        }
    }
}
