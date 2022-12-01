<?php

namespace App\Repository;

use App\DataBase\ConnectionHandler;
use Exception;

require_once '../src/DataBase/ConnectionHandler.php';

class UserRepository extends Repository
{
    protected $tablename = "user";

    private $columnUsername = "username";
    private $columnEmail = "email";
    private $columnPassword = "password";
    private $columnApiKey = "apiKey";
    private $columnAdmin = "admin";

    public function create($username, $email, $password, $apiKey)
    {
        $query = "INSERT INTO $this->tablename ($this->columnUsername, $this->columnEmail, $this->columnPassword, $this->columnApiKey) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('ssss', $username, $email, password_hash($password, PASSWORD_DEFAULT), $apiKey);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function readByID($id)
    {
        $query = "SELECT * FROM $this->tablename WHERE $this->columnId = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();

        return $this->processSingleResult($statement->get_result());
    }
    
    public function readByUsername($username)
    {
        $query = "SELECT * FROM $this->tablename WHERE $this->columnUsername = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $username);
        $statement->execute();

        return $this->processSingleResult($statement->get_result());
    }

    public function readByApiKey($apiKey)
    {
        $query = "SELECT * FROM $this->tablename WHERE $this->columnApiKey = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $apiKey);
        $statement->execute();

        return $this->processSingleResult($statement->get_result());
    }

    public function updateMail($userId, $email)
    {
        $query = "UPDATE $this->tablename SET $this->columnEmail = ? WHERE $this->columnId = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si', $email, $userId);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function updatePassword($userId, $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE $this->tablename SET $this->columnPassword = ? WHERE $this->columnId = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si', $password, $userId);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function updateApiKey($userId, $apiKey) {
        $password = password_hash($apiKey, PASSWORD_DEFAULT);
        $query = "UPDATE $this->tablename SET $this->columnApiKey = ? WHERE $this->columnId = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si', $apiKey, $userId);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }

    public function deleteById($id)
    {
        $query = "DELETE FROM $this->tablename WHERE $this->columnId = ?";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $id);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }


    public function countUsers()
    {
        $query = "SELECT count(*) AS 'number' FROM $this->tablename";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->execute();
        return $this->processSingleResult($statement->get_result());
    }
}
