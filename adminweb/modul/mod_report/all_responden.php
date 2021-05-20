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
error_reporting(0);


include "../../../koneksi.php";
include "../../../fungsi/fungsi_indotgl.php";

$hasil = mysqli_query($hore,"SELECT * FROM tdescription left join tgroup on tgroup.groupId = tdescription.groupId");
$date = date('Y-m-d');
$time = date('H:i:s');
$dateIndo = tgl_indo($date);

echo "<center><table border=0 cellpadding=10 cellspacing=5 bgcolor= #e6e6e6>
		<tr >
			<td colspan='8'  bgcolor=#337ab7 style='border: none ;color:white;'>
			<a href='../../master.php?module=hasil&sub=laporan'>
			<button style='margin-right:230px;' class='btn'><span class='glyphicon glyphicon-arrow-left'></span> Kembali</button>
			</a>
			<b><font size=5>REKAP KUISIONER</font></b>
			<a href='exportExcel.php'>
			<button style='margin-left:230px;' class='btn'><span class='glyphicon glyphicon-print'></span> Cetak</button></a>
			</td>
		</tr>
		<tr>
			<td colspan=2>Dicetak : <b>$dateIndo $time</b></td>
		</tr>
		
		<tr>
			<td>
				<table cellpadding=2 border=2 bgcolor='#fff'>
					<tr>
					<td bgcolor=#c6e1f2 align=center><b>NO</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Dimensi</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Kriteria</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Sangat Baik</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Baik</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Cukup</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Buruk</b></td>
					<td bgcolor=#c6e1f2 align=center><b>Sangat Buruk</b></td>
					<tr>
		";
$no = 1;
while ($data = mysqli_fetch_array($hasil)){
	$descriptionId = $data[descriptionId];
	$sql = mysqli_query($hore,"SELECT SUM(jawabanA) As TotalA,
						SUM(jawabanB) As TotalB,
						SUM(jawabanC) As TotalC,
						SUM(jawabanD) As TotalD,
						SUM(jawabanE) As TotalE
						FROM tanswer WHERE descriptionId = '$descriptionId'");
	
	while($oke = mysqli_fetch_array($sql)){
		echo "<tr valign=top>
			<td align='center'>$no</td>
			<td align='center'>$data[groupName]</td>
			<td >$data[description]</td>
			<td align='center'>$oke[TotalA]</td>
			<td align='center'>$oke[TotalB]</td>
			<td align='center'>$oke[TotalC]</td>
			<td align='center'>$oke[TotalD]</td>
			<td align='center'>$oke[TotalE]</td>
		  </tr>";	 
		$no++;
	}
}
$data_count = mysqli_fetch_array(mysqli_query($hore,"SELECT SUM(jawabanA) As TotalA,
						SUM(jawabanB) As TotalB,
						SUM(jawabanC) As TotalC,
						SUM(jawabanD) As TotalD,
						SUM(jawabanE) As TotalE
						FROM tanswer"));
echo "<tr align='center'>
	
		<td bgcolor=#c6e1f2 colspan='3'><b>Total</b></td>
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
	<center>";

?>