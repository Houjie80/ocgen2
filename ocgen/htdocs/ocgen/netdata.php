<?php
    include('inc/auth.php');
    check_session();
?>
<!doctype html>
<html lang="en">
<head>
    <?php
        $title = "NetData";
        include("inc/header.php");
    ?>
</head>
<body class="<?php echo getThemeClass(); ?>">
<div id="app">
    <?php include('inc/navbar.php'); ?>
                <div class="embed-responsive embed-responsive-1by1">
                            <iframe class="embed-responsive-item" src="/netdata" allowfullscreen></iframe>              
				</div>
        <?php include('inc/footer.php'); ?>
</div>
<?php include("inc/javascript.php"); ?>
</body>
</html>