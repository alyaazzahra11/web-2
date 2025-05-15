<?php
$pdo = new PDO("mysql:host=localhost;dbname=dbkegiatan_dosen;charset=utf8mb4", "root", "");

// Proses input data prodi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    if ($_POST['type'] == 'tambah') {
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telpon = $_POST['telpon'];
        $ketua = $_POST['ketua'];

        // Pastikan kolom id tidak disertakan dalam query INSERT
        $stmt = $pdo->prepare("INSERT INTO prodi (kode, nama, alamat, telpon, ketua) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$kode, $nama, $alamat, $telpon, $ketua]);
        echo '<script>alert("Data prodi berhasil ditambah!");location.href="?url=prodi";</script>';
        exit;
    } elseif ($_POST['type'] == 'update') {
        $id = $_POST['id'];
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telpon = $_POST['telpon'];
        $ketua = $_POST['ketua'];
        $stmt = $pdo->prepare("UPDATE prodi SET kode=?, nama=?, alamat=?, telpon=?, ketua=? WHERE id=?");
        $stmt->execute([$kode, $nama, $alamat, $telpon, $ketua, $id]);
        echo '<script>alert("Data prodi berhasil diupdate!");location.href="?url=prodi";</script>';
        exit;
    } elseif ($_POST['type'] == 'delete') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM prodi WHERE id=?");
        $stmt->execute([$id]);
        echo '<script>alert("Data prodi berhasil dihapus!");location.href="?url=prodi";</script>';
        exit;
    }
}

$prodiList = $pdo->query("SELECT * FROM prodi")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <!-- Tombol Tambah Prodi -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-tambah-prodi">
                Tambah Prodi
            </button>
            <!-- Modal Tambah Prodi -->
            <div class="modal fade" id="modal-tambah-prodi">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Prodi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="kode">Kode</label>
                                    <input type="text" name="kode" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="telpon">Telpon</label>
                                    <input type="text" name="telpon" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ketua">Ketua</label>
                                    <input type="text" name="ketua" class="form-control">
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
            <!-- Tabel Data Prodi -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telpon</th>
                        <th>Ketua</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($prodiList as $prodi): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $prodi['kode'] ?></td>
                        <td><?= $prodi['nama'] ?></td>
                        <td><?= $prodi['alamat'] ?></td>
                        <td><?= $prodi['telpon'] ?></td>
                        <td><?= $prodi['ketua'] ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <!-- Tombol Edit -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $prodi['id'] ?>">Edit</button>
                                <!-- Tombol Delete -->
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $prodi['id'] ?>">
                                    <input type="hidden" name="type" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Edit Prodi -->
                    <div class="modal fade" id="modal-edit-<?= $prodi['id'] ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Prodi</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="kode">Kode</label>
                                            <input type="text" name="kode" class="form-control" value="<?= $prodi['kode'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control" value="<?= $prodi['nama'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" value="<?= $prodi['alamat'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="telpon">Telpon</label>
                                            <input type="text" name="telpon" class="form-control" value="<?= $prodi['telpon'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="ketua">Ketua</label>
                                            <input type="text" name="ketua" class="form-control" value="<?= $prodi['ketua'] ?>">
                                        </div>
                                        <input type="hidden" name="id" value="<?= $prodi['id'] ?>">
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
            
            <!-- Remove duplicate/incomplete modal and table code to prevent errors -->
            <?php
            // If you want to add more content, do it here.
            ?>
        </div>
    </div>
</div>

