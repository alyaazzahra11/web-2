<?php
require_once("Controllers/Dosen.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data = $prodi->show($id);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Prodi</title>
</head>
<body>
   <h1>Detail Prodi</h1>
   <?php if ($data) : ?>
   <p>NIDN: <?= $data['nidn']?></p> 
   <p>Nama: <?= $data['nama']?></p>
   <p>Gelar Belakang: <?= $data['gelar_belakang']?></p>
   <p>Gelar Depan: <?= $data['gelar_depan']?></p>
   <p>Jenis Kelamin: <?= $data['jenis_kelamin']?></p>
   <p>Tempat Lahir: <?= $data['tempat_lahir']?></p>
   <p>Tanggal Lahir: <?= $data['tanggal_lahir']?></p>
   <p>Alamat: <?= $data['alamat']?></p>
   <p>Email: <?= $data['email']?></p>
   <p>Tahun Masuk: <?= $data['tahun_masuk']?></p>
   <?php else: ?>
    <p>Data tidak ditemukan</p>
   <?php endif; ?>
   <a href="?url=dosen">Kembali</a>   
</body>
</html>