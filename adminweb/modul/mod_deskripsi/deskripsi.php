<script language="javascript">
	function validasideskripsi(form){
		if (form.groupId.value == 0){
			alert("Anda belum mengisikan nama group.");
			form.groupId.focus();
			return (false);
		}
		if (form.deskripsi.value == ""){
			alert("Anda belum mengisikan deskripsi.");
			form.deskripsi.focus();
			return (false);
		}
	}
</script>
<?php
$aksi = "modul/mod_deskripsi/aksi_deskripsi.php";
switch($_GET[act]){
	// Tampil deskripsi
	default:
	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-book"></i> Manajemen Kriteria
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=description">Manajemen Kriteria</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">

			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Manajemen Kriteria <i style="margin-left:710px;"><?php if($_SESSION['level']=="Super"){?><button class="btn btn-success btn-sm " onclick="window.location.href='?module=description&act=tambahpertanyaan'"><span class="glyphicon glyphicon-plus"></span> Tambah Kriteria </button></i><?php }?></div>
		</div>
		<div class="panel-body">
			<table id="tablekonten" class="table table-striped table-bordered table-responsive" style="">
				<thead>
					<th width="1%"><div id="konten">No</div></th>
					<th width="10%"><div id="konten">Nama Dimensi</div></th>
					<th width="10%"><div id="konten">Nama Kriteria</div></th>
					
					<th width="10%"><div id="konten">Aksi</div></th>
					
				</thead>
				<tbody>
					<?php 
					
						$p      = new PagingSoal();
						$batas  = 10;
						$posisi = $p->cariPosisi($batas);
					    $tampil = mysqli_query($hore,"SELECT * FROM tdescription left join tgroup on tgroup.groupId = tdescription.groupId order by tdescription.groupId asc limit $posisi,$batas ");
					    $no = $posisi+1;
						while ($data = mysqli_fetch_array($tampil)){
							?>
							<tr>
								<td><div id="kontentd"><?php echo $no; ?></div></td>
								<td><div id="kontentd"><?php echo $data['groupName'];?></div></td>
								<td><div id="kontentd"><?php echo $data['description'];?></div></td>
								<td><div id="kontentd"><?php if($_SESSION['level']=="Super"){?><a href="?module=description&act=editdescription&id=<?php echo $data['descriptionId'];?>"><button class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-wrench"></span> Edit</button></a> | <a href="<?php echo $aksi;?>?module=description&act=hapus&id=<?php echo $data['descriptionId'];?>"><button class="btn btn-danger btn-sm" onclick="return confirm('Hapus Kriteria?')"><span class="glyphicon glyphicon-trash"></span> Hapus</button></a><?php } ?></div>
								</td>
							</tr>

							<?php
							$no++;
						}
						$jmldata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tdescription"));
						$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
						$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

						
					?>
				</tbody>
			</table>
			
			<?php echo "<ul class='pagination'> $linkHalaman </ul>"; ?>
		</div>
	</div>


	<?php
	break;
  
	// Form Tambah Deskripsi
	case "tambahpertanyaan":
	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen Kriteria
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=description">Manajemen Kriteria</a> / <a href="master.php?module=description&act=tambahpertanyaan">Tambah Kriteria</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
    	<div class="panel-heading">
			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Tambah Kriteria <i style="margin-left:770px;"><button class="btn btn-success btn-sm " onclick="window.location.href='?module=description'"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></i></div>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo $aksi;?>?module=description&act=input" onSubmit="return validasi(this)" class="form-horizontal" >
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Dimensi </label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-tags"></span>
							</div>
							<select name="groupId" id="" class="form-control">
								<?php 
								$sql = mysqli_query($hore,"SELECT * FROM tgroup ORDER BY groupId");
								while ($data = mysqli_fetch_array($sql)){
									echo "<option value='$data[groupId]'> $data[groupName]</option>";
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Kriteria </label>
					<div class="col-sm-5">
						<input type="text" name="deskripsi" class="form-control">
						<!-- <textarea class="form-control" rows="4" name="deskripsi" class="form-control"></textarea> -->
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
  
  // Form Edit deskripsi
  case "editdescription":
    $edit = mysqli_query($hore,"SELECT * FROM tdescription WHERE descriptionId='$_GET[id]'");
    $r = mysqli_fetch_array($edit);
    ?>
	
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen Kriteria
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=description">Manajemen Kriteria</a> / <a href="master.php?module=description&act=editdescription&id=<?php echo $r['descriptionId'];?>">Edit Kriteria</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">
				<i class="glyphicon glyphicon-wrench"></i> Edit Kriteria
			</div>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo $aksi ?>?module=description&act=update"  class="form-horizontal" >
				<input type="hidden" name="id" value="<?php echo $r[descriptionId]; ?>">
				<div class="form-group">
					<label for="group" class="col-sm-2 control-label">Dimensi </label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-list"></span>

							</div>
							<select name="groupId"  class="form-control">
								<?php 
								$sql = mysqli_query($hore,"SELECT * FROM tgroup");
								  while($data = mysqli_fetch_array($sql)){
									if($r[groupId] == $data[groupId]){
										echo "<option value='$data[groupId]' SELECTED>$data[groupName]</option>";
									}
									else{
										echo "<option value='$data[groupId]'>$data[groupName]</option>";
									}
								  }
	  
								?>
							</select>
							
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="col-sm-2 control-label">Kriteria </label>
					<div class="col-sm-5"> 
						<input type="text" name="description" value="<?= $r['description'] ?>" class="form-control">
						<!-- <textarea name="description" id="" class="form-control">
							<?php echo $r[description]; ?>
						</textarea> -->
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