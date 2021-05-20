
<script type="text/javascript" src="fusion/JS/jquery-1.4.js"></script>
<script type="text/javascript" src="fusion/JS/jquery.fusioncharts.js"></script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="glyphicon glyphicon-new-window"></i> Laporan
        </h1>
        <ol class="breadcrumb">
        	<li class="active">
                 <a href="master.php?module=hasil&sub=all">Laporan</a>
            </li>
        	<?php if ($_GET['sub']=='all'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=all">Hasil Kuisioner</a>
            </li>
            <?php } ?>
			<?php if ($_GET['sub']=='pergroup'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=pergroup">Hasil Kuisioner Per Dimensi</a>
            </li>
            <?php } ?>
            <?php if ($_GET['sub']=='laporan'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=laporan">Laporan Responden</a>
            </li>
            <?php } ?>
            <?php if ($_GET['sub']=='laporan_rekan'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=laporan_rekan">Laporan Rekan</a>
            </li>
            <?php } ?>
            <?php if ($_GET['sub']=='laporan_rekan_all'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=laporan_rekan_all">Laporan Rekan</a>
            </li>
            <?php } ?>
            <?php if ($_GET['sub']=='laporan_kriteria'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=laporan_kriteria">Laporan Per Kriteria</a>
            </li>
            <?php } ?>
            <?php if ($_GET['sub']=='laporan_dimensi'){ ?>
            <li class="active">
                 <a href="master.php?module=hasil&sub=laporan_dimensi">Laporan Per Dimensi</a>
            </li>
            <?php } ?>
        </ol>
    </div>
</div>
<nav class="navbar navbar-inverse" >
	<ul class="nav navbar-nav">
		<?php if($_SESSION['level'] != 'Rekan' ) :  ?>
		<li class="<?php if($_GET['sub']=='all'){echo'active';} ?>"><a href="?module=hasil&sub=all">Hasil Kuisioner</a></li>
		<li class="<?php if($_GET['sub']=='pergroup'){echo'active';} ?>"><a href="?module=hasil&sub=pergroup">Hasil Kuisioner Per Dimensi</a></li>
		<?php endif; ?>
		<?php if($_SESSION['level'] == 'Rekan' ) :  ?>
		<li class="<?php if($_GET['sub']=='laporan_rekan'){echo'active';} ?>"><a href="?module=hasil&sub=laporan_rekan">Laporan Rekan</a></li>
		<?php endif;?>
		<?php //if($_SESSION['level'] == 'Pimpinan' ) :  ?>
		<?php //endif;?>
		<?php if($_SESSION['level'] != 'Rekan' ) :  ?>
			<li class="<?php if($_GET['sub']=='laporan'){echo'active';} ?>"><a href="?module=hasil&sub=laporan">Laporan Responden</a></li>
			<li class="<?php if($_GET['sub']=='laporan_rekan_all'){echo'active';} ?>"><a href="?module=hasil&sub=laporan_rekan_all">Laporan Rekan</a></li>
			<li class="<?php if($_GET['sub']=='laporan_kriteria'){echo'active';} ?>"><a href="?module=hasil&sub=laporan_kriteria">Laporan Per Kriteria</a></li>
			<li class="<?php if($_GET['sub']=='laporan_dimensi'){echo'active';} ?>"><a href="?module=hasil&sub=laporan_dimensi">Laporan Per Dimensi</a></li>
		<?php endif; ?>
	</ul>
