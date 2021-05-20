<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <img src="home/images/logo-kapa.png" width="20%" alt="">
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="index.php" class="nav-link pl-0">Home</a></li>
                <li class="nav-item"><a href="legalitas.php" class="nav-link">Legalitas</a></li>
                <li class="nav-item"><a href="layanan.php" class="nav-link">Layanan</a></li>
                <!-- <li class="nav-item"><a href="kuisioner.php" class="nav-link">Kuisioner</a></li> -->
                <li class="nav-item"><a href="hubungi.php" class="nav-link">Hubungi Kami</a></li>
                <li class="nav-item"><a href="#login" data-toggle="modal" class="nav-link"> Login</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
<div class="modal fade" id="login">
    <form name="login" action="adminweb/cek_login.php" method="POST" onSubmit="return validasi(this)">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" bgcolor="black">
                    <img src="images/logo-kapa.png" width="30%" alt="">
                    <div class="modal-title">
                        <center>
                            <h4>Login</h4>
                        </center>
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