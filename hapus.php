<?php
// include database connection file
include "koneksi.php";
$hapus = mysqli_query($koneksi, "delete from produk where produkID='$_GET[produkID]'");
header("location:produk.php");
 ?>