<?php

class EmpController
{
    private $database;

    //Connect Database
    public function __construct($connect)
    {
        $this->database = $connect;
    }

    //Get data from role table
    public function getRole()
    {
        try {
            $sql = "SELECT * FROM role";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Create new account
    public function insert($fullname, $username, $userPassword, $roleID)
    {
        try {
            $newPassword = md5($userPassword . $username);

            $sql = "INSERT INTO employees(fullname,username,userPassword,roleID)
                                VALUES(:fullname,:username,:user_password,:role_id) ";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":fullname", $fullname);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":user_password", $newPassword);
            $stmt->bindParam(":role_id", $roleID);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Check if a username already exists. (num > 0) 
    public function checkUsername($username)
    {
        try {
            $sql = "SELECT COUNT(*) as num FROM employees WHERE username=:username";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Get user detail for login
    function getUser($username, $userPassword, $roleID)
    {
        try {
            $sql = "SELECT * FROM employees WHERE username = :username AND userPassword=:userPassword AND roleID = :roleID ";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":userPassword", $userPassword);
            $stmt->bindParam(":roleID", $roleID);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Get user detail for show on table with role
    function getUserRole()
    {
        try {
            $sql = "SELECT * FROM employees INNER JOIN role ON employees.roleID = role.roleID";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Delete user account
    function delete($productID)
    {
        try {
            $sql = "DELETE FROM employees WHERE id =:id";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":id", $productID);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Get user detail from id to edit detail
    function getUserDetail($userID)
    {
        try {
            $sql = "SELECT * FROM employees INNER JOIN role ON employees.roleID = role.roleID WHERE id =:id";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":id", $userID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Update user detail
    function update($fullname, $username, $userPassword, $roleID, $userID)
    {
        try {
            $sql = "UPDATE employees 
                SET fullname=:fullname, username=:username,
                userPassword=:userPassword, roleID=:roleID
                WHERE id =:userID ";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":fullname", $fullname);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":userPassword", $userPassword);
            $stmt->bindParam(":roleID", $roleID);
            $stmt->bindParam(":userID", $userID);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
