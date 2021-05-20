
<?php 
	// require '../connect.php';
	if (isset($_POST['level'])) {
		$level = $_POST['level'];
		// $sql = "select * from supplier where id_barang=$barang";
		// $hasil = mysqli_query($konek,$sql);
		// while($data = mysqli_fetch_array($hasil)){
			?>
			<input type="text" name="nama">
		<!-- <option value="<?php echo $data['id_supplier'];?>"><?php echo $data['namaSupplier']; ?></option> -->
			<?php
		// }
	}
?>