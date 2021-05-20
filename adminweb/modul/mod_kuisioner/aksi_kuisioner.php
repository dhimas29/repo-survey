<link href="../../../css/bootstrap.min.css" rel="stylesheet">
<?php
error_reporting(0);

include "../../../koneksi.php";
include "../../../fungsi/fungsi_indotgl.php";
$module=$_GET[module];
$act=$_GET[act];
if ($module=='kuisioner' AND $act=='input'){
$date = date('Y-m-d');
$companyId = date('Ymd his');

	$sekarang = Date('Y-m-d');
	$kontrak = mysqli_query($hore, "SELECT * FROM kontrak_kerja where id_tcompany = '$_POST[id_perus]'");
	$rowkontrak = mysqli_fetch_array($kontrak);
			$tanggal_kontrak = strtotime(date('Y-m-d', strtotime($rowkontrak['tanggal_akhir'])));
			$tanggal_sekarang = strtotime(date('Y-m-d'));
			if (($tanggal_sekarang >= $tanggal_kontrak)) {
	
	$no_hitung = 1;
	$sql_hitung = mysqli_query($hore,"SELECT * FROM tgroup");
	while($data_hitung = mysqli_fetch_array($sql_hitung)){
		$id_hitung = $data_hitung[groupId];		
		$hasil_hitung = mysqli_query($hore,"SELECT * FROM tdescription, tgroup WHERE tdescription.groupId = '$id_hitung' AND tdescription.groupId = tgroup.groupId ORDER BY tgroup.groupId");
		$i_hitung = 1;
		while ($r_hitung = mysqli_fetch_array($hasil_hitung)){
			$id_hitung = $data_hitung[groupId];
			$asfa_hitung = $_POST['asfa'.$i_hitung.$id_hitung];
			if (empty($asfa_hitung)){
				echo "<script lang=javascript>
			 		window.alert('Anda belum mengisi kuisioner atau ada kuisioner yang belum terisi..!');
			 		history.back();
			 		</script>";
	  			exit;
			}
			
			$i_hitung++;
		}
		echo "<br>";
		$no_hitung++;
	}
		$no = 1;
		$sql = mysqli_query($hore,"SELECT * FROM tgroup");
		while($data = mysqli_fetch_array($sql)){
			$id = $data[groupId];
			$hasil = mysqli_query($hore,"SELECT * FROM tdescription, tgroup WHERE tdescription.groupId = '$id' AND tdescription.groupId = tgroup.groupId ORDER BY tgroup.groupId");
			$i = 1;
			while ($r = mysqli_fetch_array($hasil)){
				$id = $data[groupId];		
				$asfa = $_POST['asfa'.$i.$id];
				$asf = $_POST['asf'.$i.$id];
				// echo "$i $asfa<br>";
				if ($asfa == 'A'){
					mysqli_query($hore,"INSERT INTO tanswer (descriptionId,groupId,companyId,id_kontrak,id_layanan,tanggal_pengisian_kuisioner,jawaban,jawabanA,jawabanB,jawabanC,jawabanD,jawabanE) 
					VALUES('$r[descriptionId]','$r[groupId]','$_POST[id_perus]','$rowkontrak[id_kontrak]','$_POST[id_layan]','$sekarang','$asfa','1','0','0','0','0')");
				}	
				elseif($asfa == 'B'){
					mysqli_query($hore,"INSERT INTO tanswer (descriptionId,groupId,companyId,id_kontrak,id_layanan,tanggal_pengisian_kuisioner,jawaban,jawabanA,jawabanB,jawabanC,jawabanD,jawabanE) 
					VALUES('$r[descriptionId]','$r[groupId]','$_POST[id_perus]','$rowkontrak[id_kontrak]','$_POST[id_layan]','$sekarang','$asfa','0','1','0','0','0')");
				}
				elseif($asfa == 'C'){
					mysqli_query($hore,"INSERT INTO tanswer (descriptionId,groupId,companyId,id_kontrak,id_layanan,tanggal_pengisian_kuisioner,jawaban,jawabanA,jawabanB,jawabanC,jawabanD,jawabanE) 
					VALUES('$r[descriptionId]','$r[groupId]','$_POST[id_perus]','$rowkontrak[id_kontrak]','$_POST[id_layan]','$sekarang','$asfa','0','0','1','0','0')");
				}
				elseif($asfa == 'D'){
					mysqli_query($hore,"INSERT INTO tanswer (descriptionId,groupId,companyId,id_kontrak,id_layanan,tanggal_pengisian_kuisioner,jawaban,jawabanA,jawabanB,jawabanC,jawabanD,jawabanE) 
					VALUES('$r[descriptionId]','$r[groupId]','$_POST[id_perus]','$rowkontrak[id_kontrak]','$_POST[id_layan]','$sekarang','$asfa','0','0','0','1','0')");
				}
				else{
					mysqli_query($hore,"INSERT INTO tanswer (descriptionId,groupId,companyId,id_kontrak,id_layanan,tanggal_pengisian_kuisioner,jawaban,jawabanA,jawabanB,jawabanC,jawabanD,jawabanE) 
					VALUES('$r[descriptionId]','$r[groupId]','$_POST[id_perus]','$rowkontrak[id_kontrak]','$_POST[id_layan]','$sekarang','$asfa','0','0','0','0','1')");
				}

				if ($asf == 'A'){
					mysqli_query($hore,"INSERT INTO tanswer2 (descriptionId,groupId,companyId,id_kontrak,id_layanan,jawaban,jawabanA,jawabanB,jawabanC,jawabanD,jawabanE) 
					VALUES('$r[descriptionId]','$r[groupId]','$_POST[id_perus]','$rowkontrak[id_kontrak]','$_POST[id_layan]','$asf','1','0','0','0','0')");
				}	
				elseif($asf == 'B'){
					mysqli_query($hore,"INSERT INTO tanswer2 (descriptionId,groupId,companyId,id_kontrak,id_layanan,jawaban,jawabanA,jawabanB,jawabanC,jawabanD,jawabanE) 
					VALUES('$r[descriptionId]','$r[groupId]','$_POST[id_perus]','$rowkontrak[id_kontrak]','$_POST[id_layan]','$asf','0','1','0','0','0')");
				}
				elseif($asf == 'C'){
					mysqli_query($hore,"INSERT INTO tanswer2 (descriptionId,groupId,companyId,id_kontrak,id_layanan,jawaban,jawabanA,jawabanB,jawabanC,jawabanD,jawabanE) 
					VALUES('$r[descriptionId]','$r[groupId]','$_POST[id_perus]','$rowkontrak[id_kontrak]','$_POST[id_layan]','$asf','0','0','1','0','0')");
				}
				elseif($asf == 'D'){
					mysqli_query($hore,"INSERT INTO tanswer2 (descriptionId,groupId,companyId,id_kontrak,id_layanan,jawaban,jawabanA,jawabanB,jawabanC,jawabanD,jawabanE) 
					VALUES('$r[descriptionId]','$r[groupId]','$_POST[id_perus]','$rowkontrak[id_kontrak]','$_POST[id_layan]','$asf','0','0','0','1','0')");
				}
				else{
					mysqli_query($hore,"INSERT INTO tanswer2 (descriptionId,groupId,companyId,id_kontrak,id_layanan,jawaban,jawabanA,jawabanB,jawabanC,jawabanD,jawabanE) 
					VALUES('$r[descriptionId]','$r[groupId]','$_POST[id_perus]','$rowkontrak[id_kontrak]','$_POST[id_layan]','$asf','0','0','0','0','1')");
				}
				$i++;
			}
			echo "<br>";
			$no++;
		}

		// $pengurangan = $rowkontrak['sisah_kontrak'] - 1 ;
		// $sisah = mysqli_query($hore, "UPDATE kontrak_kerja set sisah_kontrak='$pengurangan' where id_tcompany='$_POST[id_perus]'");
		$saran = mysqli_query($hore, "UPDATE tcompany set suggestion='$_POST[suggestion]' where companyId='$_POST[id_perus]'");
		echo "<center><font face='Tahoma' size='2'>
				Pelanggan yang terhormat,<br><br>
				Terima kasih atas waktu yang telah diluangkan untuk melengkapi kuisioner yang kami sediakan. <br>
				Pendapat Anda sangat berarti bagi kami untuk meningkatkan pelayanan. <br><br>
				Hormat kami, <br><br>
				Management<br>
				KAP-AAFA </font><br>
				<a href='../../master.php?module=kuisioner'>
				<button  class='btn btn-lg btn-info'><span class='glyphicon glyphicon-arrow-left'></span> Kembali</button>
				</a>
				</center>";
	// }else{
	// 	echo "<script lang=javascript>
	//  	window.alert('Anda Sudah Tidak Dapat Mengisi Kuisioner..!');history.back();</script>";
	// 	exit;
	// }	
		// }	
			}else{
				echo "<script lang=javascript>
					 window.alert('Anda Tidak Dapat Mengisi Kuisioner, Dapat Mengisi Kuisioner Saat Masa Kontrak Habis..!');history.back();</script>";
		  			exit;
			}
}
?>