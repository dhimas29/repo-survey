<?php
$aksi = "modul/mod_kuisioner/aksi_kuisioner.php";
switch($_GET[act]){
	// Tampil Group
	default:

	?>
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Kuisioner
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=kuisioner">Kuisioner</a>
	            </li>
	        </ol>
	    </div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">

			<div class="panel-title"><span class="glyphicon glyphicon-list"></span> Kuisioner <i style="margin-left:700px;"><?php if($_SESSION['level']=="Super"){?><button class="btn btn-success btn-sm " onclick="window.location.href='?module=group&act=tambahgroup'"><span class="glyphicon glyphicon-plus"></span> Tambah Dimensi</button></i><?php } ?></div>
		</div>
		<div class="panel-body">
			<table id="tablekonten" class="table table-striped table-bordered table-responsive" style="">
				<thead>
					<th width="1%"><div id="konten">No</div></th>
					<th width="10%"><div id="konten">Layanan/Jasa</div></th>
					<th width="10%"><div id="konten">Pengisian Kuisioner</div></th>
					<th width="10%"><div id="konten">Aksi</div></th>
				</thead>
				<tbody>
					<?php 
					
						$p      = new PagingKuis();
						$batas  = 10;
                        $posisi = $p->cariPosisi($batas);
                        $quer = mysqli_query($hore, "SELECT * FROM tcompany 
                        left join kontrak_kerja on tcompany.companyId = kontrak_kerja.id_tcompany
                        left join tanswer on kontrak_kerja.id_kontrak = tanswer.id_kontrak
                        where tcompany.companyName = '$_SESSION[fullname]'");
				        $rowquer = mysqli_fetch_array($quer);

                        $kontrak = mysqli_query($hore, "SELECT * FROM tanswer 
                        where tanswer.companyId = '$rowquer[companyId]'
                        group by companyId");
                        
                        while ($rkon = mysqli_fetch_array($kontrak)) {
					    $tampil = mysqli_query($hore,"SELECT *,tcompany_layanan.id_layanan as id_lay 
                        FROM tcompany_layanan
                        left join layanan on layanan.id = tcompany_layanan.id_layanan
                        left join tanswer on tanswer.id_layanan = tcompany_layanan.id_layanan
                        left join kontrak_kerja on kontrak_kerja.id_kontrak = tanswer.id_kontrak
                        left join tcompany on tcompany.companyId = tcompany_layanan.companyId
                        where tcompany_layanan.companyId = '$rowquer[companyId]'
                        group by tcompany_layanan.id_layanan
                        limit $posisi,$batas");
					    $no =$posisi+1;
						while ($data = mysqli_fetch_array($tampil)){
							?>
							<tr>
								<td><div id="kontentd"><?php echo $no; ?></div></td>
								<!-- <td><div id="kontentd"><?php echo $data['groupId'];?></div></td> -->
								<td><div id="kontentd"><?php echo $data['nama_layanan'];?></div></td>
								<!-- <td><div id="kontentd"><?php echo $data['tanggal_kontrak'];?></div></td> -->
                                <?php
                                $qk = mysqli_fetch_array(mysqli_query($hore,"SELECT * FROM tanswer
                                where companyId = '$data[companyId]'
                                and id_kontrak ='$data[id_kontrak]'
                                and id_layanan ='$data[id_layanan]'"));
                                    if ($qk['tanggal_pengisian_kuisioner'] == '') {
                                        $tgl = 'Belum Melakukan Pengisian Kuisioner';
                                    }else{
                                        $tgl = date('d F Y',strtotime($qk['tanggal_pengisian_kuisioner']));
                                    }
                                ?>
								<td><div id="kontentd"><?php echo $tgl;?></div></td>
                                <?php
                                $cek = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tanswer 
                                where companyId ='$data[companyId]' 
                                and id_layanan ='$data[id_layanan]'
                                and id_kontrak ='$data[id_kontrak]'"));
                                if ($cek > 0) {
                                    if($_SESSION['level']=="Klien"){?>
                                        <td>
                                            <div id="kontentd">
                                            <a href="?module=kuisioner&act=isikuisioner&id_layanan=<?php echo $data['id_lay'];?>">
                                            <button class="btn btn-success btn-sm" disabled><span class="glyphicon glyphicon-wrench">
                                            </span> Sudah Mengisi Kuisioner</button></a>
                                            </div>
                                        </td>
                                <?php } 
                                }else{
                                if($_SESSION['level']=="Klien"){?>
                                <td>
                                    <div id="kontentd">
                                    <a href="?module=kuisioner&act=isikuisioner&id_layanan=<?php echo $data['id_lay'];?>">
                                    <button class="btn btn-success btn-sm" ><span class="glyphicon glyphicon-wrench">
                                    </span> Isi Kuisioner</button></a>
                                    </div>
								</td>
                                <?php } 
                                }?>
							</tr>

							<?php
							$no++;
						}
                    }
						$jmldata = mysqli_num_rows(mysqli_query($hore,"SELECT * FROM tgroup"));
						$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
						$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

						
					?>
				</tbody>
			</table>
			
				<ul class="pagination">
					<?php echo "$linkHalaman"; ?>
				</ul>
			
			
		</div>
	</div>
    <?php
	break;
  
	// Form Tambah group
	case "isikuisioner":
	?>    
<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">
	            <i class="glyphicon glyphicon-user"></i> Kuisioner
	        </h1>
	        <ol class="breadcrumb">
	            <li class="active">
	                 <a href="master.php?module=kuisioner">Kuisioner</a> 
	            </li>
	        </ol>
	    </div>
	</div>
    <div class="row">
        <div class="col-md-12">
        <?php
            $sql = mysqli_query($hore,"SELECT * FROM tcompany_layanan
            left join kontrak_kerja on kontrak_kerja.id_tcompany = tcompany_layanan.companyId
            left join tcompany on tcompany.companyId = tcompany_layanan.companyId
            left join trekan on trekan.id = kontrak_kerja.id_rekan
            left join layanan on layanan.id = tcompany_layanan.id_layanan
            where tcompany.companyName = '$_SESSION[fullname]' and tcompany_layanan.id_layanan = '$_GET[id_layanan]'");
            $data = mysqli_fetch_array($sql);
        ?>
            <div class="form-group" style="margin-right:30px;">
                <label class="col-sm-2 control-label">Nama</label>
                <label for="">:</label>
                <label for=""><?php echo $data['companyName'] ?></label>
            </div>
            <div class="form-group" style="margin-right:30px;">
                <label class="col-sm-2 control-label">Alamat</label>
                <label for="">:</label>
                <label for=""><?php echo $data['companyAddress'] ?></label>
            </div>
            <div class="form-group" style="margin-right:30px;">
                <label class="col-sm-2 control-label">Layanan/Jasa</label>
                <label for="">:</label>
                <label for=""><?php echo $data['nama_layanan'] ?></label>
            </div>
            <div class="form-group" style="margin-right:30px;">
                <label class="col-sm-2 control-label">Nama Rekanan</label>
                <label for="">:</label>
                <label for=""><?php echo $data['nama'] ?></label>
            </div>
            <div class="form-group" style="margin-right:30px;">
                <label class="col-sm-2 control-label">Tanggal</label>
                <label for="">:</label>
                <label for=""><?php echo date('d F Y'); ?></label>
            </div>
        </div>
    </div>
	<div class="panel panel-primary">
    	<div class="panel-heading">
			<div class="panel-title"><span class="glyphicon glyphicon-list">
			</span> Isi Kuisioner <i style="margin-left:820px;"><button class="btn btn-success btn-sm " onclick="window.location.href='?module=home'">
			<span class="glyphicon glyphicon-arrow-left"></span> Kembali</button></i></div>
		</div>
		<div class="panel-body">
			<form method="POST" action="<?php echo $aksi;?>?module=kuisioner&act=input" onSubmit="return validasi(this)" class="form-horizontal" >
				<?php
				$quer = mysqli_query($hore, "SELECT * FROM tcompany where companyName = '$_SESSION[fullname]'");
				$rowquer = mysqli_fetch_array($quer);
				?>
				<input type="hidden" name="id_perus" value="<?= $rowquer[companyId] ?>">
				<input type="hidden" name="id_layan" value="<?= $_GET[id_layanan] ?>">
                
				<table class="table table-striped table-bordered">
                  <thead>
                      <th width='3%' ><b><font face='Tahoma' size='2'>No</font></b></th>
                      <th colspan='2'><p align='center'><b><font face='Tahoma' size='2'>DESKRIPSI</font></b></th>
                      <th colspan="5" bgcolor='#FFFF00'><p align='center'><font face='Tahoma' size='2'>Penilaian</font></th>
                        <!-- <th colspan="5" bgcolor='#FFFF00'><p align='center'><font face='Tahoma' size='2'>HARAPAN</font></th> -->
                  </thead>
                  <tbody>
                      <?php
                      include "koneksi.php";
                      error_reporting(0);
                      $no = 1;
                      $sql = mysqli_query($hore,"SELECT * FROM tgroup");
                      while($data = mysqli_fetch_array($sql)){
                          $id = $data[groupId];
                          echo "<tr valign='top'>
                                  <td><font face='Tahoma' size='2' colspan='1'><b> $no</b></font></td>
                                  <td colspan='2'><font face='Tahoma' size='2'><b>$data[groupName]</b></font></td>
                                  
                                  <td height='25' width='5%' bgcolor='#000000'><p align='center'><font face='Tahoma' size='1' color='white'>A<br>(Sangat Baik)</font></td>
                                  <td height='25' width='5%' bgcolor='#000000'><p align='center'><font face='Tahoma' size='1' color='white'>B<br>(Baik)</font></td>
                                  <td height='25' width='5%' bgcolor='#000000'><p align='center'><font face='Tahoma' size='1' color='white'>C<br>(Cukup)</font></td>
                                  <td height='25' width='5%' bgcolor='#000000'><p align='center'><font face='Tahoma' size='1' color='white'>D<br>(Buruk)</font></td>
                                  <td height='25' width='5%' bgcolor='#000000'><p align='center'><font face='Tahoma' size='1' color='white'>E<br>(Sangat Buruk)</font></td>
                              </tr>";
                              
                          $hasil = mysqli_query($hore,"SELECT * FROM tdescription, tgroup WHERE tdescription.groupId = '$id' AND tdescription.groupId = tgroup.groupId ORDER BY tgroup.groupId");
                          $i = 1;
                          while ($r = mysqli_fetch_array($hasil)){
                          
                              echo "<tr>
                                      <td colspan='1'><font face='Tahoma' size='2'>$no.$i</font></td>
                                     
                                      <td colspan='2'><font face='Tahoma' size='2'> $r[description]</font></td>
                                      <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='A'> </td>
                                      <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='B'> </td>
                                      <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='C'> </td>
                                      <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='D'> </td>
                                      <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='E'> </td>
                                      <input type='hidden' value='B' name='asf$i$data[groupId]'>
                                      

                                      </tr>";
                              $i++;
                          }
                          $no++;
                      }
                      ?>

                  </tbody>
              </table>
          </td>
          </tr>
          <tr>
              <td colspan="8">    
                      <div class="well">
                          <h4>Komentar / Saran...</h4>
                              <div class="form-group">
                                  <textarea name='suggestion' class="form-control" rows="3" placeholder="Tulis Komentar dan Saran..."></textarea>
                              </div>
                             
                      </div>
                  <hr>
              </td>
          </tr>
          <tr>
              <td colspan="8"> <center><button type="submit" class="btn btn-primary btn-lg">Submit</button></center> </td>
          </tr>
          <tr>
              <td width="97%" valign="top" align="center" colspan="5" style="border-style: none; border-width: medium">
              <center class="well">
              <font face="Arial" size="1"><b>Terima Kasih Atas Waktu dan Masukan yang anda berikan,Semua masukan yang anda berikan </b> </i></font>
              <font face="Arial" size="1"><b>akan kami terima sebagai sarana bagi kami untuk meningkatkan kulaitas pelanan kami</b>  </i></font>
              </center>
              </td>
          </tr>
      </table>
	</form>
</div>
</div>
<?php
    break;  
}