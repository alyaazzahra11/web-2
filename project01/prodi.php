<?php
include 'config/database.php';

// Tambah 
if (isset($_POST['tambah'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];
    $ketua = $_POST['ketua'];
    mysqli_query($conn, "INSERT INTO prodi (kode, nama, alamat, telpon, ketua) VALUES ('$kode','$nama','$alamat','$telpon','$ketua')");
}

// Edit data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];
    $ketua = $_POST['ketua'];
    mysqli_query($conn, "UPDATE prodi SET kode='$kode', nama='$nama', alamat='$alamat', telpon='$telpon', ketua='$ketua' WHERE id=$id");
    header("Location: prodi.php");
}

// Ambil data untuk edit
$edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM prodi WHERE id=$id");
    $edit = mysqli_fetch_assoc($result);
}

// Delete
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM prodi WHERE id=$id");
    header("Location: prodi.php");
}

// Ambil data
$data = mysqli_query($conn, "SELECT * FROM prodi");
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Data Prodi</h2>
            <div class="card mb-4">
                <div class="card-header">
                    <form method="POST" class="row g-2 align-items-center">
                        <?php if ($edit): ?>
                            <input type="hidden" name="id" value="<?= $edit['id'] ?>">
                        <?php endif; ?>
                        <div class="col">
                            <input type="text" name="kode" class="form-control" placeholder="Kode" required value="<?= $edit ? htmlspecialchars($edit['kode']) : '' ?>">
                        </div>
                        <div class="col">
                            <input type="text" name="nama" class="form-control" placeholder="Nama" required value="<?= $edit ? htmlspecialchars($edit['nama']) : '' ?>">
                        </div>
                        <div class="col">
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat" required value="<?= $edit ? htmlspecialchars($edit['alamat']) : '' ?>">
                        </div>
                        <div class="col">
                            <input type="text" name="telpon" class="form-control" placeholder="No Telepon" required value="<?= $edit ? htmlspecialchars($edit['telpon']) : '' ?>">
                        </div>
                        <div class="col">
                            <input type="text" name="ketua" class="form-control" placeholder="Ketua" required value="<?= $edit ? htmlspecialchars($edit['ketua']) : '' ?>">
                        </div>
                        <div class="col-auto">
                            <?php if ($edit): ?>
                                <button name="update" class="btn btn-success">Update</button>
                                <a href="prodi.php" class="btn btn-secondary">Batal</a>
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
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telpon</th>
                                    <th>Ketua</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($row['kode']) ?></td>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                                    <td><?= htmlspecialchars($row['telpon']) ?></td>
                                    <td><?= htmlspecialchars($row['ketua']) ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" href="?edit=<?= $row['id'] ?>">Edit</a>
                                        <a class="btn btn-sm btn-danger" href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php if (mysqli_num_rows($data) == 0): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Data prodi belum terdaftar.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'; ?>
