<?php
session_start();
include "function.php";
// LOGIN
if (isset($_POST["Login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    if (!empty($username) || !empty($password)) {
        $account_found = login_attempt($username, $password);
        if ($account_found) {
            $_SESSION["userid"] = $account_found["userid"];
            $_SESSION["username"] = $account_found["username"];
            $_SESSION["password"] = $account_found["password"];
            echo "<div style='background-color:#538bf3cc;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            Welcome " . $_SESSION["username"] . "</div>";
            redirect("Dashboard.php");
            // exit;
        } else {
            echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            Invalid Username or Password </div>";
            redirect("Login.php");
        }
    } else {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            All fields must be filled out! </div>";
        redirect("Login.php");
    }
}

// SIGNUP
if (isset($_POST["create_account"])) {
    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $sql = "INSERT INTO user(username,password,email) 
        VALUES(:usernamE,:passworD,:emaiL)";
        $stmt = $connectingdb->prepare($sql);
        $stmt->bindParam(':usernamE', $username);
        $stmt->bindParam(':passworD', $password);
        $stmt->bindParam(':emaiL', $email);
        $stmt->execute();
        if ($stmt) {
            echo "<div style='background-color:#538bf3cc;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            Account Created Successfull! </div>";
            redirect("Login.php");
        } else {
            echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            Something went wrong! </div>";
            redirect("Login.php");
        }
    } else {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            All fields must be filled out! </div>";
        redirect("Login.php");
    }
}
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
    <style>
        ::placeholder {
            color: #aaa1fd;
        }
    </style>
</head>

<body>
    <!-- START HEADER -->
    <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="cyan">
                <div class="nav-wrapper">
                    <h1 class="logo-wrapper" style="margin-left:40%"><a href="Login.php" class="brand-logo darken-1"><img src="images/materialize-logo.png" alt="materialize logo"></a> <span class="logo-text">Materialize</span></h1>
                    <ul class="right hide-on-med-and-down">
                        <li class="search-out">
                            <input type="text" class="search-out-text">
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
    </header>
    <!-- END HEADER -->

    <!-- CONTENT -->

    <div class="col s12 m12 l6">
        <!-- LOGIN FORM -->
        <div class="card-panel" style="width:50%;margin-left:25%" id="log-in">
            <h2 class="header2" style="text-align: center;color:red">Login</h2>
            <div class="row">
                <form class="col s12" method="post" action="Login.php">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="username" type="text" name="username" placeholder="UserName">
                            <!-- <label for="username">UserName</label> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12" style="display: inline-flex;">
                            <input id="password" type="password" name="password" placeholder="Password">
                            <button type="button" id="p-btn" style="height:20px;margin:10px;border:0px;background-color:white;" onclick="showhide()">
                                <img src="https://i.stack.imgur.com/waw4z.png" id="img" /></button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn cyan waves-effect waves-light left" type="submit" name="Login" id="login" style="margin-left:25%;width:50%">Login
                                <i class="mdi-content-send right"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <button class="btn  waves-effect waves-light right" id="signupbtn" onclick="signup()" style="margin-right:26.5%;width:47%">Sign Up
                    <i class="mdi-content-send right"></i>
                </button>
            </div>

        </div>

        <!-- SIGN UP FORM -->
        <div class="card-panel" style="width:50%;margin:0px 0px 10% 25%; display:none" id="sign-up">
            <h2 class="header2" style="text-align: center;color:red">Sign Up</h2>
            <div class="row">
                <form class="col s12" method="post" action="Login.php">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="username" type="text" name="username" placeholder="UserName">
                            <!-- <label for="username">UserName</label> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12" style="display: inline-flex;">
                            <input id="pwd" type="password" name="password" placeholder="Password">
                            <button type="button" id="p-btn" style="height:20px;margin:10px;border:0px;background-color:white;" onclick="hideshow()">
                                <img src="https://i.stack.imgur.com/waw4z.png" id="image" /></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" name="email" placeholder="Email">
                            <!-- <label for="password">Password</label> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn  waves-effect waves-light right" type="submit" name="create_account" id="signup" style="margin-right:25%;width:50%">Create Account
                                <i class="mdi-content-send right"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <button class="btn  waves-effect waves-light left" id="back_to_login" onclick="back_to_login()" style="background-color:#00bcd4;margin-left:26%;width:48%">Back
                    <i class="mdi-content-send left"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <script>
        function signup() {
            // var signup_btn = document.getElementById('signupbtn');
            var login_div = document.getElementById('log-in');
            login_div.style.display = "none";
            // console.log(login_div.style);
            var signup_div = document.getElementById('sign-up');
            signup_div.style.display = "block";
            // console.log(signup_div.style);
        }

        function back_to_login() {
            // var back_to_login=document.getElementById('back_to_login');
            var login_div = document.getElementById('log-in');
            login_div.style.display = "block";
            var signup_div = document.getElementById('sign-up');
            signup_div.style.display = "none";
        }

        function showhide() {
            var p = document.getElementById('password');
            var i = document.getElementById('img');
            if (p.type == 'password') {
                p.type = 'text';
                i.src = "https://i.stack.imgur.com/waw4z.png";
            } else {
                p.type = "password";
                i.src = "https://i.stack.imgur.com/Oyk1g.png";
            }
        }
        function hideshow() {
            var p = document.getElementById('pwd');
            var i = document.getElementById('image');
            if (p.type == 'password') {
                p.type = 'text';
                i.src = "https://i.stack.imgur.com/waw4z.png";
            } else {
                p.type = "password";
                i.src = "https://i.stack.imgur.com/Oyk1g.png";
            }
        }

    </script>

    <!-- START FOOTER -->
    <footer class="page-footer" style=" width:100%;margin-top:38px;">

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