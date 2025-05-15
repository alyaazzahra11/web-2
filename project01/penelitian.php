<?php
include 'config/database.php';

// Tambah
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $mulai = $_POST['mulai'];
    $akhir = $_POST['akhir'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $bidang_ilmu_id = $_POST['bidang_ilmu_id'];

    mysqli_query($conn, "INSERT INTO penelitian (judul, mulai, akhir, tahun_ajaran, bidang_ilmu_id)
                         VALUES ('$judul', '$mulai', '$akhir', '$tahun_ajaran', '$bidang_ilmu_id')");
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $mulai = $_POST['mulai'];
    $akhir = $_POST['akhir'];
    $tahun_ajaran = $_POST['tahun_ajaran'];
    $bidang_ilmu_id = $_POST['bidang_ilmu_id'];

    mysqli_query($conn, "UPDATE penelitian SET judul='$judul', mulai='$mulai', akhir='$akhir', tahun_ajaran='$tahun_ajaran', bidang_ilmu_id='$bidang_ilmu_id' WHERE id=$id");
    header("Location: penelitian.php");
}

// Edit
$edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM penelitian WHERE id=$id");
    $edit = mysqli_fetch_assoc($result);
}

// Delete
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM penelitian WHERE id=$id");
    header("Location: penelitian.php");
}

// Ambil data penelitian dengan nama bidang ilmu
$data = mysqli_query($conn, "SELECT p.*, b.nama AS nama_bidang 
                             FROM penelitian p 
                             LEFT JOIN bidang_ilmu b ON p.bidang_ilmu_id = b.id");

// Ambil data bidang ilmu untuk dropdown
$bidang_ilmu = mysqli_query($conn, "SELECT * FROM bidang_ilmu");
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<div id="layoutSidenav_content">
<div class="container-fluid px-4">
    <h2 class="mt-4">Data Penelitian</h2>

    <!-- Form tambah/edit penelitian -->
    <div class="card mb-4">
        <div class="card-header">
            <form method="POST" class="row g-2 align-items-center">
                <?php if ($edit): ?>
                    <input type="hidden" name="id" value="<?= $edit['id'] ?>">
                <?php endif; ?>
                <div class="col">
                    <textarea name="judul" class="form-control" placeholder="Judul Penelitian" required><?= $edit ? htmlspecialchars($edit['judul']) : '' ?></textarea>
                </div>
                <div class="col">
                    <input type="date" name="mulai" class="form-control" placeholder="Mulai" required value="<?= $edit ? htmlspecialchars($edit['mulai']) : '' ?>">
                </div>
                <div class="col">
                    <input type="date" name="akhir" class="form-control" placeholder="Selesai" required value="<?= $edit ? htmlspecialchars($edit['akhir']) : '' ?>">
                </div>
                <div class="col">
                    <input type="text" name="tahun_ajaran" class="form-control" placeholder="Tahun Ajaran" required value="<?= $edit ? htmlspecialchars($edit['tahun_ajaran']) : '' ?>">
                </div>
                <div class="col">
                    <select name="bidang_ilmu_id" class="form-select" required>
                        <option value="">Bidang Ilmu</option>
                        <?php mysqli_data_seek($bidang_ilmu, 0); while ($b = mysqli_fetch_assoc($bidang_ilmu)) { ?>
                            <option value="<?= $b['id'] ?>" <?= $edit && $edit['bidang_ilmu_id'] == $b['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($b['nama']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-auto">
                    <?php if ($edit): ?>
                        <button name="update" class="btn btn-success">Update</button>
                        <a href="penelitian.php" class="btn btn-secondary">Batal</a>
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
                            <th>Judul</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Tahun Ajaran</th>
                            <th>Bidang Ilmu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['judul']) ?></td>
                            <td><?= htmlspecialchars($row['mulai']) ?></td>
                            <td><?= htmlspecialchars($row['akhir']) ?></td>
                            <td><?= htmlspecialchars($row['tahun_ajaran']) ?></td>
                            <td><?= htmlspecialchars($row['nama_bidang']) ?></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="?edit=<?= $row['id'] ?>">Edit</a>
                                <a class="btn btn-sm btn-danger" href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if (mysqli_num_rows($data) == 0): ?>
                        <tr>
                            <td colspan="7" class="text-center">Data penelitian belum terdaftar.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
