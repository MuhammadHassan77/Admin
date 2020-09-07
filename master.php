<?php
session_start();
require "dbconnect.php";
include("function.php");

if (isset($_POST["logout"])) {
    $userid = $_SESSION["userid"];
    $username = $_SESSION["username"];
    $password = $_SESSION["password"];
    unset($userid);
    unset($username);
    unset($password);
    session_destroy();
    redirect("Login.php");
}
if (empty($_SESSION["userid"]) && empty($_SESSION["username"])) {
    redirect("Login.php");
} else {
    $userid = $_SESSION["userid"];
    $username = $_SESSION["username"];
    echo "<script>console.log('username: $username '+' userid: $userid')</script>";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
        <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
        <title>Materialize</title>

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
        <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">


    </head>

    <body>
        <!-- START HEADER -->
        <header id="header" class="page-topbar">
            <!-- start header nav-->
            <div class="navbar-fixed">
                <nav class="cyan">
                    <div class="nav-wrapper">
                        <h1 class="logo-wrapper"><a href="index-2.html" class="brand-logo darken-1"><img src="images/materialize-logo.png" alt="materialize logo"></a> <span class="logo-text">Materialize</span></h1>
                        <ul class="right hide-on-med-and-down">
                            <li class="search-out">
                                <form action="" method="post">
                                    <input type="text" class="search-out-text" name="search_btn">
                                </form>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect waves-block waves-light show-search"><i class="mdi-action-search"></i></a>
                            </li>
                            <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                            </li>
                            <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light"><i class="mdi-social-notifications"></i></a>
                            </li>
                            <!-- Dropdown Trigger -->
                            <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                            </li>
                            <li style="height:100%;">
                                <form action="master.php" method="post">
                                    <!-- <i class="mdi-hardware-keyboard-tab" style="margin-left: 18px;"></i></a> -->
                                    <input type="submit" value="Logout" name="logout" style="border:0px;border-radius:30px;font-size:09.em;color:red;margin:23px 10px 0px 10px;">
                                </form>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- end header nav-->
        </header>
        <!-- END HEADER -->


        <!-- START LEFT SIDEBAR NAV-->
        <aside id="left-sidebar-nav">
            <ul id="slide-out" class="side-nav fixed leftside-navigation">
                <li class="user-details cyan darken-2">
                    <div class="row">
                        <div class="col col s4 m4 l4">
                            <img src="images/avatar2.jpg" alt="" class="circle responsive-img valign profile-image">
                        </div>
                        <div class="col col s8 m8 l8">
                            <ul id="profile-dropdown" class="dropdown-content">
                                <li><a href="#"><i class="mdi-action-face-unlock"></i> Profile</a>
                                </li>
                                <li><a href="#"><i class="mdi-action-settings"></i> Settings</a>
                                </li>
                                <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="mdi-action-lock-outline"></i> Lock</a>
                                </li>
                                <!-- <li><a href="#"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                    </li> -->
                                <li>
                                    <form action="master.php" method="post">
                                        <i class="mdi-hardware-keyboard-tab" style="margin-left: 18px;width:18px;"></i></a>
                                        <input type="submit" value="Logout" name="logout" style="width:54px;border:0px;font-size:09.em;color:red;margin:0px 0px 0px 0px;">
                                    </form>
                                </li>
                            </ul>
                            <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $username; ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                            <p class="user-roal">Administrator</p>
                        </div>
                    </div>
                </li>
                <li class="bold"><a href="Dashboard.php" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
                </li>
                <li class="bold"><a href="Product.php" class="waves-effect waves-cyan"><i class="mdi-communication-email"></i> Products </a>
                </li>
                <li class="bold"><a href="Categories.php" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Categories</a>
                </li>
                <li class="bold"><a href="Stock.php" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Stock</a>
                </li>
                <li class="bold"><a href="User.php" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Users</a>
                </li>
                <li class="bold"><a href="Orders.php" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Orders</a>
                </li>
                <!-- <li class="bold"><a href="Report.php" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Report</a> -->
                </li>
            </ul>
            </li>
            <!--                     
                    <li class="li-hover">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="sample-chart-wrapper">                            
                                    <div class="ct-chart ct-golden-section" id="ct2-chart"></div>
                                </div>
                            </div>
                        </div>
                    </li> -->
            </ul>
            <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only darken-2"><i class="mdi-navigation-menu"></i></a>
        </aside>
        <!-- END LEFT SIDEBAR NAV-->

        <!-- //////////////////////////////////////////////////////////////////////////// -->

        <!-- START FOOTER -->
        <footer class="page-footer" style=" position: fixed;left: 0;bottom: 0;width:100%;">

            <div class="footer-copyright">
                <div class="container">
                    Copyright © 2015 <a class="grey-text text-lighten-4" href="http://themeforest.net/user/geekslabs/portfolio?ref=geekslabs" target="_blank">GeeksLabs</a> All rights reserved.
                    <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="http://geekslabs.com/">GeeksLabs</a></span>
                </div>
            </div>
        </footer>
        <!-- END FOOTER -->


    </body>

    </html>
<?php } ?>