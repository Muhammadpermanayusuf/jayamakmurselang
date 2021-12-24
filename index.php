<?php
if (version_compare(phpversion(), "5.3.0", ">=")  == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE);  
  ?>
<?php
session_start();
//error_reporting(0);
require_once"admin/konmysqli.php";
$mnu="";
if(isset($_GET["mnu"])){
$mnu=$_GET["mnu"];
}

date_default_timezone_set("Asia/Jakarta");


/*
$tanggal = '2005-09-01 09:02:23';
$tanggal = new DateTime($tanggal); 

$sekarang = new DateTime();

$perbedaan = $tanggal->diff($sekarang);

//gabungkan
echo $perbedaan->y.' selisih tahun.';
echo $perbedaan->m.' selisih bulan.';
echo $perbedaan->d.' selisih hari.';
echo $perbedaan->h.' selisih jam.';
echo $perbedaan->i.' selisih menit.';
*/

$LAMAJAM=5;

	$sql="select `id_pemesanan`,`jam`,`tanggal` from `$tbpemesanan` where `status`='Order'";
	$jum=getJum($conn,$sql);
	if($jum>0){
			$arr=getData($conn,$sql);
			foreach($arr as $dx) {		
				$id_pemesanan=$dx["id_pemesanan"];
				$jam=$dx["jam"];
				$tanggal=$dx["tanggal"];
			
			$waktuOrder = $tanggal." ".$jam;
			$waktuOrder = new DateTime($waktuOrder); 
				$waktuSekarang = new DateTime();
				$selisih = $waktuOrder->diff($waktuSekarang);
				$wk=$selisih->h;
				$hr=$selisih->d;
				//echo $wk."@$hr#";
				if($wk>$LAMAJAM || $hr>0){
					$sqlk="Update `$tbpemesanan` set `status`='Batal',`keterangan`='Expire Time' where `id_pemesanan`='$id_pemesanan'";
					$up=process($conn,$sqlk);

					 $sqlv="select `id_barang`,`jumlah` from `$tbpemesanandetail` where id_pemesanan='$id_pemesanan'";
					$arrv=getData($conn,$sqlv);
					foreach($arrv as $dv) {		
							$id_barang=$dv["id_barang"];
							$jumlah=$dv["jumlah"];
							
							$sqls="update  `$tbbarang` set `stok`=`stok`+'$jumlah' where `id_barang`='$id_barang'";
							$up=process($conn,$sqls);
							}///for1
			}
		}//for
	}
