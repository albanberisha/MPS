<?php
include('config.php');
error_reporting(0);
session_start();
$medid=$_SESSION['medid'] ;
$name = $_POST['nameMed'];
$manufacturer = $_POST['nameProd'];
$mass = $_POST['massProd'];
$quantity = $_POST['quantityProd'];
$lowquantity = $_POST['quantityProdStock'];
$description  = $_POST['description'];
$manufactured_date = $_POST['manufacturestart_date'];
$expiary_date = $_POST['expiarystart_date'];
$price = $_POST['price'];
$barcode  = $_POST['barcode'];
$status="1";
$today = date("Y-m-d");
$barcode = str_replace(' ', '', $barcode);
$barcode = str_replace('_', '', $barcode);
if(empty($name))
{
    echo $error="19";
}elseif(empty($manufacturer))
{
    echo $error="20";
}elseif(empty($mass))
{
    echo $error="21";
}elseif(empty($quantity)|| $quantity<0)
{
    echo $error="22";
}elseif(empty($lowquantity)|| $lowquantity<0)
{
    echo $error="23";
}elseif(empty($manufactured_date))
{
    echo $error="25";
}elseif(($manufactured_date>$today))
{
    echo $error="26";
}elseif(empty($expiary_date))
{
    echo $error="27";
}elseif(($expiary_date<$manufactured_date)|| ($expiary_date==$manufactured_date))
{
    echo $error="28";
}elseif($price<0 || empty($price))
{
    echo $error="29";

}elseif(strlen($barcode)!=13)
{
    echo $error="30";
}else{
   savedata($con,$medid,$name,$manufacturer,$mass,$quantity,$lowquantity,$description,$manufactured_date,$expiary_date,$price,$barcode);
}



function  savedata($con,$medid,$name,$manufacturer,$mass,$quantity,$lowquantity,$description,$manufactured_date,$expiary_date,$price,$barcode)
{
    $today = date("Y-m-d h:i:sa");
    $stmt2 = $con->prepare("UPDATE medicaments  SET name=?, manufacturer_name=?, mass=?, quantity=?, lowStock=?, description=?, price=?, barcode=?, manufactured_date=?, expired_date=?, last_updated=? WHERE id=?");
    $rc = $stmt2->bind_param("sssiisissssi",$name,$manufacturer,$mass,$quantity,$lowquantity,$description,$price,$barcode,$manufactured_date,$expiary_date,$today,$medid);
 $stmt2->execute();
 $stmt2->close();
}
?>