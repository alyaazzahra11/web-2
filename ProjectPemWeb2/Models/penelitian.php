<?php
// filepath: c:\xampp\htdocs\web-2\Models\Penelitian.php

class Penelitian
{
    private $pdo;

    public function __construct()
    {
        // Ganti konfigurasi sesuai database Anda
        $host = 'localhost';
        $db   = 'dbkegiatan_dosen'; // GANTI dengan nama database Anda
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new \PDO($dsn, $user, $pass, $options);
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM penelitian");
        return $stmt->fetchAll();
    }

    public function create($data)
    {
        $sql = "INSERT INTO penelitian (judul, mulai, akhir, tahun_ajaran) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['judul'],
            $data['mulai'],
            $data['akhir'],
            $data['tahun_ajaran']
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE penelitian SET judul=?, mulai=?, akhir=?, tahun_ajaran=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['judul'],
            $data['mulai'],
            $data['akhir'],
            $data['tahun_ajaran'],
            $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM penelitian WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}