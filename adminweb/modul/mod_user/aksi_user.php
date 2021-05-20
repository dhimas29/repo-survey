<?php
error_reporting(0);
session_start();
use PHPMailer\PHPMailer\PHPMailer;

include "../../../koneksi.php";
$module=$_GET[module];
$act=$_GET[act];
// Hapus user
if ($module=='user' AND $act=='hapus'){
	if ($_GET['level'] == 'Klien') {
		$query = mysqli_query($hore, "SELECT * FROM tuser where userId='$_GET[id]'");
			$roquery = mysqli_fetch_array($query);
		$comp = mysqli_query($hore, "SELECT * FROM tcompany where companyName='$roquery[fullname]'");
			$compquery = mysqli_fetch_array($comp);
		$kkerja = mysqli_query($hore, "SELECT * FROM kontrak_kerja where id_tcompany = '$compquery[companyId]'");
			$kkerjaquery = mysqli_fetch_array($kkerja);
			if ($q1 = mysqli_query($hore,"DELETE FROM tanswer WHERE companyId = '$kkerjaquery[id_tcompany]'")){
				if($q2 = mysqli_query($hore,"DELETE FROM tanswer2 WHERE companyId = '$kkerjaquery[id_tcompany]'")){
					if($q3 = mysqli_query($hore,"DELETE FROM kontrak_kerja WHERE id_tcompany = '$kkerjaquery[id_tcompany]'")){
						$qs = mysqli_query($hore,"DELETE FROM tcompany_layanan WHERE companyId = '$kkerjaquery[id_tcompany]'");
						if($q4 = mysqli_query($hore,"DELETE FROM tcompany WHERE companyName = '$roquery[fullname]'")){
							$q5 = mysqli_query($hore,"DELETE FROM tuser WHERE userId = '$_GET[id]'");
						}
					}	
				}			
			}	
	}else if($_GET['level'] == 'Rekan'){
		$query = mysqli_query($hore, "SELECT * FROM tuser where userId='$_GET[id]'");
			$roquery = mysqli_fetch_array($query);
		$comp = mysqli_query($hore, "SELECT * FROM trekan where nama='$roquery[fullname]'");
			$compquery = mysqli_fetch_array($comp);
		$kkerja = mysqli_query($hore, "SELECT * FROM kontrak_kerja where id_rekan = '$compquery[id]'");
			while($kkerjaquery = mysqli_fetch_array($kkerja)){
			$kkcomp = mysqli_query($hore, "SELECT * FROM tcompany where companyId = '$kkerjaquery[id_tcompany]'");
			$kkcompquery = mysqli_fetch_array($kkcomp);
			$q3 = mysqli_query($hore,"DELETE FROM tcompany WHERE companyId = '$kkcompquery[companyId]'");
			$sz = mysqli_query($hore,"DELETE FROM tcompany_layanan WHERE companyId = '$kkcompquery[companyId]'");
			$q7 = mysqli_query($hore,"DELETE FROM tuser WHERE fullname = '$kkcompquery[companyName]'");	
			}
		$kanswer = mysqli_query($hore, "SELECT * FROM tanswer where companyId = '$kkerjaquery[id_tcompany]'");
			$kanswerquery = mysqli_fetch_array($kanswer);
			$hit1 = mysqli_query($hore,"DELETE FROM dimensi_harapan_rekan WHERE id_rekan = '$compquery[id]'");
			$hit2 = mysqli_query($hore,"DELETE FROM dimensi_kenyataan_rekan WHERE id_rekan = '$compquery[id]'");
			$hit3 = mysqli_query($hore,"DELETE FROM dimensi_rekan WHERE id_rekan = '$compquery[id]'");
			$hit4 = mysqli_query($hore,"DELETE FROM kriteria_harapan_rekan WHERE id_rekan = '$compquery[id]'");
			$hit5 = mysqli_query($hore,"DELETE FROM kriteria_kenyataan_rekan WHERE id_rekan = '$compquery[id]'");
			$hit6 = mysqli_query($hore,"DELETE FROM kriteria_rekan WHERE id_rekan = '$compquery[id]'");
			$hit7 = mysqli_query($hore,"DELETE FROM dimensi_harapan_rekan_layanan WHERE id_rekan = '$compquery[id]'");
			$hit8 = mysqli_query($hore,"DELETE FROM dimensi_kenyataan_rekan_layanan WHERE id_rekan = '$compquery[id]'");
			$hit9 = mysqli_query($hore,"DELETE FROM dimensi_rekan_layanan WHERE id_rekan = '$compquery[id]'");
			$hit10 = mysqli_query($hore,"DELETE FROM kriteria_harapan_rekan_layanan WHERE id_rekan = '$compquery[id]'");
			$hit11 = mysqli_query($hore,"DELETE FROM kriteria_kenyataan_rekan_layanan WHERE id_rekan = '$compquery[id]'");
			$hit12 = mysqli_query($hore,"DELETE FROM kriteria_rekan_layanan WHERE id_rekan = '$compquery[id]'");
			if($q1 = mysqli_query($hore,"DELETE FROM tanswer2 WHERE companyId = '$kanswerquery[companyId]'")){
				if($q2 = mysqli_query($hore,"DELETE FROM tanswer WHERE id_kontrak = '$kkerjaquery[id_kontrak]'")){
					$ans = mysqli_query($hore,"DELETE FROM tanswer2 WHERE id_kontrak = '$kkerjaquery[id_kontrak]'");
						if($q4 = mysqli_query($hore,"DELETE FROM kontrak_kerja WHERE id_rekan = '$compquery[id]'")){
							if($q5 = mysqli_query($hore,"DELETE FROM trekan WHERE nama = '$roquery[fullname]'")){
								$q6 = mysqli_query($hore,"DELETE FROM tuser WHERE userId = '$_GET[id]'");
						}
					}	
				}
			}
		}	
	else{
		$q5 = mysqli_query($hore,"DELETE FROM tuser WHERE userId = '$_GET[id]'");	
	}
	var_dump($q);
	header('location:../../master.php?module=user');
}

