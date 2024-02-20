<?php
// include database connection file
include "koneksi.php";
$hapus = mysqli_query($koneksi, "delete from detail_penjualan where detailID='$_GET[detailID]'");
header("location:index.php");
 ?>