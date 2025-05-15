<?php

class Kegiatan
{
    private $pdo;

    public function __construct()
    {
        $host = 'localhost';
        $db   = 'dbkegiatan_dosen';
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
        $stmt = $this->pdo->query("SELECT * FROM kegiatan");
        return $stmt->fetchAll();
    }

    public function create($data)
    {
        $sql = "INSERT INTO kegiatan (tanggal_mulai, tanggal_selesai, tempat, deskripsi, jenis_kegiatan_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['tanggal_mulai'],
            $data['tanggal_selesai'],
            $data['tempat'],
            $data['deskripsi'],
            $data['jenis_kegiatan_id']
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE kegiatan SET tanggal_mulai=?, tanggal_selesai=?, tempat=?, deskripsi=?, jenis_kegiatan_id=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['tanggal_mulai'],
            $data['tanggal_selesai'],
            $data['tempat'],
            $data['deskripsi'],
            $data['jenis_kegiatan_id'],
            $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM kegiatan WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}