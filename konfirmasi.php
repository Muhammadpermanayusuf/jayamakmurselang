		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col">
						<p class="bread"><span><a href="?mnu=home">Beranda</a></span> / 
						<span>Konfirmasi Pembayaran</span></p>
					</div>
				</div>
			</div>
		</div>

		  <section class="checkout spad">
        <div class="container">
			<?php 
			$id_pelanggan=$_SESSION["cid"];
			$id_pemesanan="";
			if(isset($_GET["id_pemesanan"])){
				$id_pemesanan=$_GET["id_pemesanan"];
			?>
		
    
            <div class="checkout__form">
                <h4>Konfirmasi Pembayaran <?php echo $id_pemesanan;?></h4>
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="row">
					<?php
				
					$sql="select * from `$tbpemesanan` where `id_pemesanan`='$id_pemesanan'";
						$d=getField($conn,$sql);
									$id_pemesanan=$d["id_pemesanan"];
									$id_pemesanan0=$d["id_pemesanan"];
									$tanggal=WKT($d["tanggal"]);
									$jam=$d["jam"];
									$id_pelanggan=$d["id_pelanggan"];
									$pesan=$d["pesan"];
									$alamat=$d["alamat"];
									$status=$d["status"];
									$keterangan=$d["keterangan"];
									
										$sql="select * from `$tbpelanggan` where `id_pelanggan`='$id_pelanggan'";
										$d=getField($conn,$sql);
											$nama_pelanggan=$d["nama_pelanggan"];
											$telepon=$d["telepon"];
											$email=$d["email"];
											$status=$d["status"];
											$alamat=$d["alamat"];
							
							?>
		
                                        <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p><b>Nama Pelanggan :</b></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                               <?php echo "$nama_pelanggan";?>
                                            </div>
                                        </div>
                                 
							
							           <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p><b>Alamat :</b></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                                <?php echo "$alamat";?>
                                            </div>
                                        </div>
										
										 <div class="col-lg-4">
                                            <div class="login-input-head">
                                                <p><b>Waktu Pemesanan / Order :</b></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="login-input-area">
                                               <?php echo "$tanggal $jam  Wib";?>
                                            </div>
                                        </div>
								
						<hr>
                        						
                        <div class="col-lg-6 col-md-6">
										<?php  
											$sql="select sum(`subtotal`) as `subtotal` from `$tbpemesanandetail` where id_pemesanan='$id_pemesanan'";
											$d=getField($conn,$sql);
											$nominal=$d["subtotal"];

											$ONGKIR=$NONJABO;
											if($alamat=="Jabodetabek"){
												$ONGKIR=$JABO;
											}
											$nominaltx=$nominal+$ONGKIR;
										?>    
                            <div class="checkout__input">
                                <p><h4><font color="#0000ff"> Konfirmasi<span>*</font></h4></span>
                                <textarea required type="text" name="pesan" value="" placeholder="Tulis Pesan Konfirmasi Anda disini" style="width: 350px;" class="form-control"></textarea>
                            </div>
								<?php  
									$tot=0;
									  $sql="select * from `$tbpemesanandetail` where `id_pemesanan`='$id_pemesanan' order by `id` asc";
									  $jum=getJum($conn,$sql);
											if($jum > 0){
										$no=1;		
										$arr=getData($conn,$sql);
											foreach($arr as $d) {							
													$id=$d["id"];
													$id_pemesanan=$d["id_pemesanan"];
													$id_barang=$d["id_barang"];
													$jumlah=$d["jumlah"];
													$harga=$d["harga"];
													$subtotal=RP($d["subtotal"]);
													$catatan=$d["catatan"];
													
												$sqlv="select * from `$tbbarang` where `id_barang`='$id_barang'";
													$dv=getField($conn,$sqlv);
													$nama_barang=$dv["nama_barang"];
													$deskripsi=$dv["deskripsi"];
													$gambar=$dv["gambar"];
													$gambar0=$dv["gambar"];
													$ukuran=$dv["ukuran"];
													$tot+=$d["subtotal"];
													
													echo" ";
											}
											}
											else{
											echo"<li>Belum Ada Transaksi<span>0</span></li>";
											}
																 ?>     
							
                            <div class="checkout__input"><br>
                                <font color="#0000ff"> <b>Nominal <span>*</b></font></span><br>
                                <input type="text" name="jumlahtx" style="width: 250px;" value="<?php echo $nominaltx;?>" class="form-control">
                            </div>
							<div class="checkout__input"><br>
							  <font color="#0000ff"> <b>Bank <span>*</b></font></span><br>
								<select name="bank" class="form-control" style="width: 250px;">
									 <option></option>
									 <option value="BCA - 8770471819" <?php if($bank=="BCA - 8770471819"){echo"selected";} ?> >BCA - 8770471819 a/n Jaya Makmur Selang</option>
									 <option value="PERMATA - 0xxxxxxxxx" <?php if($bank=="PERMATA - 0xxxxxxxxx"){echo"selected";} ?> >PERMATA - 0xxxxxxxxx a/n Jaya Makmur Selang</option>
								</select>
							</div>
                            <div><br>
                                <font color="#0000ff"> <b>Bukti Bayar<span>*</b></font></span><br>
                                <input required type="file" name="bukti_bayar" value="<?php echo $nominal; ?>" placeholder="Upload Bukti Bayar Nominal Transfer Anda disini" >
                            </div><br>
							<div>
								<input type="hidden" value="<?php echo $id_pemesanan;?>" name="id_pemesanan">
								<input type="hidden" value="<?php echo $ONGKIR;?>" name="ONGKIR">
								<input type="hidden" value="<?php echo $id_pelanggan;?>" name="id_pelanggan">
								<input type="hidden" value="<?php echo $nominal;?>" name="nominal">
								<input type="hidden" value="<?php echo $nominaltx;?>" name="nominaltx"> 
								<button name="Upload" type="submit" id="Upload"  class="btn btn-custon-rounded-four btn-info"><font color="#fff"><b>Kirim</b></font></button>
					        </div>
                        </div>
					
                        <div class="col-lg-6 col-md-6"><br>
                            <div class="checkout__order">
                                <h4>Pesanan <?php echo $id_pemesanan;?></h4>
                                <div class="checkout__order__products">Produk <span>Total</span></div>
                                <ul>
								<?php  
									$tot=0;
									  $sql="select * from `$tbpemesanandetail` where `id_pemesanan`='$id_pemesanan' order by `id` asc";
									  $jum=getJum($conn,$sql);
											if($jum > 0){
										$no=1;		
										$arr=getData($conn,$sql);
											foreach($arr as $d) {							
													$id=$d["id"];
													$id_pemesanan=$d["id_pemesanan"];
													$id_barang=$d["id_barang"];
													$jumlah=$d["jumlah"];
													$harga=$d["harga"];
													$subtotal=RP($d["subtotal"]);
													$catatan=$d["catatan"];
													
												$sqlv="select * from `$tbbarang` where `id_barang`='$id_barang'";
													$dv=getField($conn,$sqlv);
													$nama_barang=$dv["nama_barang"];
													$deskripsi=$dv["deskripsi"];
													$gambar=$dv["gambar"];
													$gambar0=$dv["gambar"];
													$ukuran=$dv["ukuran"];
													$tot+=$d["subtotal"];
													echo" <li>$nama_barang ($jumlah) <span>$subtotal</span></li>";
											}
											}
											else{
											echo"<li>Belum Ada Transaksi<span>0</span></li>";
											}
                             ?>       
                                   
                                </ul>
                                <div class="checkout__order__subtotal">Total <span><?php echo RP($tot);?></span></div>
                                <div class="checkout__order__total">Terbilang <span><?php echo terbilang($tot);?></span></div>
                               <input type="hidden" value="<?php echo $tot;?>" name="tot"> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
			<?php
			}
