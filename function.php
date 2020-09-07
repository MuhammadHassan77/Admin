<?php
$DSN='mysql:host=localhost;dbname=onlinestore';
$connectingdb = new PDO($DSN,'root','');
 $connectingdb;
function login_attempt($Username,$Password)
{
global $connectingdb;
$sql="SELECT * FROM user WHERE username=:userName AND password=:passWord AND status=1 LIMIT 1 ";
$stmt=$connectingdb->prepare($sql);
$stmt->bindValue(':userName',$Username);
$stmt->bindValue(':passWord',$Password);
$stmt->execute();
$result=$stmt->rowcount();
if($result==1)
{
    return $account_found=$stmt->fetch();
    // redirect("Login.php");
}
else
{
    return null;
}
}

function redirect($newlocation)
{
    echo "<script>window.location.href='$newlocation'</script>";
    // header("location:$newlocation");
}
?>