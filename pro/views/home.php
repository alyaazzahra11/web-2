<?php
// Enable error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($pdo)) {
    $pdo = new PDO("mysql:host=localhost;dbname=dbkegiatan_dosen;charset=utf8mb4", "root", "");
}
// Query summary data
$dosenCount = $pdo->query("SELECT COUNT(*) FROM dosen")->fetchColumn();
$penelitianCount = $pdo->query("SELECT COUNT(*) FROM penelitian")->fetchColumn();
$kegiatanCount = $pdo->query("SELECT COUNT(*) FROM kegiatan")->fetchColumn();
$kategoriCount = $pdo->query("SELECT COUNT(*) FROM jenis_kegiatan")->fetchColumn();

// Ambil data kegiatanegiatankan kegiatan
$prodiCount = $pdo->query("SELECT COUNT(*) FROM prodi")->fetchColumn();
$bidangCount = $pdo->query("SELECT COUNT(*) FROM bidang_ilmu")->fetchColumn();
$prodiList = $pdo->query("SELECT * FROM prodi")->fetchAll(PDO::FETCH_ASSOC);
$bidangList = $pdo->query("SELECT * FROM bidang_ilmu")->fetchAll(PDO::FETCH_ASSOC);
// Query for the latest activities
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Dosen -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $dosenCount ?></h3>
                        <p>Dosen</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                    <a href="?url=dosen" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Penelitian -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $penelitianCount ?></h3>
                        <p>Penelitian</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-erlenmeyer-flask"></i>
                    </div>
                    <a href="?url=penelitian" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Kegiatan Akademik -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $kegiatanCount ?></h3>
                        <p>Kegiatan Akademik</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-university"></i>
                    </div>
                    <a href="?url=kegiatan" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Jenis Kegiatan -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $kategoriCount ?></h3>
                        <p>Jenis Kegiatan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-list"></i>
                    </div>
                    <a href="?url=kategori" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>        
    </div>
</section>