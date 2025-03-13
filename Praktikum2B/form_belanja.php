<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Belanja Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
require_once "total_belanja.php";
?>

<body>
<div class="container mt-4">
    <div class="row">
        <!-- Form Belanja -->
        <div class="col-md-8">
            <h1 class="mb-4">Belanja Online</h1>
            <form method="POST" action="total_belanja.php">
                <div class="form-group row">
                    <label for="nama" class="col-4 col-form-label">Nama Customer</label> 
                    <div class="col-8">
                        <input id="nama" name="customer" placeholder="Customer" type="text" class="form-control" required="required">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="produk" class="col-4 col-form-label">Pilih Produk</label> 
                    <div class="col-8">
                        <?php
                        foreach ($ar_produk as $pilihan => $harga) {
                            echo "<div class='custom-control custom-checkbox custom-control-inline'>";
                            echo "<input name='produk[]' id='produk_$pilihan' type='checkbox' class='custom-control-input' value='$pilihan'>";
                            echo "<label for='produk_$pilihan' class='custom-control-label'>$pilihan</label>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jumlah" class="col-4 col-form-label">Jumlah</label> 
                    <div class="col-8">
                        <input id="jumlah" name="jumlah" placeholder="Jumlah" type="text" class="form-control" required="required">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="offset-4 col-8">
                        <button name="proses" type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Daftar Harga -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-black text-white"> Daftar Harga </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">TV : 4.200.000</li>
                    <li class="list-group-item">Kulkas : 3.100.000</li>
                    <li class="list-group-item">Mesin Cuci : 3.800.000</li>
                </ul>
                <div class="card-footer bg-black text-white"> Harga Dapat Berubah Setiap Saat </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>