<?php

require_once('config/config.php');

class Database
{
    public $host = HOST;
    public $user = USER;
    public $pass = PASSWORD;
    public $db = DATABASE;
    public $conn;

    function __construct()
    {
        $this->dbconnect();
    }

    function dbconnect()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
    }

    function mysql()
    {
        return new mysqli($this->host, $this->user, $this->pass, $this->db);
    }

    function insert($query)
    {
        mysqli_query($this->conn, $query);
    }

    function select($query)
    {
        $data = [];
        $show = mysqli_query($this->conn, $query);
        while ($rows = mysqli_fetch_assoc($show)) {
            $data[] = $rows;
        }
        return $data;
    }

    function delete($query)
    {
        mysqli_query($this->conn, $query);
    }
}