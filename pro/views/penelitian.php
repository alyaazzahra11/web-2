<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Pastikan file model Penelitian ada di folder yang benar
$penelitianFile = __DIR__ . '/../Models/Penelitian.php';
if (file_exists($penelitianFile)) {
    require_once($penelitianFile);
} else {
    die('File Penelitian.php not found in Models directory.');
}
if (!class_exists('Penelitian')) {
    die('Class Penelitian not found. Please check the path and class definition in Models/Penelitian.php.');
}
$penelitian = new Penelitian();

// Ambil data bidang_ilmu untuk dropdown
$pdo = new PDO("mysql:host=localhost;dbname=dbkegiatan_dosen;charset=utf8mb4", "root", "");
$bidangIlmuList = $pdo->query("SELECT id, nama FROM bidang_ilmu")->fetchAll(PDO::FETCH_ASSOC);

// Handle form submissions before any HTML output
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
    if ($_POST['type'] == "tambah") {
        $data = [
            'judul' => $_POST['judul'],
            'mulai' => $_POST['mulai'],
            'akhir' => $_POST['akhir'],
            'tahun_ajaran' => $_POST['tahun_ajaran'],
            'bidang_ilmu_id' => $_POST['bidang_ilmu_id'],
        ];
        $penelitian->create($data);
        echo '<script>alert("tambah berhasil")</script><meta http-equiv="refresh" content="0; url=?url=penelitian">';
        exit;
    } elseif ($_POST['type'] == "update") {
        $data = [
            'judul' => $_POST['judul'],
            'mulai' => $_POST['mulai'],
            'akhir' => $_POST['akhir'],
            'tahun_ajaran' => $_POST['tahun_ajaran'],
            'bidang_ilmu_id' => $_POST['bidang_ilmu_id'],
        ];
        $penelitian->update($_POST['id'], $data);
        echo '<script>alert("update berhasil")</script><meta http-equiv="refresh" content="0; url=?url=penelitian">';
        exit;
    } elseif ($_POST['type'] == "delete") {
        $penelitian->delete($_POST['id']);
        echo '<script>alert("delete berhasil")</script><meta http-equiv="refresh" content="0; url=?url=penelitian">';
        exit;
    }
}
?>

<div class="container">
    <div class="card">
        <div class="card-body">
            <!-- Tombol Form Penelitian -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Tambah Penelitian
            </button>
            <!-- Modal Tambah Penelitian -->
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Penelitian</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <textarea name="judul" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="mulai">Tanggal Mulai</label>
                                    <input type="date" name="mulai" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="akhir">Tanggal Akhir</label>
                                    <input type="date" name="akhir" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tahun_ajaran">Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" class="form-control" maxlength="5">
                                </div>
                                <div class="form-group">
                                    <label for="bidang_ilmu_id">Bidang Ilmu</label>
                                    <select name="bidang_ilmu_id" class="form-control" required>
                                        <option value="">Pilih Bidang Ilmu</option>
                                        <?php foreach ($bidangIlmuList as $bi): ?>
                                            <option value="<?= $bi['id'] ?>"><?= $bi['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden" name="type" value="tambah">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Mulai</th>
                        <th>Akhir</th>
                        <th>Tahun Ajaran</th>
                        <th>Bidang Ilmu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row = $penelitian->index();
                    $nomor = 1;
                    foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= isset($item['judul']) ? $item['judul'] : '' ?></td>
                            <td><?= isset($item['mulai']) ? $item['mulai'] : '' ?></td>
                            <td><?= isset($item['akhir']) ? $item['akhir'] : '' ?></td>
                            <td><?= isset($item['tahun_ajaran']) ? $item['tahun_ajaran'] : '' ?></td>
                            <td>
                                <?php
                                $namaBidang = '';
                                foreach ($bidangIlmuList as $bi) {
                                    if ($bi['id'] == $item['bidang_ilmu_id']) {
                                        $namaBidang = $bi['nama'];
                                        break;
                                    }
                                }
                                echo $namaBidang;
                                ?>
                            </td>
                            <td>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="submit" value="delete" class="btn btn-danger btn-sm">
                                </form>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $item['id'] ?>">Edit</button>
                            </td>
                        </tr>
                        <!-- Modal Edit Penelitian -->
                        <div class="modal fade" id="modal-edit-<?= $item['id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Form Edit Penelitian</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="judul">Judul</label>
                                                <textarea name="judul" class="form-control" required><?= $item['judul'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="mulai">Tanggal Mulai</label>
                                                <input type="date" name="mulai" class="form-control" value="<?= $item['mulai'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="akhir">Tanggal Akhir</label>
                                                <input type="date" name="akhir" class="form-control" value="<?= $item['akhir'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                                <input type="text" name="tahun_ajaran" class="form-control" maxlength="5" value="<?= isset($item['tahun_ajaran']) ? htmlspecialchars($item['tahun_ajaran']) : '' ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="bidang_ilmu_id">Bidang Ilmu</label>
                                                <select name="bidang_ilmu_id" class="form-control" required>
                                                    <option value="">Pilih Bidang Ilmu</option>
                                                    <?php foreach ($bidangIlmuList as $bi): ?>
                                                        <option value="<?= $bi['id'] ?>" <?= (isset($item['bidang_ilmu_id']) && $item['bidang_ilmu_id'] == $bi['id']) ? 'selected' : '' ?>>
                                                            <?= $bi['nama'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="type" value="update">
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    <?php endforeach; ?>

                    <?php
                    // Handle file upload if form is submitted and file is present
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = __DIR__ . '/../uploads/';
                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0777, true);
                        }
                        $fileName = basename($_FILES['file_upload']['name']);
                        $targetFile = $uploadDir . $fileName;

                        if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $targetFile)) {
                            // Save file info to MySQL
                            $conn = new mysqli('localhost', 'root', '', 'your_database_name');
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $stmt = $conn->prepare("INSERT INTO uploads (file_name, file_path) VALUES (?, ?)");
                            $filePath = 'uploads/' . $fileName;
                            $stmt->bind_param("ss", $fileName, $filePath);
                            $stmt->execute();
                            $stmt->close();
                            $conn->close();
                            echo '<script>alert("File uploaded successfully.");</script>';
                        } else {
                            echo '<script>alert("File upload failed.");</script>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


