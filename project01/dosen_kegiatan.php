<?php
include 'config/database.php';

// Tambah
if (isset($_POST['tambah'])) {
    $dosen_id = $_POST['dosen_id'];
    $kegiatan_id = $_POST['kegiatan_id'];
    mysqli_query($conn, "INSERT INTO dosen_kegiatan (dosen_id, kegiatan_id) VALUES ('$dosen_id', '$kegiatan_id')");
}

// Update
if (isset($_POST['update'])) {
    $old_dosen_id = $_POST['old_dosen_id'];
    $old_kegiatan_id = $_POST['old_kegiatan_id'];
    $dosen_id = $_POST['dosen_id'];
    $kegiatan_id = $_POST['kegiatan_id'];
    mysqli_query($conn, "UPDATE dosen_kegiatan SET dosen_id='$dosen_id', kegiatan_id='$kegiatan_id' WHERE dosen_id='$old_dosen_id' AND kegiatan_id='$old_kegiatan_id'");
    header("Location: dosen_kegiatan.php");
}

// Edit
$edit = null;
if (isset($_GET['edit'])) {
    $dosen_id = $_GET['dosen_id'];
    $kegiatan_id = $_GET['kegiatan_id'];
    $result = mysqli_query($conn, "SELECT * FROM dosen_kegiatan WHERE dosen_id=$dosen_id AND kegiatan_id=$kegiatan_id");
    $edit = mysqli_fetch_assoc($result);
}

// Delete
if (isset($_GET['hapus'])) {
    $dosen_id = $_GET['dosen_id'];
    $kegiatan_id = $_GET['kegiatan_id'];
    mysqli_query($conn, "DELETE FROM dosen_kegiatan WHERE dosen_id = $dosen_id AND kegiatan_id = $kegiatan_id");
    header("Location: dosen_kegiatan.php");
}

// Ambil data relasi
$data = mysqli_query($conn, "SELECT dk.dosen_id, dk.kegiatan_id, d.nama AS nama_dosen, k.deskripsi AS nama_kegiatan 
                             FROM dosen_kegiatan dk
                             JOIN dosen d ON dk.dosen_id = d.id
                             JOIN kegiatan k ON dk.kegiatan_id = k.id");

// Ambil data untuk dropdown
$dosen = mysqli_query($conn, "SELECT * FROM dosen");
$kegiatan = mysqli_query($conn, "SELECT * FROM kegiatan");
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div id="layoutSidenav_content">
<div class="container-fluid px-4">
    <h2 class="mt-4">Kegiatan Dosen</h2>

    <!-- Form tambah/edit relasi -->
    <div class="card mb-4">
        <div class="card-header">
            <form method="POST" class="row g-2 align-items-center">
                <?php if ($edit): ?>
                    <input type="hidden" name="old_dosen_id" value="<?= $edit['dosen_id'] ?>">
                    <input type="hidden" name="old_kegiatan_id" value="<?= $edit['kegiatan_id'] ?>">
                <?php endif; ?>
                <div class="col">
                    <select name="dosen_id" class="form-select" required>
                        <option value="">Dosen</option>
                        <?php mysqli_data_seek($dosen, 0); while ($d = mysqli_fetch_assoc($dosen)) { ?>
                            <option value="<?= $d['id'] ?>" <?= $edit && $edit['dosen_id'] == $d['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($d['nama']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <select name="kegiatan_id" class="form-select" required>
                        <option value="">Kegiatan</option>
                        <?php mysqli_data_seek($kegiatan, 0); while ($k = mysqli_fetch_assoc($kegiatan)) { ?>
                            <option value="<?= $k['id'] ?>" <?= $edit && $edit['kegiatan_id'] == $k['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($k['deskripsi']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-auto">
                    <?php if ($edit): ?>
                        <button name="update" class="btn btn-success">Update</button>
                        <a href="dosen_kegiatan.php" class="btn btn-secondary">Batal</a>
                    <?php else: ?>
                        <button name="tambah" class="btn btn-primary">Create</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Dosen</th>
                            <th>Kegiatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama_dosen']) ?></td>
                            <td><?= htmlspecialchars($row['nama_kegiatan']) ?></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="?edit=1&dosen_id=<?= $row['dosen_id'] ?>&kegiatan_id=<?= $row['kegiatan_id'] ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="?hapus=1&dosen_id=<?= $row['dosen_id'] ?>&kegiatan_id=<?= $row['kegiatan_id'] ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if ($no == 1): ?>
                        <tr>
                            <td colspan="4" class="text-center">Data kegiatan dosen belum terdaftar.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
