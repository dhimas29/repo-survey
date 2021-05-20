<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <i class="glyphicon glyphicon-home"></i> Home
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="master.php?module=home">Home</a>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php
                $tanggal = date('Y-m-d');
                $tanggalFinal = tgl_indo($tanggal);
                $time = date('h:i:s');
                ?>
                <h3 class="panel-title" align="right"><i class="glyphicon glyphicon-calendar"></i> <?php echo "<font face='tahoma' size='2'>$tanggalFinal | $time</font>"; ?></h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="alert alert-info">
                        <?php if ($_SESSION['level'] == 'Super') {
                            echo "Selamat Datang Administrator <strong>" . $_SESSION['fullname'] . "</strong> Selamat bertugas";
                        } elseif ($_SESSION['level'] == 'Rekan') {
                            echo "Selamat Datang Rekanan <strong>" . $_SESSION['fullname'] . "</strong> Silahkan untuk melihat data";
                        } elseif ($_SESSION['level'] == 'Pimpinan') {
                            echo "Selamat Datang Pimpinan <strong>" . $_SESSION['fullname'] . "</strong> Silahkan untuk melihat data";
                        } else {
                            echo "Selamat Datang Klien <strong>" . $_SESSION['fullname'] . "</strong> 
                        Silahkan untuk mengisi kuisioner";
                        }
                        ?>
                    </div>
                    <?php if ($_SESSION['level'] == 'Klien') {
                        $quer = mysqli_query($hore, "SELECT * FROM tcompany 
                    where companyName = '$_SESSION[fullname]'");
                        $rowquer = mysqli_fetch_array($quer);

                        $kontrak = mysqli_query($hore, "SELECT * FROM tanswer 
                    where tanswer.companyId = '$rowquer[companyId]'
                    group by id_layanan");
                        $cek = mysqli_num_rows($kontrak);
                        if ($cek > 0) { ?>
                            <div class="alert alert-danger">
                                <?php
                                echo "Harap Isi Kuisioner Pada Layanan/Jasa<br>";
                                ?>
                                <?php
                                $qcek = mysqli_query($hore, "SELECT * FROM tcompany_layanan 
                        left join layanan on layanan.id = tcompany_layanan.id_layanan
                        where companyId ='$rowquer[companyId]' and id_layanan not in(SELECT id_layanan from tanswer)
                        group by id_layanan");
                                while ($c = mysqli_fetch_array($qcek)) {
                                    echo "- " . $c['nama_layanan'] . "<br>";
                                ?>
                            <?php
                                }
                            } ?>
                            </div> <?php
                                } ?>
                </div>

            </div>
            <div class="panel-footer">
                <center>Created By Dhimas<br> All rights reserved. | 2020</center>
            </div>
        </div>
    </div>
</div>