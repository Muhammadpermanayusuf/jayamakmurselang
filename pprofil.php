

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="?mnu=home">Home</a></span> / 
						<span>Profil Pelanggan</span></p>
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
				$telepon=$d["telepon"];
				$email=$d["email"];
				$alamat=$d["alamat"];
				$username=$d["username"];
				$password=$d["password"];
?>

		<div id="colorlib-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="contact-wrap">
							<h3>Profil Pelanggan</h3>
							<form name="form-login" action="#" method="post" class="contact-form">
								<div class="row">
								   <div class="col-md-6">
										<div class="form-group">
											<label for="lname">Nama : </label><br>
											<?php echo $nama_pelanggan; ?>
										</div>
									</div>
								    <div class="col-md-6">
										<div class="form-group">
											<label for="fname">Telepon : </label><br>
											<?php echo $telepon; ?>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="lname">Email : </label><br>
											<?php echo $email; ?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="fname">Username : </label><br>
											<?php echo $username; ?>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="lname">Password : </label><br>
											<?php echo md5($password); ?>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="lname">Alamat : </label><br>
											<?php echo $alamat; ?>
										</div>
									</div>
								</div>
							</form>		
						</div>
					</div>
					
				
					
					<div class="col-md-6">
						<div class="contact-wrap">
							<h3>Form Ubah Profil</h3>
							<form name="form-buatakun" action="#" method="post" class="contact-form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="lname">Nama</label>
											<input readonly type="nama_pelanggan" name="nama_pelanggan" class="form-control" value="<?php echo $nama_pelanggan; ?>">
										</div>
									</div>
								    <div class="col-md-6">
										<div class="form-group">
											<label for="fname">Telepon</label>
											<input  type="number" name="telepon" class="form-control" value="<?php echo $telepon; ?>">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="lname">Email</label>
											<input  type="email" name="email" class="form-control" value="<?php echo $email; ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="fname">Username</label>
											<input  type="username" name="username" class="form-control" value="<?php echo $username; ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="lname">Password</label>
											<input readonly type="password" name="password" class="form-control" value="<?php echo $password; ?>">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="lname">Alamat</label>
											<textarea readonly type="text" name="alamat" class="form-control" placeholder="Alamat belum tersedia"><?php echo $alamat; ?></textarea>
										</div>
									</div>
									
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
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
if(isset($_POST["Simpan"])){
	$id_pelanggan=strip_tags($_POST["id_pelanggan"]);
	$nama_pelanggan=strip_tags($_POST["nama_pelanggan"]);
	$telepon=strip_tags($_POST["telepon"]);
	$email=strip_tags($_POST["email"]);
	$username=strip_tags($_POST["username"]);
	$password=strip_tags($_POST["password"]);
	$alamat=strip_tags($_POST["alamat"]);
	$keterangan=strip_tags($_POST["keterangan"]);
	$status=strip_tags($_POST["status"]);
	
$sql="update `$tbpelanggan` set 
	`username`='$username',
	`password`='$password',
	`telepon`='$telepon' ,
	`email`='$email',
	`alamat`='$alamat'
	 where `id_pelanggan`='$id_pelanggan'";
	
	$ubah=process($conn,$sql);
		if($ubah) {echo "<script>alert('Data $nama_pelanggan berhasil diubah !');document.location.href='?mnu=pprofil';</script>";}
		else{echo"<script>alert('Data $nama_pelanggan gagal diubah...');document.location.href='?mnu=pprofil';</script>";}
	}//else simpan
?>

