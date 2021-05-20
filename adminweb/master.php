
<?php
session_start();
error_reporting(1);

if (empty($_SESSION[username]) AND empty($_SESSION[password])){
    echo "
    <center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../index.php><b>LOGIN</b></a></center>";
}
else{
    
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Survey KAP AAFA</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
 
    <!-- <link href="../css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
</head>
<script>
function kosongkan()
{
   $("#validasi").empty();
   $("#validasi2").empty();
   $("#validasi3").empty(); 
}
function cekpasslama()
    {
        
        var pass_lama=$("#pass_lama").val();
        if(pass_lama=='')
        {
            $("#validasi").html("Password Tidak boleh kosong");
        }
        else
        {
            $.post('gantipass.php',{pass_lama:pass_lama,aksi:'cekpass'}, function(data) {
            if(data=="oke")
            {
                $("#validasi").html("Password Sesuai");    
            }
            else
            {
             $("#validasi").html("Password Tidak Sesuai");
                
            }
             });
             
        }
    }
function konfirmasi()
    {
        var stat2;
        var pass_baru = $("#pass_baru").val();
        var kon_pass_baru = $("#konpassbaru").val();
        if(kon_pass_baru==''||pass_baru=='')
        {
            $("#validasi3").html("password tidak boleh kosong");
            
            $("#validasi2").html("konfirmasi password tidak boleh kosong");
        }
        else
        {
            if(pass_baru!=kon_pass_baru)
        {
            $("#validasi2").html("Konfirmasi Password Baru tidak sesuai");
            var stat2='no'; 
        }
            else
            {
                $("#validasi2").html("Password Cocok");
                var stat2='oke';
                
            }
        }
        return stat2;
    }
function gantipass()
    {
       
        var stat=konfirmasi();
        if(stat=='oke')
        {
            var pass_lama=$("#pass_lama").val();
            var pass_baru =$("#pass_baru").val();
            $.post('gantipass.php',{pass_lama:pass_lama,aksi:'cekpass'}, function(data) {
                if(data=="oke")
                {
                    $.post('gantipass.php', {newpass:pass_baru,aksi:'gantipass'}, function(data) {
                        alert(data);
                      window.location.reload();
                    });
                }
                else
                {
                 $("#validasi").html("Password Tidak Sesuai");
                    alert("Password lama tidak sesuai dengan yang di database");
                }
            });
        }
        else
        {
            alert("Konfirmasi password tidak sesuai")
        }
    }
</script>
<body>
    <div class="modal fade" id="gantipass">
        <div class="modal-dialog">
            <div class="modal-content">
                <div  class="form-horizontal">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">&times;</button>
                        <div class="modal-title">
                            <h4>Ganti Password</h4>

                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="lama" class="col-sm-4 control-label">Password Lama</label>
                            <div class="col-sm-4">
                                <input type="password" name="pass_lama" id="pass_lama" class="form-control" onmouseout="cekpasslama()">
                            </div> 
                            <div class="col-sm-4" id="validasi">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lama" class="col-sm-4 control-label">Password Baru</label>
                            <div class="col-sm-4">
                                <input type="password" name="pass_baru" class="form-control" id="pass_baru" onmouseout="konfirmasi()">
                            </div>
                            <div class="col-sm-4" id="validasi3">
                                
                            </div>
                            
                        </div>
                        <div class="form-group">
                             <label for="lama" class="col-sm-4 control-label">Konfirmasi Pass Baru</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control"  id="konpassbaru" onmouseout="konfirmasi()">
                            </div>
                            <div class="col-sm-4" id="validasi2">
                                
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal" onclick="kosongkan()"><i class="glyphicon glyphicon-remove"></i> Batal</button>
                        <button class="btn btn-primary" onclick="gantipass()"><i class="glyphicon glyphicon-ok"></i> Ganti</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="height: 0px;padding: 0px 0px;" href="master.php">
                <img src="../images/logo-kapa.png" width="10%" alt=""></a>
            </div>
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION[fullname] ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#gantipass" data-toggle="modal"><i class="fa fa-fw fa-gear"></i> Ganti Password</a> 
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse" >
                
                <ul class="nav navbar-nav side-nav">
                    <li class="<?php if($_GET['module']=='home'){echo'active';} ?>" >
                        <a href="?module=home"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                    <?php if($_SESSION['level'] == 'Super') : ?>
                    <li class="<?php if($_GET['module']=='user'){echo'active';} ?>">
                        <a href="?module=user"><i class="glyphicon glyphicon-user"></i> Manajemen User</a>
                    </li>
                    <li class="<?php if($_GET['module']=='klien'){echo'active';} ?>">
                        <a href="?module=klien"><i class="glyphicon glyphicon-book"></i> Manajemen Klien </a>
                    </li>
                    <li class="<?php if($_GET['module']=='group'){echo'active';} ?>">
                        <a href="?module=group"><i class="glyphicon glyphicon-list"></i> Manajemen Dimensi</a>
                    </li>
                    <li class="<?php if($_GET['module']=='description'){echo'active';} ?>">
                        <a href="?module=description"><i class="glyphicon glyphicon-book"></i> Manajemen Kriteria </a>
                    </li>
                    <?php endif; ?>
                    <?php if(($_SESSION['level'] != 'Rekan') && ($_SESSION['level'] != 'Klien')) : ?>
                    <li class="<?php if($_GET['module']=='perhitungan'){echo'active';} ?>">
                        <a href="?module=perhitungan"><i class="glyphicon glyphicon-new-window"></i> Perhitungan</a>
                    </li>
                    <?php endif; ?>
                    <?php if($_SESSION['level'] == 'Rekan') : ?>
                    <li class="<?php if($_GET['module']=='klien'){echo'active';} ?>">
                        <a href="?module=klien"><i class="glyphicon glyphicon-book"></i> Data Klien </a>
                    </li>
                    <li class="<?php if($_GET['module']=='perhitungan_rekan'){echo'active';} ?>">
                        <a href="?module=perhitungan_rekan"><i class="glyphicon glyphicon-new-window"></i> Perhitungan</a>
                    </li>
                    
                    <?php endif; ?>
                    <?php if($_SESSION['level'] == 'Klien') : ?>
                    <li class="<?php if($_GET['module']=='kuisioner'){echo'active';} ?>">
                        <a href="?module=kuisioner"><i class="glyphicon glyphicon-new-window"></i> Kuisioner</a>
                    </li>
                    <?php endif; ?>
                    <?php if(($_SESSION['level'] != 'Rekan') && ($_SESSION['level'] != 'Klien')) : ?>
                    <li class="<?php if($_GET['module']=='hasil'){echo'active';} ?>">
                        <a href="?module=hasil&sub=all"><i class="glyphicon glyphicon-new-window"></i> Laporan</a>
                    </li>
                    <?php endif; ?>
                    <?php if($_SESSION['level'] == 'Rekan') : ?>
                    <li class="<?php if($_GET['module']=='hasil'){echo'active';} ?>">
                        <a href="?module=hasil&sub=laporan_rekan"><i class="glyphicon glyphicon-new-window"></i> Laporan</a>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

            <?php include "konten.php"; ?>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script type='text/javascript'>
        $(window).load(function(){            
        $("#level").change(function() {
            if ($("#level option:selected").val() == 'Klien') {
                $('#alamat').prop('hidden', false);
                $('#tlp').prop('hidden', false);
                $('#nama_perusahaan').text('Nama Perusahaan');
                $('#nama').prop('placeholder','Nama Perusahaan');
                $('#nomor_induk').prop('hidden', true);
            }
            else if ($("#level option:selected").val() == 'Rekan') {
                $('#alamat').prop('hidden', false);
                $('#tlp').prop('hidden', false);
                $('#nomor_induk').prop('hidden', false);
                $('#nama_perusahaan').text('Nama Lengkap');
                $('#nama').prop('placeholder','Nama Lengkap');
            } else {
                $('#alamat').prop('hidden', true);
                $('#tlp').prop('hidden', true);
                $('#nomor_induk').prop('hidden', true);
                $('#nama_perusahaan').text('Nama Lengkap');
                $('#nama').prop('placeholder','Nama Lengkap');
            }
        });
    });
    </script>
    <script type="text/javascript">
    $("#bulan").change(function(){
        var id_bulan = $("#bulan").val();
        window.location.href = "?module=klien&bulan="+id_bulan;
    });
    $("#rek").change(function(){
        var id_rek = $("#rek").val();
        window.location.href = "?module=klien&rek="+id_rek;
    });
    $("#perrekan").change(function(){
        var id_perrekan = $("#perrekan").val();
        window.location.href = "?module=hasil&sub=laporan_rekan_all&perrekan="+id_perrekan;
        // var rekn = document.getElementById("#perrekan").value();
        // $(this).attr('selected',true);
    });
    $("#rekn").change(function(){
        var id_rekn = $("#rekn").val();
        window.location.href = "?module=perhitungan_rekan&rekn="+id_rekn;
    });
    $("#lay").change(function(){
        var id_lay = $("#lay").val();
        window.location.href = "?module=perhitungan_rekan_layanan&lay="+id_lay;
    });
    $("#datepicker").datepicker({
        format: 'yyyy-mm-dd',
        changeMonth : true,
        changeYear : true,
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom auto",
        minDate: new Date("<?php echo $bln ?>"),
    });
    </script>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/daterangepicker.js"></script>
    <script src="../js/moment.min.js"></script>
    <script src="../datepicker/jquery-ui.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#kontrak_awal").datepicker({
                minDate: 0,
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                onClose: function( selectedDate, inst ) {
                    var minDate = new Date(Date.parse(selectedDate));
                    minDate.setDate(maxDate.getDate() + 1);
                    $("#kontrak_berakhir").datepicker("option", "minDate", minDate);
                }
            });
            $("#kontrak_berakhir").datepicker({
                minDate: "+1D",
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
                onClose: function( selectedDate, inst ) {
                    var maxDate = new Date(Date.parse(selectedDate));
                    maxDate.setDate(maxDate.getDate() - 1);            
                    $("#kontrak_awal").datepicker("option", "maxDate", maxDate);
                }
            });
        });
        </script>
</body>

</html>
<?php
}
