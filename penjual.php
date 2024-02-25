<?php
include 'koneksi.php';
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard Kasir</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Aplikasi Kasir</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Detail Penjualan
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Master Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="Produk.php">Produk</a>
                                    <a class="nav-link" href="penjual.php">Penjualan</a>
                                </nav>
                            </div>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"></div>
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"></div>
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <a href="#"  method="POST" class="d-block"><?php echo "<h6> "."Admin ". $_SESSION['username']. "</h6>"; ?></a>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Penjualan</h1>
                        <ol class="breadcrumb mb-4">
                            Ini adalah data Penjualan Toko.
                        </ol>
                     
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Table Data
                            </div>
                            <div class="card-body">
                            <table id="datatablesSimple">
                                    <thead>
                                        <tr>         
                <th>No</th>
                <th>Penjualan</th>
                <th>Tanggal Penjualan</th>
                <th>Total Harga</th>
                <th colspan = "2"><center>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include "koneksi.php";
                $query    =mysqli_query($koneksi, "SELECT * FROM penjualan ORDER BY penjualanID DESC");
                $no=0;
                while($data    =mysqli_fetch_array($query)){
                $no++
            ?>
            <tr>            
                <td><?php echo $no?></td>
                <td><?php echo $data['penjualanID']?></td>
                <td><?php echo $data['tanggalPenjualan']?></td>
                <td>Rp. <?php echo $data['totalHarga']?>,00</td>
                <td><a href="edit2.php?penjualanID=<?=$data['penjualanID']?>">Edit</a> 
                | <a href="del2.php?penjualanID=<?=$data['penjualanID']?>">Hapus</a> 
                | <a href="view.php?penjualanID=<?=$data['penjualanID']?>">View</a> 
            </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
                            </div>
                        </div>
                    </div>
                    <!-- The Modal -->
<div class="modal" id="insert">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Input Data Produk</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="produk.php" method="post" name="form1">
            <div class="card-body">
            <div class="form-group">
                    <label for="produkId">ID Produk</label>
                    <input type="text" class="form-control" name="produkID" placeholder="Masukkan ID">
                </div>
            <div class="form-group">
                    <label for="namaProduk">Nama Produk</label>
                    <input type="text" class="form-control" name="namaProduk" placeholder="Masukkan Nama">
                </div>
            <div class="form-group">
                    <label for="Harga">Harga</label>
                    <input type="text" class="form-control" name="Harga" placeholder="Masukkan Harga">
                  </div>
                  <div class="form-group">
                    <label for="Stok">Stok</label>
                    <input type="text" class="form-control" name="Stok" placeholder="Masukkan Stok">
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-danger" name="Submit"></button>
                </div>
              </form>
            <?php
 
    // Check If form submitted, insert form data into users table.
    if(isset($_POST['Submit'])){
        $id = $_POST['produkID'];
        $nama = $_POST['namaProduk'];
        $harga = $_POST['Harga'];
        $stok = $_POST['Stok'];
        
        // include database connection file
        include_once("koneksi.php");
                
        // Insert user data into table
        $result = mysqli_query($koneksi, "INSERT INTO produk(produkID,namaProduk,Harga,Stok) VALUES('$id','$nama','$harga','$stok')");
        
        // Show message when user added
        //header("Location: shows.php");
        echo "<script>window.location.href='produk.php';</script>";
    }
    ?>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      </div>

    </div>
  </div>
</div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Jovica Website 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
