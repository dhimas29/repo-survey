<?php
error_reporting(0);
$namaFile = "responden_report.xls";
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Transfer-Encoding: binary ");

include "../../../koneksi.php";
include "../../../fungsi/fungsi_indotgl.php";

$hasil = mysqli_query($hore,"SELECT * FROM tdescription left join tgroup on tgroup.groupId = tdescription.groupId");
$date = date('Y-m-d');
$time = date('H:i:s');
$dateIndo = tgl_indo($date);
$dateIndo2 = tgl_indo($responden['dateSurvey']);

$responden = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM tanswer, tcompany WHERE tanswer.companyId = '$_GET[id]' AND tcompany.companyId = tanswer.companyId"));
$dateIndo2 = tgl_indo($responden['dateSurvey']);
$namaFile = "responden_report_$responden[companyName].xls";
header("Content-Disposition: attachment; filename=$namaFile");
echo "<table border=1 cellpadding=0 cellspacing=0>
		<tr align='center'>
			<td colspan=8 bgcolor=yellow style='border: none';>Laporan Kuisioner Responden</td>
		</tr>
		<tr>
			<td colspan=8>Dicetak : <b>$dateIndo $time</b></td>
		</tr>
		<tr>
			<td colspan=8>Nama : <b>$responden[companyName]</b></td>
		</tr>
		<tr>
			<td colspan=8>Alamat : <b>$responden[companyAddress]</b></td>
		</tr>
		<tr>
			<td colspan=8>Telp / Ph : <b>$responden[companyPhoneHp]</b></td>
		</tr>
		<tr>
			<td colspan=8>Tanggal Isi Survey : <b>$dateIndo2 </b></td>
		</tr>
		<tr>
			<td colspan=8>Kritik dan Saran : <b>$responden[suggestion]</b></td>
		</tr>
		
		<tr>
			<td bgcolor=#c6e1f2 align=center><b>NO</b></td>
			<td bgcolor=#c6e1f2 align=center><b>Dimensi</b></td>
			<td bgcolor=#c6e1f2 align=center><b>Kriteria</b></td>
			<td bgcolor=#c6e1f2 align=center><b>Sangat Baik</b></td>
			<td bgcolor=#c6e1f2 align=center><b>Baik</b></td>
			<td bgcolor=#c6e1f2 align=center><b>Cukup</b></td>
			<td bgcolor=#c6e1f2 align=center><b>Buruk</b></td>
			<td bgcolor=#c6e1f2 align=center><b>Sangat Buruk</b></td>
		</tr>";
$no = 1;
while ($data = mysqli_fetch_array($hasil)){
	$descriptionId = $data[descriptionId];
	$sql = mysqli_query($hore,"SELECT SUM(jawabanA) As TotalA,
						SUM(jawabanB) As TotalB,
						SUM(jawabanC) As TotalC,
						SUM(jawabanD) As TotalD,
						SUM(jawabanE) As TotalE
						FROM tanswer WHERE descriptionId = '$descriptionId' AND companyId = '$_GET[id]'");
	
	while($oke = mysqli_fetch_array($sql)){
		echo "<tr valign=top>
			<td>$no</td>
			<td>$data[groupName]</td>
			<td>$data[description]</td>
			<td>$oke[TotalA]</td>
			<td>$oke[TotalB]</td>
			<td>$oke[TotalC]</td>
			<td>$oke[TotalD]</td>
			<td>$oke[TotalE]</td>
		  </tr>";	 
		 
		$no++;
	}
}
$data_count = mysqli_fetch_array(mysqli_query($hore,"SELECT SUM(jawabanA) As TotalA,
						SUM(jawabanB) As TotalB,
						SUM(jawabanC) As TotalC,
						SUM(jawabanD) As TotalD,
						SUM(jawabanE) As TotalE
						FROM tanswer WHERE companyId = '$_GET[id]'"));
echo "<tr>
	<td bgcolor=#c6e1f2 colspan='3' align='right'><b>Total</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalA]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalB]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalC]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalD]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalE]</b></td>
	</tr>";

?>