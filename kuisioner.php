<?php include('header.php') ?>
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('home/images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">Kuisioner</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Kuisioner <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>
    <div class="container">
    <div class="panel panel-default" >
          <div class="panel-body" style="background-color:white;">
            <center>  
              <div class="row">
                  <center>
                  <div class="col-md-12">
                  <div class="panel-body">
                      <form method='POST' action='aksi_kuosioner.php' onSubmit=\"return validasisurvey(this)\" >
                          <script language="javascript">
                              function validasisurvey(form){
                                  if (form.companyName.value == ""){
                                      alert("Anda belum mengisikan nama Anda.");
                                      form.companyName.focus();
                                      return (false);
                                  }
                                  if (form.companyAddress1.value == ""){
                                      alert("Anda belum mengisikan alamat Anda.");
                                      form.companyAddress1.focus();
                                      return (false);
                                  }
                              }
                          </script>
                          <table class="table"> 
                              <tr >
                                  <td>
                                      <div class="form-horizontal"  style="margin-top:20px;background-color:#fff;padding-top:20px;padding-bottom:20px;">
                                          <div class="page-header" style="margin-left:30px;">
                                            <h3><center>Informasi Pelanggan</h3>
                                          </div>
                                          <div class="form-group">
                                             <label for="nama_pelanggan" class="control-label col-sm-3">Nama Pelanggan</label>
                                             <div class="col-sm-6">
                                                 <div class="input-group">
                                                     <div class="input-group-addon">
                                                         <span class="glyphicon glyphicon-user"></span>
                                                     </div>
                                                     <input type="text" id="nama_pelanggan" class="form-control" name="companyName" placeholder="Nama Pelanggan">
                                                 </div>
                                             </div>
                                          </div>
                                        
                                          <div class="form-group">
                                             <label for="alamat_pelanggan" class="control-label col-sm-2">Alamat</label>
                                             <div class="col-sm-6">
                                                 <div class="input-group">
                                                     <div class="input-group-addon">
                                                         <span class="glyphicon glyphicon-bookmark"></span>
                                                     </div>
                                                     <input type="text" id="alamat_pelanggan" class="form-control" name="companyAddress1" placeholder="Alamat">
                                                 </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                          
                                             <label for="produk" class="control-label col-sm-2">Jasa Layanan</label>
                                             <div class="col-sm-6">
                                                 <div class="input-group">
                                                     <div class="input-group-addon">
                                                         <span class="glyphicon glyphicon-tags"></span>
                                                     </div>
                                                     <select name="companyProduct" id="produk" class="form-control">
                                                         <option value="">-- pilih --</option>
                                                         <option value="Jasa Penyusunan Pembukuan">Jasa Penyusunan Pembukuan</option>
                                                         <option value="Jasa Kompilasi Laporan Keuangan">Jasa Kompilasi Laporan Keuangan</option>
                                                         <option value="Jasa Review Laporan Keuangan">Jasa Review Laporan Keuangan</option>
                                                         <option value="Jasa Audit Khusus">Jasa Audit Khusus</option>
                                                         <option value="Jasa Audit Laporan Keuangan">Jasa Audit Laporan Keuangan</option>
                                                     </select>
                                                 </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="hp" class="control-label col-sm-2">Telepon</label>
                                             <div class="col-sm-6">
                                                 <div class="input-group">
                                                     <div class="input-group-addon">
                                                         <span class="glyphicon glyphicon-phone"></span>
                                                     </div>
                                                     <input type="text" id="hp" class="form-control" name="companyHp" placeholder="No Handphone">
                                                 </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <label for="tgl" class="control-label col-sm-2">Tanggal</label>
                                             <div class="col-sm-6">
                                                 <div class="input-group">
                                                     <div class="input-group-addon">
                                                         <span class="glyphicon glyphicon-calender"></span>
                                                     </div>
                                                     <?php
                                                          include "fungsi/fungsi_indotgl.php";
                                                          $tanggal = date('Y-m-d');
                                                          $tglFinal = tgl_indo($tanggal);
                                                          ?>
                                                     <input type="text" id="tgl" class="form-control" disabled="" name="companyName" value="<?php echo $tglFinal; ?>">
                                                 </div>
                                             </div>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td width="97%" valign="top" align="center" colspan="5" style="border-style: none; border-width: medium">
                                  <font face="Arial" size="1"><b>Mohon kesediaan Anda untuk memberikan 
                                  penilaian dan masukan kepada KAP-AAFA, dimana hal ini sangat bermanfaat 
                                  untuk meningkatkan kualitas layanan kami.<br>
                                  </b><i>Silahkan diisi dengan mengklik pilihan sesuai dengan penilaian Anda 
                                  pada kolom yang telah disediakan</i></font>
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan="9">
                                      <table class="table table-striped table-bordered" >
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
                                                              <td colspan='1'>$r[groupId].$i</td>
                                                             
                                                              <td colspan='2'><font face='Tahoma' size='2'> $r[description]</font></td>
                                                              <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='A'> </td>
                                                              <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='B'> </td>
                                                              <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='C'> </td>
                                                              <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='D'> </td>
                                                              <td align='center'> <input type='radio' name='asfa$i$data[groupId]' value='E'> </td>
                                                              <input type='hidden' value='A' name='asf$i$data[groupId]'>
                                                              

                                                              </tr>";
                                                      $i++;
                                                  }
                                                  echo "<br>";
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
           </div>
        </div>
                                            </div>
    </div>
		
<?php include('footer.php') ?>