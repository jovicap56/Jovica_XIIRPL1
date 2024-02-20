<table class="table table-bordered" id="dynamic_field">  
<tr>  
     <td>
      
     <select style="width:300px" name="name[]" class="form-control name_list col-sm col-md-7">
     <option value="Umam">Umam</option>
     <option value="Agus">Agus</option>
     </select>
     <input type="text" style="width:200px" name="nilai[]" class="form-control nilai_list" placeholder="Input Nilai"/>
     </td>  
     <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
</tr>  
</table>  
<div class="form-group">
                <label for="detailID">ID Detail</label>
                <input type="text" class="form-control" name="detailID" placeholder="Masukkan ID Detail">
            </div>
            <div class="form-group">
                    <label for="produkId">ID Produk</label>
                    <select name ="produkId" class="form-control">
              <option disabled selected> Pilih </option>
              <?php 
              $t_produk= mysqli_query($koneksi,"select produkId, namaProduk, Harga from produk");
              foreach ($t_produk as $produk){
                echo "<option value =$produk[produkId]>$produk[namaProduk]($produk[Harga])</option>";
              }
				?>		
        </select>
            </div>
            <div class="form-group">
                    <label for="jumlahProduk">Jumlah Produk</label>
                    <input type="text" class="form-control" name="jumlahProduk" placeholder="Masukkan Jumlah Produk">
            </div>

            <html>  
     <head>  
          <title>Tambah dan Hapus Dinamis dengan Jquery</title>  
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
     </head>  
     <body>  
          <div class="container">  
               <br />  
               <br />  
               <h2 align="center">Tambah dan Hapus Dinamis dengan Jquery</h2>  
               <div class="form-group">  
                    <form name="add_name" id="add_name">  
                         <div class="table-responsive">  
                              <table class="table table-bordered" id="dynamic_field">  
                                   <tr>  
                                        <td>
                                         
                                        <select style="width:300px" name="name[]" class="form-control name_list col-sm col-md-7">
                                        <option value="Umam">Umam</option>
                                        <option value="Agus">Agus</option>
                                        </select>
                                        <input type="text" style="width:200px" name="nilai[]" class="form-control nilai_list" placeholder="Input Nilai"/>
                                        </td>  
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                   </tr>  
                              </table>  
                              <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />  
                         </div>  
                    </form>  
               </div>  
          </div>  
     </body>  
</html>  
<script>  
$(document).ready(function(){  
     var i=1;  
     $('#add').click(function(){  
          i++;  
          $('#dynamic_field').append('<tr id="row'+i+'"><td><select style="width:300px" name="name[]" class="form-control name_list col-sm col-md-7"><option value="Umam">Umam</option><option value="Agus">Agus</option></select><input style="width:200px" type="text" name="nilai[]" class="form-control nilai_list" placeholder="Input Nilai"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
     });  
     $(document).on('click', '.btn_remove', function(){  
          var button_id = $(this).attr("id");   
          $('#row'+button_id+'').remove();  
     });  
     $('#submit').click(function(){            
          $.ajax({  
               url:"name.php",  
               method:"POST",  
               data:$('#add_name').serialize(),  
               success:function(data)  
               {  
                    alert(data);  
                    $('#add_name')[0].reset();  
               }  
          });  
     });  
});  
</script>