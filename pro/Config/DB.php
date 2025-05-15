<?php

/**
 * File ini akan digunakan untuk memanggil database
 */
class DB {
    private $connection;

    public function __construct() {
        $host = "localhost";
        $dbname = "dbkegiatan_dosen";
        $username = "root";
        $password = "";

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}

?>
