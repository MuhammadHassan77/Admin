<?php
include "master.php";
if (isset($_POST["submit"])) {
    $connectingdb;
    $productid = $_POST["productid"]; //echo $productid;
    $productname = $_POST["productname"]; //echo $productname;
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $categoryname = $_POST["categoryname"];
    $subcategoryname = $_POST["subcategoryname"];
    $current_time = time();
    $datetime = strftime("%d-%b-%Y %H:%M:%S", "$current_time");
    $status = $_POST["status"];
    if (empty($_POST["productname"]) && empty($_POST["price"]) && empty($_POST["quantity"]) && empty($_POST["status"])) {
        echo "All fields must be filled out";
    } else {
        $sql = "INSERT INTO stock(productid,productname,price,quantity,categoryname,subcategoryname,date,status)
    VALUES('$productid','$productname','$price','$quantity','$categoryname','$subcategoryname','$datetime','$status')";
        $stmt = $connectingdb->prepare($sql);
        $stmt->execute();
        var_dump($stmt);
        if ($stmt) {
            echo "Product Added with Id: " . $connectingdb->LastInsertId() . " Sccessfully.";
            redirect("Stock.php");
        } else {
            echo "Something went wrong!";
            redirect("Stock.php");
        }
    }
}
// CHANGE STATUS ON

if (isset($_POST["change_status_off"])) {
    $productid = $_POST["productid"];
    $stmt = $connectingdb->query("UPDATE stock SET status ='off' WHERE productid='$productid' ");
    $stmt->execute();
    if ($stmt) {
        echo "<div style='background-color:#84ff8d;width:50%;margin-left:30%;text-align:center;'><h4>Statuschanged successfully!</h4></div>";
        redirect("Stock.php");
    } else {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            Something went wrong! </div>";
        redirect("Stock.php");
    }
}

// CHANGE STATUS OFF

