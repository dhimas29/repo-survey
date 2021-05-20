<?php include('header.php') ?>
	
	<section class="ftco-section ftco-consult ftco-no-pt ftco-no-pb" style="background-image: url(images/bg_1.jpg);" data-stellar-background-ratio="0.5">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row justify-content-end">
    			<div class="col-md-12 py-5 px-md-5">
    				<div class="py-md-5">
		          <div class="heading-section heading-section-white ftco-animate mb-5">
		            <h1 style="color:white">Kantor Akuntan Publik</h1>
		            <h1 style="color:white">Abdul Aziz Fiby Ariza</h1>
		          </div>
    			</div>
        </div>
    	</div>
    </section>
		
		<section class="ftco-counter" id="section-counter">
    	<div class="container">
    		<div class="row d-md-flex align-items-center justify-content-center">
				
    			<div class="wrapper">
					<h2 align="center" style="color:blue">KAP-AAFA | Kantor Akuntan Publik Abdul Aziz Fiby Ariza</h2>
					<p><center>Kami siap membantu memecahkan dan sekaligus mencarikan solusi untuk setiap permasalahan Bisnis Anda</center></p>
    			<div class="row d-md-flex align-items-center">
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		            	<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-business"></span></div>
		              <div class="text">
		                <span style="color:blue"><center>Accounting Service</center></span>
		                <p><center>Membantu permasalahan akunting di perusahaan kecil, sedan dan menengah yang belum memiliki bagian khusus yang bertugas memproses dokumen transaksi menjadi laporan keuangan bulanan, triwulan dan tahunan.</center></p>
		              </div>
		            </div>
		          </div>
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
						<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-rating"></span></div>
		              <div class="text">
		                <span style="color:blue"><center>Review Laporan Keuangan</center></span>
		                <p><center>Memberikan keyakinan terbatas bahwa tidak terdapat modifikasi material yang harus dilaksanakan agar laporan keuangan sesuai dengan standard akuntansi keuangan atas basis akuntansi komperhensif lainnya.</center></p>
		              </div>
		            </div>
		          </div>
		          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18">
		            	<div class="icon mt-2 d-flex justify-content-center align-items-center"><span class="flaticon-analysis"></span></div>
		              <div class="text">
		                <span style="color:blue"><center>Audit Laporan Keuangan</center></span>
		                <p>
							<center>Audit umum atas laporan keuangan untuk memberikan pernyataan pendapat mengenai kewajaran laporan keuangan suatu entitas ekonomi dihubungkan dengan standard akuntansi keuangan.</center></p>
		              </div>
		            </div>
		          </div>
	          </div>
          </div>
        </div>
    	</div>
    </section>

    
		
	<section class="ftco-intro ftco-no-pb img" style="background-image: url(images/bg_1.jpg);">
    	<div class="container">
    		<div class="row justify-content-center">
		  
			<h2 style="color:white"><center>Butuh Jasa Akuntan Publik</center></h2>
		 	<center><p style="color:white">Segera hubungi kami di nomor (021) 863 2184 , email info@kap-aafa.co.id atau silahkan melalui halaman Contact Us</p>
			</center>
        </div>	
    	</div>
    </section>
		
	<?php include('footer.php') ?>
	
	<div class="modal fade" id="login">
        <form name="login" action="../adminweb/cek_login.php" method="POST" onSubmit="return validasi(this)" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" bgcolor="black">
						<img src="images/logo-kapa.png" width="30%" alt="">
                        <div class="modal-title" >
                           <center><h4>Login Admin</h4></center>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </div>
                                        <input type="text" class="form-control" name="username" placeholder="Username">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username" class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-lock"></span>
                                            
                                        </div>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class=" control-label col-sm-3"></label>
                                <div class="col-sm-1">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
					<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-log-in"></span> Masuk</button>
					<button class="btn btn-danger" type="reset" data-dismiss="modal">Cancel</button>	
                    </div>
                </div>
            </div>
        </form>
    </div>