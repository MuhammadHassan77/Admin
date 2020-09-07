<?php
require 'master.php';
// ADD CATEGORY
if (isset($_POST["Submit"])) {
    $categoryname = $_POST["category"];
    $current_time = time();
    $date = strftime("%d-%b-%Y %H:%M:%S", "$current_time");
    if (empty($_POST["category"])) {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            All fields must be filled out!! </div>";
        redirect("Categories.php");
    } else {
        $sql = "INSERT INTO category(categoryname,date) VALUES('$categoryname','$date')";
        $stmt = $connectingdb->prepare($sql);
        $stmt->execute();
        if ($stmt) {
            echo "Catagory Added with Id: " . $connectingdb->LastInsertId() . " Sccessfully.";
        } else {
            echo "Something went wrong!";
        }
    }
}

// ADD SUBCATEGORY
if (isset($_POST["submit"]) && !empty($_POST["CategoryId"])) {
    $id = $_POST["CategoryId"];    //echo $id;
    $subcategoryname = $_POST["subcategory"];
    $current_time = time();
    $date = strftime("%d-%b-%Y %H:%M:%S", "$current_time");
    if (empty($_POST["subcategory"])) {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            All fields must be filled out!! </div>";
        redirect("Categories.php");
    } else {
        $sql = "INSERT INTO subcategory(subcategoryname,categoryid,date) VALUES('$subcategoryname','$id','$date')";
        $stmt = $connectingdb->prepare($sql);
        $stmt->execute();
        // var_dump($stmt);
        if ($stmt) {
            echo "<div style='background-color:#84ff8d;width:50%;margin-left:30%;text-align:center;'><h4>
            Catagory Added with Id: " . $connectingdb->LastInsertId() . " Sccessfully!</h4></div>";
        } else {
            echo "Something went wrong!";
        }
    }
}


// DELETE CATEGORIES
if (isset($_POST["delete_cat"])) {

    $cat_id = $_POST["cat_id"];
    echo "<script>alert($cat_id);</script>";
    $sql = "DELETE FROM category WHERE categoryid='$cat_id'";
    $stmt = $connectingdb->query($sql);
    if ($stmt) {
        echo "<div style='background-color:#84ff8d;width:50%;margin-left:30%;text-align:center;'><h4>Category removed successfully!</h4></div>";
        redirect("Categories.php");
    } else {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
    Something went wrong! </div>";
        redirect("Categories.php");
    }
}

// DELETE SUBCATEGORIES
if (isset($_POST["delete_subcat"])) {

    $subcat_id = $_POST["subcat_id"];
    echo "<script>alert($subcat_id);</script>";
    $sql = "DELETE FROM subcategory WHERE subcategoryid='$subcat_id'";
    $stmt = $connectingdb->query($sql);
    if ($stmt) {
        echo "<div style='background-color:#84ff8d;width:50%;margin-left:30%;text-align:center;'><h4>SubCategory removed successfully!</h4></div>";
        redirect("Categories.php");
    } else {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
        Something went wrong! </div>";
        redirect("Categories.php");
    }
}

// UPDATE CATEGORY
if (isset($_POST["update_cat"])) {
    if (!empty($_POST["cat_id"]) && !empty($_POST["cat_name"])) {
        $cat_id = $_POST["cat_id"];
        $cat_name = $_POST["cat_name"];
        $stmt = $connectingdb->query("UPDATE category SET categoryname = '$cat_name' WHERE categoryid= '$cat_id' ");
        if ($stmt) {
            echo "<div style='background-color:#84ff8d;width:50%;margin-left:30%;text-align:center;'><h4>Category Updated successfully!</h4></div>";
            redirect("Categories.php");
        } else {
            echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            Something went wrong! </div>";
            redirect("Categories.php");
        }
    } else {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            All fields must be filled out! </div>";
        redirect("Categories.php");
    }
}


