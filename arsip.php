
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.php">Beranda</a></span> / <span>Arsip Belanja </span></p>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-product">
		<?php
		$sql="select * from `$tbpemesanan` where  id_pelanggan='".$_SESSION["cid"]."'   and not `status`='Order' order by `id_pemesanan` desc";
		if(isset($_GET["id"])){
			$id_pemesanan=$_GET["id"];
				$sql="select * from `$tbpemesanan` where  id_pelanggan='".$_SESSION["cid"]."'  and  `id_pemesanan`='$id_pemesanan'";
		}
							$arr=getData($conn,$sql);
									foreach($arr as $d) {	
										$id_pemesanan=$d["id_pemesanan"];
										$tanggal=WKT($d["tanggal"]);
										$jam=$d["jam"];
										$id_pelanggan=$d["id_pelanggan"];
										$status=$d["status"];
										$keterangan=$d["keterangan"];
			
			
			$sqlb="select * from `$tbkonfirmasi` where `id_pemesanan`='$id_pemesanan' order by `id_konfirmasi` desc";
			$db=getField($conn,$sqlb);
				$id_konfirmasi=$db["id_konfirmasi"];
				$tanggaldb=WKT($db["tanggal"]);
				$jamdb=$db["jam"]." Wib";
				$pesan=$db["pesan"];
				$nominal=RP($db["nominal"]);
				$statusdb=$db["status"];
				$keterangandb=$db["keterangan"];
				$bukti_bayar=$db["bukti_bayar"];				
				
			?>



				<div class="wishlist-box-main">
				<div class="container">
				<div class="row">
				
				
				<div class="col-md-12">
				<h3>Nota Order <?php echo "$id_konfirmasi - $id_pemesanan :$status" ;?></h3>
					<?php
					echo"<b>Nominal Transfer :Rp. $nominal</b> Waktu: $tanggaldb $jamdb<br>";
					echo"<b>Pesan : $pesan</b> |";
					?>
					<a href="admin/downloadget.php?nf=<?php echo $bukti_bayar;?>">Download bukti bayar</a><hr>
				</div>

			<div class="container">
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="product-name d-flex">
							<div class="one-forth text-left px-4">
								<span>Gambar | Nama Barang</span>
							</div>
							<div class="one-eight text-center">
								<span>Jumlah</span>
							</div>
							<div class="one-eight text-center">
								<span></span>
							</div>
							<div class="one-eight text-center">
								<span>Total</span>
							</div>
						</div>
						
						<?php  
					   $tot=0;
						$sql="select * from `$tbpemesanandetail` where id_pemesanan='$id_pemesanan' order by `id` desc";
						$arr=getData($conn,$sql);
						foreach($arr as $d) {							
							$id=$d["id"];
							$id_pemesanan=$d["id_pemesanan"];
							$id_barang=$d["id_barang"];
							$jenis=$d["jenis"];
							$jumlah=$d["jumlah"];
							$subtotal=$d["subtotal"];
							$tot+=$subtotal;
							$catatan=$d["catatan"];
								
							$sql2="select * from `$tbbarang` where `id_barang`='$id_barang'";
							$d2=getField($conn,$sql2);
								$id_barang=$d2["id_barang"];
								$nama_barang=$d2["nama_barang"];
								$kategori=$d2["kategori"];
								$deskripsi=$d2["deskripsi"];
								$harga_roll=$d2["harga_roll"];
								$harga_meteran=$d2["harga_meteran"];
								$gambar=$d2["gambar"];
								$keterangan=$d2["keterangan"];
															
								if($jenis=="Roll"){
									$harga=$harga_roll;
								} else if($jenis=="Meteran"){
									$harga=$harga_meteran;
	                            }
						?>
						
						<div class="product-cart d-flex">
							<div class="one-forth">
								<img width="100" height="80" src="admin/ypathfile/<?php echo $gambar;?>" title="<?php echo "kategori Barang $kategori;";?>">
									
								<div class="display-tc">
									<h3><?php echo $nama_barang;?><br>
										<?php echo $keterangan;?><br>
										Rp. <?php echo RP($harga)." | $jenis";?></h3>
								</div>
							</div>
							<div class="one-eight text-center">
									<?php echo $jumlah;?>
						    </div>	
							<div class="one-eight text-center">
								<div class="display-tc"></div>
						    </div>
							<div class="grand-total text-left">
								<p><span>Rp. <?php echo RP($subtotal);?></span></p>
							</div>
					   </div>
					   	<div class="total-cost text-right">
							<h6><button class="btn btn-success">Rp. <?php echo RP($tot)." (".terbilang($tot).")";?></button></h6>
						</div>
				</div>
				<?php } } ?>
				