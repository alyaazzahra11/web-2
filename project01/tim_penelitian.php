<?php
include 'config/database.php';

// Tambah
if (isset($_POST['tambah'])) {
    $penelitian_id = $_POST['penelitian_id'];
    $dosen_id = $_POST['dosen_id'];
    $peran = $_POST['peran'];
    mysqli_query($conn, "INSERT INTO tim_penelitian (penelitian_id, dosen_id, peran) VALUES ('$penelitian_id', '$dosen_id', '$peran')");
}

// Update
if (isset($_POST['update'])) {
    $old_penelitian_id = $_POST['old_penelitian_id'];
    $old_dosen_id = $_POST['old_dosen_id'];
    $penelitian_id = $_POST['penelitian_id'];
    $dosen_id = $_POST['dosen_id'];
    $peran = $_POST['peran'];
    mysqli_query($conn, "UPDATE tim_penelitian SET penelitian_id='$penelitian_id', dosen_id='$dosen_id', peran='$peran' WHERE penelitian_id='$old_penelitian_id' AND dosen_id='$old_dosen_id'");
    header("Location: tim_penelitian.php");
}

// Ambil data untuk edit
$edit = null;
if (isset($_GET['edit'])) {
    $penelitian_id = $_GET['penelitian_id'];
    $dosen_id = $_GET['dosen_id'];
    $result = mysqli_query($conn, "SELECT * FROM tim_penelitian WHERE penelitian_id=$penelitian_id AND dosen_id=$dosen_id");
    $edit = mysqli_fetch_assoc($result);
}

// Hapus relasi tim
if (isset($_GET['hapus'])) {
    $penelitian_id = $_GET['penelitian_id'];
    $dosen_id = $_GET['dosen_id'];
    mysqli_query($conn, "DELETE FROM tim_penelitian WHERE penelitian_id=$penelitian_id AND dosen_id=$dosen_id");
    header("Location: tim_penelitian.php");
}

// Ambil data tim dengan relasi dosen dan penelitian
$data = mysqli_query($conn, "SELECT tp.*, d.nama AS nama_dosen, p.judul AS judul_penelitian
                             FROM tim_penelitian tp
                             LEFT JOIN dosen d ON tp.dosen_id = d.id
                             LEFT JOIN penelitian p ON tp.penelitian_id = p.id");

// Ambil data dosen dan penelitian untuk dropdown
$dosen = mysqli_query($conn, "SELECT * FROM dosen");
$penelitian = mysqli_query($conn, "SELECT * FROM penelitian");
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div id="layoutSidenav_content">
<div class="container-fluid px-4">
    <h2 class="mt-4">Tim Penelitian</h2>

    <!-- Form tambah/edit tim penelitian -->
    <div class="card mb-4">
        <div class="card-header">
            <form method="POST" class="row g-2 align-items-center">
                <?php if ($edit): ?>
                    <input type="hidden" name="old_penelitian_id" value="<?= $edit['penelitian_id'] ?>">
                    <input type="hidden" name="old_dosen_id" value="<?= $edit['dosen_id'] ?>">
                <?php endif; ?>
                <div class="col">
                    <select name="penelitian_id" class="form-select" required>
                        <option value="">Pilih Judul Penelitian</option>
                        <?php
                        mysqli_data_seek($penelitian, 0);
                        while ($p = mysqli_fetch_assoc($penelitian)) { ?>
                            <option value="<?= $p['id'] ?>" <?= $edit && $edit['penelitian_id'] == $p['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['judul']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <select name="dosen_id" class="form-select" required>
                        <option value="">Pilih Dosen</option>
                        <?php
                        mysqli_data_seek($dosen, 0);
                        while ($d = mysqli_fetch_assoc($dosen)) { ?>
                            <option value="<?= $d['id'] ?>" <?= $edit && $edit['dosen_id'] == $d['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($d['nama']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <input type="text" name="peran" class="form-control" placeholder="Peran (contoh: Ketua, Anggota)" required value="<?= $edit ? htmlspecialchars($edit['peran']) : '' ?>">
                </div>
                <div class="col-auto">
                    <?php if ($edit): ?>
                        <button name="update" class="btn btn-success">Update</button>
                        <a href="tim_penelitian.php" class="btn btn-secondary">Batal</a>
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
                            <th>Judul Penelitian</th>
                            <th>Nama Dosen</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['judul_penelitian']) ?></td>
                            <td><?= htmlspecialchars($row['nama_dosen']) ?></td>
                            <td><?= htmlspecialchars($row['peran']) ?></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="?edit=1&penelitian_id=<?= $row['penelitian_id'] ?>&dosen_id=<?= $row['dosen_id'] ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="?hapus=1&penelitian_id=<?= $row['penelitian_id'] ?>&dosen_id=<?= $row['dosen_id'] ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if ($no == 1): ?>
                        <tr>
                            <td colspan="5" class="text-center">Tim penelitian belum terdaftar.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
