<?php
$pdo = new PDO("mysql:host=localhost;dbname=dbkegiatan_dosen;charset=utf8mb4", "root", "");
$dosenList = $pdo->query("SELECT * FROM dosen")->fetchAll(PDO::FETCH_ASSOC);
$penelitianList = $pdo->query("SELECT id FROM penelitian")->fetchAll(PDO::FETCH_ASSOC);
$kategoriList = $pdo->query("SELECT * FROM kategori")->fetchAll(PDO::FETCH_ASSOC);

// Menambahkan logika CRUD untuk tabel baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    if ($_POST['type'] == 'tambah') {
        $dosen_id = $_POST['dosen_id'];
        $penelitian_id = $_POST['penelitian_id'];
        $peran = $_POST['peran'];
        $stmt = $pdo->prepare("INSERT INTO tim_penelitian (dosen_id, penelitian_id, peran) VALUES (?, ?, ?)");
        $stmt->execute([$dosen_id, $penelitian_id, $peran]);
        echo '<script>alert("Data tim penelitian berhasil ditambah!");location.href="?url=tim_penelitian";</script>';
        exit;
    } elseif ($_POST['type'] == 'update') {
        $id = $_POST['id'];
        $dosen_id = $_POST['dosen_id'];
        $penelitian_id = $_POST['penelitian_id'];
        $peran = $_POST['peran'];
        $stmt = $pdo->prepare("UPDATE tim_penelitian SET dosen_id=?, penelitian_id=?, peran=? WHERE id=?");
        $stmt->execute([$dosen_id, $penelitian_id, $peran, $id]);
        echo '<script>alert("Data tim penelitian berhasil diupdate!");location.href="?url=tim_penelitian";</script>';
        exit;
    } elseif ($_POST['type'] == 'delete') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM tim_penelitian WHERE id=?");
        $stmt->execute([$id]);
        echo '<script>alert("Data tim penelitian berhasil dihapus!");location.href="?url=tim_penelitian";</script>';
        exit;
    }
}

$timPenelitianList = $pdo->query(
    "SELECT tp.*, d.nama AS dosen_nama, k.nama AS kategori_nama 
     FROM tim_penelitian tp
     JOIN dosen d ON tp.dosen_id = d.id
     JOIN penelitian p ON tp.penelitian_id = p.id
     JOIN kategori k ON p.kategori_id = k.id"
)->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="card">
        <div class="card-body">                       
                        <!-- Tombol Tambah Tim Penelitian -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-tambah-tim">
                Tambah Tim Penelitian
            </button>
            <!-- Modal Tambah Tim Penelitian -->
            <div class="modal fade" id="modal-tambah-tim">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Tim Penelitian</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="dosen_id">Dosen ID</label>
                                    <select name="dosen_id" class="form-control" required>
                                        <option value="">Pilih Dosen</option>
                                        <?php foreach ($dosenList as $dosen): ?>
                                            <option value="<?= $dosen['id'] ?>" <?= (isset($item['dosen_id']) && $item['dosen_id'] == $dosen['id']) ? 'selected' : '' ?>>
                                                <?= $dosen['nama'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="penelitian_id">Penelitian ID</label>
                                    <select name="penelitian_id" class="form-control" required>
                                        <option value="">Pilih Penelitian</option>
                                        <?php foreach ($penelitianList as $penelitian): ?>
                                            <option value="<?= $penelitian['id'] ?>" <?= (isset($item['penelitian_id']) && $item['penelitian_id'] == $penelitian['id']) ? 'selected' : '' ?>>
                                                <?= $penelitian['id'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="peran">Peran</label>
                                    <input type="text" name="peran" class="form-control">
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
            <!-- Tabel Data Tim Penelitian -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dosen</th>
                        <th>Penelitian ID</th>
                        <th>Kategori</th>
                        <th>Peran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($timPenelitianList as $tim): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($tim['dosen_nama']) ?></td>
                        <td><?= htmlspecialchars($tim['penelitian_id']) ?></td>
                        <td><?= htmlspecialchars($tim['kategori_nama']) ?></td>
                        <td><?= htmlspecialchars($tim['peran']) ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <!-- Tombol Edit -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $tim['id'] ?>">Edit</button>
                                <!-- Tombol Delete -->
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $tim['id'] ?>">
                                    <input type="hidden" name="type" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Edit Tim Penelitian -->
                    <div class="modal fade" id="modal-edit-<?= $tim['id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Tim Penelitian</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="dosen_id">Dosen</label>
                                            <select name="dosen_id" class="form-control" required>
                                                <?php foreach ($dosenList as $dosen): ?>
                                                    <option value="<?= $dosen['id'] ?>" <?= ($tim['dosen_id'] == $dosen['id']) ? 'selected' : '' ?>>
                                                        <?= $dosen['nama'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="penelitian_id">Penelitian ID</label>
                                            <input type="number" name="penelitian_id" class="form-control" value="<?= htmlspecialchars($tim['penelitian_id']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="peran">Peran</label>
                                            <input type="text" name="peran" class="form-control" value="<?= htmlspecialchars($tim['peran']) ?>">
                                        </div>
                                        <input type="hidden" name="id" value="<?= $tim['id'] ?>">
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
        </div>
    </div>
</div>