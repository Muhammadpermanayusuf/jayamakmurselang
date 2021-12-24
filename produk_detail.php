<?php  
$id_barang=$_GET["kd"];
  $sql="select * from `$tbbarang` where id_barang='$id_barang'";
  $d=getField($conn,$sql);				
				$id_barang=$d["id_barang"];
								$nama_barang=$d["nama_barang"];
								$deskripsi=$d["deskripsi"];
								$gambar=$d["gambar"];
								$harga_roll=$d["harga_roll"];
								$harga_meteran=$d["harga_meteran"];
								$id_kategori=$d["id_kategori"];
								$keterangan=$d["keterangan"];
								$status=$d["status"];
								$stok=$d["stok"];
				?>


		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="?mnu=home">Beranda</a></span> / <span>Produk Detail</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
			<form action="" method="post">
				<div class="row row-pb-lg product-detail-wrap">
					<div class="col-sm-8">
							<div class="item">
								<div class="product-entry border">
									<a href="#" onclick="buka('admin/barang/zoom.php?id=<?php echo $id_barang;?>')" class="prod-img">
										<img src="admin/ypathfile/<?php echo $gambar; ?>" class="img-fluid" width="100%" height="230px">
									</a>
								</div>
							</div>
					</div>
					<div class="col-sm-4">
						<div class="product-desc">
							<h3><?php echo $nama_barang; ?> <?php echo $keterangan; ?></h3>
							<p class="price">
								<span>Harga / Meter : <?php echo RP($harga_meteran); ?></span> 
								<span>Harga / Roll : <?php echo RP($harga_roll); ?></span>
							</p>
							<p><h5>Stok Meter : <span><?php echo $status; ?></span></h5></p>
							<div class="size-wrap">
								<div class="block-26 mb-2">
									<h4>Kategori</h4>
				               <ul>
				                  <div class="sc-item">
							<input type="radio" value="Meteran" name="jenis"  checked="" id="xs-size">
							<label for="xs-size" title="Order Secara Meteran Atau Satuan"></label>Meteran
							<input type="radio" value="Roll"  name="jenis" id="m-size">
							<label for="m-size" title="Order Secara Roolan / Banyak"></label>Roll
						</div>
				               </ul>
				            </div>
							</div>
							
					<?php if($_SESSION["cid"]){ ?>		
						 <div class="input-group mb-4">
							<p>Jumlah :&nbsp;</p>
							<div class="pro-qty"><input type="text" style="width: 70px;" name="jumlah" value="1"></div>
						 </div>
						
						 <div class="quantity">
							<p>Catatan</p>
							<textarea class="form-control" type="text" name="catatan" required value="" cols="50" placeholder=""></textarea>
						 </div><br>
						 <div class="row">
							<div class="col-sm-12 text-center">
										<p class="addtocart">
										<button name="Order" type="submit" class="btn btn-primary btn-addtocart"><i class="icon-shopping-cart"></i> Masukkan ke keranjang</a>
										<input type="hidden"  name="id_barang" value="<?php echo $id_barang;?>" >
										<input type="hidden"  name="harga_meteran" value="<?php echo $harga_meteran;?>" >	
										<input type="hidden"  name="harga_roll" value="<?php echo $harga_roll;?>" >	
										</p>
									</div>
								</div>
							</div>
						 </div>
						<?php } else { echo "<marquee><b>Silahkan Login Terlebih Dahulu...</b></marquee>";} ?> 
				</form>
				</div>
				

				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-md-12 pills">
								<div class="bd-example bd-example-tabs">
								  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

								    <li class="nav-item">
								      <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Deskripsi</a>
								    </li>
								
								  </ul>

								  <div class="tab-content" id="pills-tabContent">
								    <div class="tab-pane border fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
								      <p><?php echo $deskripsi; ?></p>
								    </div>
								    </div>
								  </div>
								</div>
				         </div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
