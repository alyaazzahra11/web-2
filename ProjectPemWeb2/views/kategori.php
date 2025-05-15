<?php
require_once __DIR__ . '/../Models/kegiatan.php';
$kegiatan = new Kegiatan();

// Ambil data jenis kegiatan untuk dropdown
$pdo = new PDO("mysql:host=localhost;dbname=dbkegiatan_dosen;charset=utf8mb4", "root", "");
$jenisKegiatanList = $pdo->query("SELECT id, nama FROM jenis_kegiatan")->fetchAll(PDO::FETCH_ASSOC);

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    if ($_POST['type'] == "tambah") {
        $data = [
            'tanggal_mulai' => $_POST['tanggal_mulai'],
            'tanggal_selesai' => $_POST['tanggal_selesai'],
            'tempat' => $_POST['tempat'],
            'deskripsi' => $_POST['deskripsi'],
            'jenis_kegiatan_id' => $_POST['jenis_kegiatan_id'],
        ];
        $kegiatan->create($data);
        echo '<script>alert("Tambah berhasil");location.href="?url=kegiatan";</script>';
        exit;
    } elseif ($_POST['type'] == "delete") {
        $kegiatan->delete($_POST['id']);
        echo '<script>alert("Hapus berhasil");location.href="?url=kegiatan";</script>';
        exit;
    } elseif ($_POST['type'] == "update") {
        $data = [
            'tanggal_mulai' => $_POST['tanggal_mulai'],
            'tanggal_selesai' => $_POST['tanggal_selesai'],
            'tempat' => $_POST['tempat'],
            'deskripsi' => $_POST['deskripsi'],
            'jenis_kegiatan_id' => $_POST['jenis_kegiatan_id'],
        ];
        $kegiatan->update($_POST['id'], $data);
        echo '<script>alert("Update berhasil");location.href="?url=kegiatan";</script>';
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type']) && $_POST['type'] == "tambah_kategori") {
    $nama = $_POST['nama_kategori'];
    $stmt = $pdo->prepare("INSERT INTO jenis_kegiatan (nama) VALUES (?)");
    $stmt->execute([$nama]);
    echo '<script>alert("Kategori berhasil ditambah!");location.href="?url=kategori";</script>';
    exit;
}

$data = $kegiatan->index();
?>

<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Daftar Kegiatan</h4>
        </div>
        <div class="card-body">
            <!-- Tombol Tambah Kegiatan -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-tambah">
                Tambah Kegiatan
            </button>
            <!-- Tombol Tambah Kategori -->
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-tambah-kategori">
                Tambah Kategori Kegiatan
            </button>
            <!-- Modal Tambah Kegiatan -->
            <div class="modal fade" id="modal-tambah">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Kegiatan</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="tanggal_mulai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" name="tanggal_selesai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tempat</label>
                                    <input type="text" name="tempat" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kegiatan</label>
                                    <select name="jenis_kegiatan_id" class="form-control" required>
                                        <option value="">Pilih Jenis Kegiatan</option>
                                        <?php foreach ($jenisKegiatanList as $jk): ?>
                                            <option value="<?= $jk['id'] ?>"><?= $jk['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" name="type" value="tambah">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Tambah Kategori -->
            <div class="modal fade" id="modal-tambah-kategori">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Kategori Kegiatan</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input type="text" name="nama_kategori" class="form-control" required placeholder="Contoh: Seminar, Pelatihan, Pengabdian Masyarakat">
                                </div>
                                <input type="hidden" name="type" value="tambah_kategori">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Tabel Data Kegiatan -->
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Tempat</th>
                        <th>Deskripsi</th>
                        <th>Jenis Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($data as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['tanggal_mulai'] ?></td>
                        <td><?= $row['tanggal_selesai'] ?></td>
                        <td><?= $row['tempat'] ?></td>
                        <td><?= $row['deskripsi'] ?></td>
                        <td>
                            <?php
                            $namaJenis = '';
                            foreach ($jenisKegiatanList as $jk) {
                                if ($jk['id'] == $row['jenis_kegiatan_id']) {
                                    $namaJenis = $jk['nama'];
                                    break;
                                }
                            }
                            echo $namaJenis;
                            ?>
                        </td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="type" value="delete">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $row['id'] ?>">Edit</button>
                        </td>
                    </tr>

                    <!-- Modal Edit Kegiatan -->
                    <div class="modal fade" id="modal-edit-<?= $row['id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Kegiatan</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Tanggal Mulai</label>
                                            <input type="date" name="tanggal_mulai" class="form-control" value="<?= $row['tanggal_mulai'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Selesai</label>
                                            <input type="date" name="tanggal_selesai" class="form-control" value="<?= $row['tanggal_selesai'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat</label>
                                            <input type="text" name="tempat" class="form-control" value="<?= htmlspecialchars($row['tempat']) ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control"><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kegiatan</label>
                                            <select name="jenis_kegiatan_id" class="form-control" required>
                                                <option value="">Pilih Jenis Kegiatan</option>
                                                <?php foreach ($jenisKegiatanList as $jk): ?>
                                                    <option value="<?= $jk['id'] ?>" <?= ($jk['id'] == $row['jenis_kegiatan_id']) ? 'selected' : '' ?>>
                                                        <?= $jk['nama'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="hidden" name="type" value="update">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                </tbody>
            </table>
            <h5 class="mt-4">Daftar Kategori Kegiatan</h5>
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($jenisKegiatanList as $jk): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $jk['nama'] ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>