if (isset($_POST["change_status_on"])) {
    $productid = $_POST["productid"];
    $stmt = $connectingdb->query("UPDATE stock SET status ='on' WHERE productid='$productid' ");
    $stmt->execute();
    if ($stmt) {
        echo "<div style='background-color:#84ff8d;width:50%;margin-left:30%;text-align:center;'><h4>Statuschanged successfully!</h4></div>";
        redirect("Stock.php");
    } else {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            Something went wrong! </div>";
        redirect("Stock.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
        <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
        <title>Stock</title>

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
        <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">
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

</head>

<body>

    <!-- START LEFT SIDEBAR NAV-->
    <!-- <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
                <div class="row">
                    <div class="col col s4 m4 l4">
                        <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image">
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
                            <li><a href="#"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                            </li>
                        </ul>
                        <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">John Doe<i class="mdi-navigation-arrow-drop-down right"></i></a>
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
            <li class="bold"><a href="Order.php" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Orders</a>
            </li>
            </li>
        </ul>
        </li>

        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only darken-2"><i class="mdi-navigation-menu"></i></a>
    </aside> -->
    <!-- END LEFT SIDEBAR NAV-->
    <div style="width:80%; margin-left:20%">
        <div class="col s12 m12 l6">
            <div class="card-panel">
                <h2 class="header2" style="text-align:center">Stock</h2>
                <div class="row">
                    <form class="col s12" method="post" action="Stock.php" stlye="background-color:red;">
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="first_name">Existing Products</label><br><br><br>
                                <select id="PRODUCTID">
                                    <option value="0">Please Select Products</option>
                                    <?php
                                    $connectingdb;
                                    $sql = "SELECT * FROM product";
                                    $stmt = $connectingdb->query($sql);
                                    while ($DataRows = $stmt->fetch()) {
                                        $productid = $DataRows["productid"];
                                        $productname = $DataRows["productname"];
                                    ?>
                                        <option value="<?php echo $productid; ?>"><?php echo $productname; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="productid" id="ProductId">
                                <input type="hidden" name="productname" id="ProductName">
                                <script>
                                    //Ajax
                                    window.addEventListener('load', function() {
                                        $('#PRODUCTID').on('change', function() {
                                            $("#ProductId").val($("#PRODUCTID").find(":selected").val());
                                            var productid = $("#ProductId").val();
                                            // alert(productid);    
                                            $.ajax({
                                                url: "get_procat.php",
                                                type: "POST",
                                                data: {
                                                    productid: productid
                                                },
                                                cache: false,
                                                success: function(dataResult) {
                                                    console.log(dataResult);
                                                    var temp = dataResult.split(",");
                                                    console.log(temp[0]);
                                                    $("#price").val(temp[1]);
                                                    $("#quantity").val(temp[2]);
                                                    $("#CategoryName").val(temp[3]);
                                                    $("#SubCategoryName").val(temp[4]);

                                                }
                                            });
                                        });
                                    });
                                </script>
                                <script>
                                    window.addEventListener('load', function() {
                                        $("#PRODUCTID").change(function() {
                                            $("#ProductId").val($("#PRODUCTID").find(":selected").val());
                                            $("#ProductName").val($("#PRODUCTID").find(":selected").text());

                                        });
                                    })
                                </script>

                                <div class="input-field col s12">
                                    <input id="price" type="text" name="price" style="margin-top:25px;">
                                    <label for="first_name">Price</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="quantity" type="text" name="quantity" style="margin-top:25px;">
                                    <label for="first_name">Quantity</label>
                                </div>
                                <div class="input-field col s12">
                                    <label for="first_name">Existing Categories</label><br>
                                    <input type="text" name="categoryname" id="CategoryName">
                                </div>
                                <div class="input-field col s12">
                                    <label for="first_name">Existing Sub Categories</label><br>
                                    <input type="text" name="subcategoryname" id="SubCategoryName">
                                </div>

                                <div class="input-field col s12">
                                    <label for="Status" class=""> Status</label><br><br>
                                    <input type="radio" id="test1" value="on" name="status">
                                    <label for="test1">Approve</label>
                                    <input type="radio" id="test2" value="off" name="status">
                                    <label for="test2">Dis-Approve</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit" name="submit">Add
                                        <i class="mdi-content-send right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="divider"></div>
            <div id="responsive-table">
            <h2 class="header" style="text-align:center;">Available Stock <sub style="font-size:0.3em;">(with status on)</sub></h2>
                <div class="row">

                    <div class="col s12 m8 l9">
                        <table class="responsive-table" style="width:135%;">
                            <thead>
                                <tr style="background-color: #7ee7ff;height:50px">
                                    <th data-field=" id">Stock Id</th>
                                    <th data-field="id">Product Id</th>
                                    <th data-field="id">Product Name</th>
                                    <th data-field="name">Price</th>
                                    <th data-field="price">Quantity</th>
                                    <th data-field="total">Date</th>
                                    <th data-field="status">Category</th>
                                    <th data-field="status">Sub Category</th>
                                    <th data-field="status">Status</th>
                                    <th data-field="status">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $connectingdb;
                                $sql = "SELECT * FROM stock WHERE status='on'";
                                $stmt = $connectingdb->query($sql);
                                while ($DataRows = $stmt->fetch()) {
                                    $stockid = $DataRows["stockid"];
                                    $productid = $DataRows["productid"];
                                    $productname = $DataRows["productname"];
                                    $price = $DataRows["price"];
                                    $quantity = $DataRows["quantity"];
                                    $date = $DataRows["date"];
                                    $categoryname = $DataRows["categoryname"];
                                    $subcategoryname = $DataRows["subcategoryname"];
                                    $status = $DataRows["status"];
                                ?>
                                    <tr style="font-weight:500;">
                                        <td><?php echo $stockid; ?></td>
                                        <td><?php echo $productid; ?></td>
                                        <td><?php echo $productname; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $categoryname; ?></td>
                                        <td><?php echo $subcategoryname; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <form action="Stock.php" method="post">
                                                <input type="submit" name="change_status_off" class="btn" value="OFF">
                                                <input type="hidden" name="productid" value="<?php echo $productid; ?>">
                                            </form>
                                        </td>
                                    </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="responsive-table">
                <h2 class="header" style="text-align:center;">Available Stock <sub style="font-size:0.3em;">(with status off)</sub></h2>
                <div class="row">

                    <div class="col s12 m8 l9">
                        <table class="responsive-table" style="width:135%;">
                            <thead>
                                <tr style="background-color: #7ee7ff;height:50px">
                                    <th data-field=" id">Stock Id</th>
                                    <th data-field="id">Product Id</th>
                                    <th data-field="id">Product Name</th>
                                    <th data-field="name">Price</th>
                                    <th data-field="price">Quantity</th>
                                    <th data-field="total">Date</th>
                                    <th data-field="status">Category</th>
                                    <th data-field="status">Sub Category</th>
                                    <th data-field="status">Status</th>
                                    <th data-field="status">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $connectingdb;
                                $sql = "SELECT * FROM stock WHERE status='off' ";
                                $stmt = $connectingdb->query($sql);
                                while ($DataRows = $stmt->fetch()) {
                                    $stockid = $DataRows["stockid"];
                                    $productid = $DataRows["productid"];
                                    $productname = $DataRows["productname"];
                                    $price = $DataRows["price"];
                                    $quantity = $DataRows["quantity"];
                                    $date = $DataRows["date"];
                                    $categoryname = $DataRows["categoryname"];
                                    $subcategoryname = $DataRows["subcategoryname"];
                                    $status = $DataRows["status"];
                                ?>
                                    <tr style="font-weight:500;">
                                        <td><?php echo $stockid; ?></td>
                                        <td><?php echo $productid; ?></td>
                                        <td><?php echo $productname; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $quantity; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $categoryname; ?></td>
                                        <td><?php echo $subcategoryname; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td>
                                            <form action="Stock.php" method="post">
                                                <input type="submit" name="change_status_on" class="btn" value="On">
                                                <input type="hidden" name="productid" value="<?php echo $productid; ?>">
                                            </form>
                                        </td>
                                    </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- START FOOTER -->
    <footer class="page-footer">

        <div class="footer-copyright">
            <div class="container">
                Copyright © 2015 <a class="grey-text text-lighten-4" href="http://themeforest.net/user/geekslabs/portfolio?ref=geekslabs" target="_blank">GeeksLabs</a> All rights reserved.
                <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="http://geekslabs.com/">GeeksLabs</a></span>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->
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

    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.js"></script>
</body>

</html>