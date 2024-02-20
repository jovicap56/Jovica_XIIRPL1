<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['produkID'];
$nama = $_POST['namaProduk'];
$harga = $_POST['Harga'];
$stok = $_POST['Stok'];
 
// update data ke database
mysqli_query($koneksi,"update produk set namaProduk='$nama', Harga='$harga', Stok='$stok' where produkID='$id'");
 
// mengalihkan halaman kembali ke index.php
header("location:produk.php");
 
?>