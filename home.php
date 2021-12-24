
		<div class="colorlib-product">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
						<h2>Best Sellers</h2>
					</div>
				</div>
				<div class="row row-pb-md">
				<?php  
						
							  $sql="select * from `$tbbarang` order by rand() limit 0,16";
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
				
					<div class="col-lg-3 mb-4 text-center">
						<div class="product-entry border">
							<a href="#" class="prod-img">
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
