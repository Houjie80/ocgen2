<?php
    include('inc/config-inc.php');
    include('inc/auth.php');
    $loginError = false;
    if ((isset($_SESSION['username'])) && (isset($_SESSION['password']))) {
        header("Location: index.php");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $system_config = file_get_contents($ocgen_dir.'/system/config.json');
        $system_config = json_decode($system_config);
        if (($system_config->system->username === $username) && ($system_config->system->password === $password)) {
            set_session($username, $password);
        } else {
            $loginError = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        $title = "Login";
        include("inc/header.php");
    ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="<?php echo getThemeClass(); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 mx-auto mt-4 mb-2">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <img src="/luci-static/resources/openclash/img/logo.png" alt="OpenClash" width="150" class="width: 5%" />               
                        </div>
                    </div>
                    <div class="card-body">
							
                            <div class="form-group">
			                    <form role="form" action="" method="post" class="login-form">
								<p><strong>Login </strong></p>
                                <?php

                                if ($loginError) {
                                    echo '<div class="alert alert-danger" role="alert">Username and Password is incorrect, Check Again..!!</div>';
                                }
                            ?>
			<div class="form-group">
                <label class="sr-only" for="form-control" > Username </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
                  </div>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                </div>
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-control">Password</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-key fa-fw"></i></span>
                  </div>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
                </div>
              </div>
			  <button type="submit" class="btn btn-primary"> <i class="fa fa-sign-in"></i> Login</button>
			                    </form>
		                    </div>
                        </div>
                    </div>                    
                </div>
            </div>        
        </div>
    </div>
	
<?php include("inc/javascript.php"); ?>
		<?php include('inc/footer.php'); ?>
    </body>
    
</html>