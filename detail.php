<?php
require 'ceklogin.php';

if(isset($_GET['idp'])){
    $idp = $_GET['idp'];

    $ambilnamapelanggan = mysqli_query($mysqli,"select * from pesanan p, pelanggan pl where p.idpelanggan=pl.idpelanggan and p.idorder='$idp'");
    $mp = mysqli_fetch_array($ambilnamapelanggan);
    $namapel = $mp['nama'];
}
else{
    header('location:index.php');
}
?> 