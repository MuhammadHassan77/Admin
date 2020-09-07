<?php
// require("dbconnect.php") ;
require("master.php");
$connectingdb;
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    if (empty($_POST["username"]) && empty($_POST["password"]) && empty($_POST["email"])) {
        echo ("Alll Feilds must be filled out!");
    } else {
        $sql = "INSERT INTO user(username,password,email)
              VALUES('$username','$password','$email')";
        $stmt = $connectingdb->prepare($sql);
        $stmt->execute();
        // var_dump($stmt);
        if ($stmt) {
            echo "<div style='background-color:#84ff8d;width:50%;margin-left:30%;text-align:center;'><h4>
            Product Added with Id: " . $connectingdb->LastInsertId() . " Sccessfully.</h4></div>";
            redirect("User.php");
        } else {
            echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            Something went wrong! </div>";
            redirect("User.php");
        }
    }
}
// DELETE USER
if (isset($_POST["delete_user"])) {

    $userid = $_POST["userid"];
    echo "<script>alert($userid);</script>";
    $sql = "DELETE FROM user WHERE userid='$userid'";
    $stmt = $connectingdb->query($sql);
    if ($stmt) {
        echo "<div style='background-color:#84ff8d;width:50%;margin-left:30%;text-align:center;'><h4>User removed successfully!</h4></div>";
        redirect("User.php");
    }
    echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
    Something went wrong! </div>";
    redirect("User.php");
}
// APPROVE USER
if (isset($_POST["approve_user"])) {
    $userid = $_POST["userid"];
    // echo "<script>console.log($userid)</script>";
    $stmt = $connectingdb->query("UPDATE user SET status=1 WHERE userid='$userid'");
    if ($stmt) {
        echo "<div style='background-color:#84ff8d;width:50%;margin-left:30%;text-align:center;'><h4>User Approved successfully!</h4></div>";
        redirect("User.php");
    } else {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
        Something went wrong! </div>";
        redirect("User.php");
    }
}
// DIS-APPROVE USER
if (isset($_POST["disapprove_user"])) {
    $userid = $_POST["userid"];
    // echo "<script>console.log($userid)</script>";
    $stmt = $connectingdb->query("UPDATE user SET status=0 WHERE userid='$userid'");
    if ($stmt) {
        echo "<div style='background-color:#84ff8d;width:50%;margin-left:30%;text-align:center;'><h4>User Dis-Approved successfully!</h4></div>";
        redirect("User.php");
    } else {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
                Something went wrong! </div>";
        redirect("User.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 1.0
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->


<!-- Mirrored from demo.geekslabs.com/materialize/app-calendar.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jul 2015 06:55:37 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>Users</title>

    <!-- Favicons-->
    <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->


    <!-- CORE CSS-->

    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection">


    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/fullcalendar/css/fullcalendar.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <style>
        tr:nth-child(odd) {
            background: #a9a9da
        }

        tr:nth-child(even) {
            background: #CCC
        }

        table,
        th,
        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START HEADER -->

    <!-- END HEADER -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">



            <!-- //////////////////////////////////////////////////////////////////////////// -->

            <!-- START CONTENT -->
            <siv id="basic-form" class="section">
                <div class="row">
                    <div class="col s12 m12 l6" style="width:100%">
                        <div class="card-panel">
                            <h2 class="header2" style="text-align:center">Add User</h2>
                            <div class="row">
                                <form class="col s12" method="post" enctype="multipart/form-data/" action="User.php">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="name" type="text" name="username">
                                            <label for="first_name">User Name</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input id="name" type="password" name="password">
                                            <label for="first_name">Password</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input id="name" type="email" name="email">
                                            <label for="first_name">Email</label>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button class="btn cyan waves-effect waves-light right" type="submit" name="submit">Submit
                                                    <i class="mdi-content-send right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

        </div>

        <div id="responsive-table" style="width:98%;">
            <h2 class="header" style="text-align:center;margin:30px 0px 30px 0px;">Existing Users</h2>
            <div class="row">

                <div class="col s12 m8 l9">
                    <table class="responsive-table" style="width:135%;margin-bottom:25px;">
                        <thead>
                            <tr style="background-color:#00bcd4; width:140%;height:70px;text-align:center;">
                                <th data-field="id">S:No</th>
                                <th data-field="id">User Id</th>
                                <th data-field="id">User Name</th>
                                <th data-field="id">Email</th>
                                <th data-field="total">Action</th>
                                <th data-field="total">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $connectingdb;
                            $sql = "SELECT * FROM user WHERE status=1";
                            $i = 1;
                            $stmt = $connectingdb->query($sql);
                            while ($DataRows = $stmt->fetch()) {
                                $userid = $DataRows["userid"];
                                $username = $DataRows["username"];
                                $Email = $DataRows["email"];
                            ?>
                                <tr style="font-weight: bold;">

                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $userid; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td style="color:blue;"><?php echo $Email; ?></td>
                                    <!-- <td><button type="submit" name="delete_user" class="btn">Delete</button></td> -->
                                    <td>
                                        <form action="User.php" method="post">
                                            <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                            <input type="submit" value="Delete" name="delete_user" class="btn">
                                            <input type="submit" value="Dis-Approve" name="disapprove_user" class="btn cyan">
                                        </form>
                                    </td>
                                    <td>
                                        <h6 style="font-weight:bold">Approved</h6>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="responsive-table" style="width:98%;">
            <h2 class="header" style="text-align:center;margin:30px 0px 30px 0px;">Approve Users</h2>
            <div class="row">

                <div class="col s12 m8 l9">
                    <table class="responsive-table" style="width:135%;margin-bottom:25px;">
                        <thead>
                            <tr style="background-color:#00bcd4; width:140%;height:70px;text-align:center;">
                                <th data-field="id">S:No</th>
                                <th data-field="id">User Id</th>
                                <th data-field="id">User Name</th>
                                <th data-field="id">Email</th>
                                <th data-field="total">Action</th>
                                <th data-field="total">Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $connectingdb;
                            $sql = "SELECT * FROM user WHERE status=0";
                            $i = 1;
                            $stmt = $connectingdb->query($sql);
                            while ($DataRows = $stmt->fetch()) {
                                $userid = $DataRows["userid"];
                                $username = $DataRows["username"];
                                $Email = $DataRows["email"];
                            ?>
                                <tr style="font-weight: bold;">

                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $userid; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td STYLE="color:blue;"><?php echo $Email; ?></td>
                                    <!-- <td><button type="submit" name="delete_user" class="btn">Delete</button></td> -->
                                    <td>
                                        <form action="User.php" method="post">
                                            <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                            <input type="submit" value="Delete" name="delete_user" class="btn">
                                            <input type="submit" value="Approve" name="approve_user" class="btn cyan">
                                        </form>
                                    </td>
                                    <td>
                                        <h6 style="font-weight:bold">Dis-Approved</h6>
                                    </td>
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </dion>
    <!-- END CONTENT -->


    </div>
    <!-- END WRAPPER -->

    </div>
    <!-- END MAIN -->



    <!-- //////////////////////////////////////////////////////////////////////////// -->




    <!-- ================================================
    Scripts
    ================================================ -->

    <!-- jQuery Library -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.js"></script>
    <!--prism-->
    <script type="text/javascript" src="js/prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>

    <!-- Calendar Script -->
    <script type="text/javascript" src="js/plugins/fullcalendar/lib/jquery-ui.custom.min.js"></script>
    <script type="text/javascript" src="js/plugins/fullcalendar/lib/moment.min.js"></script>
    <script type="text/javascript" src="js/plugins/fullcalendar/js/fullcalendar.min.js"></script>
    <script type="text/javascript" src="js/plugins/fullcalendar/fullcalendar-script.js"></script>

    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.js"></script>


</body>


<!-- Mirrored from demo.geekslabs.com/materialize/app-calendar.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Jul 2015 06:55:42 GMT -->

</html>