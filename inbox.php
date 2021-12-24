

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="?mnu=home">Beranda</a></span> / 
						<span>Inbox</span></p>
					</div>
				</div>
			</div>
		</div>
<?php
	$id_pelanggan=$_SESSION["cid"];
	$sql="select * from `$tbpelanggan` where `id_pelanggan`='$id_pelanggan'";
	$d=getField($conn,$sql);
				$id_pelanggan=$d["id_pelanggan"];
				$nama_pelanggan=$d["nama_pelanggan"];
				?>

		<div id="colorlib-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="contact-wrap">
							<h3>Form Inbox</h3>
							<form name="form-buatakun" action="#" method="post" class="contact-form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="id_pelanggan">Nama</label>
											<input required type="text" style="width: 450px;"  name="id_pelanggan" class="form-control"  value="<?php echo $nama_pelanggan; ?>" readonly placeholder="<?php echo $nama_pelanggan; ?>">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="email">Pesan</label>
											<textarea type="text"  class="form-control" name="pesan" placeholder="" /><?php echo $pesan;?></textarea>
										</div>
									</div>
									
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="submit" name="Kirim" value="Kirim" class="btn btn-primary">
											<input name="id_pelanggan" type="hidden" id="id_pelanggan" value="<?php echo $id_pelanggan;?>" />
										</div>
									</div>
								</div>
							</form>		
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
if(isset($_POST["Kirim"])){
	$pro=strip_tags($_POST["pro"]);
	$id_inbox=strip_tags($_POST["id_inbox"]);
	$id_admin=strip_tags($_POST["id_admin"]);
	$id_pelanggan=strip_tags($_POST["id_pelanggan"]);
	$pesan=strip_tags($_POST["pesan"]);
	$tanggal=date("Y-m-d");
	$jam=date("H:i:s");
	$status=strip_tags($_POST["status"]);
		
 $sql=" INSERT INTO `$tbinbox` (
`id_pelanggan` ,
`id_admin` ,
`pesan` ,
`tanggal` ,
`jam` ,
`status` 
) VALUES (
'$id_pelanggan',
'$id_admin',
'$pesan', 
'$tanggal',
'$jam',
'0'
)";
	
$simpan=process($conn,$sql);
	if($simpan) {echo "<script>alert('Data $id_pelanggan berhasil disimpan !');document.location.href='?mnu=inbox';</script>";}
		else{echo"<script>alert('Data $id_pelanggan gagal disimpan...');document.location.href='?mnu=inbox';</script>";}
}
?>

