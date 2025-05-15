<?php
$pdo = new PDO("mysql:host=localhost;dbname=dbkegiatan_dosen;charset=utf8mb4", "root", "");
$prodiList = $pdo->query("SELECT id, nama FROM prodi")->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Form Dosen
            </button>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Dosen</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nidn">NIDN</label>
                                    <input type="text" name="nidn" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="gelar_depan">Gelar Depan</label>
                                    <input type="text" name="gelar_depan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="gelar_belakang">Gelar Belakang</label>
                                    <input type="text" name="gelar_belakang" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tahun_masuk">Tahun Masuk</label>
                                    <input type="number" name="tahun_masuk" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="prodi_id">Program Studi</label>
                                    <select name="prodi_id" class="form-control" required>
                                        <option value="">Pilih Prodi</option>
                                        <?php foreach ($prodiList as $prodi): ?>
                                            <option value="<?= $prodi['id'] ?>" <?= (isset($item['prodi_id']) && $item['prodi_id'] == $prodi['id']) ? 'selected' : '' ?>>
                                                <?= $prodi['nama'] ?>
                                            </option>
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
                        <th>NIDN</th>
                        <th>Nama</th>
                        <th>Gelar Depan</th>
                        <th>Gelar Belakang</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Tahun Masuk</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("Controllers/Dosen.php");

                    // Handle form submissions before any HTML output
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
                        if ($_POST['type'] == "tambah") {
                            $data = [                                
                                'nidn' => $_POST['nidn'],
                                'nama' => $_POST['nama'],
                                'gelar_depan' => $_POST['gelar_depan'],
                                'gelar_belakang' => $_POST['gelar_belakang'],
                                'jenis_kelamin' => $_POST['jenis_kelamin'],
                                'tempat_lahir' => $_POST['tempat_lahir'],
                                'tanggal_lahir' => $_POST['tanggal_lahir'],
                                'alamat' => $_POST['alamat'],
                                'email' => $_POST['email'],
                                'tahun_masuk' => $_POST['tahun_masuk'],
                                'prodi_id' => $_POST['prodi_id'],                                
                            ];
                            $dosen->create($data);
                            echo '<script>alert("tambah berhasil")</script><meta http-equiv="refresh" content="0; url=?url=dosen">';
                            exit;
                        } elseif ($_POST['type'] == "update") {
                            $data = [
                                'nidn' => $_POST['nidn'],
                                'nama' => $_POST['nama'],
                                'gelar_depan' => $_POST['gelar_depan'],
                                'gelar_belakang' => $_POST['gelar_belakang'],
                                'jenis_kelamin' => $_POST['jenis_kelamin'],
                                'tempat_lahir' => $_POST['tempat_lahir'],
                                'tanggal_lahir' => $_POST['tanggal_lahir'],
                                'alamat' => $_POST['alamat'],
                                'email' => $_POST['email'],
                                'tahun_masuk' => $_POST['tahun_masuk'],
                                'prodi_id' => $_POST['prodi_id'],
                            ];
                            $dosen->update($_POST['id'], $data);
                            echo '<script>alert("update berhasil")</script><meta http-equiv="refresh" content="0; url=?url=dosen">';
                            exit;
                        } elseif ($_POST['type'] == "delete") {
                            $dosen->delete($_POST['id']);
                            echo '<script>alert("delete berhasil")</script><meta http-equiv="refresh" content="0; url=?url=dosen">';
                            exit;
                        }
                    }

                    $row = $dosen->index();
                    $nomor = 1;
                    foreach ($row as $item):
                    ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= isset($item['nidn']) ? $item['nidn'] : '' ?></td>
                            <td><?= isset($item['nama']) ? $item['nama'] : '' ?></td>
                            <td><?= isset($item['gelar_depan']) ? $item['gelar_depan'] : '' ?></td>
                            <td><?= isset($item['gelar_belakang']) ? $item['gelar_belakang'] : '' ?></td>
                            <td><?= isset($item['jenis_kelamin']) ? $item['jenis_kelamin'] : '' ?></td>
                            <td><?= isset($item['tempat_lahir']) ? $item['tempat_lahir'] : '' ?></td>
                            <td><?= isset($item['tanggal_lahir']) ? $item['tanggal_lahir'] : '' ?></td>
                            <td><?= isset($item['alamat']) ? $item['alamat'] : '' ?></td>
                            <td><?= isset($item['email']) ? $item['email'] : '' ?></td>
                            <td><?= isset($item['tahun_masuk']) ? $item['tahun_masuk'] : '' ?></td>
                            <td><?= isset($item['prodi_id']) ? $item['prodi_id'] : '' ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                        <input type="hidden" name="type" value="delete">
                                        <input type="submit" value="delete" class="btn btn-danger btn-sm">
                                    </form>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit-<?= $item['id'] ?>">Edit</button>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-edit-<?= $item['id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Form Edit Data Dosen</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nidn">NIDN</label>
                                                <input type="text" name="nidn" class="form-control" value="<?= $item['nidn'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" class="form-control" value="<?= $item['nama'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="gelar_depan">Gelar Depan</label>
                                                <input type="text" name="gelar_depan" class="form-control" value="<?= $item['gelar_depan'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="gelar_belakang">Gelar Belakang</label>
                                                <input type="text" name="gelar_belakang" class="form-control" value="<?= $item['gelar_belakang'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                                <select name="jenis_kelamin" class="form-control">
                                                    <option value="">Pilih</option>
                                                    <option value="L" <?= $item['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                                    <option value="P" <?= $item['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="form-control" value="<?= $item['tempat_lahir'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" class="form-control" value="<?= $item['tanggal_lahir'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" name="alamat" class="form-control" value="<?= $item['alamat'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" value="<?= $item['email'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun_masuk">Tahun Masuk</label>
                                                <input type="number" name="tahun_masuk" class="form-control" value="<?= $item['tahun_masuk'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="prodi_id">Program Studi</label>
                                                <select name="prodi_id" class="form-control" required>
                                                    <option value="">Pilih Prodi</option>
                                                    <?php foreach ($prodiList as $prodi): ?>
                                                        <option value="<?= $prodi['id'] ?>" <?= (isset($item['prodi_id']) && $item['prodi_id'] == $prodi['id']) ? 'selected' : '' ?>>
                                                            <?= $prodi['nama'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="type" value="update">
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
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

