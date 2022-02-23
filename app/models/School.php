<?php


class School
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT schools.school_id,schools.school,schools.date,users.firstname,users.lastname FROM schools JOIN users ON schools.user_id = users.user_id");
        $stmt->execute();
        $schools = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $schools;
    }

    public function insert($data)
    {
        $stmt = $this->db->query("INSERT INTO schools (school, user_id,date) VALUES (:school,:user_id,:date)");
        if ($stmt->execute(array(
            ':school' => $data['school'],
            ':user_id' => $data['user_id'],
            'date' => $data['date']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function getSchoolById($id)
    {
        $stmt = $this->db->query("SELECT * FROM schools WHERE school_id = :id");
        $stmt->execute(array(
            ':id' => $id
        ));
        $school = $stmt->fetch(PDO::FETCH_OBJ);
        return $school;
    }

    public function update($data)
    {
        $stmt = $this->db->query("UPDATE schools SET school = :school, user_id = :user_id, date = :date WHERE school_id = :id");
        if ($stmt->execute(array(
            ':school' => $data['school_name'],
            ':user_id' => $data['user_id'],
            ':date' => $data['date'],
            ':id' => $data['id']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($school)
    {
        $stmt = $this->db->query("DELETE FROM schools WHERE school_id = :id");
        if ($stmt->execute(array(
            ':id' => $school->school_id
        ))) {
            return true;
        } else {
            return false;
        }
    }
}
