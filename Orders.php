<?php
require 'master.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        tr:nth-child(odd) {
            background: #a9a9da
        }

        tr:nth-child(even) {
            background: #CCC
        }
        table,th,td{
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="divider"></div>
    <div id="responsive-table" style="width:80%; margin-left:16%">
        <h2 class="header" style="text-align: center;margin:30px 0px 30px 0px;">Latest Orders History</h2>
        <div class="row">

            <div class="col s12 m8 l9">
                <table class="responsive-table" style="width:140%;margin-bottom:25px;">
                    <thead>
                        <tr style="background-color:#00bcd4; width:140%;height:70px;">
                            <th data-field="id">Order Id</th>
                            <th data-field="id">Customername & Email</th>
                            <th data-field="id">Product Id</th>
                            <th data-field="id">Product Name</th>
                            <th data-field="name">Price</th>
                            <th data-field="price">Quantity</th>
                            <th data-field="total">Date</th>
                            <th data-field="total">Total</th>
                            <!-- <th data-field="status">Category</th>
                            <th data-field="status">Sub Category</th> -->
                            <!-- <th data-field="status">Status</th> -->
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <?php
                            $connectingdb;
                            $sql = "SELECT *, 
                            (SELECT productname FROM product WHERE product.productid=paynow.productid ) AS productname,
                            (SELECT price FROM product WHERE product.productid=paynow.productid ) AS price,
                            --  SELECT categoryname FROM category WHERE product.productid=category.productid ) AS categoryname,
                            -- (SELECT subcategoryname FROM subcategory WHERE product.productid=subcategory.productid ) AS subcategoryname
                              (SELECT username FROM customer WHERE customer.customerid=paynow.customerid ) AS customername,
                              (SELECT email FROM customer WHERE customer.customerid=paynow.customerid ) AS email
                             FROM paynow LIMIT 15";

                            $stmt = $connectingdb->query($sql);
                            while ($DataRows = $stmt->fetch()) {
                                $orderid = $DataRows["orderid"];
                                $Customername = $DataRows["customername"];
                                $Email = $DataRows["email"];
                                $productid = $DataRows["productid"];
                                $productname = $DataRows["productname"];
                                $price = $DataRows["price"];
                                $quantity = $DataRows["quantity"];
                                $date = $DataRows["date"];
                                $Total = $DataRows["total"];
                                // $categoryname = $DataRows["categoryname"];
                                // $subcategoryname = $DataRows["subcategoryname"];
                                // $status = $DataRows["status"];
                            ?>

                                <td><?php echo $orderid; ?></td>
                                <td><?php echo $Customername . '<br>' . $Email; ?></td>
                                <td><?php echo $productid; ?></td>
                                <td><?php echo $productname; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo $Total; ?></td>
                                
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
    <!-- <footer class="page-footer">

        <div class="footer-copyright">
            <div class="container">
                Copyright © 2015 <a class="grey-text text-lighten-4" href="http://themeforest.net/user/geekslabs/portfolio?ref=geekslabs" target="_blank">GeeksLabs</a> All rights reserved.
                <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="http://geekslabs.com/">GeeksLabs</a></span>
            </div>
        </div>
    </footer> -->
    <!-- END FOOTER -->
</body>

</html>