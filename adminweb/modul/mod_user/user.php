<script language="javascript">
	function validasi(form){
		if (form.username.value == ""){
			alert("Anda belum mengisikan username.");
			form.username.focus();
			return (false);
		}
		
		if (form.password.value == ""){
			alert("Anda belum mengisikan password.");
			form.password.focus();
			return (false);
		}
		
		if (form.nama.value == ""){
			alert("Anda belum mengisikan Nama Lengkap.");
			form.nama.focus();
			return (false);
		}
	}
</script>
<?php
if ($_SESSION[level] == 'Super'){
	$aksi = "modul/mod_user/aksi_user.php";
	switch($_GET[act]){
		// Tampil User
		default:
		?> 
		<div class="row">
		    <div class="col-lg-12">
		        <h1 class="page-header">
		            <i class="glyphicon glyphicon-user"></i> Manajemen User
		        </h1>
		        <ol class="breadcrumb">
		            <li class="active">
		                 <a href="master.php?module=user">Manajemen User</a>
		            </li>
		        </ol>
		    </div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">

				<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Daftar User <i style="margin-left:820px;"><button class="btn btn-success btn-sm " onclick="window.location.href='?module=user&act=tambahuser'"><span class="glyphicon glyphicon-plus"></span> Tambah User</button></i></div>
			</div>
			<div class="panel-body">
				<table id="tablekonten" class="table table-striped table-bordered table-responsive" style="">
					<thead>
						<th width="1%"><div id="konten">No</div></th>
						<th width="10%"><div id="konten">Username</div></th>
						<th width="10%"><div id="konten">Nama Lengkap</div></th>
						<th width="10%"><div id="konten">Email</div></th>
						<th width="10%"><div id="konten">Level</div></th>
						<th width="10%"><div id="konten">Aksi</div></th>
						
					</thead>
					<tbody>
						<?php 
						$tampil = mysqli_query($hore,"SELECT * FROM tuser ORDER BY level desc,username asc");
						$no=1;
						while ($r=mysqli_fetch_array($tampil)){
						?>
						<tr>
						<td><div id="kontentd"><?php echo $no; ?></div></td>
						<td><div id="kontentd"><?php echo $r['username'];?></div></td>
						<td><div id="kontentd"><?php echo $r['fullname'];?></div></td>
						<td><div id="kontentd"><a href="mailto:<?php echo$r['email']; ?>"><?php echo $r['email'];?></a>
						<td><div id="kontentd"><?php echo $r['level'];?></div></td>
						<td><div id="kontentd"><a href="?module=user&act=edituser&id=<?php echo $r['userId'];?>&level=<?php echo $r['level']; ?>"><button class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-wrench"></span> Edit</button></a> | <a href="<?php echo $aksi;?>?module=user&act=hapus&id=<?php echo $r['userId'];?>&level=<?php echo $r['level'] ?>"><button class="btn btn-danger btn-sm" ><span class="glyphicon glyphicon-trash"></span> Hapus</button></a></div>
						</td>
						</tr>
						<?php $no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php
	break;
  
	case "tambahuser":

	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Manajemen User
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=user">Manajemen User</a> / <a href="master.php?module=user&act=tambahuser">Tambah User</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
    	<div class="panel-heading">
			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Tambah User <i style="margin-left:830px;"><button class="btn btn-success btn-sm " onclick="window.location.href='?module=user'"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></i></div>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo $aksi;?>?module=user&act=input" onSubmit="return validasi(this)" class="form-horizontal" >
				<div class="form-group">
					<label for="level" class="col-sm-2 control-label">Level</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-random"></span>
							</div>
							<select name="level" id="level" class="form-control">
								<option>--Pilih--</option>
								<option value="Klien">Klien</option>
								<option value="Rekan">Rekan</option>
								<option value="Pimpinan">Pimpinan</option>
								<option value="Super">Super Admin</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="username" class="col-sm-2 control-label">Username</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-user"></span>
							</div>
							<input type="text" name="username" class="form-control" placeholder="Username">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-lock"></span>
							</div>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
					</div>
				</div>

				<div class="form-group" hidden="" id="nomor_induk">
					<label for="nama" id="nip" class="col-sm-2 control-label">NIP</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-tags"></span>
							</div>
							<input type="text" name="nip" id="nip" class="form-control" placeholder="NIP">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="nama" id="nama_perusahaan" class="col-sm-2 control-label">Nama Lengkap</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-tags"></span>
							</div>
							<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="Email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-envelope"></span>
							</div>
							<input type="email" name="email" class="form-control" placeholder="Email">
						</div>
					</div>
				</div>
				
				<div class="form-group" hidden="" name="alamat" id="alamat">
					<label for="Alamat" class="col-sm-2 control-label">Alamat</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-home"></span>
							</div>
							<input type="text" name="alamat" id="alamat" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group" hidden="" name="tlp" id="tlp">
					<label for="No Telp" class="col-sm-2 control-label">No Telp</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-phone-alt"></span>
							</div>
							<input type="number" name="no_telp" id="no_telp" class="form-control">
						</div>
					</div>
				</div>
				<!-- <div class="form-group" hidden="" name="jasa_layanan" id="jasa_layanan">
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
				<div class="form-group" hidden="" name="rekanan" id="rekanan">
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
								<option value="<?= $row[id] ?>"><?= $row['nama'] ?></option>
							<?php endwhile; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group" hidden="" name="kontrak" id="kontrak">
					<label for="Kontrak" class="col-sm-2 control-label">Kontrak</label>
					<div class="col-sm-4">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-time"></span>
							</div>
							<input type="number" name="kontrak" id="kontrak" class="form-control">
						</div>
					</div>
					<label class="control-label">Bulan</label>
				</div> -->

				<!-- <div class="form-group">
					<input type="hidden" name="id_data" id="id_data" value="">
				</div>
 -->
				<div class="form-group">
					<label for="Email" class="col-sm-2 control-label"></label>
					<div class="col-sm-6">
						<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Simpan</button> &nbsp;<button class="btn btn-danger" type="button" onclick="self.history.back()"><span class="glyphicon glyphicon-remove"></span> Batal</button>
					</div>
					
				</div>
			<!-- 	<blockquote class="blockquote-reverse">
					<i><font size="1">Super admin mengizinkan untuk mengakses modul User sedangkan admin biasa tidak dapat mengakses modul user</font>	</i>
				</blockquote> -->
			</form>
		</div>
    </div>
	<?php
	break;

	case "edituser":
		$edit=mysqli_query($hore,"SELECT * FROM tuser WHERE userId='$_GET[id]'");
		$r=mysqli_fetch_array($edit);
		?> 
		<div class="row">
		    <div class="col-lg-12">
		        <h1 class="page-header">
		            <i class="glyphicon glyphicon-user"></i> Manajemen User
		        </h1>
		        <ol class="breadcrumb">
		            <li class="active">
		                 <a href="master.php?module=user">Manajemen User</a> / <a href="?module=user&act=edituser&id=<?php echo $r['userId'];?>">Edit User</a>
		            </li>
		        </ol>
		    </div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="glyphicon glyphicon-wrench"></i> Edit User
				</div>
			</div>
			<div class="panel-body">
				<form method="POST" action="<?php echo $aksi ?>?module=user&act=update"  class="form-horizontal" >
					<input type="hidden" name="id" value="<?php echo $r[userId]; ?>">
					<div class="form-group">
					<label for="level" class="col-sm-2 control-label">Level</label>
					<div class="col-sm-5">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-random"></span>
							</div>
							<select name="" disabled id="level" class="form-control">
								<option value="<?php echo $r[level] ?>"><?php echo $r[level] ?></option>
								<option value="Klien">Klien</option>
								<option value="Rekan">Rekan</option>
								<option value="Pimpinan">Pimpinan</option>
								<option value="Super">Super Admin</option>
							</select>
							</div>
						</div>
					</div>
					<input type="hidden" name="level" value="<?php echo $r[level];?>">
					<div class="form-group">
						<label for="username" class="col-sm-2 control-label">Username</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-user"></span>
								</div>
								<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $r[username];?>">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-lock"></span>
								</div>
								<input type="text" name="password" class="form-control" placeholder="Password">
							</div>
						</div>
					</div>
					<?php if($_GET['level'] == 'Rekan'): ?>
					<?php $rek = mysqli_query($hore,"SELECT * FROM trekan 
					where nama ='$r[fullname]'");
					$qrek = mysqli_fetch_array($rek); ?>
					<div class="form-group">
						<label for="nip" class="col-sm-2 control-label">NIP</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-tags"></span>
								</div>
								<input type="text" readonly value='<?php echo $qrek[id] ?>' name="nip" class="form-control" placeholder="nip">
							</div>
						</div>
					</div>
					<?php endif; ?>
					<?php if($_GET['level'] == 'Klien'): ?>
					<div class="form-group">
						<label for="nama" class="col-sm-2 control-label">Nama Perusahaan</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-tags"></span>
								</div>
								<input type="text" name="nama" class="form-control" placeholder="Nama Perusahaan" value="<?php echo $r[fullname];?>">
							</div>
						</div>
					</div>
					<?php endif; ?>
					<?php if($_GET['level'] != 'Klien'): ?>
					<div class="form-group">
						<label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-tags"></span>
								</div>
								<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo $r[fullname];?>">
							</div>
						</div>
					</div>
					<?php endif; ?>
					<input type="hidden" name="exnama" value="<?php echo $r[fullname] ?>">
					<div class="form-group">
						<label for="Email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-envelope"></span>
								</div>
								<input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $r[email];?>">
							</div>
						</div>
					</div>
				<?php if($_GET['level'] == 'Rekan'): ?>
					<div class="form-group">
						<label for="Alamat" class="col-sm-2 control-label">Alamat</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-home"></span>
								</div>
								<input type="text" readonly value='<?php echo $qrek[alamat] ?>' name="alamat" class="form-control" placeholder="Alamat">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="no_telp" class="col-sm-2 control-label">No Telp</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-phone-alt"></span>
								</div>
								<input type="text" readonly value='<?php echo $qrek[no_telp] ?>' name="no_telp" class="form-control" placeholder="no_telp">
							</div>
						</div>
					</div>
				<?php endif?>			
				<?php if($_GET['level'] == 'Klien'): ?>
				<?php $cek = mysqli_query($hore,"SELECT * FROM tcompany 
				left join tcompany_layanan on tcompany_layanan.companyId = tcompany.companyId
				left join layanan on tcompany_layanan.id_layanan = layanan.id
				left join kontrak_kerja on tcompany.companyId = kontrak_kerja.id_tcompany
				left join trekan on kontrak_kerja.id_rekan = trekan.id
				where companyName ='$r[fullname]'");
				$qcek = mysqli_fetch_array($cek);
				?>
					<div class="form-group">
					<label for="Alamat" class="col-sm-2 control-label">Alamat</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-home"></span>
								</div>
								<input type="text" readonly name="alamat" value="<?php echo $qcek['companyAddress'] ?>" id="alamat" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
					<label for="Alamat" class="col-sm-2 control-label">No Telp</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-phone-alt"></span>
								</div>
								<input type="text" readonly name="no_telp" value="<?php echo $qcek['companyPhoneHp'] ?>" id="no_telp" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
					<label for="Alamat" class="col-sm-2 control-label">Jasa/Layanan</label>
						<div class="col-sm-5">
							<div class="input-group">
								<!-- <div class="input-group-addon">
									<span class="glyphicon glyphicon-home"></span>
								</div> -->
								<?php 
									$m = mysqli_query($hore,"SELECT * FROM layanan");
									while($fm = mysqli_fetch_array($m)){
									?>
									<label for="">
									<input disabled type="checkbox" name='produk[]' 
									<?php
										$qcomp = mysqli_query($hore,"SELECT * FROM tcompany_layanan where companyId ='$qcek[companyId]'");
										while($rcomp = mysqli_fetch_array($qcomp)){
									?>
									<?php if($fm['id'] == $rcomp['id_layanan']){ echo "checked='checked'";}} ?> 
									value='<?php echo $fm['id'] ?>'>
										<?php echo $fm['nama_layanan'] ?>
									</label><br>
									<?php } 
									?>
								<!-- <input type="text" name="no_telp" value="<?php echo $qcek['nama_layanan'] ?>" id="no_telp" class="form-control"> -->
							</div>
						</div>
					</div>
					<div class="form-group">
					<label for="Alamat" class="col-sm-2 control-label">Rekanan</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-user"></span>
								</div>
								<input type="text" readonly name="rekanan" value="<?php echo $qcek['nama'] ?>" id="rekanan" class="form-control">
							</div>
						</div>
					</div>
					<div class="form-group">
					<label for="Alamat" class="col-sm-2 control-label">Kontrak</label>
						<div class="col-sm-5">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
								</div>
								<input type="text" readonly name="rekanan" value="<?php echo $qcek['kontrak'] ?> Bulan" id="rekanan" class="form-control">
							</div>
						</div>
					</div>
				<?php endif; ?>	
				<div class="form-group">
					<label for="Email" class="col-sm-2 control-label"></label>
					<div class="col-sm-6">
						<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-floppy-save"></span> Simpan</button> &nbsp;<button class="btn btn-danger" type="button" onclick="self.history.back()"><span class="glyphicon glyphicon-remove"></span> Batal</button>
					</div>
					
				</div>
					<blockquote class="blockquote-reverse">
						<i><font size="1">*) Apa bila password tidak dirubah maka kosongkan saja..!</font>	</i>
					</blockquote>
				</form>
			</div>
		</div>
		<?php
	break;  
	
	}
}
else{
 ?>
 <div class="alert alert-danger"><p><i>"Anda Tidak Berhak Mengakses Modul ini"</i></p></div>
 <?php
}
?>
