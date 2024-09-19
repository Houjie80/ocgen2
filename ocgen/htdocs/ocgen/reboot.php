<?php
    include('inc/auth.php');
    check_session();
?>
<!doctype html>
<html lang="en">
<head>
    <?php
        $title = "Restart Openwrt";
        include("inc/header.php");
    ?>
</head>
<body class="<?php echo getThemeClass(); ?>">
<div id="app">
<?php include('inc/navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 mx-auto mt-4 mb-2">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <h3><i class="fa fa-refresh fa-spin fa-1x fa-fw"></i> Restart</h3>
                        </div>
                    </div>
							<div class="card-body">
							 
								<div class="text-center">
								<p>Proses Restart router membutuhkan waktu 1 Menit. </p>
									<div>
										<form @submit.prevent="RestartRouter">
											<p>
											<button type="submit" class="btn btn-danger" name="button"> <i class="fa fa-refresh fa-spin fa-1x fa-fw" aria-hidden="true"></i> Restart Router</button>
										</form>
										<form @submit.prevent="RestartOc">
											<p>
											<button type="submit" class="btn btn-primary" name="button"><i class="fa fa-github" aria-hidden="true"></i> Restart Openclash</button>
										</form>
										<div class="justify-content-md-center text-center" style="font-family:courier" align="center">
		<span class="text-primary"><i class="fa-brands fa-superpowers"></i> <b>Uptime : </b><span> <span id="uptime"></span>
										</div>		
										<div class="justify-content-md-center text-center" style="font-family:courier" align="center">
		<span class="text-primary"><i class="fa-solid fa-bolt"></i> <b>Openclash status : </b><span> <span id="clash_status"></span>
										</div>				
									</div>
								</div>
							</div>
					</div>
                </div>
            </div>
        </div>
        <?php include('inc/footer.php'); ?>
    </div>
</div>
<?php include("inc/javascript.php"); ?>
<script src="js/reboot.js" async></script>
<script src="js/openclash.js" async></script>
</body>
</html>

