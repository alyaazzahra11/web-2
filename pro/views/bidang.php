<?php
$pdo = new PDO("mysql:host=localhost;dbname=dbkegiatan_dosen;charset=utf8mb4", "root", "");

$prodiList = $pdo->query("SELECT * FROM prodi")->fetchAll(PDO::FETCH_ASSOC);

// Proses input data bidang_ilmu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    if ($_POST['type'] == 'tambah') {
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $stmt = $pdo->prepare("INSERT INTO bidang_ilmu (nama, deskripsi) VALUES (?, ?)");
        $stmt->execute([$nama, $deskripsi]);
        echo '<script>alert("Data bidang ilmu berhasil ditambah!");location.href="?url=bidang";</script>';
        exit;
    } elseif ($_POST['type'] == 'update') {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];
        $stmt = $pdo->prepare("UPDATE bidang_ilmu SET nama=?, deskripsi=? WHERE id=?");
        $stmt->execute([$nama, $deskripsi, $id]);
        echo '<script>alert("Data bidang ilmu berhasil diupdate!");location.href="?url=bidang";</script>';
        exit;
    } elseif ($_POST['type'] == 'delete') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM bidang_ilmu WHERE id=?");
        $stmt->execute([$id]);
        echo '<script>alert("Data bidang ilmu berhasil dihapus!");location.href="?url=bidang";</script>';
        exit;
    }
}

$bidangList = $pdo->query("SELECT * FROM bidang_ilmu")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="card">
        <div class="card-body">                       
            <!-- Tombol Tambah Bidang Ilmu -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-tambah-bidang">
                Tambah Bidang Ilmu
            </button>
            <!-- Modal Tambah Bidang Ilmu -->
            <div class="modal fade" id="modal-tambah-bidang">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Bidang Ilmu</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control"></textarea>
                                </div>
                                <input type="hidden" name="type" value="tambah">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Tabel Data Bidang Ilmu -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($bidangList as $bidang): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($bidang['nama']) ?></td>
                        <td><?= nl2br(htmlspecialchars($bidang['deskripsi'])) ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <!-- Tombol Edit -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $bidang['id'] ?>">Edit</button>
                                <!-- Tombol Delete -->
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $bidang['id'] ?>">
                                    <input type="hidden" name="type" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Edit Bidang Ilmu -->
                    <div class="modal fade" id="modal-edit-<?= $bidang['id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Bidang Ilmu</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($bidang['nama']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control"><?= htmlspecialchars($bidang['deskripsi']) ?></textarea>
                                        </div>
                                        <input type="hidden" name="id" value="<?= $bidang['id'] ?>">
                                        <input type="hidden" name="type" value="update">
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </tbody>
            </table>            
            <?php            
            ?>
        </div>
    </div>
</div>

