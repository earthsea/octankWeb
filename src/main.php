<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="Cache-Control" content="max-age=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Welcome to OCTANK</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <style>body {margin-top: 40px; background-color: #700;}</style>
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>

    <body>
        <div class="container">
            <div class="hero-unit" >
                <h1><a href="main.php" style="text-decoration:none">OCTANK WEB PoC</a></h1>
                <h2>Welcome to OCTANK Web Service 11</h2>
                <p>This PHP application is now running on a container in Amazon ECS.</p>
                <p>The container is running PHP version <?php echo phpversion(); ?>.</p>
                <?php
                        $myfile = fopen("/var/www/my-vol/date", "r") or die("");
                        echo fread($myfile,filesize("/var/www/my-vol/date"));
                        fclose($myfile);
                ?>
                <h2><?php include('get-cpu-load.php'); ?></h2>
                <br />
                <p><h2><a href="octank-photo.html" style="text-decoration:none">OCTANK Logo</a></h2></P>
                <p><h2><a href="put-cpu-load.php" style="text-decoration:none">CPU LOAD >></a></h2></P>
                <P><h2><a href="rds-read-data.php" style="text-decoration:none">RDS >></a></h2></P>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>
