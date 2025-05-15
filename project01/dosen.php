<?php
include 'config/database.php';

// Tambah data
if (isset($_POST['tambah'])) {
    $nidn = $_POST['nidn'];
    $nama = $_POST['nama'];
    $gelar_belakang = $_POST['gelar_belakang'];
    $gelar_depan = $_POST['gelar_depan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $tahun_masuk = $_POST['tahun_masuk'];
    $prodi_id = $_POST['prodi_id'];

    mysqli_query($conn, "INSERT INTO dosen (nidn, nama, gelar_belakang, gelar_depan, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, email, tahun_masuk, prodi_id)
    VALUES ('$nidn','$nama','$gelar_belakang','$gelar_depan','$jenis_kelamin','$tempat_lahir','$tanggal_lahir','$alamat','$email','$tahun_masuk','$prodi_id')");
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nidn = $_POST['nidn'];
    $nama = $_POST['nama'];
    $gelar_belakang = $_POST['gelar_belakang'];
    $gelar_depan = $_POST['gelar_depan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $tahun_masuk = $_POST['tahun_masuk'];
    $prodi_id = $_POST['prodi_id'];

    mysqli_query($conn, "UPDATE dosen SET nidn='$nidn', nama='$nama', gelar_belakang='$gelar_belakang', gelar_depan='$gelar_depan', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat='$alamat', email='$email', tahun_masuk='$tahun_masuk', prodi_id='$prodi_id' WHERE id=$id");
    header("Location: dosen.php");
}

// Edit
$edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM dosen WHERE id=$id");
    $edit = mysqli_fetch_assoc($result);
}

// Delete
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM dosen WHERE id=$id");
    header("Location: dosen.php");
}

// Ambil data dosen
$data = mysqli_query($conn, "SELECT dosen.*, prodi.nama as nama_prodi FROM dosen 
                             LEFT JOIN prodi ON dosen.prodi_id = prodi.id");

// Ambil data prodi untuk dropdown
$prodi = mysqli_query($conn, "SELECT * FROM prodi");
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div id="layoutSidenav_content">
<div class="container-fluid px-4">
    <h2 class="mt-4">Data Dosen</h2>

    <!-- Form tambah/edit dosen -->
    <div class="card mb-4">
        <div class="card-header">
            <form method="POST" class="row g-2 align-items-center">
                <?php if ($edit): ?>
                    <input type="hidden" name="id" value="<?= $edit['id'] ?>">
                <?php endif; ?>
                <div class="col">
                    <input type="text" name="nidn" class="form-control" placeholder="NIDN" required value="<?= $edit ? htmlspecialchars($edit['nidn']) : '' ?>">
                </div>
                <div class="col">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required value="<?= $edit ? htmlspecialchars($edit['nama']) : '' ?>">
                </div>
                <div class="col">
                    <input type="text" name="gelar_depan" class="form-control" placeholder="G.Depan" value="<?= $edit ? htmlspecialchars($edit['gelar_depan']) : '' ?>">
                </div>
                <div class="col">
                    <input type="text" name="gelar_belakang" class="form-control" placeholder="G.Belakang" value="<?= $edit ? htmlspecialchars($edit['gelar_belakang']) : '' ?>">
                </div>
                <div class="col">
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">JK</option>
                        <option value="L" <?= $edit && $edit['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= $edit && $edit['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="col">
                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="<?= $edit ? htmlspecialchars($edit['tempat_lahir']) : '' ?>">
                </div>
                <div class="col">
                    <input type="date" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" value="<?= $edit ? htmlspecialchars($edit['tanggal_lahir']) : '' ?>">
                </div>
                <div class="col">
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?= $edit ? htmlspecialchars($edit['alamat']) : '' ?>">
                </div>
                <div class="col">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $edit ? htmlspecialchars($edit['email']) : '' ?>">
                </div>
                <div class="col">
                    <input type="text" name="tahun_masuk" class="form-control" placeholder="Tahun Masuk" value="<?= $edit ? htmlspecialchars($edit['tahun_masuk']) : '' ?>">
                </div>
                <div class="col">
                    <select name="prodi_id" class="form-select" required>
                        <option value="">Prodi</option>
                        <?php mysqli_data_seek($prodi, 0); while ($p = mysqli_fetch_assoc($prodi)) { ?>
                            <option value="<?= $p['id'] ?>" <?= $edit && $edit['prodi_id'] == $p['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nama']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-auto">
                    <?php if ($edit): ?>
                        <button name="update" class="btn btn-success">Update</button>
                        <a href="dosen.php" class="btn btn-secondary">Batal</a>
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
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Gelar Depan</th>
                            <th>Gelar Belakang</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Tahun Masuk</th>
                            <th>Prodi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nidn']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['gelar_depan']) ?></td>
                            <td><?= htmlspecialchars($row['gelar_belakang']) ?></td>
                            <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                            <td><?= htmlspecialchars($row['tempat_lahir']) ?>, <?= htmlspecialchars($row['tanggal_lahir']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['tahun_masuk']) ?></td>
                            <td><?= htmlspecialchars($row['nama_prodi']) ?></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="?edit=<?= $row['id'] ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (mysqli_num_rows($data) == 0): ?>
                        <tr>
                            <td colspan="12" class="text-center">Data dosen belum terdaftar.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

