<?php

require_once('lib/Database.php');

class Mahasiswa
{
    public $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function add($data)
    {
        $nim = $data['nim'];
        $nama = $data['nama'];
        $email = $data['email'];
        $gender = $data['gender'];
        $query = "INSERT INTO mahasiswa VALUES ('$nim', '$nama', '$email', '$gender')";
        $this->db->insert($query);
    }

    function show()
    {
        $query = "SELECT * FROM mahasiswa";
        return $this->db->select($query);
    }

    function getByNim($nim)
    {
        $query = "SELECT * FROM mahasiswa WHERE nim='$nim'";
        return $this->db->select($query)[0];
    }

    function edit($nim, $data)
    {
        $nim = $data['nim'];
        $nama = $data['nama'];
        $email = $data['email'];
        $gender = $data['gender'];
        $query = "UPDATE mahasiswa SET nim='$nim', nama='$nama', email='$email', gender='$gender' WHERE nim = '$nim'";
        $this->db->insert($query);
    }

    function destroy($nim)
    {
        $query = "DELETE FROM mahasiswa WHERE nim = '$nim'";
        $this->db->delete($query);
    }
}