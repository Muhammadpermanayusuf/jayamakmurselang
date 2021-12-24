

		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="?mnu=home">Home</a></span> / 
						<span>Login</span></p>
					</div>
				</div>
			</div>
		</div>


		<div id="colorlib-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="contact-wrap">
							<h3>Form Login</h3>
							<form name="form-login" action="#" method="post" class="contact-form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="fname">Username</label>
											<input type="username" name="user" class="form-control" placeholder="Username">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="lname">Password</label>
											<input type="password" name="pass" class="form-control" placeholder="Password">
										</div>
									</div>
									
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="submit" name="Login" value="Masuk" class="btn btn-primary">
										</div>
									</div>
								</div>
							</form>		
						</div>
					</div>
					
					<?php
if(isset($_POST["Login"])){
	$usr=$_POST["user"];
	$pas=$_POST["pass"];
	
		$sql1="select * from `$tbpelanggan` where `username`='$usr' and `password`='$pas' and `status`='Aktif'";
		
		if(getJum($conn,$sql1)>0){
			$d=getField($conn,$sql1);
				$kode=$d["id_pelanggan"];
				$nama=$d["nama_pelanggan"];
				   $_SESSION["cid"]=$kode;
				   $_SESSION["cnama"]=$nama;
				   $_SESSION["cstatus"]="Pelanggan";
		echo "<script>alert('Otentikasi ".$_SESSION["cstatus"]." ".$_SESSION["cnama"]." (".$_SESSION["cid"].") berhasil Login!');
		document.location.href='index.php?mnu=home';</script>";
		}

		else{
			session_destroy();
			echo "<script>alert('Otentikasi Login GAGAL !,Silakan cek data Anda kembali...');
			document.location.href='index.php?mnu=login';</script>";
		}
}
?>
					
					<div class="col-md-6">
						<div class="contact-wrap">
							<h3>Form Buat Akun</h3>
							<form name="form-buatakun" action="#" method="post" class="contact-form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="fname">Nama</label>
											<input required type="text" name="nama_pelanggan" class="form-control" placeholder="Nama">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="lname">Telepon</label>
											<input required type="text" name="telepon" class="form-control" placeholder="Telepon">
										</div>
									</div>
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="email">Email</label>
											<input required type="text" name="email" class="form-control" placeholder="Email">
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label for="email">Alamat</label>
											<input required type="text" name="alamat" class="form-control" placeholder="Alamat">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="fname">Username</label>
											<input required type="text" name="username" class="form-control" placeholder="Username">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="lname">Password</label>
											<input required type="text" name="password" class="form-control" placeholder="Password">
										</div>
									</div>
									
									<div class="w-100"></div>
									<div class="col-sm-12">
										<div class="form-group">
											<input type="submit" name="Daftar" value="Daftar" class="btn btn-primary">
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
if(isset($_POST["Daftar"])){
	$id_pelanggan=strip_tags($_POST["id_pelanggan"]);
	$nama_pelanggan=strip_tags($_POST["nama_pelanggan"]);
	$telepon=strip_tags($_POST["telepon"]);
	$email=strip_tags($_POST["email"]);
	$username=strip_tags($_POST["username"]);
	$password=strip_tags($_POST["password"]);
	$alamat=strip_tags($_POST["alamat"]);
	$keterangan=strip_tags($_POST["keterangan"]);
	$status=strip_tags($_POST["status"]);
	
	$sql="select `id_pelanggan` from `$tbpelanggan` order by `id_pelanggan` desc";
$q=mysqli_query($conn, $sql);
  $jum=mysqli_num_rows($q);
  $th=date("y");
  $bl=date("m")+0;if($bl<10){$bl="0".$bl;}

  $kd="PLG".$th.$bl;//KEG1610001
  if($jum > 0){
   $d=mysqli_fetch_array($q);
   $idmax=$d["id_pelanggan"];
   
   $bul=substr($idmax,5,2);
   $tah=substr($idmax,3,2);
    if($bul==$bl && $tah==$th){
     $urut=substr($idmax,7,3)+1;
     if($urut<10){$idmax="$kd"."00".$urut;}
     else if($urut<100){$idmax="$kd"."0".$urut;}
     else{$idmax="$kd".$urut;}
    }//==
    else{
     $idmax="$kd"."001";
     }   
   }//jum>0
  else{$idmax="$kd"."001";}
  $id_pelanggan=$idmax;

$sql=" INSERT INTO `$tbpelanggan` (
`id_pelanggan` ,
`nama_pelanggan` ,
`telepon` ,
`email` ,
`username` ,
`password` ,
`alamat` ,
`keterangan` ,
`status` 
) VALUES (
'$id_pelanggan', 
'$nama_pelanggan', 
'$telepon',
'$email',
'$username',
'$password',
'$alamat',
'-',
'Aktif'
)";
	
$simpan=process($conn,$sql);
		if($simpan) {echo "<script>alert('Data $nama_pelanggan berhasil terdaftar !');document.location.href='?mnu=login';</script>";}
		else{echo"<script>alert('Data $nama_pelanggan gagal terdaftar...');document.location.href='?mnu=login';</script>";}
	}
?>

