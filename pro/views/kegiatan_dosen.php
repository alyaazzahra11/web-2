<?php
$pdo = new PDO("mysql:host=localhost;dbname=dbkegiatan_dosen;charset=utf8mb4", "root", "");

// Ambil data dosen dan kegiatan untuk dropdown
$dosenList = $pdo->query("SELECT id, nama FROM dosen")->fetchAll(PDO::FETCH_ASSOC);
$kegiatanList = $pdo->query("SELECT id, deskripsi FROM kegiatan")->fetchAll(PDO::FETCH_ASSOC);

// Proses input data kegiatan_dosen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    if ($_POST['type'] == 'tambah') {
        $dosen = $_POST['dosen_id'];
        $kegiatan = $_POST['kegiatan_id'];
        $stmt = $pdo->prepare("INSERT INTO kegiatan_dosen (dosen_id, kegiatan_id) VALUES (?, ?)");
        $stmt->execute([$dosen, $kegiatan]);
        echo '<script>alert("Data kegiatan dosen berhasil ditambah!");location.href="?url=kegiatan_dosen";</script>';
        exit;
    } elseif ($_POST['type'] == 'update') {
        $id = $_POST['id'];
        $dosen = $_POST['dosen_id'];
        $kegiatan = $_POST['kegiatan_id'];
        $stmt = $pdo->prepare("UPDATE kegiatan_dosen SET dosen_id=?, kegiatan_id=? WHERE id=?");
        $stmt->execute([$dosen, $kegiatan, $id]);
        echo '<script>alert("Data kegiatan dosen berhasil diupdate!");location.href="?url=kegiatan_dosen";</script>';
        exit;
    } elseif ($_POST['type'] == 'delete') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM kegiatan_dosen WHERE id=?");
        $stmt->execute([$id]);
        echo '<script>alert("Data kegiatan dosen berhasil dihapus!");location.href="?url=kegiatan_dosen";</script>';
        exit;
    }
}

$kegiatanDosenList = $pdo->query("SELECT kd.id, d.nama AS dosen, k.deskripsi AS kegiatan FROM kegiatan_dosen kd JOIN dosen d ON kd.dosen_id = d.id JOIN kegiatan k ON kd.kegiatan_id = k.id")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="card">
        <div class="card-body">                       
            <!-- Tombol Tambah Kegiatan Dosen -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-tambah-kegiatan_dosen">
                Tambah Kegiatan Dosen
            </button>
            <!-- Modal Tambah Kegiatan Dosen -->
            <div class="modal fade" id="modal-tambah-kegiatan_dosen">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Kegiatan Dosen</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="dosen_id">Dosen</label>
                                    <select name="dosen_id" class="form-control" required>
                                        <option value="">Pilih Dosen</option>
                                        <?php foreach ($dosenList as $dosen): ?>
                                            <option value="<?= $dosen['id'] ?>"><?= htmlspecialchars($dosen['nama']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kegiatan_id">Kegiatan</label>
                                    <select name="kegiatan_id" class="form-control" required>
                                        <option value="">Pilih Kegiatan</option>
                                        <?php foreach ($kegiatanList as $kegiatan): ?>
                                            <option value="<?= $kegiatan['id'] ?>"><?= htmlspecialchars($kegiatan['deskripsi']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
            <!-- Tabel Data Kegiatan Dosen -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dosen</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($kegiatanDosenList as $kegiatanDosen): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($kegiatanDosen['dosen']) ?></td>
                        <td><?= htmlspecialchars($kegiatanDosen['kegiatan']) ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <!-- Tombol Edit -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $kegiatanDosen['id'] ?>">Edit</button>
                                <!-- Tombol Delete -->
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $kegiatanDosen['id'] ?>">
                                    <input type="hidden" name="type" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Edit Kegiatan Dosen -->
                    <div class="modal fade" id="modal-edit-<?= $kegiatanDosen['id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Kegiatan Dosen</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="dosen_id">Dosen</label>
                                            <select name="dosen_id" class="form-control" required>
                                                <?php foreach ($dosenList as $dosen): ?>
                                                    <option value="<?= $dosen['id'] ?>" <?= $dosen['id'] == $kegiatanDosen['dosen_id'] ? 'selected' : '' ?>><?= htmlspecialchars($dosen['nama']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kegiatan_id">Kegiatan</label>
                                            <select name="kegiatan_id" class="form-control" required>
                                                <?php foreach ($kegiatanList as $kegiatan): ?>
                                                    <option value="<?= $kegiatan['id'] ?>" <?= $kegiatan['id'] == $kegiatanDosen['kegiatan_id'] ? 'selected' : '' ?>><?= htmlspecialchars($kegiatan['deskripsi']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="id" value="<?= $kegiatanDosen['id'] ?>">
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

