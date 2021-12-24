

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="?mnu=home">Beranda</a></span> / 
						<span>Produk</span></p>
					</div>
				</div>
			</div>
		</div>


		<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-xl-3">
						<div class="row">
							<div class="col-sm-12">
								<div class="side border mb-1">
									<h3>Type Selang</h3>
									<ul>
									<?php  
									  $sql="select distinct(nama_barang) from `$tbbarang` order by `nama_barang` asc";
											$arr=getData($conn,$sql);
											foreach($arr as $d) {			
											$nama_barang=$d["nama_barang"];
											
											$sql1="select * from `$tbbarang` where nama_barang='$nama_barang'";
											$jum=getJum($conn,$sql1);
									?>
									
										<li><a href="?mnu=produk&kat=<?php echo $nama_barang;?>"><b><?php echo $nama_barang;?></b> <span> (<?php echo $jum;?>)</span></a></li>
										
									<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-9 col-xl-9">
					 <?php	
					$kat="";
						if(isset($_GET["kat"])){
							$kat =$_GET["kat"];
							echo "<h3>$kat</h3>";
						}
						else {
							$kat="Semua Produk";
							echo "<h3>$kat</h3>";
						}
						?>
						<div class="row row-pb-md">
						<?php  
							if($_GET["kat"]){
								$sql="select * from `$tbbarang` where nama_barang='".$_GET["kat"]."' order by `id_barang` desc";
							} 
							else if(isset($_POST['Cari'])){
								$cari=$_POST['txtcari'];
								$sql="select * from `$tbbarang`  where  `nama_barang` like '%$cari%' OR `keterangan` like '%$cari%'";
							}
							else{
							  $sql="select * from `$tbbarang` order by rand() limit 0,12";
							}
							  $arr=getData($conn,$sql);
									foreach($arr as $d) {						
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
							<div class="col-lg-4 mb-4 text-center">
								<div class="product-entry border">
									<a href="index.php?mnu=produk_detail&kd=<?php echo $id_barang; ?>" class="prod-img">
										<img src="admin/ypathfile/<?php echo $gambar; ?>"  width="100%" height="230px">
									</a>
									<div class="desc">
										<h2><a href="index.php?mnu=produk_detail&kd=<?php echo $id_barang; ?>"><b><?php echo $nama_barang; ?> <br> <?php echo $keterangan; ?></b></a></h2>
										<span class="text-left"><b>Rp. <?php echo RP($harga_roll); ?>&nbsp;&nbsp;&nbsp; (<?php echo $status; ?>)</b></span>
									</div>
									
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>