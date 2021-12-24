
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="index.php">Beranda</a></span> / <span>Keranjang Belanja </span></p>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-product">
		<?php
if(empty($_SESSION["corder"]) || !isset($_SESSION["corder"])){
	echo "";
}
else{
	$id_pemesanan=$_SESSION["corder"];
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

?>

<div class="wishlist-box-main">
<div class="container">
<div class="row">
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
<td height="24"><label for="id_pelangga">Alamat Pelanggan</label>
<td>:<td><?php echo "$alamat, Telp. $telepon ";?>
</tr>

	
<tr>
<td height="24"><label for="id_pelangga">Status</label>
<td>:<td><?php echo "$status";?>
</tr>
</table>
<?php } ?>
			<div class="container">
				<div class="row row-pb-lg">
				<?php 
			  $id_pemesanan=$_SESSION["corder"];
			  $sql="select * from `$tbpemesanan` where `id_pemesanan`='$id_pemesanan'";
			  $jum=getJum($conn,$sql);
				if($jum > 0){
				  $d=getField($conn,$sql);
							$id=$d["id"];
							$id_pemesanan=$d["id_pemesanan"];
							$id_barang=$d["id_barang"];
							$jumlah=$d["jumlah"];
							$subtotal=$d["subtotal"];
							$catatan=$d["catatan"];
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
							<div class="one-eight text-center px-4">
								<span>Hapus</span>
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
								$catatan=$d["catatan"];
									$jumlah=$d["jumlah"];
									$subtotal=$d["subtotal"];
									$tot+=$subtotal ;
									
								$sql2="select * from `$tbbarang` where `id_barang`='$id_barang'";
								$d2=getField($conn,$sql2);
									$id_barang=$d2["id_barang"];
									$nama_barang=$d2["nama_barang"];
									$kategori=getKategori($conn,$d2["id_kategori"]);
									$deskripsi=$d2["deskripsi"];
									$harga_roll=$d2["harga_roll"];
									$harga_meteran=$d2["harga_meteran"];
									$gambar=$d2["gambar"];
									$keterangan=$d2["keterangan"];
									
									$harga=$harga_meteran;
									if($jenis=="Roll"){
										$harga=$harga_roll;
									}
									$subtotal=$jumlah * $harga;
	
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
							<div class="one-eight text-center">
								<div class="display-tc">
								<a onClick="return confirm('Apakah Anda benar-benar akan menghapus <?php echo $nama_barang;?> pada data belanja Anda ?..')" href="index.php?mnu=keranjang_belanja&pro=hapus&kd=<?php echo $id;?>">
							          <button class="closed"></button>
							        </a>
								</div>
							</div>
						</div>
						<?php } ?>
						<div class="grand-total text-right">
							<p>Total: <span>Rp. <?php echo RP($tot)." (".terbilang($tot).")";?></span></p>
						</div>
					</div>
				</div>
				<div class="row row-pb-lg">
					<div class="col-md-12">
						<div class="total-wrap">
							<div class="row">
								<div class="col-lg-8">
									<form action="" method="post">
										<div class="row form-group">
											<div class="col-sm-9">
												<input type="Submit" value="Checkout" name="Kirim" class="btn btn-primary">
												<input type="hidden"  name="id_pemesanan" value="<?php echo $id_pemesanan;?>" >
											    <a href="index.php?mnu=produk"><input type="button" value="Belanja Lagi" class="btn btn-primary"></a>
											    <a onClick="return confirm('Apakah Anda benar-benar akan MENGHAPUS SEMUA ORDER <?php echo $id_pemesanan;?> pada data belanja Anda ?..')"  href="index.php?mnu=keranjang_belanja&pro=reset&id=<?php echo $id_pemesanan;?>" class="btn btn-primary">Batalkan Semua</a>
											</div>
										</div>
									</form>
								</div>
							<?php 
							  } else{
								  echo"<h3><font color='#ff0000'><marquee>Maaf, belum ada pemesanan barang, silahkan melakukan pemesanan...</marquee></h3></font>";
							  }
							 ?> 
							</div>
						</div>
					</div>
				</div>
<?php
	if($_GET["pro"]=="hapus"){
	$ido=$_GET["kd"];
	$nama_barang=$_GET["nama_barang"];
	
		$sql="select `id_barang`,`jumlah` from `$tbpemesanandetail` where `id`='$ido'";
	$d=getField($conn,$sql);
				$id_barang=$d["id_barang"];
				$jumlah=$d["jumlah"];
				
				
	//$sql="update  `$tbbarang` set `stok`=`stok`+'$jumlah' where `id_barang`='$id_barang'";
	//$hapus=process($conn,$sql);

	$sql="delete from `$tbpemesanandetail` where `id`='".$ido."'";
	$hapus=process($conn,$sql);
	if($hapus) {echo "<script>alert('Order $nama_barang berhasil dihapus !');document.location.href='?mnu=keranjang_belanja';</script>";}
	else{echo"<script>alert('Data Order $nama_barang gagal dihapus...');document.location.href='?mnu=keranjang_belanja';</script>";}

}

	if($_GET["pro"]=="reset"){
	$ido=$_GET["id"];
		
	$sql="delete from `$tbpemesanandetail` where `id_pemesanan`='".$ido."'";
	$hapus=process($conn,$sql);
	
	if($hapus) {echo "<script>alert('Data Semua Pemesanan Nota $ido berhasil dihapus !');document.location.href='?mnu=keranjang_belanja';</script>";}
	else{echo"<script>alert('Data Semua Pemesanan Nota $ido gagal dihapus...');document.location.href='?mnu=keranjang_belanja';</script>";}
	}
?>

<?php
	if(isset($_POST["Kirim"])){
	$id_pemesanan=$_GET["id_pemesanan"];
	$sql="update `$tbpemesanan` set `status`='Order' where `id_pemesanan`='".$id_pemesanan."'";
	$ubah=process($conn,$sql);

	$_SESSION["corder"]="";
	unset($_SESSION["corder"]);
	if($ubah) {echo "<script>alert('Data Pemesanan ".$id_pemesanan." berhasil  di Proses, Selanjutnya Silahkan Melakukan Pembayaran terlebih dahulu,!');document.location.href='?mnu=checkout';</script>";}
	else{echo"<script>alert('Data Pemesanan $ido gagal Dikonfirmasikan...');document.location.href='?mnu=cart';</script>";}
}
?>			

