
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.php">Beranda</a></span> / <span>Pengiriman </span></p>
					</div>
				</div>
			</div>
		</div>



		<div class="colorlib-product">
				<div class="wishlist-box-main">
				<div class="container">
				<div class="row">
	<?php 
$id_pelanggan=$_SESSION["cid"];
$sql="select * from `$tbpemesanan` where `id_pelanggan`='$id_pelanggan'";
$jum=getJum($conn,$sql);

if($jum>0){
	$d=getField($conn,$sql);
	   $id_pemesanan=$d["id_pemesanan"];
?>		
			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="product-name d-flex">
							<div class="one-forth text-left px-4">
								<span>Waktu Pengiriman |  Catatan</span>
							</div>
							<div class="one-eight text-center">
								<span>Id Pemesanan</span>
							</div>
							<div class="one-eight text-center">
								<span></span>
							</div>
							
							<div class="one-eight text-center">
								<span>Status</span>
							</div>
						</div>
						
						<?php  
							$sql="select * from `$tbpengiriman`  order by `id_pengirim` desc";
							$jum=getJum($conn,$sql);
								$arr=getData($conn,$sql);
								foreach($arr as $d) {							
										$id_pengirim=$d["id_pengirim"];
										$id_pemesanan=$d["id_pemesanan"];
										$jam=$d["jam"];
										$tanggal=WKT($d["tanggal"]);
										$deskripsi=$d["deskripsi"];
										$status=$d["status"];
										$catatan=$d["catatan"];
							?>
						
						<div class="product-cart d-flex">
							<div class="one-forth">
									<?php echo $tanggal;?> - <?php echo $jam;?> |
									<?php echo $deskripsi;?>
							</div>
							
							<div class="one-eight text-center">
									<?php echo $id_pemesanan;?>
						    </div>	
							<div class="one-eight text-center">
								<div class="display-tc"></div>
						    </div>
							<div class="grand-eight text-center">
								<?php echo $status;?>
							</div>
					   </div>
					   <?php } ?>
					  
<?php 
} else { 
	echo" <br><br><br><br><br>";
	echo"<h3><font color='#ff0000'><marquee>Maaf, belum ada pemesanan barang, silahkan melakukan pemesanan...</marquee></h3></font>";
    echo" <br><br><br><br><br>";			  	
	 }
?>						  
				</div>
