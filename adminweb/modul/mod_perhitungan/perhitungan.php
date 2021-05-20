<?php
$bobot_harapan = 0;
$bobot_kenyataan = 0;
$gap_dimensi = 0;
$gap_kriteria = 0;
$rata_kenyataan = 0;
$rata_harapan = 0;
$r = [];

//Menghitung Bobot,Rata-rata,Gap Per Kriteria

$query = mysqli_query($hore, "SELECT descriptionId,groupId FROM tdescription");
while ($row = mysqli_fetch_array($query)) {
	//Persepsi/Kenyataan
	$rows = mysqli_query($hore, "SELECT *,SUM(
		CASE
			When jawaban = 'A' Then 5
			When jawaban = 'B' Then 4
			When jawaban = 'C' Then 3
			When jawaban = 'D' Then 2
			ELSE 1
		END) AS nilai,COUNT(*) as respon
		from tanswer where descriptionId = '$row[descriptionId]'");
	while ($rows1 = mysqli_fetch_array($rows)) {
		$bobot_kenyataan = $rows1['nilai'];
		$rata_kenyataan = $rows1['nilai'] / $rows1['respon'];
		// $nilai = $rows1['nilai'];
		// $val = $rows1['nilai']/$rows1['respon'];
	}
	if (
		mysqli_query($hore, "INSERT INTO kriteria_kenyataan(descriptionId,groupId,bobot,rata)
		values ('$row[descriptionId]','$row[groupId]','$bobot_kenyataan','$rata_kenyataan')")
	) {
	} else {
		mysqli_query($hore, "UPDATE kriteria_kenyataan set bobot = '$bobot_kenyataan',rata = '$rata_kenyataan' where descriptionId = '$row[descriptionId]'");
	}
	//Harapan
	$rows2 = mysqli_query($hore, "SELECT *,SUM(
		CASE
			When jawaban = 'A' Then 5
			When jawaban = 'B' Then 4
			When jawaban = 'C' Then 3
			When jawaban = 'D' Then 2
			ELSE 1
		END) AS nilai1,COUNT(*) as respon1
		from tanswer2 where descriptionId = '$row[descriptionId]'");
	while ($rows3 = mysqli_fetch_array($rows2)) {
		$bobot_harapan = $rows3['nilai1'];
		$rata_harapan = $rows3['nilai1'] / $rows3['respon1'];
		// $nilai1 = $rows3['nilai1'];
		// $val1 = $rows3['nilai1']/$rows3['respon1'];
	}
	if (
		mysqli_query($hore, "INSERT INTO kriteria_harapan(descriptionId,groupId,bobot,rata)
		values ('$row[descriptionId]','$row[groupId]','$bobot_harapan','$rata_harapan')")
	) {
	} else {
		mysqli_query($hore, "UPDATE kriteria_harapan set bobot = '$bobot_harapan',rata = '$rata_harapan' where descriptionId = '$row[descriptionId]'");
	}
	// var_dump($input);
	$gap_kriteria = $rata_kenyataan - $rata_harapan;
	if ($gap_kriteria > 0) {
		$ket = "Sangat Puas";
	} elseif ($gap_kriteria == 0) {
		$ket = "Cukup Puas";
	} else {
		$ket = "Tidak Puas";
	}
	$krit_har = mysqli_query($hore, "SELECT * FROM kriteria_harapan where descriptionId = '$row[descriptionId]'");
	$fet = mysqli_fetch_array($krit_har);

	$krit_ken = mysqli_query($hore, "SELECT * FROM kriteria_kenyataan where descriptionId = '$row[descriptionId]'");
	$fetn = mysqli_fetch_array($krit_ken);
	if (
		mysqli_query($hore, "INSERT INTO kriteria(id_kriteria_harapan,id_kriteria_kenyataan,gap,keterangan)
		values ('$fet[id]','$fetn[id]','$gap_kriteria','$ket')")
	) {
	} else {
		mysqli_query($hore, "UPDATE kriteria set gap = '$gap_kriteria',keterangan = '$ket' where id_kriteria_kenyataan = '$fetn[id]' and id_kriteria_harapan = '$fet[id]'");
	}

	// var_dump($ket,$gap_kriteria);
}

//Menghitung Bobot,Rata-rata,Gap Per Dimensi
$querys = mysqli_query($hore, "SELECT groupId FROM tgroup");
$atribut = mysqli_num_rows($querys);
while ($rowz = mysqli_fetch_array($querys)) {
	//Persepsi/Kenyataan Dimensi
	$rowd = mysqli_query($hore, "SELECT SUM(bobot) as nilai2 from kriteria_kenyataan where groupId = '$rowz[groupId]'");
	while ($rowd2 = mysqli_fetch_array($rowd)) {
		$bobot_dimensi1 = $rowd2['nilai2'];
		$rata_dimensi1 = $rowd2['nilai2'] / $atribut;
		// $val = $rowd2['nilai2']/$rowd2['respon2'];
	}
	if (
		mysqli_query($hore, "INSERT INTO dimensi_kenyataan(groupId,bobot,rata)
		values ('$rowz[groupId]','$bobot_dimensi1','$rata_dimensi1')")
	) {
	} else {
		mysqli_query($hore, "UPDATE dimensi_kenyataan set bobot = '$bobot_dimensi1',rata = '$rata_dimensi1' where groupId = '$rowz[groupId]'");
	}

	//Harapan Dimensi
	$rowd = mysqli_query($hore, "SELECT SUM(bobot) as nilai2 from kriteria_harapan where groupId = '$rowz[groupId]'");
	while ($rowd3 = mysqli_fetch_array($rowd)) {
		$bobot_dimensi2 = $rowd3['nilai2'];
		$rata_dimensi2 = $rowd3['nilai2'] / $atribut;
		// $val = $rowd2['nilai2']/$rowd2['respon2'];
	}
	if (
		mysqli_query($hore, "INSERT INTO dimensi_harapan(groupId,bobot,rata)
		values ('$rowz[groupId]','$bobot_dimensi2','$rata_dimensi2')")
	) {
	} else {
		mysqli_query($hore, "UPDATE dimensi_harapan set bobot = '$bobot_dimensi2',rata = '$rata_dimensi2' where groupId = '$rowz[groupId]'");
	}

	$gap_dimensi = $rata_dimensi1 - $rata_dimensi2;

	if ($gap_dimensi > 0) {
		$keterangan = "Sangat Puas";
	} elseif ($gap_dimensi == 0) {
		$keterangan = "Cukup Puas";
	} else {
		$keterangan = "Tidak Puas";
	}
	$dimen_har = mysqli_query($hore, "SELECT * FROM dimensi_harapan where groupId = '$rowz[groupId]'");
	$dim = mysqli_fetch_array($dimen_har);

	$dimen_ken = mysqli_query($hore, "SELECT * FROM dimensi_kenyataan where groupId = '$rowz[groupId]'");
	$dimens = mysqli_fetch_array($dimen_ken);
	if (
		mysqli_query($hore, "INSERT INTO dimensi(id_dimensi_harapan,id_dimensi_kenyataan,gap,keterangan)
		values ('$dim[id]','$dimens[id]','$gap_dimensi','$keterangan')")
	) {
	} else {
		mysqli_query($hore, "UPDATE dimensi set gap = '$gap_dimensi',keterangan = '$keterangan' where id_dimensi_kenyataan = '$dimens[id]' and id_dimensi_harapan = '$dim[id]'");
	}
}
?>

<!-- <script language="javascript">
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
switch ($_GET['act']) {
		// Tampil Group
	default:

?> -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">
			<i class="glyphicon glyphicon-user"></i> Perhitungan Servqual
		</h1>
		<ol class="breadcrumb">
			<li class="active">
				<a href="master.php?module=perhitungan">Perhitungan Servqual</a>
			</li>
		</ol>
	</div>
</div>
<div class="panel-body">
	<div class="row">
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title"> Perhitungan Berdasarkan Rekanan</div>
				</div>
				<div class="panel-body">
					<form action="?module=perhitungan" method="post" class="form-horizontal">
						<?php //include "../fungsi/fungsi_combobox.php"; include "../fungsi/library.php";
						?>
						<div class="form-group">
							<label for="tanggal1" class="control-label col-sm-4">Rekan</label>
							<div class="col-sm-7">
								<select name="rekn" id="rekn" class="form-control">
									<option value="">--pilih--</option>
									<?php
									$data = mysqli_query($hore, "SELECT * FROM trekan");
									while ($rdata = mysqli_fetch_array($data)) {
									?>
										<option class="form-control" value="<?php echo $rdata['id'] ?>"><?php echo $rdata['nama'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<input type="hidden" name="rekn" value="rekn">
						</div>
						<div class="col-sm-4">
							<a href="?module=perhitungan" class="btn btn-primary">Reset</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Perhitungan Per Kriteria <i style="margin-left:0px;"></div>
		</div>
		<div class="panel-body">
			<table id="tablekonten" class="table table-striped table-bordered table-responsive" style="">
				<thead>
					<tr>
						<th rowspan="2">
							<div id="konten">
								<center>No
							</div>
						</th>
						<th rowspan="2">
							<div id="konten">
								<center>Kriteria Pernyataan
							</div>
						</th>
						<th colspan="2">
							<div id="konten">
								<center>Penilaian
							</div>
						</th>
						<!-- <th colspan="2" ><div class="konten"><center>Kenyataan</div></th> -->
						<th rowspan="2">
							<div id="konten">
								<center>Nilai Gap 5
							</div>
						</th>
						<th rowspan="2">
							<div class="konten">
								<center>Keterangan
							</div>
						</th>
					</tr>
					<tr>
						<th>
							<center>Nilai Pembobotan
						</th>
						<th>
							<center>Rata-Rata
						</th>
						<!-- <th ><center>Nilai Pembobotan</th>
						<th ><center>Rata-Rata Kenyataan</th> -->
					</tr>
				</thead>
				<tbody>
					<?php

					$tampil = mysqli_query($hore, "SELECT * FROM tdescription order by descriptionId asc");
					$no = $posisi + 1;
					while ($data = mysqli_fetch_array($tampil)) {
						// var_dump($data['descriptionId']);
						$rh = mysqli_query($hore, "SELECT * from kriteria_harapan where descriptionId = '$data[descriptionId]'");
						while ($rz = mysqli_fetch_array($rh)) {
							$krit_bobot = $rz['bobot'];
							$krit_rata = $rz['rata'];
							$har_id = $rz['id'];
						}

						$rk = mysqli_query($hore, "SELECT * from kriteria_kenyataan where descriptionId = '$data[descriptionId]'");
						while ($rn = mysqli_fetch_array($rk)) {
							$krit_bobot1 = $rn['bobot'];
							$krit_rata1 = $rn['rata'];
							$ken_id = $rn['id'];
						}

						$rz = mysqli_query($hore, "SELECT * from kriteria where id_kriteria_harapan = '$har_id' and id_kriteria_kenyataan = '$ken_id'");
						while ($rm = mysqli_fetch_array($rz)) {
							$gapk = $rm['gap'];
							$keterk = $rm['keterangan'];
						}
					?>
						<tr>
							<td>
								<center><?php echo $no ?>
							</td>
							<td>
								<center><?php echo $data['description'] ?>
							</td>
							<!-- <td><div id="kontentd"><?php echo $data['groupId']; ?></div></td> -->
							<!-- <td><center><?php echo $krit_bobot ?></td>
								<td><center><?php echo round($krit_rata, 2) ?></td> -->
							<td>
								<center><?php echo $krit_bobot1 ?>
							</td>
							<td>
								<center><?php echo round($krit_rata1, 2) ?>
							</td>
							<td>
								<center><?php echo round($gapk, 2) ?>
							</td>
							<td>
								<center><?php echo $keterk ?>
							</td>
						</tr>

					<?php
						$no++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Perhitungan Per Dimensi <i style="margin-left:0px;"></div>
		</div>
		<div class="panel-body">
			<table id="tablekonten" class="table table-striped table-bordered table-responsive" style="">
				<thead>
					<tr>
						<th rowspan="2">
							<div id="konten">
								<center>No
							</div>
						</th>
						<th rowspan="2">
							<div class="konten">
								<center>Dimensi Pernyataan
							</div>
						</th>
						<th rowspan="2">
							<div class="konten">
								<center>Kriteria Pernyataan
							</div>
						</th>
						<th colspan="2">
							<div id="konten">
								<center>Penilaian
							</div>
						</th>
						<!-- <th colspan="2" ><div class="konten"><center>Kenyataan</div></th> -->
						<th rowspan="2">
							<div id="konten">
								<center>Nilai Gap 5
							</div>
						</th>
						<th rowspan="2">
							<div class="konten">
								<center>Keterangan
							</div>
						</th>
					</tr>
					<tr>
						<th>
							<center>Nilai Pembobotan
						</th>
						<th>
							<center>Rata-Rata
						</th>
						<!-- <th ><center>Nilai Pembobotan</th>
						<th ><center>Rata-Rata Kenyataan</th> -->
					</tr>
				</thead>
				<tbody>
					<?php
					$tampil = mysqli_query($hore, "SELECT * FROM tgroup order by groupId asc");
					$no = $posisi + 1;
					while ($data = mysqli_fetch_array($tampil)) {
						$namagroup = $data['groupName'];

						// var_dump($data['descriptionId']);
						$rh = mysqli_query($hore, "SELECT * from dimensi_harapan where groupId = '$data[groupId]'");
						while ($rz = mysqli_fetch_array($rh)) {
							$dim_bobot = $rz['bobot'];
							$dim_rata = $rz['rata'];
							$har_id = $rz['id'];
						}

						$rk = mysqli_query($hore, "SELECT * from dimensi_kenyataan where groupId = '$data[groupId]'");
						while ($rn = mysqli_fetch_array($rk)) {
							$dim_bobot1 = $rn['bobot'];
							$dim_rata1 = $rn['rata'];
							$ken_id = $rn['id'];
						}

						$rz = mysqli_query($hore, "SELECT * from dimensi where id_dimensi_harapan = '$har_id' and id_dimensi_kenyataan = '$ken_id'");
						while ($rm = mysqli_fetch_array($rz)) {
							$gapk = $rm['gap'];
							$keterk = $rm['keterangan'];
						}
					?>
						<tr>
							<td>
								<center><?php echo $no ?>
							</td>
							<td>
								<center><?php echo $namagroup ?></center>
							</td>
							<td>
								<center>
									<?php
									$dkrit = mysqli_query($hore, "SELECT * FROM tdescription where groupId='$data[groupId]'");
									while ($rkrit = mysqli_fetch_array($dkrit)) {
										$idkrit = $rkrit['descriptionId'];
										echo $idkrit . ",";
									}
									?>
								</center>
							</td>
							<!-- <td><div id="kontentd"><?php echo $data['groupId']; ?></div></td> -->
							<!-- <td><center><?php echo $dim_bobot ?></td>
								<td><center><?php echo round($dim_rata, 2) ?></td> -->
							<td>
								<center><?php echo $dim_bobot1 ?>
							</td>
							<td>
								<center><?php echo round($dim_rata1, 2) ?>
							</td>
							<td>
								<center><?php echo round($gapk, 2) ?>
							</td>
							<td>
								<center><?php echo $keterk ?>
							</td>
						</tr>

					<?php
						$no++;
					}



					?>
				</tbody>
			</table>
	<?php
}
	?>