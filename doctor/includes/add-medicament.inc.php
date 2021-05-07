<?php
include('config.php');
session_start();

$patientId=$_POST['patientid'];
$medicamentid=$_POST['medID'];
$medname=$_POST['medname'];
$userInCharge=$_SESSION['id'];
$medusage=$_POST['newmedicamentusage'];
$quantityperday=$_POST['quantityPerDay'];
$startday=$_POST['usageStartDay'];
$endday=$_POST['usageEndDay'];

$today=date("Y-m-d");//
if(empty($medname))
{
    echo $error="120";
}elseif(empty($medusage)){
    echo $error="121";
}elseif(empty($startday))
{
    echo $error="122";
}elseif($today>$startday)
{
    echo$error="123";
}elseif($startday>=$endday)
{
    echo$error="124";
}elseif(empty($quantityperday))
{
    echo $error="125";
}else{
    if(medicamentexists($con,$medname))
    {
        saveToHistory($con,$patientId,$userInCharge,$medusage,$quantityperday,$startday,$endday);
    }else{
        $price=0;
        $status='1';
        addNewMedicament($con,$medname,$price,$today,$status,$patientId,$userInCharge,$medusage,$quantityperday,$startday,$endday);
    }
}

function addNewMedicament($con,$medname,$price,$today,$status,$patientId,$userInCharge,$medusage,$quantityperday,$startday,$endday)
{
    $quant=0;
    $lowstock=0;
    $today=date("Y-m-d H:i:s");//
    $query=mysqli_query($con,"INSERT INTO medicaments(name,quantity,lowStock,price,registered,status) VALUES
    ('$medname','$quant','$lowstock','$price','$today','$status')");
    if(!$query)
    {
        die(mysqli_error($con).$query);
    }else{
        medicamentexists($con,$medname);
        saveToHistory($con,$patientId,$userInCharge,$medusage,$quantityperday,$startday,$endday);
    }
}

$OldmedId=null;
function getMedId()
{
    global $OldmedId;
    return $OldmedId;
}
function saveToHistory($con,$patientId,$userInCharge,$medusage,$quantityperday,$startday,$endday)
{
    $medicamentid=getMedId();
    $date1=date_create($startday);
    $date2=date_create($endday);
     $diff = $date2->diff($date1)->format("%a");
            $quantitynedded=$diff*$quantityperday;
    $query=mysqli_query($con,"INSERT INTO med_history(patientId,medicamentId,added_by_user,medUsage,quantity,startUseDate,endUseDate) VALUES
    ('$patientId','$medicamentid','$userInCharge','$medusage','$quantitynedded','$startday','$endday')");
    if(!$query)
    {
        die(mysqli_error($con).$query);
    }else{
        $date1=date_create($startday);
$date2=date_create($endday);
 $diff = $date2->diff($date1)->format("%a");
        $quantitynedded=$diff*$quantityperday;
        $query=mysqli_query($con,"UPDATE medicaments SET quantity=quantity-'$quantitynedded' where id='$medicamentid' ");
        if(!$query)
        {
            die(mysqli_error($con).$query);
        }else{
            echo "Medikamenti u shtua me sukses.";
        }
    }
}
function medicamentexists($con,$medname)
{
    global $OldmedId;
    $query=mysqli_query($con,"SELECT id,name from medicaments WHERE status='1' and name='$medname' GROUP BY name");
    if(!$query)
    {
        die(mysqli_error($con).$query);
    }else{
        $data=mysqli_fetch_array($query);
        if($data>0)
        {

            $OldmedId=$data['id'];
            return true; 
        }else{
            return false;
        }
    }
}

?>