// UPDATE SUBCATEGORY
if (isset($_POST["upd_subcat"])) {
    if (!empty($_POST["upd_subcatid"]) && !empty($_POST["upd_subcatname"])&& !empty($_POST["pre_subcatname"])) {
        $pre_name=$_POST["pre_subcatname"]; echo ' '.$pre_name;
        $upd_subcatid = $_POST["upd_subcatid"]; echo ' '.$upd_subcatid;
        $upd_subcatname = $_POST["upd_subcatname"]; echo ' '.$upd_subcatname;
        $sql="UPDATE subcategory SET subcategoryname = '$upd_subcatname' WHERE subcategoryid= '$upd_subcatid'";
        $stmt = $connectingdb->query($sql);
        echo '<br>'.$sql;
        if ($stmt) {
            echo "<div style='background-color:#84ff8d;width:50%;margin-left:30%;text-align:center;'><h4>Category Updated successfully!</h4></div>";
            redirect("Categories.php");
        } else {
            echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            Something went wrong! </div>";
            redirect("Categories.php");
        }
    } 
    else {
        echo "<div style='background-color:#ea9595;margin:auto;width:30%;text-align:center;font-size:1.8em;'>
            All fields must be filled out! </div>";
        redirect("Categories.php");
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
    <title>Categories</title>

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
                <!-- FORMS -->
                <div class="row">
                    <div class="col s12 m12 l6" style="display:block;" id="default_catdiv">
                        <div class="card-panel">
                            <h2 class="header" style="text-align:center;margin:30px 0px 30px 0px;">Add Category</h2>
                            <div class="row">
                                <form class="col s12" method="post" action="Categories.php">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="name" type="text" name="category">
                                            <label for="first_name">Category Name</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn cyan waves-effect waves-light right" type="submit" name="Submit">Submit
                                                <i class="mdi-content-send right"></i>
                                            </button>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="col s12 m12 l6" style="display:none;" id="update_catdiv">
                        <div class="card-panel">
                            <h2 class="header" style="text-align:center;margin:30px 0px 30px 0px;">Update Category</h2>
                            <div class="row">
                                <form class="col s12" method="post" action="Categories.php">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input type="hidden" name="cat_id" value="" id="upd_catid">
                                            <input type="text" name="cat_name" value="" id="upd_catname" style="color:black;font-weight:bold;">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn cyan waves-effect waves-light right" type="submit" name="update_cat">Submit
                                                <i class="mdi-content-send right"></i>
                                            </button>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="col s12 m12 l6" style="display:block;" id="default_subcatdiv">
                        <div class="card-panel">
                            <h2 class="header" style="text-align:center;margin:30px 0px 30px 0px;">Add SubCategory</h2>
                            <div class="row">
                                <form class="col s12" method="post">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <label for="first_name">Existing Categories</label><br><br><br>
                                            <select id="categoryid">
                                                <option value="0">Please Select Category</option>
                                                <?php
                                                $connectingdb;
                                                $sql = "SELECT * FROM category";
                                                $stmt = $connectingdb->query($sql);
                                                while ($DataRows = $stmt->fetch()) {
                                                    $CategoryId = $DataRows["categoryid"];
                                                    $existingcategory = $DataRows["categoryname"];
                                                ?>

                                                    <option value="<?php echo $CategoryId; ?>"><?php echo $existingcategory; ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="CategoryId" id="CategoryId">
                                            <script>
                                                window.addEventListener('load', function() {
                                                    $("#categoryid").change(function() {
                                                        $("#CategoryId").val($("#categoryid").find(":selected").val());

                                                    });
                                                })
                                            </script>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="name" type="text" name="subcategory">
                                                <label for="first_name">Sub Category Name</label>
                                            </div>
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

                    <div class="col s12 m12 l6" style="display:none;" id="update_subcatdiv">
                        <div class="card-panel">
                            <h2 class="header" style="text-align:center;margin:30px 0px 30px 0px;">Update SubCategory</h2>
                            <div class="row">
                                <form class="col s12" action="Categories.php" method="post">
                                    <div class="row">
                                        <!-- <div class="input-field col s12">
                                            <label for="first_name">Existing Categories</label><br><br><br>
                                            <select id="ctid">
                                                <option value="0">Please Select Category</option>
                                                <?php
                                                $connectingdb;
                                                $sql = "SELECT * FROM category";
                                                $stmt = $connectingdb->query($sql);
                                                while ($DataRows = $stmt->fetch()) {
                                                    $CategoryId = $DataRows["categoryid"];
                                                    $existingcategory = $DataRows["categoryname"];
                                                ?>

                                                    <option value="<?php echo $CategoryId; ?>"><?php echo $existingcategory; ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="CATID" id="CId">
                                            <script>
                                                window.addEventListener('load', function() {
                                                    $("#ctid").change(function() {
                                                        $("#CId").val($("#ctid").find(":selected").val());

                                                    });
                                                })
                                            </script>
                                        </div> -->
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <span>Prevoius SubCategory Name</span>
                                                <input id="pre_subcatname" name="pre_subcatname" value="" type="text" style="color:black;font-weight:bold;" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input type="hidden" name="upd_subcatid" id="upd_subcatid" value="">
                                                <input id="upd_subcatname" type="text" name="upd_subcatname" value="">
                                                <label for="first_name">Sub Category Name</label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col s12">
                                                <button class="btn cyan waves-effect waves-light right" type="submit" name="upd_subcat">Submit
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
                <!-- TABLES -->
                <div id="responsive-table" style="width:98%;">
                    <h2 class="header" style="text-align:center;margin:30px 0px 30px 0px;">Existing Categories</h2>
                    <div class="row">

                        <div class="col s12 m8 l9">
                            <table class="responsive-table" style="width:135%;margin-bottom:25px;">
                                <thead>
                                    <tr style="background-color:#00bcd4; width:140%;height:70px;text-align:center;">
                                        <th data-field="id">S:No</th>
                                        <th data-field="id">Category Id</th>
                                        <th data-field="id">Category Name</th>
                                        <th data-field="id">Date</th>
                                        <th data-field="total">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $connectingdb;
                                    $sql = "SELECT * FROM category";
                                    $i = 1;
                                    $stmt = $connectingdb->query($sql);
                                    while ($DataRows = $stmt->fetch()) {
                                        $categoryid = $DataRows["categoryid"];
                                        $categoryname = $DataRows["categoryname"];
                                        $date = $DataRows["date"];
                                    ?>
                                        <tr style="font-weight: bold;">

                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $categoryid; ?></td>
                                            <td><?php echo $categoryname; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td>
                                                <form action="Categories.php" method="post">
                                                    <input type="hidden" name="cat_id" value="<?php echo $categoryid; ?>">
                                                    <input type="hidden" name="cat_name" value="<?php echo $categoryname; ?>">
                                                    <input type="submit" value="Delete" name="delete_cat" class="btn">
                                                </form>
                                                <a href="#update_catdiv">
                                                <input type="button" value="Update" class="btn cyan" id="cat_btn" onclick="display_updatediv_cat('<?php echo $categoryid ?>','<?php echo $categoryname ?>')">
                                                </a>
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
                    <h2 class="header" style="text-align:center;margin:30px 0px 30px 0px;">Existing SubCategories</h2>
                    <div class="row">

                        <div class="col s12 m8 l9">
                            <table class="responsive-table" style="width:135%;margin-bottom:25px;">
                                <thead>
                                    <tr style="background-color:#00bcd4; width:140%;height:70px;text-align:center;">
                                        <th data-field="id">S:No</th>
                                        <th data-field="id">SubCategory Id</th>
                                        <th data-field="id">SubCategory Name</th>
                                        <th data-field="id">Category Name</th>
                                        <th data-field="id">Date</th>
                                        <th data-field="total">Action</th>
                                        <!-- <th data-field="total">Status</th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $connectingdb;
                                    $sql = "SELECT *,(SELECT categoryname FROM category WHERE category.categoryid=subcategory.categoryid) AS categoryname
                                     FROM subcategory";
                                    $i = 1;
                                    $stmt = $connectingdb->query($sql);
                                    while ($DataRows = $stmt->fetch()) {
                                        $subcategoryid = $DataRows["subcategoryid"];
                                        $subcategoryname = $DataRows["subcategoryname"];
                                        $categoryid = $DataRows["categoryid"];
                                        $categoryname = $DataRows["categoryname"];
                                        $date = $DataRows["date"];
                                    ?>
                                        <tr style="font-weight: bold;">

                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $subcategoryid; ?></td>
                                            <td><?php echo $subcategoryname; ?><sub><?php echo '(C-id=' . $categoryid . ')'; ?></sub></td>
                                            <td><?php echo $categoryname; ?></td>
                                            <td><?php echo $date; ?></td>
                                            <td>
                                                <form action="Categories.php" method="post">
                                                    <input type="hidden" name="subcat_id" value="<?php echo $subcategoryid; ?>">
                                                    <input type="hidden" name="subcat_name" value="<?php echo $subcategoryname; ?>">
                                                    <input type="submit" value="Delete" name="delete_subcat" class="btn">
                                                </form>
                                                <a href="#update_subcatdiv">
                                                <input type="button" value="Update" name="update_subcat" class="btn cyan" onclick="display_updatediv_subcat('<?php echo $subcategoryid; ?>','<?php echo $subcategoryname; ?>')">
                                                </a>
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

    <!-- START FOOTER -->
    <footer class="page-footer" style=" position: fixed;left: 0;bottom: 0;width:100%">
        <div class="footer-copyright">
            <div class="container">
                Copyright © 2015 <a class="grey-text text-lighten-4" href="http://themeforest.net/user/geekslabs/portfolio?ref=geekslabs" target="_blank">GeeksLabs</a> All rights reserved.
                <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="http://geekslabs.com/">GeeksLabs</a></span>
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->




    <!-- ================================================
    Scripts
    ================================================ -->
    <script>
        function display_updatediv_cat(id, name) {
            var update_catdiv = document.getElementById('update_catdiv');
            update_catdiv.style.display = "block";
            var defualt_catdiv = document.getElementById('default_catdiv');
            defualt_catdiv.style.display = "none";

            var upd_catid = document.getElementById('upd_catid');
            upd_catid.value = id;
            var upd_catname = document.getElementById('upd_catname');
            upd_catname.value = name;
            console.log('upd_catname.value ' + upd_catname.value);

        }

        function display_updatediv_subcat(id, name) {
            var update_subcatdiv = document.getElementById('update_subcatdiv');
            update_subcatdiv.style.display = "block";
            var default_subcatdiv = document.getElementById('default_subcatdiv');
            default_subcatdiv.style.display = "none";

            // var catid = document.getElementById('catid');
            // catid.value = catid;
            var upd_subcatid = document.getElementById('upd_subcatid');
            upd_subcatid.value = id;
            var pre_subcatname = document.getElementById('pre_subcatname');
            pre_subcatname.value = name ;
            console.log(' SC-id '+id+' '+'upd_subcatname.value ' + pre_subcatname.value);
        }
    </script>
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