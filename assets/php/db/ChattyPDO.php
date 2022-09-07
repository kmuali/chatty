<?php

class ChattyPDO extends PDO
{
    private $db_name = "ChattyDB";
    private $users_table_name = "ChattyUsers";
    private $messages_table_name = "ChattyMessages";

    private $mysql_host = "localhost";
    private $mysql_username = "root";
    private $mysql_password = "";

    public function __construct()
    {
        mysqli_connect($this->mysql_host, $this->mysql_username, $this->mysql_password)->query("CREATE DATABASE IF NOT EXISTS $this->db_name");
        parent::__construct("mysql:host=localhost;dbname=$this->db_name", "root", "");
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->run(
            "CREATE TABLE IF NOT EXISTS $this->users_table_name (
                    `id` int AUTO_INCREMENT PRIMARY KEY,
                    `username` varchar(255) NOT NULL,
                    `password` varchar(255) NOT NULL,
                    `firstName` varchar(255) NOT NULL,
                    `familyName` varchar(255) NOT NULL,
                    `email` varchar(255),
                    `gender` char NOT NULL,
                    `dob` date NOT NULL
                    );"
        );
        $this->run(
            "CREATE TABLE IF NOT EXISTS $this->messages_table_name (
                    `id` int AUTO_INCREMENT PRIMARY KEY,
                    `userId` int NOT NULL,
                    `message` TEXT NOT NULL,
                    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    );"
        );
    }

    public function insertUser($username, $password, $firstName, $familyName, $email = "-", $gender, $dob)
    {
        return $this->run(
            "INSERT INTO $this->users_table_name(`username`, `password`, `firstName`,
             `familyName`, `email`, `gender`, `dob`) VALUES (?, ?, ?, ?, ?, ?, ?)",
            array($username, $password, $firstName, $familyName, $email, $gender, $dob)
        ) != "error";
    }
    public function insertMessage($userId, $message)
    {
        return $this->run(
            "INSERT INTO $this->messages_table_name(`userId`, `message`) VALUES (?, ?)",
            array($userId, $message)
        ) != "error";
    }

    public function getMessages()
    {
        return $this->run("SELECT * FROM $this->messages_table_name WHERE 1")->fetchAll();
    }

    public function existsUsername($username)
    {
        return count($this->run("SELECT * FROM $this->users_table_name WHERE LOWER(`username`) = LOWER(?)", [$username])->fetchAll());
    }


    public function getUserIdByUsername($username)
    {
        return $this->run("SELECT `id` FROM $this->users_table_name WHERE LOWER(`username`) = LOWER(?)", [$username])->fetchAll()[0][0];
    }

    public function getUserRowById($id)
    {
        return $this->run("SELECT * FROM $this->users_table_name WHERE `id` = ?", [$id])->fetchAll()[0];
    }

    private function run($query, $array = null)
    {
        try {
            $_ = $this->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $_->execute($array);
            return $_;
        } catch (\Throwable $th) {
            echo $th;
            return "error";
        }
    }
}
