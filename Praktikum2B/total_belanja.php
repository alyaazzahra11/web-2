<?php

// buat array untuk menyimpan harga dari masing-masing produk
$ar_produk = [
    "TV" => 4200000,
    "Kulkas" => 3100000,
    "Mesin Cuci" => 3800000
];

// mengambil data dari file data-form-regis.php
require_once "form_belanja.php"; 

// buat variabel yang menerima value yang dikirim dari form
$customer = ""; 
$produk = []; 
$jumlah = []; 
$total = 0; 

// LOGIKA MENGHITUNG TOTAL HARGA
if (isset($_POST['proses'])) {  // isset() digunakan untuk memeriksa apakah sebuah variabel sudah ada dan tidak bernilai NULL
    $customer = $_POST['customer'];  
    $produk = $_POST['produk'];  
    $jumlah = $_POST['jumlah']; 
    $total = 0;
}

// mencetak belanjaan
echo "<h2>Detail Belanja</h2>";
echo "Nama Customer: $customer<br>";
echo "Produk yang dibeli:<br>";

if (!empty($produk)) {
    foreach ($produk as $key => $item_produk) {  
        $harga_satuan = $ar_produk[$item_produk];  
        $jumlah_barang = $jumlah[$key];  
        $subtotal = $harga_satuan * $jumlah_barang;  
        $total += $subtotal; 
        echo "- $item_produk (Jumlah: $jumlah_barang) <br>";  
    }
}

echo "Total Harga: Rp " . number_format($total, 0, ',', '.') . "<br>";  // Display total price
?>
