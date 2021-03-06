<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>AuroraDB Read</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <style>body {margin-top: 40px; background-color: #777;}</style>
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>

    <body>
        <div class="container">
            <div class="hero-unit" align=center>
                <h1>Aurora DB Read View</h1><p>
                <?php
                //This is a simple address book example for testing with RDS

                include('rds.conf.php');

                // Set address book variables
                isset($_REQUEST['mode']) ? $mode=$_REQUEST['mode'] : $mode="";
                isset($_REQUEST['id']) ? $id=$_REQUEST['id'] : $id="";
                isset($_REQUEST['name']) ? $name=$_REQUEST['name'] : $name="";
                isset($_REQUEST['phone']) ? $phone=$_REQUEST['phone'] : $phone="";
                isset($_REQUEST['email']) ? $email=$_REQUEST['email'] : $email="";

                // Connect to the RDS database
                mysql_connect($RDS_URL, $RDS_user, $RDS_pwd) or die(mysql_error());
                mysql_select_db($RDS_DB) or die(mysql_error());

                if ( $mode=="add")
                {
                Print '<h2>Add DATA</h2>
                <p>
                <form action=';
                echo $_SERVER['PHP_SELF'];
                Print '
                method=post>
                <table>
                <tr><td>Name:</td><td><input type="text" name="name" /></td></tr>
                <tr><td>Phone:</td><td><input type="text" name="phone" /></td></tr>
                <tr><td>Time:</td><td><input type="text" name="email" /></td></tr>
                <tr><td colspan="2" align="center"><input type="submit" /></td></tr>
                <input type=hidden name=mode value=added>
                </table>
                </form> <p>';
                }

                if ( $mode=="added")
                {
                mysql_query ("INSERT INTO address (name, phone, email) VALUES ('$name', '$phone', '$email')");
                }

                if ( $mode=="edit")
                {
                Print '<h2>Edit DATA</h2>
                <p>
                <form action=';
                echo $_SERVER['PHP_SELF'];
                Print '
                method=post>
                <table>
                <tr><td>Name:</td><td><input type="text" value="';
                Print $name;
                print '" name="name" /></td></tr>
                <tr><td>Phone:</td><td><input type="text" value="';
                Print $phone;
                print '" name="phone" /></td></tr>
                <tr><td>Email:</td><td><input type="text" value="';
                Print $email;
                print '" name="Time" /></td></tr>
                <tr><td colspan="2" align="center"><input type="submit" /></td></tr>
                <input type=hidden name=mode value=edited>
                <input type=hidden name=id value=';
                Print $id;
                print '>
                </table>
                </form> <p>';
                }

                if ( $mode=="edited")
                {
                mysql_query ("UPDATE address SET name = '$name', phone = '$phone', email = '$email' WHERE id = $id");
                Print "Data Updated!<p>";
                }

                if ( $mode=="remove")
                {
                mysql_query ("DELETE FROM address where id=$id");
                Print "Entry has been removed <p>";
                }

                $data = mysql_query("SELECT * FROM address ORDER BY email DESC")
                or die(mysql_error());
                Print "<table border cellpadding=3>";
                Print "<tr><th width=100>Name</th> " .
                "<th width=100>Phone</th> " .
                "<th width=200>Time</th> " .
                "<th width=100 colspan=2>Admin</th></tr>";
                Print "<td colspan=5 align=right> " .
                "<a href=" .$_SERVER['PHP_SELF']. "?mode=add>Add DATA</a></td>";
                while($info = mysql_fetch_array( $data ))
                {
                Print "<tr><td>".$info['name'] . "</td> ";
                Print "<td>".$info['phone'] . "</td> ";
                Print "<td> <a href=mailto:".$info['email'] . ">" .$info['email'] . "</a></td>";
                Print "<td><a href=" .$_SERVER['PHP_SELF']. "?id=" . $info['id'] ."&name=" . $info['name'] . "&phone=" . $info['phone'] ."&email=" . $info['email'] . "&mode=edit>Edit</a></td>";
                Print "<td><a href=" .$_SERVER['PHP_SELF']. "?id=" . $info['id'] ."&mode=remove>Remove</a></td></tr>";
                }
                Print "</table>";
                ?>
            </div>
        </div>
    </body>
</html>