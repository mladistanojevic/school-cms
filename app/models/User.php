<?php

class User
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll($school_id, $limit, $offset)
    {
        $stmt = $this->db->query("SELECT users.user_id,users.firstname,users.lastname,users.image,users.email,users.date,users.gender,users.rank,schools.school FROM users JOIN schools ON users.school_id = schools.school_id WHERE users.school_id = :school_id AND users.rank != 'student' ORDER BY user_id DESC LIMIT $limit OFFSET $offset");
        $stmt->execute(array(
            ':school_id' => $school_id
        ));
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->db->query('SELECT * FROM users WHERE email = :email');
        $stmt->execute(array(
            ':email' => $email
        ));
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllStudents($school_id, $limit, $offset)
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE rank = 'student' AND school_id = :school_id ORDER BY user_id DESC LIMIT $limit OFFSET $offset");
        $stmt->execute(array(
            ':school_id' => $school_id
        ));
        $students = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $students;
    }

    public function getUserById($id)
    {
        $stmt = $this->db->query('SELECT * FROM users WHERE user_id = :id');
        $stmt->execute(array(
            ':id' => $id
        ));
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    public function insert($data)
    {
        $stmt = $this->db->query("INSERT INTO users (firstname,lastname,email,password,gender,rank,date,school_id) VALUES (:firstname,:lastname,:email,:password,:gender,:rank,:date,:school_id)");
        if ($stmt->execute(array(
            ':firstname' => $data['firstname'],
            ':lastname' => $data['lastname'],
            ':email' => $data['email'],
            ':password' => $data['password'],
            ':gender' => $data['gender'],
            ':rank' => $data['rank'],
            ':date' => $data['date'],
            ':school_id' => $data['school_id']
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function login($data)
    {
        $stmt = $this->db->query("SELECT users.user_id,users.firstname,users.lastname,users.school_id,users.email,users.password,users.date,users.gender,users.rank,schools.school FROM users JOIN schools ON users.school_id = schools.school_id WHERE email = :email");
        $stmt->execute(array(
            ':email' => $data['email']
        ));
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$user) {
            return false;
        }

        $hashedPassword = $user->password;
        if (password_verify($data['password'], $hashedPassword)) {
            return $user;
        } else {
            return false;
        }
    }

    public function updateSchool($user_id, $school_id)
    {
        $stmt = $this->db->query('UPDATE users SET school_id = :school_id WHERE user_id = :user_id');
        if ($stmt->execute(array(
            ':school_id' => $school_id,
            ':user_id' => $user_id
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function update($data)
    {
        $stmt = $this->db->query("UPDATE users SET firstname = :firstname, lastname = :lastname, gender = :gender,image = :image WHERE user_id = :user_id");
        if ($stmt->execute(array(
            ':firstname' => $data['firstname'],
            ':lastname' => $data['lastname'],
            ':gender' => $data['gender'],
            ':image' => $data['destination'],
            ':user_id' => $data['user']->user_id
        ))) {
            return true;
        } else {
            return false;
        }
    }

    public function search($name, $id)
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE (firstname like '%$name%' || lastname like '%$name%')  AND rank = 'lecturer' AND school_id = :id LIMIT 10");
        $stmt->execute(array(
            ':id' => $id
        ));
        $lecturers = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $lecturers;
    }

    public function searchStudent($name, $id)
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE (firstname like '%$name%' || lastname like '%$name%')  AND rank = 'student' AND school_id = :id LIMIT 10");
        $stmt->execute(array(
            ':id' => $id
        ));
        $lecturers = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $lecturers;
    }

    public function getAllStudentsSearch($search, $school_id)
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE (firstname like '%$search%' || lastname like '%$search%') AND school_id = :school_id AND rank = 'student' ");

        $stmt->execute(array(
            ':school_id' => $school_id
        ));
        $students = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $students;
    }

    public function getAllStuffSearch($search, $school_id)
    {
        $stmt = $this->db->query("SELECT * FROM users WHERE (firstname like '%$search%' || lastname like '%$search%') AND school_id = :school_id AND rank != 'student' LIMIT 10");

        $stmt->execute(array(
            ':school_id' => $school_id
        ));
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }
}
