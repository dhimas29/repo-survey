<?php
session_start();
include "../../../koneksi.php";
use PHPMailer\PHPMailer\PHPMailer;
$module = $_GET['module'];
$act = $_GET['act'];
// Hapus Group
if ($module=='klien' AND $act=='hapus'){
	mysqli_query($hore,"DELETE FROM tcompany_layanan WHERE companyId='$_GET[id]' and id_rekan ='$_GET[id_rekan]' and id_kontrak='$_GET[id_kontrak]'");
	mysqli_query($hore,"DELETE FROM kontrak_kerja WHERE id_tcompany='$_GET[id]' and id_rekan='$_GET[id_rekan]' and id_kontrak ='$_GET[id_kontrak]'");
	header('location:../../master.php?module=klien');
}
elseif($module=='kontrak' AND $act=='reset'){
	mysqli_query($hore, "UPDATE kontrak_kerja set sisah_kontrak ='$_GET[kontrak]'
		WHERE id_kontrak='$_GET[id]'");
	header('location:../../master.php?module=kontrak');
}
elseif($module=='klien' AND $act=='up'){
	$query = mysqli_query($hore, "UPDATE kontrak_kerja set konfirmasi ='Dapat Mengisi Kuisioner'
		WHERE id_kontrak='$_GET[id_kontrak]'");
	if($query){
		require 'PHPMailer/Exception.php';
		require 'PHPMailer/PHPMailer.php';
		require 'PHPMailer/SMTP.php';
		$mail = new PHPMailer();
		$email = $_GET['email'];
		try {
			//Server settings
			$mail->SMTPDebug = 1;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'skripsi2021dela@gmail.com';                     // SMTP username
			$mail->Password   = 'skripsi21dela';                               // SMTP password
			$mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

			//Recipients
			$mail->setFrom('skripsi2021dela@gmail.com', 'Dela');
			$mail->addAddress($email);     // Add a recipient

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Isi Kuisioner';
			$mail->Body    = 'Anda Dapat Mengisi Kuisioner';

			$mail->send();
			echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}		
	header('location:../../master.php?module=klien');
}
// Input Group
elseif ($module=='klien' AND $act=='input'){
	$checkbox1 = $_POST['produk'];
	$chk="";  
	$companyId = $_POST['tcompanyId'];
	$date = date('Y-m-d');
	
	// $groupName 	= $_POST['grup'];
	
	$createdDate = date('Y-m-d H:i:s');
	// $cek = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM kontrak_kerja 
	// left join tcompany
	// where id_rekan = '$_POST[rekanan]' and id_tcompany ='$companyId' and month"));
	// var_dump($cek);die;
	// if ($cek > 0) {
		
	// }else{
		$masuk2 = mysqli_query($hore,"UPDATE INTO tcompany set product ='$chk' where companyId = '$companyId')");
		$kontrak = mysqli_query($hore, 
		"INSERT INTO kontrak_kerja(id_tcompany,id_rekan,tanggal_awal,tanggal_akhir) 
		values ('$companyId','$_POST[rekanan]','$_POST[kontrak_awal]','$_POST[kontrak_berakhir]')");
	
	$ck = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM kontrak_kerja 
	where id_rekan = '$_POST[rekanan]' and id_tcompany ='$companyId' 
	and tanggal_awal='$_POST[kontrak_awal]' 
	and tanggal_akhir='$_POST[kontrak_berakhir]' 
	order by id_kontrak desc limit 1"));
	if ($kontrak) {
		foreach($checkbox1 as $chk1)  
		{  
			$chk .= $chk1.",";  
			$ce = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tcompany_layanan 
			where id_rekan = '$_POST[rekanan]' and companyId ='$companyId' and id_layanan='$chk1'"));
			if($ce > 0){
			$query = mysqli_query($hore,"DELETE FROM kontrak_kerja WHERE id_tcompany='$companyId' and id_rekan='$_POST[rekanan]' and id_kontrak ='$ck[id_kontrak]'");

			}else{
			$query = mysqli_query($hore, "INSERT INTO tcompany_layanan(id_layanan,companyId,id_rekan,id_kontrak)
				VALUES('$chk1','$companyId','$_POST[rekanan]','$ck[id_kontrak]')"); 
			}
		}
	}	
	header('location:../../master.php?module=klien');
	
}

// Update Group
elseif ($module=='group' AND $act=='update'){
	$modifiedDate = date('Y-m-d H:i:s');
	$aksi=mysqli_query($hore,"UPDATE tgroup SET groupName = '$_POST[grup]', ModifiedDate = '$modifiedDate', ModifiedUser = '$_SESSION[userId]' WHERE groupId = '$_POST[id]'");
	if($aksi)
  {
    header('location:../../master.php?module=group');
  }
  else
  {
    echo "gagal";
  }
}
?>
