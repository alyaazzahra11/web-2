<?php
class Dosen {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM dosen");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM dosen WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $stmt = $this->pdo->prepare("INSERT INTO dosen (nama, nidn, email, fakultas, jurusan) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$data['nama'], $data['nidn'], $data['email'], $data['fakultas'], $data['jurusan']]);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE dosen SET nama=?, nidn=?, email=?, fakultas=?, jurusan=? WHERE id=?");
        return $stmt->execute([$data['nama'], $data['nidn'], $data['email'], $data['fakultas'], $data['jurusan'], $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM dosen WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
