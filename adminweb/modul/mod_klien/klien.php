<script language="javascript">
	function validasigrup(form){
		if (form.grup.value == ""){
			alert("Anda belum mengisikan nama grup.");
			form.grup.focus();
			return (false);
		}
	}
</script>

<?php
$aksi = "modul/mod_klien/aksi_klien.php";
switch($_GET[act]){
	// Tampil Group
	default:
	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen Klien
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=klien">Manajemen Klien</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
		<!-- <div class="panel-title"><span class="glyphicon glyphicon-list"></span> Daftar User <i style="margin-left:820px;"> -->
			
			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Manajemen Klien <i style="margin-left:700px;">
			<?php if($_SESSION['level']=="Super"){?>
			<button class="btn btn-success btn-sm " onclick="window.location.href='?module=klien&act=tambahklien'">
			<span class="glyphicon glyphicon-plus"></span> Tambah Data</button></i>
			<?php } ?>
			</div>
		</div>
		<div class="panel-body">
			<div class="col-md-4" style="margin-top: 10px">
				<span class="form-group"> Jumlah Data : 
					<?php
					if($_SESSION['level']=="Rekan"){
						$se = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM trekan 
						where nama ='$_SESSION[fullname]'"));
						$idz = $se['id'];
						if (isset($_GET['bulan'])) {  
							$quer = mysqli_query($hore, "SELECT * FROM kontrak_kerja 
							where MONTH(tanggal_awal) = '$_GET[bulan]' and id_rekan='$idz'");
							$jm = mysqli_num_rows($quer);
						}else{
							$quer = mysqli_query($hore, "SELECT * FROM kontrak_kerja where id_rekan='$idz'");
							$jm = mysqli_num_rows($quer);
						}
					}else{	
						if (isset($_GET['bulan'])) {  
							$quer = mysqli_query($hore, "SELECT * FROM kontrak_kerja 
							where MONTH(tanggal_awal) = '$_GET[bulan]' and id_rekan='$idz'");
							$jm = mysqli_num_rows($quer);
						}else{
							$quer = mysqli_query($hore, "SELECT * FROM kontrak_kerja where id_rekan='$idz'");
							$jm = mysqli_num_rows($quer);
						}
					}
					echo $jm;
					?>
				</span>
			</div>
			<div style="margin-left: 500px">	
			<div class="col-md-12">
				<div class="row">
			<?php if($_SESSION['level']=="Super"){?>
				<div class="col-md-4">
					<select name="rek" class="form-control" id="rek">
					<option value="">--Pilih Rekan--</option>
					<?php $query = mysqli_query($hore, "SELECT * FROM trekan");
					while($rq = mysqli_fetch_array($query)):
					?>
						<option value="<?php echo $rq['id']?>"><?php echo $rq['nama'] ?></option>
					<?php endwhile; ?>
					</select>
				</div>
			<?php } ?>		
				<div class="col-md-4">
					<select name="bulan" class="form-control" id="bulan">
						<?php if (!isset($_GET['bulan'])) {  ?>
						<option>--Pilih--</option>
						<?php }else{ ?>
							<option value="<?= $_GET['bulan'] ?>">
								<?php 
								if ($_GET['bulan'] == '01') {
									echo 'Januari';
								}elseif ($_GET['bulan'] == '02') {
									echo 'Februari';
								}elseif ($_GET['bulan'] == '03') {
									echo 'Maret';
								}elseif ($_GET['bulan'] == '04') {
									echo 'April';
								}elseif ($_GET['bulan'] == '05') {
									echo 'Mei';
								}elseif ($_GET['bulan'] == '06') {
									echo 'Juni';
								}elseif ($_GET['bulan'] == '07') {
									echo 'Juli';
								}elseif ($_GET['bulan'] == '08') {
									echo 'Agustus';
								}elseif ($_GET['bulan'] == '09') {
									echo 'September';
								}elseif ($_GET['bulan'] == '10') {
									echo 'Oktober';
								}elseif ($_GET['bulan'] == '11') {
									echo 'November';
								}else{
									echo "Desember";
								}
								?>
							</option>
						<?php } ?>
						<option value="01">Januari</option>
						<option value="02">Februari</option>
						<option value="03">Maret</option>
						<option value="04">April</option>
						<option value="05">Mei</option>
						<option value="06">Juni</option>
						<option value="07">Juli</option>
						<option value="08">Agustus</option>
						<option value="09">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
				</div>
				<div class="col-md-4">
				<a href="master.php?module=klien" class="btn btn-primary">Reset</a>
				</div>
				</div>
			</div>
			</div><br><br>
			<table id="tablekonten" class="table table-striped table-bordered table-responsive" style="">
				<thead>
					<th width="1%"><div id="konten">No</div></th>
					<th><div id="konten">Nama</div></th>
					<th><div id="konten">Alamat</div></th>
					<th><div id="konten">No Telp</div></th>
					<th><div id="konten">Nama Rekanan</div></th>
					<th><div id="konten">Layanan Jasa</div></th>
					<th><div id="konten">Tanggal Awal Kontrak</div></th>
					<th><div id="konten">Tanggal Akhir Kontrak</div></th>
					
					<th colspan='2'><div id="konten"><center>Aksi</div></th>
					
					<!-- <th><div id="konten">Aksi</div></th> -->
				</thead>
				<tbody>
					<?php 
					
						$p      = new PagingKlien();
						$batas  = 10;
						$posisi = $p->cariPosisi($batas);
						if($_SESSION['level']=="Rekan"){
							$sel = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM trekan where nama ='$_SESSION[fullname]'"));
							$idr = $sel['id'];
							if (!isset($_GET['bulan'])) { 
							$tampil = mysqli_query($hore,
								"SELECT * FROM kontrak_kerja 
								left join tcompany on tcompany.companyId = kontrak_kerja.id_tcompany
								left join trekan on kontrak_kerja.id_rekan = trekan.id
								left join tuser on tuser.fullname = tcompany.companyName
								where kontrak_kerja.id_rekan = '$idr'
								order by id_kontrak asc limit $posisi,$batas");
							}else{
								$tampil = mysqli_query($hore,
								"SELECT * FROM kontrak_kerja 
								left join tcompany on tcompany.companyId = kontrak_kerja.id_tcompany
								left join trekan on kontrak_kerja.id_rekan = trekan.id
								left join tuser on tuser.fullname = tcompany.companyName
								where MONTH(tanggal_awal) ='$_GET[bulan]' and kontrak_kerja.id_rekan = '$idr'
								order by id_kontrak asc limit $posisi,$batas");
							}
						}else{
							if (isset($_GET['bulan'])) { 
							$tampil = mysqli_query($hore,
							"SELECT * FROM kontrak_kerja 
							left join tcompany on tcompany.companyId = kontrak_kerja.id_tcompany
							left join trekan on kontrak_kerja.id_rekan = trekan.id
							left join tuser on tuser.fullname = tcompany.companyName
							where MONTH(tanggal_awal) ='$_GET[bulan]'
							order by id_kontrak asc limit $posisi,$batas");
							}elseif(isset($_GET['rek'])){
								$tampil = mysqli_query($hore,
								"SELECT * FROM kontrak_kerja 
								left join tcompany on tcompany.companyId = kontrak_kerja.id_tcompany
								left join trekan on kontrak_kerja.id_rekan = trekan.id
								left join tuser on tuser.fullname = tcompany.companyName
								where id_rekan ='$_GET[rek]'
								order by id_kontrak asc limit $posisi,$batas");
							}else { 
							$tampil = mysqli_query($hore,
								"SELECT * FROM kontrak_kerja 
								left join tcompany on tcompany.companyId = kontrak_kerja.id_tcompany
								left join trekan on kontrak_kerja.id_rekan = trekan.id
								left join tuser on tuser.fullname = tcompany.companyName
								order by id_kontrak asc limit $posisi,$batas");
							}
							// else{
							// 	$tampil = mysqli_query($hore,
							// 	"SELECT * FROM kontrak_kerja 
							// 	left join tcompany on tcompany.companyId = kontrak_kerja.id_tcompany
							// 	left join trekan on kontrak_kerja.id_rekan = trekan.id
							// 	left join tuser on tuser.fullname = tcompany.companyName
							// 	where id_rekan ='$_GET[rek]' and MONTH(tanggal_awal) ='$_GET[bulan]'
							// 	order by id_kontrak asc limit $posisi,$batas");
							// }
							
						}
						$no =$posisi+1;
						$cek = mysqli_num_rows($tampil);
						if ($cek == 0) {
							echo "<tr>
							<td colspan='9'><center>Tidak Ada Data</td>
							</tr>";
						}
						while ($data = mysqli_fetch_array($tampil)){
							?>
							
							<tr>
								<td><div id="kontentd"><?php echo $no; ?></div></td>
								<td><div id="kontentd"><?php echo $data['companyName'];?></div></td>
								<td><div id="kontentd"><?php echo $data['companyAddress'];?></div></td>
								<td><div id="kontentd"><?php echo $data['companyPhoneHp'];?></div></td>
								<td><div id="kontentd"><?php echo $data['nama'];?></div></td>
								<td><div id="kontentd"><?php 
								$q = mysqli_query($hore,"SELECT * FROM tcompany_layanan 
								left join layanan on layanan.id = tcompany_layanan.id_layanan
								where companyId ='$data[companyId]' and id_kontrak='$data[id_kontrak]'");
								while($rq = mysqli_fetch_array($q)){echo "- ".$rq['nama_layanan']."<br>";}
								;?></div></td>
								<td><div id="kontentd"><?php echo date('d F Y',strtotime($data['tanggal_awal']));?></div></td>
								<td><div id="kontentd"><?php echo date('d F Y',strtotime($data['tanggal_akhir']));?></div></td>
								
								<?php 
								if($_SESSION['level']=="Rekan"){ ?>
								<td><?php
									$dy = date('Y-m-d');
									$cek = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM kontrak_kerja 
									where id_kontrak='$data[id_kontrak]' and konfirmasi = '-'"));
									$kontrak = mysqli_query($hore, "SELECT * FROM kontrak_kerja where id_kontrak = '$data[id_kontrak]'");
									$rowkontrak = mysqli_fetch_array($kontrak);
									$tanggal_kontrak = strtotime(date('Y-m-d', strtotime($rowkontrak['tanggal_akhir'])));
									$tanggal_sekarang = strtotime(date('Y-m-d'));
									if ($cek > 0) {
										if (($tanggal_sekarang >= $tanggal_kontrak)) { ?>
										<a href="<?php echo $aksi;?>?module=klien&act=up&id_kontrak=<?php echo $data['id_kontrak'];?>&email=<?php echo $data['email']; ?>">
										<button class="btn btn-success">
											<span class="glyphicon glyphicon-ok"></span>
										</button>
										</a>
									<?php }else{ ?>
										<a href="<?php echo $aksi;?>?module=klien&act=up&id_kontrak=<?php echo $data['id_kontrak'];?>">
										<button class="btn btn-success" disabled>
											<span class="glyphicon glyphicon-ok"></span>
										</button>
										</a>
									<?php	}	
									}else{ ?>
										<a href="<?php echo $aksi;?>?module=klien&act=up&id_kontrak=<?php echo $data['id_kontrak'];?>">
										<button class="btn btn-success" disabled>
											<span class="glyphicon glyphicon-ok"></span>
										</button>
										</a>	
									<?php }
								}?>
								</td>
								<?php if($_SESSION['level']=="Super"){?>
								<td>
									<div id="kontentd">
									<a href="?module=klien&act=editklien&id=<?php echo $data['companyId'];?>&id_rekan=<?php echo $data['id']; ?>">
									<button class="btn btn-success btn-sm" >
									<span class="glyphicon glyphicon-wrench"></span> Edit</button></a>
								</td>
								<td>
								<a href="<?php echo $aksi;?>?module=klien&act=hapus&id=<?php echo $data['companyId'];?>&id_rekan=<?php echo $data['id'] ?>&id_kontrak=<?php echo $data['id_kontrak'] ?>">
								<button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Dimensi?')" >
								<span class="glyphicon glyphicon-trash"></span> Hapus</button></a></div><?php } ?>
								</td>
							</tr>

							<?php
							$no++;
						}
					    
						
						$jmldata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tgroup"));
						$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
						$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

						
					?>
				</tbody>
			</table>
			
				<ul class="pagination">
					<?php echo "$linkHalaman"; ?>
				</ul>
			
			
		</div>
	</div>

	<?php
	break;
  
	// Form Tambah group
	case "tambahklien":
	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen Klien
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=klien">Manajemen Klien</a> / <a href="master.php?module=klien&act=tambahgroup">Tambah Data</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
    	<div class="panel-heading">
			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Tambah Data 
			<i style="margin-left:770px;"><button class="btn btn-success btn-sm " onclick="window.location.href='?module=klien'"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></i></div>
		</div>
		<div class="panel-body">

			<form method="POST" action="<?php echo $aksi;?>?module=klien&act=input" onSubmit="return validasi(this)" class="form-horizontal" >
				<div class="form-group">
					<label for="level" class="col-sm-2 control-label">Nama Klien</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-random"></span>
							</div>
							<select name="tcompanyId" id="tcompanyId" class="form-control">
								<option>--Pilih--</option>
								<?php $query = mysqli_query($hore,"SELECT * FROM tcompany");
								while($qk = mysqli_fetch_array($query)) :
								?>
								<option value="<?php echo $qk['companyId'] ?>"><?php echo $qk['companyName'] ?></option>
								<?php endwhile; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group" name="jasa_layanan" id="jasa_layanan">
					<label for="Jasa Layanan" class="col-sm-2 control-label">Jasa Layanan</label>
					<div class="col-sm-5">
						<div class="input-group">
							<?php $m = mysqli_query($hore,"SELECT * FROM layanan");
							while($fm = mysqli_fetch_array($m)){
							?>
							<label for="">
							<input type="checkbox" name='produk[]' value='<?php echo $fm['id'] ?>'>
								<?php echo $fm['nama_layanan'] ?>
							</label><br>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="form-group" name="rekanan" id="rekanan">
					<label for="Rekanan" class="col-sm-2 control-label">Rekanan</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-user"></span>
							</div>
							<select class="form-control" name="rekanan" id="rekanan">
								<option>--Pilih--</option>
							<?php 
								$query = mysqli_query($hore, "SELECT * FROM trekan ");
								while($row = mysqli_fetch_array($query)) : ?>
								<option value="<?php echo $row['id'] ?>"><?= $row['nama'] ?></option>
							<?php endwhile; ?>
							</select>
						</div>
					</div>
				</div>
				<!-- <label for="from">From</label>
				<input type="text" id="from" name="from">
				<label for="to">to</label>
				<input type="text" id="to" name="to"> -->
				<div class="form-group">
					<label for="kontr_awal" class="col-sm-2 control-label">Tanggal Awal Kontrak</label>
					<div class="col-sm-4">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-time"></span>
							</div>
							<input type="text" name="kontrak_awal" id="kontrak_awal" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="kontrak_akhir" class="col-sm-2 control-label">Tanggal Berakhir Kontrak</label>
					<div class="col-sm-4">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-time"></span>
							</div>
							<input type="text" name="kontrak_berakhir" id="kontrak_berakhir" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"></label>
					<div class="col-sm-6">
						<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Simpan</button> &nbsp;<button class="btn btn-danger" type="button" onclick="self.history.back()"><span class="glyphicon glyphicon-remove"></span> Batal</button>
					</div>
					
				</div>
			</form>
		</div>
    </div>
	<?php
     break;
  
  // Form Edit group
  case "editgroup":
    $edit=mysqli_query($hore,"SELECT * FROM tgroup WHERE groupId='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
    ?> 
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen Dimensi
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=group">Manajemen Dimensi</a> / <a href="?module=group&act=editgroup&id=<?php echo $r['groupId'];?>">Edit Dimensi</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">
				<i class="glyphicon glyphicon-wrench"></i> Edit Dimensi
			</div>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo $aksi ?>?module=group&act=update"  class="form-horizontal" >
				<input type="hidden" name="id" value="<?php echo $r[groupId]; ?>">
				<div class="form-group">
					<label for="group" class="col-sm-2 control-label">Nama Grup</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-user"></span>
							</div>
							<input type="text" name="grup" class="form-control" placeholder="Nama Dimensi" value="<?php echo $r['groupName'];?>">
						</div>
					</div>
				</div>
				
		
				<div class="form-group">
					<label for="" class="col-sm-2 control-label"></label>
					<div class="col-sm-6">
						<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Simpan</button> &nbsp;<button class="btn btn-danger" type="button" onclick="self.history.back()"><span class="glyphicon glyphicon-remove"></span> Batal</button>
					</div>
					
				</div>
				
			</form>
		</div>
	</div>
	
    <?php
    break;  
}
?>