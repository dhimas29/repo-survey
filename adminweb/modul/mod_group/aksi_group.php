<?php
session_start();
include "../../../koneksi.php";
$module = $_GET['module'];
$act = $_GET['act'];
// Hapus Group
if ($module=='group' AND $act=='hapus'){
	die;
	mysqli_query($hore,"DELETE FROM tgroup WHERE groupId='$_GET[id]'");
	header('location:../../master.php?module=group');
}

// Input Group
elseif ($module=='group' AND $act=='input'){
	$groupName 	= $_POST['grup'];
	$createdDate = date('Y-m-d H:i:s');
	$masuk = mysqli_query($hore,"INSERT INTO tgroup(groupName,CreatedDate,CreatedUser) VALUES('$groupName','$createdDate','$_SESSION[userId]')");
	
	header('location:../../master.php?module=group');
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
