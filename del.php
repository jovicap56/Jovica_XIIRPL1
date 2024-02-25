<?php
include "koneksi.php";
$ambildata = mysqli_query($koneksi, "select * from detail_penjualan where detailID='$_GET[detailID]'");
foreach ($ambildata as $k){
    $id = $k['detailID'];
    $penjual = $k['penjualanID'];
    $produk = $k['produkID'];
    $tgl = $k['tanggalPenjualan'];
    $jumlah = $k['jumlahProduk'];

        $selSto =mysqli_query($koneksi, "SELECT * FROM produk WHERE produkID='$produk'");
        $sto    =mysqli_fetch_array($selSto);
        $stok    =$sto['Stok'];
        //menghitung sisa stok
        $sisa    =$stok+$jumlah;

        $upstok= mysqli_query($koneksi, "UPDATE produk SET Stok='$sisa' WHERE produkID='$produk'");
        $hapus_transaksi = mysqli_query($koneksi, "DELETE from detail_penjualan where detailID='$_GET[detailID]'");
        header('location:index.php');
}
 ?>