if(isset($_POST["Order"])){
	    $keterangan=$_POST["keterangan"];
		$id_barang=strip_tags($_POST["id_barang"]);
		$jumlah=strip_tags($_POST["jumlah"]);
		
	//if($jumlah>$stok){
	//echo "<script>alert('Data Order Gagal Stok Tersisa Hanya $stok !');document.location.href='?mnu=produkdetail&kd=$id_barang';</script>";
	//}	
	//else{
		  $sql="select `id_pemesanan` from `$tbpemesanan` where `id_pelanggan`='".$_SESSION["cid"]."' and `status`='Order'";
				$ada=getJum($conn,$sql);
				if($ada>0){
					$d=getField($conn,$sql);
					$id_pemesanan=$d["id_pemesanan"];
					$_SESSION["corder"]=$id_pemesanan;
				}
				else{
					$sql="select `id_pemesanan` from `$tbpemesanan` order by `id_pemesanan` desc";
					$q=mysqli_query($conn, $sql);
  					$jum=mysqli_num_rows($q);
  					$th=date("y");
  					$bl=date("m")+0;if($bl<10){$bl="0".$bl;}
					$kd="ORD".$th.$bl;//KEG1610001
  					if($jum > 0){
   						$d=mysqli_fetch_array($q);
   						$idmax=$d["id_pemesanan"];
   
   						$bul=substr($idmax,5,2);
  					 	$tah=substr($idmax,3,2);
    					if($bul==$bl && $tah==$th){
     						$urut=substr($idmax,7,3)+1;
     						if($urut<10){$idmax="$kd"."00".$urut;}
     						else if($urut<100){$idmax="$kd"."0".$urut;}
    						else{$idmax="$kd".$urut;}
    					}else{$idmax="$kd"."001";}   
  					}else{$idmax="$kd"."001";}
 					$id_pemesanan=$idmax;
  					
				    $_SESSION["corder"]=$id_pemesanan;
				     $sql="INSERT INTO `$tbpemesanan` (
					`id_pemesanan` ,
					`tanggal` ,
					`jam` ,
					`id_pelanggan` ,
					`keterangan` ,
					`status` 
					) VALUES (
					'".$_SESSION["corder"]."', 
					'".date("Y-m-d")."',
					'".date("H:i:s")."',
					'".$_SESSION["cid"]."',
					'-',
					'Order')";
					$simpan=process($conn,$sql);
	}
	
	$id_pemesanan=strip_tags($_SESSION["corder"]);
	$catatan=strip_tags($_POST["catatan"]);
	$jenis=strip_tags($_POST["jenis"]);
	$jenis_meteran=strip_tags($_POST["jenis_meteran"]);
	$harga_meteran=strip_tags($_POST["harga_meteran"]);
	$harga_roll=strip_tags($_POST["harga_roll"]);
	
	$harga=$harga_meteran;
	if($jenis=="Roll"){
		$harga=$harga_roll;
		
		$subtotal=$jumlah * $harga;
	    //$sql="update  `$tbbarang` set `stok`=`stok`-'$jumlah' where `id_barang`='$id_barang'";
		
	} else if($jenis=="Meteran"){
		$harga=$harga_meteran;
		
		$subtotal=$jumlah * $harga;
	}
	
$hapus=process($conn,$sql);
$sql=" INSERT INTO `$tbpemesanandetail` (
`id` ,
`id_pemesanan` ,
`id_barang` ,
`jumlah` ,
`subtotal` ,`jenis` ,
`catatan` 
) VALUES (
'', 
'".$_SESSION["corder"]."', 
'$id_barang',
'$jumlah',
'$subtotal','$jenis',
'$catatan'
)";
	
$simpan=process($conn,$sql);
echo "<script>alert('Data  berhasil ditambahkan di ".$_SESSION["corder"]."!');document.location.href='?mnu=keranjang_belanja';</script>";
//}
}

?>