// Input user
elseif ($module=='user' AND $act=='input'){
	$checkbox1 = $_POST['produk'];
	$chk="";  
	$companyId = date('Ymd his');
	$pass = md5($_POST['password']);
	if ($_POST['level'] == 'Klien') {
		$date = date('Y-m-d');
		$query = mysqli_query($hore, "INSERT INTO tcompany(companyId,companyName,companyAddress,companyPhoneHp,dateSurvey,suggestion,product)
			VALUES('$companyId','$_POST[nama]','$_POST[alamat]','$_POST[no_telp]','$date','-','-')");
		if ($query) {
			// Import PHPMailer classes into the global namespace
			// These must be at the top of your script, not inside a function
			
			require 'PHPMailer/Exception.php';
			require 'PHPMailer/PHPMailer.php';
			require 'PHPMailer/SMTP.php';
			$mail = new PHPMailer();
			$email = $_POST['email'];
			$log = $_POST['username'];
			$ps = $_POST['password'];
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
				$mail->Subject = 'Login Klien';
				$mail->Body    = 'Username : '.$log.'<br>Password: '.$ps;

				$mail->send();
				echo 'Message has been sent';
			} catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		}	
	}elseif($_POST['level'] == 'Rekan'){
		$query = mysqli_query($hore, "INSERT INTO trekan(id,nama,alamat,no_telp)
			VALUES('$_POST[nip]','$_POST[nama]','$_POST[alamat]','$_POST[no_telp]')");
	}
	
	$aksi =mysqli_query($hore,"INSERT INTO tuser(username,
								   password,
								   fullname,
								   email,level) 
							VALUES('$_POST[username]',
								   '$pass',
								   '$_POST[nama]',
								   '$_POST[email]','$_POST[level]')");
	if($aksi)
	{
	header('location:../../master.php?module=user');
	}
	else {echo "gagal";}
}

// Update user
elseif ($module=='user' AND $act=='update'){
	if (empty($_POST[password])) {
		if ($_POST['level'] == 'Klien') {
			$do = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM  tcompany where companyName = '$_POST[exnama]'"));
			// var_dump($do);die;
			if($do){
				mysqli_query($hore,"UPDATE tcompany SET companyName	= '$_POST[nama]' where companyId = '$do[companyId]'");
			}	
		}elseif($_POST['level'] == 'Rekan'){
			$do = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM  trekan where nama = '$_POST[exnama]'"));
			if($do){
				mysqli_query($hore,"UPDATE trekan SET nama	= '$_POST[nama]' where id = '$do[id]'");
			}
		}
		mysqli_query($hore,"UPDATE tuser SET username	= '$_POST[username]',
									fullname	= '$_POST[nama]',
									email		= '$_POST[email]'
									WHERE userId = '$_POST[id]'");
	}
	else{
		$pass = md5($_POST[password]);
		if ($_POST['level'] == 'Klien') {
			$do = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM  tcompany where companyName = '$_POST[nama]'"));
			if($do){
				mysqli_query($hore,"UPDATE tcompany SET companyName	= '$_POST[nama]' where companyId = '$do[companyId]'");
			}
		}elseif($_POST['level'] == 'Rekan'){
			$do = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM  trekan where nama = '$_POST[nama]'"));
			if($do){
				mysqli_query($hore,"UPDATE trekan SET nama	= '$_POST[nama]' where id = '$do[id]'");
			}
		}
		// $do = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM tuser where userId = '$_POST[id]'"));
		// mysqli_query($hore,"UPDATE trekan SET nama	= '$_POST[nama]' where nama = '$do[fullname]'");;						 
		mysqli_query($hore,"UPDATE tuser SET username   = '$_POST[username]',
                                 password        = '$pass',
                                 fullname	     = '$_POST[nama]',
                                 email		     = '$_POST[email]'
								 WHERE userId	 = '$_POST[id]'");
	}
	header('location:../../master.php?module=user');
}


?>
