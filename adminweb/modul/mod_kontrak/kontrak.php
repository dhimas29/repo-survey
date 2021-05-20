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
$aksi = "modul/mod_group/aksi_group.php";
switch($_GET[act]){
	// Tampil Group
	default:

	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen Kontrak
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=group">Manajemen Kontrak</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Manajemen Kontrak <i style="margin-left:700px;"><?php if($_SESSION['level']=="Super"){?>
			</i><?php } ?></div>
		</div>
		<div class="panel-body">
			<div class="col-md-4" style="margin-top: 10px">
				<span class="form-group"> Jumlah Data : 
					<?php
					if (isset($_GET['bulan'])) {  
					$quer = mysqli_query($hore, "SELECT * FROM kontrak_kerja where MONTH(tanggal_kontrak) = '$_GET[bulan]'");
					$jm = mysqli_num_rows($quer);
					}else{
						$quer = mysqli_query($hore, "SELECT * FROM kontrak_kerja");
						$jm = mysqli_num_rows($quer);
					}
					echo $jm;
					?>
				</span>
			</div>
			<div style="margin-left: 800px">	
				<div class="row">
				<div class="col-md-7">
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
				<a href="master.php?module=kontrak" class="btn btn-primary">Reset</a>
				</div>
			</div><br>
			<table id="tablekonten" class="table table-striped table-bordered table-responsive" style="">
				<thead>
					<th width="1%"><div id="konten">No</div></th>
					<th><div id="konten">Nama Klien</div></th>
					<th><div id="konten">Rekanan</div></th>
					<th><div id="konten">Layanan Jasa</div></th>
					<th><div id="konten">Lama Waktu Kontrak</div></th>
					<!-- <th><div id="konten">Aksi</div></th> -->
				</thead>
				<tbody>
					<?php 
					
						$p      = new PagingGroup();
						$batas  = 10;
						$posisi = $p->cariPosisi($batas);
						if (!isset($_GET['bulan'])) { 
					    $tampil = mysqli_query($hore,
					    	"SELECT * FROM kontrak_kerja 
					    	left join tcompany on tcompany.companyId = kontrak_kerja.id_tcompany
					    	left join trekan on kontrak_kerja.id_rekan = trekan.id
					    	order by id_kontrak asc limit $posisi,$batas");
						}else{
							$tampil = mysqli_query($hore,
					    	"SELECT * FROM kontrak_kerja 
					    	left join tcompany on tcompany.companyId = kontrak_kerja.id_tcompany
					    	left join trekan on kontrak_kerja.id_rekan = trekan.id
					    	where MONTH(tanggal_kontrak) ='$_GET[bulan]'
					    	order by id_kontrak asc limit $posisi,$batas");
						}
					    $no =$posisi+1;
						while ($data = mysqli_fetch_array($tampil)){
							?>
							<tr>
								<td><div id="kontentd"><?php echo $no; ?></div></td>
								<td><div id="kontentd"><?php echo $data['companyName'];?></div></td>
								<td><div id="kontentd"><?php echo $data['nama'];?></div></td>
								<td><div id="kontentd"><?php echo $data['product'];?></div></td>
								<td><div id="kontentd"><?php echo $data['kontrak']." Bulan";?></div></td>

								<!-- <td><?php if($_SESSION['level']=="Super"){?><div id="kontentd"><a href="?module=group&act=editgroup&id=<?php echo $data['groupId'];?>"><button class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-wrench"></span> Edit</button></a> | <a href="<?php echo $aksi;?>?module=group&act=hapus&id=<?php echo $data['groupId'];?>"><button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Dimensi?')" ><span class="glyphicon glyphicon-trash"></span> Hapus</button></a></div><?php } ?>
								</td> -->
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
	case "tambahgroup":
	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen Dimensi
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=group">Manajemen Dimensi</a> / <a href="master.php?module=group&act=tambahgroup">Tambah Dimensi</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
    	<div class="panel-heading">
			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Tambah Dimensi <i style="margin-left:770px;"><button class="btn btn-success btn-sm " onclick="window.location.href='?module=group'"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></i></div>
		</div>
		<div class="panel-body">

			<form method="POST" action="<?php echo $aksi;?>?module=group&act=input" onSubmit="return validasi(this)" class="form-horizontal" >
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Nama Dimensi</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-tags"></span>
							</div>
							<input type="text" name="grup" class="form-control" placeholder="Nama Group">
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