</nav>
<?php if ($_GET['sub']=='all'){ ?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">Hasil Kuisioner Secara Keseluruhan</div>
		</div>
	
		<div style="width: 1000px;margin: 0px auto;">
			<h2>Grafik Per Kriteria</h2>
			<canvas id="myChart2"></canvas>     
		</div>
		<!-- <script type="text/javascript">
			$('#tabletest').convertToFusionCharts({
				swfPath: "fusion/Charts/",
				type: "MSColumn3D",
				data: "#tabletest",
				dataFormat: "HTMLTable",
				width:1000,
				height:500,
			});
			</script> -->
		<div class="panel-body">
			<table id="myHTMLTable" border="0" cellpadding="5" class="table table-striped">
				<tr>
				<th width="15%"><font size=2 face=tahoma>Data</font></th> 
				<th width="18%"><font size=2 face=tahoma>Sangat Baik</font></th>
				<th width="18%"><font size=2 face=tahoma>Baik</font></th>
				<th width="18%"><font size=2 face=tahoma>Cukup</font></th>
				<th width="18%"><font size=2 face=tahoma>Buruk</font></th>
				<th><font size=2 face=tahoma>Sangat Buruk</font></th>
				</tr>
			<?php

			$sql = mysqli_query($hore,"SELECT SUM(jawabanA) As TotalA,
									SUM(jawabanB) As TotalB,
									SUM(jawabanC) As TotalC,
									SUM(jawabanD) As TotalD,
									SUM(jawabanE) As TotalE
									FROM tanswer ");
			
			$des = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tdescription"));
			$noo=1;
			$oke = mysqli_fetch_array($sql);
				$a = $oke[TotalA];
				$b = $oke[TotalB];
				$c = $oke[TotalC];
				$d = $oke[TotalD];
				$e = $oke[TotalE];
				$tot = $a+$b+$c+$d+$e;
				
				$pa = ROUND(($a / $tot) * 100);
				$pb = ROUND(($b / $tot) * 100);
				$pc = ROUND(($c / $tot) * 100);
				$pd = ROUND(($d / $tot) * 100);
				$pe = ROUND(($e / $tot) * 100);
					echo "<tr>
						<td><font size=3 face=tahoma>Jumlah Jawaban</font></td>
						<td><font size=2 face=tahoma>$a</font></td>
						<td><font size=2 face=tahoma>$b</font></td>
						<td><font size=2 face=tahoma>$c</font></td>
						<td><font size=2 face=tahoma>$d</font></td>
						<td><font size=2 face=tahoma>$e</font></td>
					  </tr>
					  <tr >
						<td><font size=3 face=tahoma>Prosentase</font></td>
						<td><font size=2 face=tahoma>$pa%</font></td>
						<td><font size=2 face=tahoma>$pb%</font></td>
						<td><font size=2 face=tahoma>$pc%</font></td>
						<td><font size=2 face=tahoma>$pd%</font></td>
						<td><font size=2 face=tahoma>$pe%</font></td>
					  </tr>
					  ";	 
			?>
		
			</table>
			<!-- <script type="text/javascript">
			$('#myHTMLTable').convertToFusionCharts({
				swfPath: "fusion/Charts/",
				type: "MSColumn2D",
				data: "#myHTMLTable",
				dataFormat: "HTMLTable",
				width:1000,
				height:500,
			});
			</script> -->
		</div>
	</div>
<?php } ?>
<?php if ($_GET['sub']=='pergroup'){ ?>

		<?php
		error_reporting(1);
		$result=mysqli_query($hore,"SELECT groupId from tgroup group by groupId ");
		$kolom = 2;
		$array=array();
		while ($sql=mysqli_fetch_array($result)) 
		{
			array_push($array, $sql);
		}
		$chunks=array_chunk($array, $kolom);

			foreach ($chunks as $chunk) {
			    foreach ($chunk as $data) {
			        echo "<div class='col-md-6'style='padding-left:0px;padding-right:0px;'>";
			        $data2=mysqli_fetch_array(mysqli_query($hore,"SELECT *from tgroup where groupId='$data[groupId]' group by groupId "));
			        ?>
					<div class="panel panel-primary" style='margin-left:10px'>
						<div class="panel-heading">
							<div class="panel-title"><?php echo $data2['groupName']; ?></div>
						</div>
						<div class="panel-body">
							<table id="myHTMLTable<?php echo $data2['groupId']; ?>" border="0" cellpadding="5" class="table table-striped">
								<tr>
								<th><font size=2 face=tahoma>Data</font></th> 
								<th><font size=2 face=tahoma>Sangat Baik</font></th>
								<th><font size=2 face=tahoma>Baik</font></th>
								<th><font size=2 face=tahoma>Cukup</font></th>
								<th><font size=2 face=tahoma>Buruk</font></th>
								<th><font size=2 face=tahoma>Sangat Buruk</font></th>
								</tr>
							<?php

							$sql = mysqli_query($hore,"SELECT SUM(jawabanA) As TotalA,
													SUM(jawabanB) As TotalB,
													SUM(jawabanC) As TotalC,
													SUM(jawabanD) As TotalD,
													SUM(jawabanE) As TotalE
													FROM tanswer where groupId='$data2[groupId]' ");
							$nom = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tanswer where groupId='$data2[groupId]'"));
							
							$noo=1;
							$oke = mysqli_fetch_array($sql);
								$a = $oke[TotalA];
								$b = $oke[TotalB];
								$c = $oke[TotalC];
								$d = $oke[TotalD];
								$e = $oke[TotalE];
								$tot = $a+$b+$c+$d+$e;
								
								$pa = ROUND(($a / $tot) * 100);
								$pb = ROUND(($b / $tot) * 100);
								$pc = ROUND(($c / $tot) * 100);
								$pd = ROUND(($d / $tot) * 100);
								$pe = ROUND(($e / $tot) * 100);
									echo "<tr >
										<td><font size=3 face=tahoma>Jumlah Jawaban</font></td>
										<td><font size=2 face=tahoma>$a</font></td>
										<td><font size=2 face=tahoma>$b</font></td>
										<td><font size=2 face=tahoma>$c</font></td>
										<td><font size=2 face=tahoma>$d</font></td>
										<td><font size=2 face=tahoma>$e</font></td>
									  </tr>
									  <tr >
										<td><font size=3 face=tahoma>Prosentase</font></td>
										<td><font size=2 face=tahoma>$pa%</font></td>
										<td><font size=2 face=tahoma>$pb%</font></td>
										<td><font size=2 face=tahoma>$pc%</font></td>
										<td><font size=2 face=tahoma>$pd%</font></td>
										<td><font size=2 face=tahoma>$pe%</font></td>
									  </tr>
									  ";	 
							?>
						
							</table>
							<!-- <script type="text/javascript">
							$('#myHTMLTable<?php echo $data2[groupId]; ?>').convertToFusionCharts({
								swfPath: "fusion/Charts/",
								type: "MSColumn3D",
								data: "#myHTMLTable",
								dataFormat: "HTMLTable",
								width:500,
								height:300,
							});
							</script> -->
						</div>
					</div>
			        <?php
			        echo '</div>';
			    }
			    
			}
			
		?>
	
 <?php } ?>
 <?php if ($_GET['sub']=='laporan')
 { ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-title">
						<b>Daftar Responden</b><button style="margin-left:710px;"  class='btn btn-sm btn-success' value='Print All to Excel' onclick=location.href='modul/mod_report/all_responden.php'><span class="glyphicon glyphicon-zoom-in"></span> Rekap Semua Kuisioner</button>
					</div>
				</div>
				
				<div class="panel-body">
					<div class="row">
						<div class="col-md-5">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="panel-title"> Tampilkan Berdasarkan Tanggal</div>
								</div>
								<div class="panel-body">
									<form action="?module=hasil&sub=laporan&tampilkan=pertanggal" method="post" class="form-horizontal">
									<?php include "../fungsi/fungsi_combobox.php"; include "../fungsi/library.php";?>
										<div class="form-group">
											<label for="tanggal1" class="control-label col-sm-4">Dari tanggal</label>
											<div class="col-sm-7">
											<?php	combotgl(01,31,'tgl_mulai',$tgl_skrg);
											combobln(01,12,'bln_mulai',$bln_sekarang);
											combothn(2000,$thn_sekarang,'thn_mulai',$thn_sekarang); 
											?>
					 						</div>
										</div>
										<div class="form-group">
											<label for="tanggal2" class="control-label col-sm-4">s/d Tanggal</label>
											<div class="col-sm-7">
												<?php	combotgl(01,31,'tgl_selesai',$tgl_skrg);
												combobln(01,12,'bln_selesai',$bln_sekarang);
												combothn(2000,$thn_sekarang,'thn_selesai',$thn_sekarang); 
												?>
						 					</div>
						 				</div>
						 				<div class="col-sm-4">
						 				<input type="hidden" name="pertanggal" value="pertanggal">
						 				</div>
						 				<div class="col-sm-4">
						 					<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span>  Oke</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<?php if($_GET['tampilkan']=='pertanggal'){ 
							$tgl_awal= $_POST['thn_mulai']."-".$_POST['bln_mulai']."-".$_POST['tgl_mulai'];
							$tgl_akhir= $_POST['thn_selesai']."-".$_POST['bln_selesai']."-".$_POST['tgl_selesai'];
							$awalindo=tgl_indo($tgl_awal);
							$akhirindo=tgl_indo($tgl_akhir);

						?>
							<div class="alert alert-info" role="alert">
 								 Menampilkan data dari tanggal <b><?php echo $awalindo." Sampai dengan ".$akhirindo ?><b/> 
							</div>
							<table id="tablekonten" class="table table-striped table-bordered">
						         <th><div id='kontentd'>No</div>
						         </th>
						         <th><div id='kontentd'>Nama Responden</div></th>
						         <th>Tanggal Isi Survey</th>
						         <th><div id='kontentd'>Aksi</div></th></tr>
									<?php
									include "../../koneksi.php";
									include "../../fungsi/fungsi_indotgl.php";
									error_reporting(1);
										$jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tanswer 
										WHERE tanggal_pengisian_kuisioner BETWEEN '$tgl_awal' AND '$tgl_akhir' 
										group by companyId "));
										$sql = mysqli_query($hore,"SELECT * FROM tanswer
										left join tcompany on tcompany.companyId = tanswer.companyId
										WHERE tanggal_pengisian_kuisioner BETWEEN '$tgl_awal' AND '$tgl_akhir' 
										group by tanswer.companyId 
										order by Id asc");
										$no =1;
										while ($data = mysqli_fetch_array($sql)){
										// var_dump($tgl_awal,$tgl_akhir,$data['tanggal_pengisian_kuisioner']);
										$dateIndo = tgl_indo($data['tanggal_pengisian_kuisioner']);
										?>
										<tr><td><div id='kontentd'><?php echo $no;?></div></td>
										<td><div id='kontentd'><?php echo $data['companyName'] ?></div></td>
										<td><?php echo $dateIndo ?></td>
										<td><div id='kontentd'><a target='_blank' href='modul/mod_report/responden.php?act=detail&id=<?php echo $data[companyId];?>' >
										<button class='btn btn-sm btn-success'><span class=\"glyphicon glyphicon-zoom-in\"></span> Detail</button>
										</a>
										<?php if($_SESSION['level']=="Super"){?>
										<a href='modul/mod_report/responden.php?act=hapus&id=<?php echo $data[companyId]?>'>
										<button class='btn btn-sm btn-danger' onclick=\"return confirm('Hapus Deskripsi?')\"><span class=\"glyphicon glyphicon-trash\"></span> Hapus</button>
										</a><?php } ?>
										</div>
									   </td></tr>
											<?php
										$no++;
									}
									?>
									
							</table>
							<div class="col-md-12">
								<div class="well">
									<?php echo "Jumlah Responden : <font face='tahoma' size='3'><b>$jumlahdata </b> Responden</font>"; ?>
								</div>
							</div>
							<?php	
							}
							else
							{ ?>
							<div class="alert alert-info" role="alert">
 								 <strong>Menampilkan semua hasil survey</strong> 
							</div>
									<table id="tablekonten" class="table table-striped table-bordered">
						         <th><div id='kontentd'>No</div>
						         </th>
						         <th><div id='kontentd'>Nama Responden</div></th>
						         <th>Tanggal Isi Survey</th>
						         <th><div id='kontentd'>Aksi</div></th></tr>
									<?php
											include "../../koneksi.php";
											include "../../fungsi/fungsi_indotgl.php";
											error_reporting(1);
											
											
												$jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tanswer 
												group by companyId "));
												$p      = new PagingHasil;
												$batas  = 10;
												$posisi = $p->cariPosisi($batas);
												$sql = mysqli_query($hore,
													"SELECT * FROM tanswer  
													left join tcompany on tcompany.companyId = tanswer.companyId
													group by tanswer.companyId
													ORDER by id ASC LIMIT $posisi,$batas");
												$no = $posisi+1;
											while ($data = mysqli_fetch_array($sql)){
												$dateIndo = tgl_indo($data['dateSurvey']);
												?>
												<tr><td><div id='kontentd'><?php echo $no;?></div></td>
												 <td><div id='kontentd'><?php echo $data['companyName'] ?></div></td>
												 <td><?php echo $dateIndo ?></td>
												 <td><div id='kontentd'><a target='_blank' href='modul/mod_report/responden.php?act=detail&id=<?php echo $data[companyId];?>' >
												 <button class='btn btn-sm btn-success'><span class=\"glyphicon glyphicon-zoom-in\"></span> Detail</button></a>
												 <?php if($_SESSION['level']=="Super"){?><a href='modul/mod_report/responden.php?act=hapus&id=<?php echo $data[companyId]?>'>
												 <button class='btn btn-sm btn-danger' onclick=\"return confirm('Hapus Deskripsi?')\"><span class=\"glyphicon glyphicon-trash\"></span> Hapus</button></a><?php } ?>
												 </div>
											   		</td>
											   </tr>
													<?php
												$no++;
											}
											?>
									</table>
									<div class="col-md-12">
										<div class="well">
											<?php echo "Jumlah Responden : <font face='tahoma' size='3'><b>$jumlahdata </b> Responden</font>"; ?>
										</div>
									</div>
							<?php

								$jmldata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tcompany "));
								$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
								$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
							
								echo "<ul class='pagination'>$linkHalaman</ul> ";
							
							}
						?>
				</div>
			</div>
 <?php 
 } ?>
 <?php if ($_GET['sub']=='laporan_rekan_all')
 { ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-title">
						<b>Laporan Rekan</b>
					</div>
				</div>
				
				<div class="panel-body">
					<div class="row">
						<div class="col-md-5">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="panel-title"> Tampilkan Berdasarkan Rekanan</div>
								</div>
								<div class="panel-body">
									<form action="?module=hasil&sub=laporan&tampilkan=perrekan" method="post" class="form-horizontal">
									<?php //include "../fungsi/fungsi_combobox.php"; include "../fungsi/library.php";?>
										<div class="form-group">
											<label for="tanggal1" class="control-label col-sm-4">Rekan</label>
											<div class="col-sm-7">
												<select name="perrekan" id="perrekan" class="form-control">
													<option value="">--pilih--</option>
													<?php
													$data = mysqli_query($hore,"SELECT * FROM trekan");
													var_dump($data);
													while($rdata = mysqli_fetch_array($data)) { 
													?>
														<option class="form-control" value="<?php echo $rdata[id] ?>"><?php echo $rdata['nama'] ?></option>
													<?php } ?>
												</select>
					 						</div>
										</div>
						 				<div class="col-sm-4">
						 				<input type="hidden" name="perrekan" value="perrekan">
						 				</div>
						 				<div class="col-sm-4">
						 					<a href="master.php?module=hasil&sub=laporan_rekan_all" class="btn btn-primary">Reset</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<?php if($_GET['tampilkan']=='pertanggal'){ 
							$tgl_awal= $_POST['thn_mulai']."-".$_POST['bln_mulai']."-".$_POST['tgl_mulai'];
							$tgl_akhir= $_POST['thn_selesai']."-".$_POST['bln_selesai']."-".$_POST['tgl_selesai'];
							$awalindo=tgl_indo($tgl_awal);
							$akhirindo=tgl_indo($tgl_akhir);

						?>
							<div class="alert alert-info" role="alert">
 								 Menampilkan data dari tanggal <b><?php echo $awalindo." Sampai dengan ".$akhirindo ?><b/> 
							</div>
							<table id="tablekonten" class="table table-striped table-bordered">
						         <th><div id='kontentd'>No</div>
						         </th>
						         <th><div id='kontentd'>Nama Responden</div></th>
						         <th>Tanggal Isi Survey</th>
						         <th><div id='kontentd'>Aksi</div></th></tr>
									<?php
									include "../../koneksi.php";
									include "../../fungsi/fungsi_indotgl.php";
									error_reporting(1);
										$jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tanswer 
										WHERE tanggal_pengisian_kuisioner BETWEEN '$tgl_awal' AND '$tgl_akhir' 
										group by companyId "));
										$sql = mysqli_query($hore,"SELECT * FROM tanswer
										left join tcompany on tcompany.companyId = tanswer.companyId
										WHERE tanggal_pengisian_kuisioner BETWEEN '$tgl_awal' AND '$tgl_akhir' 
										group by tanswer.companyId 
										order by Id asc");
										$no =1;
										while ($data = mysqli_fetch_array($sql)){
										// var_dump($tgl_awal,$tgl_akhir,$data['tanggal_pengisian_kuisioner']);
										$dateIndo = tgl_indo($data['tanggal_pengisian_kuisioner']);
										?>
										<tr><td><div id='kontentd'><?php echo $no;?></div></td>
										<td><div id='kontentd'><?php echo $data['companyName'] ?></div></td>
										<td><?php echo $dateIndo ?></td>
										<td><div id='kontentd'><a target='_blank' href='modul/mod_report/responden.php?act=detail&id=<?php echo $data[companyId];?>' >
										<button class='btn btn-sm btn-success'><span class=\"glyphicon glyphicon-zoom-in\"></span> Detail</button>
										</a>
										<?php if($_SESSION['level']=="Super"){?>
										<a href='modul/mod_report/responden.php?act=hapus&id=<?php echo $data[companyId]?>'>
										<button class='btn btn-sm btn-danger' onclick=\"return confirm('Hapus Deskripsi?')\"><span class=\"glyphicon glyphicon-trash\"></span> Hapus</button>
										</a><?php } ?>
										</div>
									   </td></tr>
											<?php
										$no++;
									}
									?>
									
							</table>
							<div class="col-md-12">
								<div class="well">
									<?php echo "Jumlah Responden : <font face='tahoma' size='3'><b>$jumlahdata </b> Responden</font>"; ?>
								</div>
							</div>
							<?php	
							}
							else
							{ ?>
							<div class="alert alert-info" role="alert">
 								 <strong>Menampilkan semua hasil survey</strong> 
							</div>
								 <?php if (!isset($_GET['perrekan'])) {  ?>
								<table id="tablekonten" class="table table-striped table-bordered">
						         <th><div id='kontentd'>Ranking</div>
						         </th>
						         <th><div id='kontentd'>Nama Responden</div></th>
						         <th>Rata Gap</th>
						         <th><div id='kontentd'>Aksi</div></th></tr>
									<?php
										include "../../koneksi.php";
										include "../../fungsi/fungsi_indotgl.php";
										error_reporting(1);
											$p      = new PagingHasil;
											$batas  = 10;
											$posisi = $p->cariPosisi($batas);
												$jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM kontrak_kerja
												left join tcompany on kontrak_kerja.id_tcompany = tcompany.companyId
												left join trekan on kontrak_kerja.id_rekan = trekan.id
												group by kontrak_kerja.id_rekan"));
												$sql = mysqli_query($hore,
												"SELECT *,avg(gap) as gp FROM kontrak_kerja
												left join tcompany on kontrak_kerja.id_tcompany = tcompany.companyId
												left join trekan on kontrak_kerja.id_rekan = trekan.id
												left join dimensi_rekan on dimensi_rekan.id_rekan = kontrak_kerja.id_rekan
												group by kontrak_kerja.id_rekan
												ORDER by gp DESC LIMIT $posisi,$batas");	
											
											$no = $posisi+1;
											while ($data = mysqli_fetch_array($sql)){
											$dateIndo = tgl_indo($data['dateSurvey']);
											?>
											<tr>
												<td><div id='kontentd'><?php echo $no;?></div></td>
												<td><div id='kontentd'><?php echo $data['nama'] ?></div></td>
												<td><div id='kontentd'><?php echo $data['gp'];?></div></td>
												<!-- <td><?php echo $dateIndo ?></td> -->
												<td>
												<!-- <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Klik</a> -->
												<div id='kontentd'><a href='?module=hasil&sub=laporan_rekan_all&perrekan=<?php echo $data['id_rekan'];?>' >
												<button class='btn btn-sm btn-success'><span class=\"glyphicon glyphicon-zoom-in\"></span> Detail</button></a>
												<?php if($_SESSION['level']=="Super"){?><a href='modul/mod_report/responden.php?act=hapus&id=<?php echo $data[companyId]?>'>
												<button class='btn btn-sm btn-danger' onclick=\"return confirm('Hapus Deskripsi?')\"><span class=\"glyphicon glyphicon-trash\"></span> Hapus</button></a><?php } ?>
												</div>
												</td>
											</tr>
												<?php
											$no++;
										}
										?>
									</table>
									<div class="col-md-12">
										<div class="well">
											<?php echo "Jumlah Rekanan : <font face='tahoma' size='3'><b>$jumlahdata </b> Rekanan</font>"; ?>
										</div>
									</div>
									<?php }else{?>
											<table id="tablekonten" class="table table-striped table-bordered">
											<th><div id='kontentd'>No</div>
											</th>
											<th><div id='kontentd'>Kriteria</div></th>
											<th>Penilaian</th>
											<th><div id='kontentd'>Keterangan</div></th>
											<!-- <th><div id='kontentd'>Aksi</div></th></tr> -->
											<?php
											include "../../koneksi.php";
											include "../../fungsi/fungsi_indotgl.php";
											error_reporting(1);
											// $jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM kontrak_kerja where id_rekan ='$rowquer[id]' "));
											$p      = new PagingHasil;
											$batas  = 10;
											$posisi = $p->cariPosisi($batas);
											$jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT *FROM tanswer 
											left join kontrak_kerja on tanswer.id_kontrak = kontrak_kerja.id_kontrak
											where id_rekan ='$_GET[perrekan]'
											group by companyId "));
											$sql = mysqli_query($hore,
											"SELECT * FROM tdescription  
											left join kriteria_kenyataan_rekan on kriteria_kenyataan_rekan.descriptionId = tdescription.descriptionId
											left join kriteria_rekan on kriteria_rekan.id_kriteria_kenyataan = kriteria_kenyataan_rekan.id
											where kriteria_rekan.id_rekan ='$_GET[perrekan]'
											ORDER by gap DESC LIMIT $posisi,$batas");
											$no = $posisi+1;
											while ($data = mysqli_fetch_array($sql)){
											?>
												<tr>
													<td><div id='kontentd'><?php echo $no;?></div></td>
													<td><div id='kontentd'><?php echo $data['description'] ?></div></td>
													<td><div id='kontentd'><?php echo $data['gap'];?></div></td>
													<td><div id='kontentd'><?php echo $data['keterangan'];?></div></td>
													
												</tr>
													<?php
												$no++;
											}
											?>
										</table>
										<table id="tablekonten" class="table table-striped table-bordered">
						<th><div id='kontentd'>No</div>
						</th>
						<th><div id='kontentd'>Dimensi</div></th>
						<th>Penilaian</th>
						<th><div id='kontentd'>Keterangan</div></th>
						<!-- <th><div id='kontentd'>Aksi</div></th></tr> -->
						<?php
						include "../../koneksi.php";
						include "../../fungsi/fungsi_indotgl.php";
						error_reporting(1);
						// $jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM kontrak_kerja where id_rekan ='$rowquer[id]' "));
						// $jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tgroup"));
							$p      = new PagingHasil;
							$batas  = 10;
							$posisi = $p->cariPosisi($batas);
							$sql = mysqli_query($hore,
								"SELECT * FROM tgroup  
								left join dimensi_kenyataan_rekan on dimensi_kenyataan_rekan.groupId = tgroup.groupId
								left join dimensi_rekan on dimensi_rekan.id_dimensi_kenyataan = dimensi_kenyataan_rekan.id
								where dimensi_rekan.id_rekan ='$_GET[perrekan]'
								ORDER by gap DESC LIMIT $posisi,$batas");
						// var_dump($sql);
							$no = $posisi+1;
						while ($data = mysqli_fetch_array($sql)){
							$dateIndo = tgl_indo($data['dateSurvey']);
							?>
							<tr><td><div id='kontentd'><?php echo $no;?></div></td>
								<td><div id='kontentd'><?php echo $data['groupName'] ?></div></td>
								<td><div id='kontentd'><?php echo $data['gap'] ?></div></td>
								<td><div id='kontentd'><?php echo $data['keterangan'] ?></div></td>
							</tr>
								<?php
							$no++;
						}
						?>
						</table>		
									<div class="col-md-12">
										<div class="well">
											<?php echo "Jumlah Responden : <font face='tahoma' size='3'><b>$jumlahdata </b> Responden</font>"; ?>
										</div>
									</div>
									<?php }
									?>
							<?php

								$jmldata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tcompany "));
								$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
								$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
							
								echo "<ul class='pagination'>$linkHalaman</ul> ";
							
							}
						?>
				</div>
			</div>
 <?php 
 } ?>
 <?php if ($_GET['sub']=='laporan_rekan')
 { ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-title">
						<b>Laporan Rekan</b>
					</div>
				</div>
				<div class="panel-body">
					<table id="tablekonten" class="table table-striped table-bordered">
						<th><div id='kontentd'>No</div>
						</th>
						<th><div id='kontentd'>Kriteria</div></th>
						<th>Penilaian</th>
						<th><div id='kontentd'>Keterangan</div></th>
						<!-- <th><div id='kontentd'>Aksi</div></th></tr> -->
						<?php
						include "../../koneksi.php";
						include "../../fungsi/fungsi_indotgl.php";
						error_reporting(1);
						// $jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM kontrak_kerja where id_rekan ='$rowquer[id]' "));
						$p      = new PagingHasil;
						$batas  = 10;
						$posisi = $p->cariPosisi($batas);
						$ques = mysqli_query($hore, "SELECT * FROM trekan where nama = '$_SESSION[fullname]'");
						$rowques = mysqli_fetch_array($ques);
						$jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tanswer
						left join kontrak_kerja on kontrak_kerja.id_kontrak = tanswer.id_kontrak
						where kontrak_kerja.id_rekan = '$rowques[id]'
						group by companyId"));
							$sql = mysqli_query($hore,
								"SELECT * FROM tdescription  
								left join kriteria_kenyataan_rekan on kriteria_kenyataan_rekan.descriptionId = tdescription.descriptionId
								left join kriteria_rekan on kriteria_rekan.id_kriteria_kenyataan = kriteria_kenyataan_rekan.id
								where kriteria_rekan.id_rekan ='$rowques[id]'
								ORDER by gap DESC LIMIT $posisi,$batas");
						// var_dump($sql);
							$no = $posisi+1;
						while ($data = mysqli_fetch_array($sql)){
							$dateIndo = tgl_indo($data['dateSurvey']);
							?>
							<tr><td><div id='kontentd'><?php echo $no;?></div></td>
								<td><div id='kontentd'><?php echo $data['description'] ?></div></td>
								<td><div id='kontentd'><?php echo $data['gap'] ?></div></td>
								<td><div id='kontentd'><?php echo $data['keterangan'] ?></div></td>
							</tr>
								<?php
							$no++;
						}
						?>
						</table>

						<table id="tablekonten" class="table table-striped table-bordered">
						<th><div id='kontentd'>No</div>
						</th>
						<th><div id='kontentd'>Dimensi</div></th>
						<th>Penilaian</th>
						<th><div id='kontentd'>Keterangan</div></th>
						<!-- <th><div id='kontentd'>Aksi</div></th></tr> -->
						<?php
						include "../../koneksi.php";
						include "../../fungsi/fungsi_indotgl.php";
						error_reporting(1);
						// $jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM kontrak_kerja where id_rekan ='$rowquer[id]' "));
						// $jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tgroup"));
							$p      = new PagingHasil;
							$batas  = 10;
							$posisi = $p->cariPosisi($batas);
							$ques = mysqli_query($hore, "SELECT * FROM trekan where nama = '$_SESSION[fullname]'");
							$rowques = mysqli_fetch_array($ques);
							$sql = mysqli_query($hore,
								"SELECT * FROM tgroup  
								left join dimensi_kenyataan_rekan on dimensi_kenyataan_rekan.groupId = tgroup.groupId
								left join dimensi_rekan on dimensi_rekan.id_dimensi_kenyataan = dimensi_kenyataan_rekan.id
								where dimensi_rekan.id_rekan ='$rowques[id]'
								ORDER by gap DESC LIMIT $posisi,$batas");
						// var_dump($sql);
							$no = $posisi+1;
						while ($data = mysqli_fetch_array($sql)){
							$dateIndo = tgl_indo($data['dateSurvey']);
							?>
							<tr><td><div id='kontentd'><?php echo $no;?></div></td>
								<td><div id='kontentd'><?php echo $data['groupName'] ?></div></td>
								<td><div id='kontentd'><?php echo $data['gap'] ?></div></td>
								<td><div id='kontentd'><?php echo $data['keterangan'] ?></div></td>
							</tr>
								<?php
							$no++;
						}
						?>
						</table>

						<div class="col-md-12">
							<div class="well">
								<?php echo "Jumlah Responden : <font face='tahoma' size='3'><b>$jumlahdata </b> Responden</font>"; ?>
							</div>
						</div>
							<?php
								$jmldata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tcompany "));
								$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
								$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
								echo "<ul class='pagination'>$linkHalaman</ul> ";
							
						?>
				</div>
			</div>
 <?php 
 } ?>
<?php if ($_GET['sub']=='laporan_rekan_all_2')
 { ?>	
			
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-title">
						<b>Laporan Rekan</b>
						<!-- <button style="margin-left:710px;"  class='btn btn-sm btn-success' 
						value='Print All to Excel' onclick=location.href='modul/mod_report/all_responden.php'>
						<span class="glyphicon glyphicon-zoom-in"></span> Rekap Semua Kuisioner</button> -->
					</div>
				</div>
				
				<div class="panel-body">
					<table id="tablekonten" class="table table-striped table-bordered">
						<th><div id='kontentd'>No</div>
						</th>
						<th><div id='kontentd'>Dimensi</div></th>
						<th>Penilaian</th>
						<th><div id='kontentd'>Keterangan</div></th>
						<!-- <th><div id='kontentd'>Aksi</div></th></tr> -->
						<?php
						include "../../koneksi.php";
						include "../../fungsi/fungsi_indotgl.php";
						error_reporting(1);
						// $jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM kontrak_kerja where id_rekan ='$rowquer[id]' "));
						$jumlahdata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tgroup"));
							$p      = new PagingHasil;
							$batas  = 10;
							$posisi = $p->cariPosisi($batas);
							$ques = mysqli_query($hore, "SELECT * FROM trekan where nama = '$_SESSION[fullname]'");
							$rowques = mysqli_fetch_array($ques);
							$sql = mysqli_query($hore,
								"SELECT * FROM tgroup  
								left join dimensi_kenyataan_rekan on dimensi_kenyataan_rekan.groupId = tgroup.groupId
								left join dimensi_rekan on dimensi_rekan.id_dimensi_kenyataan = dimensi_kenyataan_rekan.id
								where dimensi_rekan.id_rekan ='$rowques[id]'
								ORDER by gap DESC LIMIT $posisi,$batas");
						// var_dump($sql);
							$no = $posisi+1;
						while ($data = mysqli_fetch_array($sql)){
							$dateIndo = tgl_indo($data['dateSurvey']);
							?>
							<tr><td><div id='kontentd'><?php echo $no;?></div></td>
								<td><div id='kontentd'><?php echo $data['groupName'] ?></div></td>
								<td><div id='kontentd'><?php echo $data['gap'] ?></div></td>
								<td><div id='kontentd'><?php echo $data['keterangan'] ?></div></td>
								<!-- <td><div id='kontentd'><a target='_blank' href='modul/mod_report/responden.php?act=detail&id=<?php echo $data[companyId];?>' >
								<button class='btn btn-sm btn-success'><span class=\"glyphicon glyphicon-zoom-in\"></span> Detail</button></a>
								<?php if($_SESSION['level']=="Super"){?><a href='modul/mod_report/responden.php?act=hapus&id=<?php echo $data[companyId]?>'>
								<button class='btn btn-sm btn-danger' onclick=\"return confirm('Hapus Deskripsi?')\"><span class=\"glyphicon glyphicon-trash\"></span> Hapus</button></a><?php } ?>
								</div>
								</td> -->
							</tr>
								<?php
							$no++;
						}
						?>
						</table>
						<div class="col-md-12">
							<div class="well">
								<?php echo "Jumlah Responden : <font face='tahoma' size='3'><b>$jumlahdata </b> Responden</font>"; ?>
							</div>
						</div>
							<?php
								$jmldata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tcompany "));
								$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
								$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
								echo "<ul class='pagination'>$linkHalaman</ul> ";
							
						?>
				</div>
			</div>
 <?php 
 } ?> 
<?php if ($_GET['sub']=='laporan_kriteria')
 { ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-title">
						<b>Laporan Per Kriteria</b>
						<!-- <button style="margin-left:650px;"  class='btn btn-sm btn-success' value='Print All to Excel' onclick=location.href='modul/mod_report/all_responden.php'><span class="glyphicon glyphicon-zoom-in"></span> Rekap Semua Data</button> -->
					</div>
				</div>
				
				<div class="panel-body">
								<table id="tablekonten" class="table table-striped table-bordered">
						         <th><div id='kontentd'>No</div>
						         </th>
						         <th><div id='kontentd'>Kriteria Pernyataan</div></th>
						         <th><div id='kontentd'>Dimensi</div></th>
						         <th><div id='kontentd'>Nilai Gap 5</div></th>
						         <th><div id='kontentd'>Keterangan</div></th>
									<?php
											include "../../koneksi.php";
											include "../../fungsi/fungsi_indotgl.php";
											error_reporting(1);
												$sql = mysqli_query($hore,"SELECT * FROM tdescription 
												left join tgroup on tgroup.groupId = tdescription.groupId
												left join kriteria_harapan on kriteria_harapan.descriptionId = tdescription.descriptionId
												left join kriteria on kriteria_harapan.id = kriteria.id_kriteria_harapan order by kriteria.gap asc");
												$no = $posisi+1;
												$jumlahdata = mysqli_num_rows($sql);
											while ($data = mysqli_fetch_array($sql)){
												$dateIndo = tgl_indo($data['dateSurvey']);
												?>
												<tr>
													<td><?php echo $no;?></div></td>
													<td><?php echo $data['description'] ?></div></td>
													<td><?php echo $data['groupName'] ?></td>
													<td><?php echo round($data['gap'],3); ?></td>
													<td><?php echo $data['keterangan']; ?></td>
											   </tr>
													<?php
												$no++;
											}
											?>
									</table>
									<div class="col-md-12">
										<div class="well">
											<?php echo "Jumlah Kriteria Pernyataan : <font face='tahoma' size='3'><b>$jumlahdata </b> Kriteria</font>"; ?>
										</div>
									</div>
							<?php
						?>
						<div style="width: 1000px;margin: 0px auto;">
						    <h2>Grafik Per Kriteria</h2>
						    <canvas id="myChart"></canvas>     
					    </div>
				</div>
			</div>
 <?php 
 } ?>
<?php if ($_GET['sub']=='laporan_dimensi')
 { ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="panel-title">
						<b>Laporan Per Dimensi</b>
						<!-- <button style="margin-left:650px;"  class='btn btn-sm btn-success' value='Print All to Excel' onclick=location.href='modul/mod_report/all_responden.php'><span class="glyphicon glyphicon-zoom-in"></span> Rekap Semua Data</button> -->
					</div>
				</div>
				
				<div class="panel-body">
								<table id="tablekonten" class="table table-striped table-bordered">
						         <th><div id='kontentd'>No</div>
						         </th>
						         <th><div id='kontentd'>Dimensi</div></th>
						         <th><div id='kontentd'>Nilai Gap 5</div></th>
						         <th><div id='kontentd'>Keterangan</div></th>
									<?php
											include "../../koneksi.php";
											include "../../fungsi/fungsi_indotgl.php";
											error_reporting(1);
												$sql = mysqli_query($hore,"SELECT * FROM tgroup 
												left join dimensi_harapan on dimensi_harapan.groupId = tgroup.groupId
												left join dimensi on dimensi_harapan.id = dimensi.id_dimensi_harapan order by dimensi.gap asc");
												$no = $posisi+1;
												$jumlahdata = mysqli_num_rows($sql);
											while ($data = mysqli_fetch_array($sql)){
												$dateIndo = tgl_indo($data['dateSurvey']);
												?>
												<tr>
													<td><?php echo $no;?></div></td>
													<td><?php echo $data['groupName'] ?></td>
													<td><?php echo round($data['gap'],3); ?></td>
													<td><?php echo $data['keterangan']; ?></td>
											   </tr>
													<?php
												$no++;
											}
											?>
									</table>
									<div class="col-md-12">
										<div class="well">
											<?php echo "Jumlah Kriteria Pernyataan : <font face='tahoma' size='3'><b>$jumlahdata </b> Kriteria</font>"; ?>
										</div>
									</div>
							<?php
						?>
						<div style="width: 1000px;margin: 0px auto;">
						    <h2>Grafik Gap 5 Per Dimensi</h2>
						    <canvas id="myChartDimensi"></canvas>     
					    </div>
				</div>
			</div>
 <?php 
 } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- CHART LINE KRITERIA -->
<?php
$kriteria_chart = mysqli_query($hore,"SELECT * FROM tdescription 
	left join kriteria_harapan on kriteria_harapan.descriptionId = tdescription.descriptionId
	left join kriteria on kriteria_harapan.id = kriteria.id_kriteria_harapan
	order by kriteria.gap asc");
	while($row = mysqli_fetch_array($kriteria_chart)){
    $status[] = $row['description'];
    // $query = mysqli_query($db,"select sum(jumlah_pesanan) as jumlah from pesanans where id_produk='".$row['id_produk']."' group by id_produk");
    // $row = $query->fetch_array();
    $jumlah_status[] = $row['gap'];
}
?> 
<script type="text/javascript" src="../chartjs/Chart.js"></script>
<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($status); ?>,
            datasets: [{
                label: 'Grafik Informasi Gap 5 Per Kriteria',
                data: <?php echo json_encode($jumlah_status); ?>,
                backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
					],
                borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>	

<?php
$dimensi_chart = mysqli_query($hore,"SELECT * FROM tgroup 
	left join dimensi_harapan on dimensi_harapan.groupId = tgroup.groupId
	left join dimensi on dimensi_harapan.id = dimensi.id_dimensi_harapan
	order by dimensi.gap asc");
	while($row = mysqli_fetch_array($dimensi_chart)){
    $status_dimensi[] = $row['groupName'];
    // $query = mysqli_query($db,"select sum(jumlah_pesanan) as jumlah from pesanans where id_produk='".$row['id_produk']."' group by id_produk");
    // $row = $query->fetch_array();
    $jumlah_status_dimensi[] = $row['gap'];
}
?> 
<script type="text/javascript" src="../chartjs/Chart.js"></script>
<script>
    var ctx = document.getElementById("myChartDimensi").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($status_dimensi); ?>,
            datasets: [{
                label: 'Grafik Informasi Gap 5 Per Dimensi',
                data: <?php echo json_encode($jumlah_status_dimensi); ?>,
                backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
					],
                borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>	
<?php
$sql = mysqli_fetch_array(mysqli_query($hore,"SELECT SUM(jawabanA) As TotalA,
SUM(jawabanB) As TotalB,
SUM(jawabanC) As TotalC,
SUM(jawabanD) As TotalD,
SUM(jawabanE) As TotalE
FROM tanswer "));
?> 
<script type="text/javascript" src="../chartjs/Chart.js"></script>
<script>
    var ctx = document.getElementById("myChart2").getContext('2d');
    var myChart2 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Sangat Baik","Baik","Cukup","Buruk","Sangat Buruk"],
            datasets: [{
                label: 'Grafik Pengisian Keselurahan Kuisioner',
                data: [<?php echo '"'.$sql[TotalA].'","'.$sql[TotalB].'","'.$sql[TotalC].'","'.$sql[TotalD].'","'.$sql[TotalE].'",'; ?>],
                backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
					],
                borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>	