else{
	
	$m=0;
	if($m==0){
		echo"<div class='row'>";
	}
	
 $sql2="select * from `$tbkonfirmasi`,`$tbpemesanan` where `$tbkonfirmasi`.`id_pemesanan`=`$tbpemesanan`.`id_pemesanan`  and `$tbpemesanan`.`id_pelanggan`='$id_pelanggan' order by `$tbkonfirmasi`.`id_konfirmasi` desc";
  $jum2=getJum($conn,$sql2);
		if($jum2 <1){
		echo"<h3><i><font color='red'><marquee>Maaf belum ada transaksi Konfirmasi sebelumnya</marquee></i></font></h3>";
		}
		$arr2=getData($conn,$sql2);
		foreach($arr2 as $d2) {							
				$id_konfirmasi=$d2["id_konfirmasi"];
				$tanggal=WKT($d2["tanggal"]);
				$jam=$d2["jam"];
				$id_pemesanan=$d2["id_pemesanan"];
				$pesan=$d2["pesan"];
				$nominal=$d2["nominal"];
				$bukti_bayar=$d2["bukti_bayar"];
				$bukti_bayar0=$d2["bukti_bayar"];
				$status=$d2["status"];
				$keterangan=$d2["keterangan"];
				$m++;
				?>
				
		
 <div class="col-lg-6 col-md-6">
   <div class="checkout__order">
     <h4>Konfirmasi <?php echo "$id_konfirmasi-$id_pemesanan";?></h4>
       <div class="checkout__order__products">Produk <span>Total</span></div>
       <ul>
		<?php  
									$tot=0;
									  $sql="select * from `$tbpemesanandetail` where id_pemesanan='$id_pemesanan' order by `id` asc";
									  $jum=getJum($conn,$sql);
											if($jum > 0){
										$no=1;		
										$arr=getData($conn,$sql);
											foreach($arr as $d) {							
													$id=$d["id"];
													$id_pemesanan=$d["id_pemesanan"];
													$id_barang=$d["id_barang"];
													$jumlah=$d["jumlah"];
													$harga=$d["harga"];
													$subtotal=RP($d["subtotal"]);
													$catatan=$d["catatan"];
													
												$sqlv="select * from `$tbbarang` where `id_barang`='$id_barang'";
													$dv=getField($conn,$sqlv);
													$nama_barang=$dv["nama_barang"];
													$deskripsi=$dv["deskripsi"];
													$gambar=$dv["gambar"];
													$gambar0=$dv["gambar"];
													$ukuran=$dv["ukuran"];
													$tot+=$d["subtotal"];
													echo" <li>$nama_barang ($jumlah) <span>$subtotal</span></li>";
											}
											}
											else{
											echo"<li>Belum Ada Transaksi<span>0</span></li>";
											}
                             ?>            
                                   
            </ul>
            <div class="checkout__order__subtotal">Total  <?php echo $status;?> <span><?php echo RP($nominal);?></span></div>
            <div class="checkout__order__total">Terbilang <span>
			<a href="download.php?nf=<?php echo $bukti_bayar?>"><?php echo terbilang($nominal);?></a></span></div>
           </div>	
		 </div>	
		<?php
		}//while
		
		if($m==2){
			$m=0;
			echo"</div>";
		}
			}//if
			?>
        </div>
    </section>


		<?php
	if(isset($_POST["Upload"])){
	$id_pemesanan=strip_tags($_POST["id_pemesanan"]);
	$id_pelanggan=strip_tags($_POST["id_pelanggan"]);
	$pesan=strip_tags($_POST["pesan"]);
	$bank=strip_tags($_POST["bank"]);
	$nominal=strip_tags($_POST["nominal"]);
	$ONGKIR=strip_tags($_POST["ONGKIR"]);
	$nominaltx=strip_tags($_POST["nominaltx"]);
	$jumlahtx=strip_tags($_POST["jumlahtx"]);
	$status="Konfirmasi";
	$keterangan="";

	if($jumlahtx<$nominaltx){
	echo "<script>alert('Maaf Nominal yang anda masukkan Kurang.....Seharusnya ".RP($nominaltx)."');document.location.href='?mnu=_konfirmasi&id_order=$id_order';</script>";
	}
	else{
	$sql="select `id_konfirmasi` from `$tbkonfirmasi` order by `id_konfirmasi` desc";
	$q=mysqli_query($conn, $sql);
	$jum=mysqli_num_rows($q);
	$th=date("y");
	$bl=date("m")+0;if($bl<10){$bl="0".$bl;}

	$kd="KFM".$th.$bl;//KEG1610001
	if($jum > 0){
	$d=mysqli_fetch_array($q);
	$idmax=$d["id_konfirmasi"];

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
	$id_konfirmasi=$idmax;

 
	$bukti_bayar0="avatar.jpg";
	if ($_FILES["bukti_bayar"] != "") {
	@copy($_FILES["bukti_bayar"]["tmp_name"],"admin/ypathfile/".$_FILES["bukti_bayar"]["name"]);
	$bukti_bayar=$_FILES["bukti_bayar"]["name"];
	} 
	else {$bukti_bayar=$bukti_bayar0;}
	if(strlen($bukti_bayar)<1){$bukti_bayar=$bukti_bayar0;}

	$keterangan="Total Pemesanan: $nominal,  Total Keseluruhan: $nominaltx";
	
	$sql="Update `$tbpemesanan` set `status`='Konfirmasi' where `id_pemesanan`='$id_pemesanan'";
	$up=process($conn,$sql);


	$sql="INSERT INTO `$tbkonfirmasi` (
	`id_konfirmasi` ,
	`id_pelanggan` ,
	`tanggal` ,
	`jam` ,
	`id_pemesanan` ,`pesan` ,
	`nominal` ,
	`bank` ,
	`bukti_bayar` ,
	`status` ,
	`keterangan` 
	) VALUES (
	'$id_konfirmasi' ,
	'$id_pelanggan' ,
	'".date("Y-m-d")."' ,
	'".date("H:i:s")."' ,
	'$id_pemesanan','$pesan' ,
	'$jumlahtx' ,
	'$bank' ,
	'$bukti_bayar' ,
	'$status',
	'$keterangan' 
	)";

	$simpan=process($conn,$sql);
	if($simpan) {echo "<script>alert('Data $id_konfirmasi berhasil dikirim !');document.location.href='?mnu=konfirmasi';</script>";}
	else{echo"<script>alert('Data $id_konfirmasi gagal dikirim...');document.location.href='?mnu=konfirmasi&id_pemesanan=$id_pemesanan';</script>";}
	}
	}
	?>