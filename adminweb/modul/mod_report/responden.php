<style>
	.btn {
  display: inline-block;
  padding: 6px 12px;
  font-size: 14px;
  font-weight: normal;
  line-height: 1.42857143;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  -ms-touch-action: manipulation;
      touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  background-image: none;
  border: 1px solid transparent;
  border-radius: 4px;
  background-color: #5cb85c; 
  padding: 5px 10px;
  font-size: 12px;
  line-height: 1.5;
  border-radius: 3px;
  margin-top:10px;
  margin-bottom: 10px;
  color: white;
}
@font-face {
  font-family: 'Glyphicons Halflings';

  src: url('../../../fonts/glyphicons-halflings-regular.eot');
  src: url('../../../fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'), url('../../../fonts/glyphicons-halflings-regular.woff2') format('woff2'), url('../../../fonts/glyphicons-halflings-regular.woff') format('woff'), url('../../../fonts/glyphicons-halflings-regular.ttf') format('truetype'), url('../../../fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular') format('svg');
}
.glyphicon {
  position: relative;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: normal;
  line-height: 1;

  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.glyphicon-print:before {
  content: "\e045";
}
.glyphicon-arrow-left:before {
  content: "\e091";
}
</style>
<?php
if($_GET['act']=='detail')
{
error_reporting(1);
session_start();


include "../../../koneksi.php";
include "../../../fungsi/fungsi_indotgl.php";
include "../../../fungsi/fungsi_rubah_tanda.php";

$hasil = mysqli_query($hore,"SELECT * FROM tdescription left join tgroup on tgroup.groupId = tdescription.groupId");
$date = date('Y-m-d');
$time = date('H:i:s');

if ($_SESSION['level'] == 'Pimpinan') {
   $responden = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM tanswer, tcompany 
   	left join kontrak_kerja on kontrak_kerja.id_tcompany = tcompany.companyId 
   	left join trekan on kontrak_kerja.id_rekan = trekan.id
   	WHERE tanswer.companyId = '$_GET[id]' AND tcompany.companyId = tanswer.companyId"));
}else{
$responden = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM tanswer, tcompany WHERE tanswer.companyId = '$_GET[id]' AND tcompany.companyId = tanswer.companyId"));
}
$dateIndo = tgl_indo($responden['dateSurvey']);
echo "<center><table border=0 cellpadding=10 cellspacing=3 bgcolor= #e6e6e6>
		<tr >
			<td colspan='8'  bgcolor=#337ab7 style='border: none ;color:white;'>
			<a href='../../master.php?module=hasil&sub=laporan'>
			<button style='margin-right:220px;' class='btn'><span class='glyphicon glyphicon-arrow-left'></span> Kembali</button>
			</a>
			<b><font size=5>LAPORAN KUISIONER RESPONDEN</font></b>
			<a href='exportExcelResponden.php?id=$_GET[id]'>
			<button style='margin-left:200px;' class='btn'><span class='glyphicon glyphicon-print'></span> Cetak</button></a>
			</td>
		</tr>
		<tr>
			<td >Nama Responden</td> <td>: <b>$responden[companyName]</b></td>
		</tr>
		<tr>
			<td >Alamat</td><td>: <b>$responden[companyAddress]</b></td>
		</tr>
		<tr>
			<td >Telp / HP</td> <td> : <b>$responden[companyPhoneHp]</b></td>
		</tr>
		<tr>
			<td width=150>Tanggal Isi Survey</td> <td>: <b>$dateIndo </b></td>
		</tr>
		<tr>
			<td >Kritik dan Saran</td> <td>: <b>$responden[suggestion]</b></td>
		</tr>";
		if ($_SESSION['level'] == 'Pimpinan') {
		echo "<tr>
				<td >Rekanan</td> <td>: <b>$responden[nama]</b></td>
			</tr>";
		}
		echo"<tr>
			<td  colspan=8 >
				<table border=1 cellpadding=2 bgcolor='#fff'>
					<tr>
					<td bgcolor=#c6e1f2 align=center><b>NO</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Dimensi</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Kriteria</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Sangat Baik</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Baik</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Cukup</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Buruk</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Sangat Buruk</b></td>
					</tr>
				
			";
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
      $a=rubah($oke[TotalA]);
      $b=rubah($oke[TotalB]);
      $c=rubah($oke[TotalC]);
      $d=rubah($oke[TotalD]);
      $e=rubah($oke[TotalE]);
			echo "<tr valign=top >
					<td align='center'>$no</td>
					<td align='center'>$data[groupName]</td>
					<td>$data[description]</td>
					<td align='center'>$a</td>
					<td align='center'>$b</td>
					<td align='center'>$c</td>
					<td align='center'>$d</td>
					<td align='center'>$e</td>
				  </tr>

			  ";	 
			 
			$no++;
		}
		}
			$data_count = mysqli_fetch_array(mysqli_query($hore,"SELECT 
								SUM(jawabanA) As TotalA,
								SUM(jawabanB) As TotalB,
								SUM(jawabanC) As TotalC,
								SUM(jawabanD) As TotalD,
								SUM(jawabanE) As TotalE
								FROM tanswer WHERE companyId = '$_GET[id]'"));
		echo "	<tr align='center'>
			
				<td bgcolor=#c6e1f2 align='center' colspan='3'><b>Total</b></td>
				<td bgcolor=#c6e1f2><b>$data_count[TotalA]</b></td>
				<td bgcolor=#c6e1f2><b>$data_count[TotalB]</b></td>
				<td bgcolor=#c6e1f2><b>$data_count[TotalC]</b></td>
				<td bgcolor=#c6e1f2><b>$data_count[TotalD]</b></td>
				<td bgcolor=#c6e1f2><b>$data_count[TotalE]</b></td>
				</tr>
				</table>
			</td>
		</tr>


	</table>
</center>";
}


if($_GET['act']=='hapus')
{
	include "../../../koneksi.php";
	
$delet_kenyataan = mysqli_query($hore,"SELECT * FROM tanswer WHERE companyId='$_GET[id]'");
while($rot_kenyataan =  mysqli_fetch_array($delet_kenyataan)){
	$delet_kriteria = mysqli_query($hore,"SELECT * FROM kriteria_harapan");
	while($rot_delet_kriteria =  mysqli_fetch_array($delet_kriteria)){
	$del_kriteria = mysqli_query($hore,"DELETE FROM kriteria where id_kriteria_harapan = '$rot_delet_kriteria[id]'");
	$del_kriteria = mysqli_query($hore,"DELETE FROM kriteria_harapan where groupId = '$rot_kenyataan[groupId]'");
	$del_harap = mysqli_query($hore,"DELETE FROM kriteria_kenyataan where groupId = '$rot_kenyataan[groupId]'");
	}
}

$delet_dimensi = mysqli_query($hore,"SELECT * FROM tanswer2 WHERE companyId='$_GET[id]'");
while($rot_dimensi =  mysqli_fetch_array($delet_dimensi)){
	$delete_dimensi = mysqli_query($hore,"SELECT * FROM dimensi_harapan");
	while($rot_delet_dimensi =  mysqli_fetch_array($delete_dimensi)){
		$del_dimensi = mysqli_query($hore,"DELETE FROM dimensi where id_dimensi_harapan = '$rot_delet_dimensi[id]'");
		$del_kriteria = mysqli_query($hore,"DELETE FROM dimensi_harapan where groupId = '$rot_dimensi[groupId]'");
		$del_harap = mysqli_query($hore,"DELETE FROM dimensi_kenyataan where groupId = '$rot_dimensi[groupId]'");
	}
}
mysqli_query($hore,"DELETE FROM tanswer WHERE companyId='$_GET[id]'");
mysqli_query($hore,"DELETE FROM tanswer2 WHERE companyId='$_GET[id]'");
mysqli_query($hore,"DELETE FROM tcompany WHERE companyId='$_GET[id]'");
	header('location:../../master.php?module=hasil&sub=laporan');
	
}
?>
 