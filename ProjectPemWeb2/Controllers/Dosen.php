<?php
require_once 'Config/DB.php';

class dosen
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index() {
        $stmt = $this->pdo->query("SELECT * FROM dosen");
        return $stmt->fetchAll();
    }

    public function show($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM dosen WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("INSERT INTO dosen (nidn, nama, gelar_belakang, gelar_depan, jenis_kelamin, tempat_lahir, alamat, email, tahun_masuk, prodi_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['nidn'],
            $data['nama'],
            $data['gelar_belakang'],
            $data['gelar_depan'],
            $data['jenis_kelamin'],
            $data['tempat_lahir'],
            $data['alamat'],
            $data['email'],
            $data['tahun_masuk'],
            $data['prodi_id'] // pastikan data ini dikirim dari form
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE dosen SET nidn = ?, nama = ?, gelar_belakang = ?, gelar_depan = ?, jenis_kelamin = ?, tempat_lahir = ?, alamat = ?, email = ?, tahun_masuk = ?, prodi_id = ? WHERE id = ?");
        return $stmt->execute([
            $data['nidn'],
            $data['nama'],
            $data['gelar_belakang'],
            $data['gelar_depan'],
            $data['jenis_kelamin'],
            $data['tempat_lahir'],
            $data['alamat'],
            $data['email'],
            $data['tahun_masuk'],
            $data['prodi_id'], // pastikan data ini dikirim dari form
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM dosen WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

$dosen = new dosen($pdo);
