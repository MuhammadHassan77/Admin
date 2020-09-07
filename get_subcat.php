 <?php
	include 'dbconnect.php';
    $connectingdb;
    $category_id=$_POST["categoryid"];
    $sql ="SELECT * FROM subcategory WHERE categoryid=$category_id";
    $stmt=$connectingdb->query($sql);
?>
<option value="">Select SubCategory</option>
<?php
while($row=$stmt->fetch() ) {
?>
	<option value="<?php echo $row["subcategoryid"];?>"><?php echo $row["subcategoryname"];?></option>
<?php
}
?>

