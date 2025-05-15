<?php
require_once 'Database.php';

class Prodi {
    private $conn;
    private $table = "prodi";

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($kode, $nama, $alamat, $telpon, $ketua){
        $query = "INSERT INTO $this->table (kode, nama, alamat, telpon, ketua) VALUES (:kode, :nama, :alamat, :telpon, :ketua)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':kode', $kode);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':telpon', $telpon);
        $stmt->bindParam(':ketua', $ketua);
        return $stmt->execute();
    }

    public function readAll(){
        $query = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update($id, $kode, $nama, $alamat, $telpon, $ketua){
        $query = "UPDATE $this->table SET kode=:kode, nama=:nama, alamat=:alamat, telpon=:telpon, ketua=:ketua WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':kode', $kode);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':telpon', $telpon);
        $stmt->bindParam(':ketua', $ketua);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id){
        $query = "DELETE FROM $this->table WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
