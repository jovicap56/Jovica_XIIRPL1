<!DOCTYPE html>
<html>
<head>
<style type="text/css">
.form-style-5{
	max-width: 500px;
	padding: 10px 20px;
	background: #f4f7f8;
	margin: 10px auto;
	padding: 20px;
	background: #f4f7f8;
	border-radius: 8px;
	font-family: Georgia, "Times New Roman", Times, serif;
}
.form-style-5 fieldset{
	border: none;
}
.form-style-5 legend {
	font-size: 1.4em;
	margin-bottom: 10px;
}
.form-style-5 label {
	display: block;
	margin-bottom: 8px;
}
.form-style-5 input[type="text"],
.form-style-5 input[type="date"],
.form-style-5 input[type="datetime"],
.form-style-5 input[type="email"],
.form-style-5 input[type="number"],
.form-style-5 input[type="search"],
.form-style-5 input[type="time"],
.form-style-5 input[type="url"],
.form-style-5 textarea,
.form-style-5 select {
	font-family: Georgia, "Times New Roman", Times, serif;
	background: rgba(255,255,255,.1);
	border: none;
	border-radius: 4px;
	font-size: 15px;
	margin: 0;
	outline: 0;
	padding: 10px;
	width: 100%;
	box-sizing: border-box; 
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box; 
	background-color: #e8eeef;
	color:#8a97a0;
	-webkit-box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
	box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
	margin-bottom: 30px;
}
.form-style-5 input[type="text"]:focus,
.form-style-5 input[type="date"]:focus,
.form-style-5 input[type="datetime"]:focus,
.form-style-5 input[type="email"]:focus,
.form-style-5 input[type="number"]:focus,
.form-style-5 input[type="search"]:focus,
.form-style-5 input[type="time"]:focus,
.form-style-5 input[type="url"]:focus,
.form-style-5 textarea:focus,
.form-style-5 select:focus{
	background: #d2d9dd;
}
.form-style-5 select{
	-webkit-appearance: menulist-button;
	height:35px;
}
.form-style-5 .number {
	background: #1abc9c;
	color: #fff;
	height: 30px;
	width: 30px;
	display: inline-block;
	font-size: 0.8em;
	margin-right: 4px;
	line-height: 30px;
	text-align: center;
	text-shadow: 0 1px 0 rgba(255,255,255,0.2);
	border-radius: 15px 15px 15px 0px;
}

.form-style-5 input[type="submit"],
.form-style-5 input[type="button"]
{
	position: relative;
	display: block;
	padding: 19px 39px 18px 39px;
	color: #FFF;
	margin: 0 auto;
	background: #1abc9c;
	font-size: 18px;
	text-align: center;
	font-style: normal;
	width: 100%;
	border: 1px solid #16a085;
	border-width: 1px 1px 3px;
	margin-bottom: 10px;
}
.form-style-5 input[type="submit"]:hover,
.form-style-5 input[type="button"]:hover
{
	background: #109177;
}
</style>
</head>
</body>
</html>
<?php
// include database connection file
include_once("koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{   
	//data asal
    $idasal = $_POST['detailIDasal'];
    $penjualasal = $_POST['penjualanIDasal'];
    $produkasal = $_POST['produkIDasal'];
    $jumlahasal = $_POST['jumlahProdukasal'];

	$id = $_POST['detailID'];
    $penjual = $_POST['penjualanID'];
    $produk = $_POST['produkID'];
    $jumlah = $_POST['jumlahProduk'];


	//reset stok
	$detailresettransaksi="SELECT * FROM `detail_penjualan` WHERE detailID = '$idasal'";
	$queryreset=mysqli_query($koneksi,$detailresettransaksi);
	$dataresettransaksi=mysqli_fetch_assoc($queryreset);
	//print_r($dataresettransaksi);
	$sql_jml_stok_awal = "select Stok from produk where produkID = '".$dataresettransaksi['produkID']."'";
	$query_jml_stok_awal = mysqli_query($koneksi,$sql_jml_stok_awal);
	$result_stok_awal = mysqli_fetch_assoc($query_jml_stok_awal);
	//print_r($sql_jml_stok_awal);
	$selSto =mysqli_query($koneksi, "SELECT * FROM produk WHERE produkID='$produk'");
	$sto    =mysqli_fetch_array($selSto);
	$stok    =$sto['Stok'];
	$harga    =$sto['Harga'];
	//menghitung sisa stok
	$sub = $harga * $jumlah;
	$total = $sub;
	$sisa    =$stok-$jumlah;

    // update user data
    $result=mysqli_query($koneksi,"UPDATE detail_penjualan set penjualanID='$penjual', produkID='$produk', jumlahProduk='$jumlah', subTotal='$sub' where detailID='$id'");
	$resultpenjualan = mysqli_query($koneksi, "UPDATE penjualan set totalHarga='$total' where penjualanID='$penjual'");
        if($result){
                  //update stok
                  $upstok= mysqli_query($koneksi, "UPDATE produk SET Stok='$sisa' WHERE produkID='$produk'");
                  ?>
                  <script language="JavaScript">
                      alert('Good! Input transaksi penjualan barang berhasil ...');
                      document.location='index.php';
                  </script>
                  <?php
              }
              else {
                  echo "<div><b>Oops!</b> 404 Error Server.</div>";
              }
    // Redirect to homepage to display updated user in list
    header("Location: index.php");
}
?>

<html>
<head>  
    <title>Update Data</title>
</head>
 
<body>
    <?php
    include_once("koneksi.php");
    $id=$_GET['detailID'];
    $row = mysqli_query($koneksi, "SELECT * FROM detail_penjualan WHERE detailID=$id");
    $data=mysqli_fetch_assoc($row);
	print_r($data);
    ?>
    <br/><br/>
    <body style="background-color: black;">
    <div class="form-style-5">
<form action="" method="post" name="form1">
<fieldset>
<h2><center>Update Data!</h2>
<?php
$id=$data['detailID'];
?>
<br>
<label for="job">ID Detail :</label>
<input type="text" name="detailID" value=<?php echo $data['detailID'];?>>
<input type="hidden" name="detailIDasal" value=<?php echo $data['detailID'];?>>
<label for="job">ID Penjualan :</label>
<input type="text" name="penjualanID" value=<?php echo $data['penjualanID'];?>>
<input type="hidden" name="penjualanIDasal" value=<?php echo $data['penjualanID'];?>>
<label for="nama">ID Kode :</label>
<select name="produkID" class="form-control">
    <option disabled>Pilih</option>
    <?php 
    $t_produk = mysqli_query($koneksi, "select produkID, namaProduk, Harga from produk");
    foreach ($t_produk as $produk) {
        $selected = ($produk['produkID'] == $produkID) ? "selected" : ""; // Tandai sebagai terpilih jika produkID sama dengan nilai yang sudah ada sebelumnya
        echo "<option value='{$produk['produkID']}' $selected>{$produk['namaProduk']} ({$produk['Harga']})</option>";
    }
    ?>
</select>		
<input type="hidden" name="produkIDasal" value=<?php echo $data['produkID'];?>>
<label for="job">Jumlah :</label>
<input type="text" name="jumlahProduk" value=<?php echo $data['jumlahProduk'];?>>	
<input type="hidden" name="jumlahProdukasal" value=<?php echo $data['jumlahProduk'];?>>	
</fieldset>

<input type="submit" name="update" value="Update">
</form>
</div>
</body>
</html>
