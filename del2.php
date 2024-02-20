<?php
// include database connection file
include "koneksi.php";
$hapus = mysqli_query($koneksi, "delete from penjualan where penjualanID='$_GET[penjualanID]'");
header("location:penjual.php");
 ?>