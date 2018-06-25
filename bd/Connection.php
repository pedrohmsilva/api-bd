<?php

namespace bd;

class Connection
{
    static $conn;
    static $servername = "localhost";
    static $username = "root";
    static $password = "";
    static $dbname = "bd1";

    public function __construct()
    {
        self::$conn = new \mysqli(self::$servername, self::$username, self::$password, self::$dbname);
        if (self::$conn->connect_error) {
            die("Falha de conexão: " . self::$conn->connect_error);
        }
        self::$conn->set_charset("utf8");
    }

    public function __destruct()
    {
        self::$conn->close();
    }

    public function post($sql)
    {   
        if (self::$conn->query($sql)) {
            return [
                "status" => true
            ];
        }
        return [
            "status" => false,
            "error" => self::$conn->error
        ];
    }

    public function get($sql)
    {
        $result = self::$conn->query($sql);
        $error = self::$conn->error;

        if ($error) {
            return [
                "status" => false,
                "error" => $error
            ];
        }

        $response = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
        }
        return $response;
    }
}