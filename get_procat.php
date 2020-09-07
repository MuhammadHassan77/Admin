<?php
	include 'dbconnect.php';
    $connectingdb;
    $product_id=$_POST["productid"];
    $sql ="SELECT productname, price, (SELECT quantity FROM `stock` where `stock`.`productid`=`product`.`productid`) as 'Quantity',
    (SELECT categoryname FROM `category` where `category`.`categoryid`=`product`.`categoryid`) as 'category', 
    (SELECT subcategoryname FROM `subcategory` where `subcategory`.`subcategoryid`=`product`.`subcategoryid`) as 'subcategory' 
    FROM `product` WHERE productid=$product_id";
    $stmt=$connectingdb->query($sql);
    
?>
<?php
$myattr = '';
while($row=$stmt->fetch() ) {
    $myattr  = $row["productname"].','.$row["price"].','.(empty($row["Quantity"]) ? '0':$row["Quantity"]).','.$row["category"].','.$row["subcategory"];
}
echo $myattr;
?>
 Showing rows 0 - 0 (1 total, Query took 0.0008 seconds.)
<!-- SELECT `productname`,`image`,`price`,(SELECT `quantity` FROM `Stock` WHERE `product`.`productid`=`stock`.`productid`) AS `quantity` FROM `product`WHERE `productid`=10 -->