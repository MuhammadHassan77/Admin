<?php
require "master.php";
$connectingdb;
if (isset($_POST["submit"])) {
    $productname = $_POST["productname"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["pic"]["name"]);
    $pic = $_FILES["pic"]["name"];
    $categoryid = $_POST["CategoryId"];
    $subcategoryid = $_POST["SubCategoryId"];
    $current_time = time();
    $datetime = strftime("%d-%b-%Y %H:%M:%S", "$current_time");
    if (empty($_POST["productname"]) && empty($_POST["price"]) && empty($_POST["description"]) && empty($_POST["pic"])) {
        echo ("Alll Feilds must be filled out!");
    } else {
        $sql = "INSERT INTO product(productname,price,description,image,categoryid,subcategoryid,date)
        VALUES('$productname','$price','$description','$pic','$categoryid','$subcategoryid','$datetime')";
        move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file);
        $stmt = $connectingdb->prepare($sql);
        $stmt->execute();
        // var_dump($stmt);
        if ($stmt) {
            echo "Product Added with Id: " . $connectingdb->LastInsertId() . " Sccessfully.";
        } else {
            echo "Something went wrong!";
        }
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
    <title>Products</title>

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
                    <div class="col-lg-12">
                        <div class="card-panel">
                            <h2 class="header2" style="text-align:center">Add Products</h2>
                            <div class="row">
                                <form class="col s12" method="post" enctype="multipart/form-data" action="Product.php">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="name" type="text" name="productname">
                                            <label for="first_name">Product Name</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input id="name" type="text" name="price">
                                            <label for="first_name">Price</label>
                                        </div>
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
                                        </div>
                                        <div class="input-field col s12">
                                            <label for="first_name">Existing Sub Categories</label><br><br><br>
                                            <select id="subcategoryid">
                                                <option value="0">Please Select Sub Category</option>
                                                <?php
                                                $connectingdb;
                                                $sql = "SELECT * FROM subcategory";
                                                $stmt = $connectingdb->query($sql);
                                                while ($DataRows = $stmt->fetch()) {
                                                    $SubCategoryId = $DataRows["subcategoryid"];
                                                    $existingsubcategory = $DataRows["subcategoryname"];
                                                ?>

                                                    <option value="<?php echo $CategoryId; ?>"><?php echo $existingsubcategory; ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="hidden" name="SubCategoryId" id="SubCategoryId">
                                            <script>
                                                //Ajax
                                                window.addEventListener('load', function() {
                                                    $('#categoryid').on('change', function() {
                                                        $("#CategoryId").val($("#categoryid").find(":selected").val());
                                                        var categoryid = $("#CategoryId").val();
                                                        $.ajax({
                                                            url: "get_subcat.php",
                                                            type: "POST",
                                                            data: {
                                                                categoryid: categoryid
                                                            },
                                                            cache: false,
                                                            success: function(dataResult) {
                                                                console.log(dataResult);
                                                                $("#subcategoryid").html(dataResult);
                                                                $("#subcategoryid").material_select();
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>

                                            <script>
                                                //JQuery
                                                window.addEventListener('load', function() {
                                                    $("#subcategoryid").change(function() {
                                                        $("#SubCategoryId").val($("#subcategoryid").find(":selected").val());

                                                    });
                                                })
                                            </script>

                                        </div>
                                        <div class="input-field col s12 ">
                                            <label for="first_name">Choose Image</label><br><br>
                                            <input id="pic" type="file" name="pic" class="">
                                        </div>
                                        <div class="input-field col s12">
                                            <label for="first_name" class=""> Description</label><br>
                                            <input id="name" type="text" name="description" class="mt-5 pt-5">

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
        </div>
        <div id="responsive-table">
            <h2 class="header" style="text-align:center;">All Products</h2>
            <div class="row">

                <div class="col s12 m8 l9">
                    <table class="responsive-table" style="width:135%;">
                        <thead>
                            <tr style="background-color: #7ee7ff;height:50px">
                                <th data-field=" id">S:No</th>
                                <th data-field="id">Product Image</th>
                                <th data-field="id">Product Id</th>
                                <th data-field="id">Product Name</th>
                                <th data-field="name">Price</th>
                                <th data-field="price">Quantity</th>
                                <th data-field="total">Date</th>
                                <th data-field="status">Category</th>
                                <th data-field="status">Sub Category</th>
                                <!-- <th data-field="status">Status</th>
                                <th data-field="status">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $connectingdb;
                            $i = 1;
                            $sql = "SELECT *,
                            (SELECT categoryname FROM category WHERE category.categoryid= product.categoryid) AS categoryname,
                            (SELECT subcategoryname FROM subcategory WHERE subcategory.subcategoryid= product.subcategoryid) AS subcategoryname,
                            (SELECT quantity FROM stock WHERE stock.productid= product.productid) AS quantity
                             FROM product";
                            $stmt = $connectingdb->query($sql);
                            while ($DataRows = $stmt->fetch()) {
                                $image = $DataRows["image"];
                                $productid = $DataRows["productid"];
                                $productname = $DataRows["productname"];
                                $price = $DataRows["price"];
                                $quantity = $DataRows["quantity"];
                                $date = $DataRows["date"];
                                $categoryname = $DataRows["categoryname"];
                                $subcategoryname = $DataRows["subcategoryname"];
                                // $status = $DataRows["status"];
                            ?>
                                <tr style="font-weight:500;">
                                    <td><?php echo $i; ?></td>
                                    <td><img src="upload/<?php echo $image; ?>" width="40px" ; height="40px" alt="product img" srcset=""></td>
                                    <td><?php echo $productid; ?></td>
                                    <td><?php echo $productname; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $categoryname; ?></td>
                                    <td><?php echo $subcategoryname; ?></td>
                                    <!-- <td><?php //echo $status; 
                                                ?></td>
                                    <td>
                                        <form action="Stock.php" method="post">
                                            <input type="submit" name="change_status_on" class="btn" value="On">
                                            <input type="hidden" name="productid" value="<?php echo $productid; ?>">
                                        </form>
                                    </td> -->
                                </tr>
                            <?php $i++;
                            } ?>
                        </tbody>
                    </table>
                </div>
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
    <footer class="page-footer">

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