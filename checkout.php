

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.php">Beranda</a></span> / <span>Checkout</span></p>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-product">
			<div class="container">
				<div class="row-lg-12">
				<?php
			$id_pelanggan=$_SESSION["cid"];
			$sql="select * from `$tbpelanggan` where `id_pelanggan`='$id_pelanggan'";
			$d=getField($conn,$sql);
				$id_pelanggan=$d["id_pelanggan"];
				$nama_pelanggan=$d["nama_pelanggan"];
				$telepon=$d["telepon"];
				$email=$d["email"];
				$status=$d["status"];
				$pesan=$d["pesan"];
				$alamat=$d["alamat"];
					
					
			  $sql0="select * from `$tbpemesanan` where  `status`='Order' and `id_pelanggan`='$id_pelanggan' order by `id_pemesanan` desc";
			  $jum0=getJum($conn,$sql0);
					if($jum0 <1){
					  echo "<h3><i><font color='red'><marquee>Maaf Data CheckOut belum tersedia...</marquee></i></font></h3>";
					}
			else{		
				$arr0=getData($conn,$sql0);
					foreach($arr0 as $d0) {						
						$id_pemesanan=$d0["id_pemesanan"];
						$tanggal=WKT($d0["tanggal"]);
						$jam=$d0["jam"];
						$status=$d0["status"];
						$keterangan=$d0["keterangan"];
				
			?>
		
		<table class="table">
			<tr>
			<th width="20%"><label for="id_pemesanan">ID Pemesanan</label>
			<th width="1%">:
			<th colspan="2"><b><?php echo $id_pemesanan;?></b></tr>

			<tr>
			<td height="24"><label for="id_pelangga">Data Pelanggan</label>
			<td>:<td><?php echo "$nama_pelanggan | $id_pelanggan";?>
			</tr>


			<tr>
			<td height="24"><label for="alamat">Alamat</label>
			<td>:<td><?php echo "$alamat ";?>
			</tr>	
			<tr>
			<td height="24"><label for="id_pelangga">Status</label>
			<td>:<td><?php echo "$status";?>
			</tr>
			<tr>
			<td height="24"><label for="id_pelangga">Waktu Pemesanan</label>
			<td>:<td><?php echo "$tanggal $jam WIB";?>
			</tr>
			</table>
				
			<?php
			$sql="select * from `$tbpemesanan` where  id_pelanggan='".$_SESSION["cid"]."'  and  `status`='Order'";
				$arr=getData($conn,$sql);
				foreach($arr as $d) {	
					$id_pemesanan=$d["id_pemesanan"];
					$tanggal=WKT($d["tanggal"]);
					$jam=$d["jam"];
					$id_pelanggan=$d["id_pelanggan"];
					$status=$d["status"];
					$keterangan=$d["keterangan"];
				?>
					<div class="col-md-12">
						<div class="product-name d-flex">
							<div class="one-forth text-left px-4">
								<span>Gambar / Nama</span>
							</div>
							<div class="one-eight text-center">
								<span>Harga</span>
							</div>
							<div class="one-eight text-center">
								<span>Jumlah</span>
							</div>
							<div class="one-eight text-center">
								<span>Catatan</span>
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
							
								
								if($jenis=="Roll"){
									$harga=$harga_roll;
								} else if ($jenis=="Meteran"){
									$harga=$harga_meteran;
								}
						?>
						<div class="product-cart d-flex">
							<div class="one-forth">
								<img width="100" height="80" src="admin/ypathfile/<?php echo $gambar;?>" title="<?php echo "kategori Barang $kategori;";?>">
							    <div class="display-tc">
									<h3><?php echo strtoupper($nama_barang);?></h3>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">Rp. <?php echo RP($harga);?></span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<?php echo $jumlah;?>
								</div>
							</div>
								<div class="one-eight text-center">
								<div class="display-tc">
									<?php echo $catatan;?>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">Rp. <?php echo RP($subtotal);?></span>
								</div>
							</div>
						</div>
						
						<?php } ?>
						
						<div class="grand-total text-right">
							<p>Total: <span>Rp. <?php echo RP($tot)." (".terbilang($tot).")";?></span></p>
						</div>
						<div class="grand-total text-left">
						<a class="btn btn-danger btn-sm" href="?mnu=keranjang_belanja&pro=reset&id_pemesanan=<?php echo $id_pemesanan;?>" onClick="return confirm('Apakah Anda benar-benar akan menghapus Semua daftar Belanja ini ?..')"
><font color="#fff">Hapus</font>
</a>
<a class="btn btn-success btn-sm" href="?mnu=konfirmasi&id_pemesanan=<?php echo $id_pemesanan;?>" onClick="return confirm('Apakah Anda benar-benar akan Konfirmasi Semua daftar Belanja ini ?..')"
><font color="#fff">Konfirmasi Semua daftar Belanja <?php echo $id_pemesanan;?></font>
</a>
<a class="btn btn-info btn-sm" target="_blank" href="?mnu=prosesmidtrans&id_pemesanan=<?php echo $id_pemesanan;?>" onClick="return confirm('Apakah Anda benar-benar akan Konfirmasi Semua daftar Belanja ini ?..')"
><font color="#fff">Konfirmasi melaui Midtrend</font>
</a>
					</div>
					</div>
				</div>
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="total-wrap">
							<div class="row">
								<div class="col-sm-8">
									<p><h2> Pembayaran Melalui : </h2><br>
										<h5><img src="images/BCA.jpg" width="80px" height="30px">  : 8770471819 a/n Jaya Makmur Selang<br></h5>
										<h5><img src="images/PERMATA.jpg" width="80px" height="30px"> : 0xxxxxxxxx a/n Jaya Makmur Selang<br></h5>
								</div>
							  
							</div>
						</div>
					</div>
				</div>
				<?php } ?>  
<?php
	}//foreacch
}//jum>0
?>

<?php
if($_GET["pro"]=="selesai"){
	$ido=$_GET["kd"];
	$sql="update `$tbpemesanan` set status='Konfirmasi' where `id_pemesanan`='".$ido."'";
	$ubah=process($conn,$sql);
	
	$_SESSION["corder"]="";
	unset($_SESSION["corder"]);
	if($ubah) {echo "<script>alert('Data detail ".$ido." berhasil  Dikonfirmasikan!');document.location.href='?mnu=checkout';</script>";}
	else{echo"<script>alert('Data pemesanandetail $ido gagal Dikonfirmasikan...');document.location.href='?mnu=checkout';</script>";}
}
?>

<?php
	if($_GET["pro"]=="hapus"){
	$id=$_GET["id"];
		
	$sql="delete from `$tbpemesanandetail` where `id`='".$id."'";
	$hapus=process($conn,$sql);
	
	if($hapus) {echo "<script>alert('Data Berhasil dihapus !');document.location.href='?mnu=checkout';</script>";}
	else{echo"<script>alert('Data Gagal dihapus...');document.location.href='?mnu=checkout';</script>";}
	}
?>