?>
<html>
	<head>
	<title>Beranda - CV.Jaya Makmur Selang</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rokkitt:100,300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/ionicons.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
	<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		
	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-sm-7 col-md-9">
							<div id="colorlib-logo"><a href="index.php">Jaya Makmur Selang</a></div>
						</div>
						<div class="col-sm-5 col-md-3">
			            <form method="POST" action="?mnu=produk" class="search-wrap">
			               <div class="form-group">
			                  <input type="text" name="txtcari"  class="form-control search" placeholder="Cari produk">
			                  <button class="btn btn-primary submit-search text-center" type="submit" name="Cari"><i class="icon-search"></i></button>
			               </div>
			            </form>
			         </div>
		         </div>
					<div class="row">
						<div class="col-sm-12 text-left menu-1">
							<ul>
							<?php
							if($_SESSION["cstatus"]=="Pelanggan"){ ?>
								<li class="active"><a href="index.php?mnu=home">Beranda</a></li>
								
								<li><a href="index.php?mnu=produk">Produk</a></li>
								<!--li class="has-dropdown">
									<a href="#">Transaksi</a>
									<ul class="dropdown">
										<li><a href="index.php?mnu=keranjang">Keranjang</a></li>
										<li><a href="index.php?mnu=checkout">Checkout</a></li>
										<li><a href="index.php?mnu=konfirmasi">Konfirmasi</a></li>
										<li><a href="index.php?mnu=arsip">Arsip</a></li>
									</ul>
								</li-->
								<li><a href="index.php?mnu=keranjang_belanja">Keranjang</a></li>
								<li><a href="index.php?mnu=checkout">Checkout</a></li>
								<li><a href="index.php?mnu=konfirmasi">Konfirmasi</a></li>
								<li><a href="index.php?mnu=arsip">Arsip</a></li>
								<li><a href="index.php?mnu=pengiriman">Pengiriman</a></li>
								<li><a href="index.php?mnu=inbox">Inbox</a></li>
								
								<li class="cart"><a href="index.php?mnu=logout">Logout</a></li> 
								<li class="cart"><a href="index.php?mnu=pprofil">Profil</a> |</li> 
								
								<?php } else { ?>	
								
								<li class="active"><a href="index.php?mnu=home">Beranda</a></li>
								<li><a href="index.php?mnu=produk">Produk</a></li>
								<li><a href="index.php?mnu=tentang_kami">Tentang Kami</a></li>
								<li><a href="index.php?mnu=kontak_kami">Kontak Kami</a></li>
								<li class="cart"><a href="index.php?mnu=login"> Login</a></li>
								
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			
			<div class="sale">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 offset-sm-2 text-center">
							<div class="row">
								<div class="owl-carousel2">
									<div class="item">
										<div class="col">
											<h3><a href="#">Selang berkualitas </a></h3>
										</div>
									</div>
									<div class="item">
										<div class="col">
											<h3><a href="#">Penjualan terbesar kami  untuk semua jenis selang</a></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>
		
		<?php if($mnu=="home" || $mnu==""){ ?>
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/img_bg_1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">CV.Jaya Makmur Selang</h1>
					   					<p><a href="#" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(images/img_bg_2.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">CV.Jaya Makmur Selang</h1>
					   					<p><a href="#" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(images/img_bg_3.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-sm-6 offset-sm-3 text-center slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">CV.Jaya Makmur Selang</h1>
					   					<p><a href="#" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		<?php } ?>
		
		<?php
						if($mnu=="produk"){require_once"produk.php";}
						else if($mnu=="produk_detail"){require_once"produk_detail.php";}
						else if($mnu=="profil"){require_once"profil.php";}
						else if($mnu=="pprofil"){require_once"pprofil.php";}
						else if($mnu=="register"){require_once"register.php";}
						else if($mnu=="kontak_kami"){require_once"kontak_kami.php";}
						else if($mnu=="tentang_kami"){require_once"tentang_kami.php";}
						else if($mnu=="keranjang_belanja"){require_once"keranjang_belanja.php";}
						else if($mnu=="checkout"){require_once"checkout.php";}
						else if($mnu=="pembayaran"){require_once"pembayaran.php";}
						else if($mnu=="pembayarana"){require_once"pembayarana.php";}
						else if($mnu=="konfirmasi"){require_once"konfirmasi.php";}
						else if($mnu=="pengiriman"){require_once"pengiriman.php";}
						else if($mnu=="Midtrans"){require_once"admin/Midtrans.php";}
						else if($mnu=="prosesmidtrans"){require_once"admin/prosesmidtrans.php";}
						else if($mnu=="inbox"){require_once"inbox.php";}
						else if($mnu=="arsip"){require_once"arsip.php";}
						else if($mnu=="history"){require_once"history.php";}
						else if($mnu=="login"){require_once"login.php";}
						else if($mnu=="logout"){require_once"logout.php";}
						else {require_once"home.php";}
					 ?>

		<footer id="colorlib-footer" role="contentinfo">
			<div class="container">
				<div class="row row-pb-md">
					<div class="col footer-col colorlib-widget">
						<h4>Tentang Jaya Makmur Selang</h4>
						<p></p>
						<p>
							<ul class="colorlib-social-icons">
								<li><a href="#"><i class="icon-twitter"></i></a></li>
								<li><a href="#"><i class="icon-facebook"></i></a></li>
								<li><a href="#"><i class="icon-linkedin"></i></a></li>
								<li><a href="#"><i class="icon-dribbble"></i></a></li>
							</ul>
						</p>
					</div>
					<div class="col footer-col colorlib-widget">
						<h4>Tautan</h4>
						<p>
							<ul class="colorlib-footer-links">
								<li><a href="index.php?mnu=home">Beranda</a></li>
								<li><a href="index.php?mnu=produk">Produk</a></li>
								<li><a href="index.php?mnu=tentang_kami">Tentang Kami</a></li>
							</ul>
						</p>
					</div>
				

					<div class="col footer-col">
						<h4>News</h4>
						<ul class="colorlib-footer-links">
							<li><a href="blog.html">Blog</a></li>
							<li><a href="#">Press</a></li>
							<li><a href="#">Exhibitions</a></li>
						</ul>
					</div>

					<div class="col footer-col">
						<h4>Contact Information</h4>
						<ul class="colorlib-footer-links">
							<li>Pusat pertokoan Glodok,<br>Blok D No.10 Mangga Besar, <br> Taman Sari, Jakarta Barat</li>
							<li><a href="tel://083893300939">+62 8389 3300 939</a></li>
							<li><a href="index.php?mnu=tentang_kami">info</a></li>
							<li><a href="cv.jayamakmurselang">cv.jayamakmurselang</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="copy">
				<div class="row">
					<div class="col-sm-12 text-center">
						<p>
						  <span><script>document.write(new Date().getFullYear());</script> CV.Jaya Makmur Selang</span> 
						</p>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.flexslider-min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/main.js"></script>
	</body>
</html>

