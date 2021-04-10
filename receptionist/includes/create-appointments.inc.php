<?php
include('config.php');
session_start();
$patid=$_SESSION['userid'];
$name = $_POST['namePatient'];//
$surname = $_POST['surnamePatient'];//
$patientid = $_POST['idPatient'];//
$birthday = $_POST['patientstart_date'];//
$gender = $_POST['patgender'];//
$state = $_POST['stateaddress'];//
$city = $_POST['cityaddress'];//
$street = $_POST['streetAddress'];//
$phone = $_POST['phone-number'];//
$doctorId = $_POST['DoctorAppointment'];//
$apointmentDate = $_POST['apointmentDate'];//
$apointmentStartTime = $_POST['apointmentStartTime'];//
$apointmentEndTime = $_POST['apointmentEndTime'];//
$status="approved";//
$today = date("Y-m-d");
$nowtime = date("H:i");
if(empty($doctorId))
{
    echo $error="10sadasdas";
}elseif(empty($apointmentDate))
{
    echo $error="11";
}elseif($apointmentDate<$today)
{
    echo $error="12";
}elseif(empty($apointmentStartTime))
{
    echo $error="13";
}elseif($apointmentStartTime<=$nowtime && $apointmentDate<=$today ){
echo $error="14";
}elseif(checkappointmentExitence($con,$apointmentStartTime,$doctorId,$apointmentDate))
{
    $closestAppointment=closestAppointment($con,$apointmentStartTime,$doctorId,$apointmentDate);
    echo $error="15".$closestAppointment;
}elseif(empty($apointmentEndTime))
{
    echo $error="16";
}elseif($apointmentEndTime<=$apointmentStartTime){
    echo $error="17";
}elseif(checkappointmentExitenceEndtime($con,$apointmentEndTime,$apointmentStartTime,$doctorId,$apointmentDate))
{$closestAppointmentend=closestAppointmentEnd($con,$apointmentEndTime,$apointmentStartTime,$doctorId,$apointmentDate);
    echo $error="18".$closestAppointmentend;
}else{
    savedata($con,$patid,$doctorId,$apointmentDate,$apointmentStartTime,$apointmentEndTime,$status);

}
$endtime=date("H:i");
function savedata($con,$patid,$doctorId,$apointmentDate,$apointmentStartTime,$apointmentEndTime,$status)
{
    $query = mysqli_query($con,"INSERT INTO appointments(patientId,doctorId,date,starttime,endtime,status) 
    VALUES('$patid','$doctorId','$apointmentDate','$apointmentStartTime','$apointmentEndTime','$status')");
    if (!$query) {
 die(mysqli_error($con).$query);
    } else {
        $extra = "../appointments.php"; //
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        echo "http://".$host.$uri."/".$extra."?add=success";

        }
    }
    $endtime=date("H:i");
    function checkappointmentExitence($con,$apointmentStartTime,$doctorId,$apointmentDate)
    {
        $exists=false;
        $query = mysqli_query($con, "SELECT appointments.doctorId,appointments.patientId,appointments.date,appointments.starttime,appointments.endtime,appointments.status from appointments WHERE doctorId='$doctorId' and appointments.date='$apointmentDate' and appointments.status!='rejected'");
         if (!$query) {
            die(mysqli_error($con).$query);
         } else {
            while($data = mysqli_fetch_array($query))
            {
                $appoisttime=$data['starttime'];
                   $appoientime=$data['endtime'];
                   if($apointmentStartTime>=$appoisttime && $apointmentStartTime<=$appoientime)
                   {
                       global $endtime;
                       $endtime=$appoientime;
                       $exists=true;
                       
                   }
            }
                return $exists;
        }
    }

    function closestAppointment($con,$apointmentStartTime,$doctorId,$apointmentDate)
    {
        global $endtime;
        $closestAppointment="";
        $newformatfundit = date('H:i:s',strtotime('+5 minutes',strtotime($endtime)));
        for($count=0; $count<20 ; $count++)
        {
            if(!checkappointmentExitence($con,$newformatfundit,$doctorId,$apointmentDate))
            {
                
                return $newformatfundit;
                break;
            }
            $newformatfundit = date('H:i:s',strtotime('+5 minutes',strtotime($endtime)));
        }
        return $closestAppointment;
        
        //return $closestAppointment;
    }
    $starttime=date("H:i");
    function checkappointmentExitenceEndtime($con,$apointmentEndTime,$apointmentStartTime,$doctorId,$apointmentDate)
    {
        $exists=false;
        $query = mysqli_query($con, "SELECT appointments.doctorId,appointments.patientId,appointments.date,appointments.starttime,appointments.endtime,appointments.status from appointments WHERE doctorId='$doctorId' and appointments.date='$apointmentDate' and appointments.status!='rejected'");
         if (!$query) {
            die(mysqli_error($con).$query);
         } else {
             $datameafert=$apointmentEndTime;
            while($data = mysqli_fetch_array($query))
            {
                $appoisttime=$data['starttime'];
                   $appoientime=$data['endtime'];
                   if($appoisttime>=$apointmentStartTime && $appoisttime<=$apointmentEndTime )
                   {
                       global $starttime;
                       $starttime=$appoisttime;
                       $exists=true;
                   }
            }
                return $exists;
        }
    }
function closestAppointmentEnd($con,$apointmentEndTime,$apointmentStartTime,$doctorId,$apointmentDate)
{
    global $starttime;
    $query = mysqli_query($con, "SELECT appointments.doctorId,appointments.patientId,appointments.date,appointments.starttime,appointments.endtime,appointments.status from appointments WHERE doctorId='$doctorId' and appointments.date='$apointmentDate' and appointments.status!='rejected'");
         if (!$query) {
            die(mysqli_error($con).$query);
         } else {
             $datameafert=$apointmentEndTime;
             while($data = mysqli_fetch_array($query))
             {
                 $appoisttime=$data['starttime'];
                    $appoientime=$data['endtime'];
                    if($appoisttime>=$apointmentStartTime && $appoisttime<=$apointmentEndTime )
                    {
                        if($appoisttime<=$datameafert)
                        {
                            $datameafert=$appoisttime;
                        }
                    }
             }
             global $starttime;
             $starttime=$datameafert;
     return $starttime;
        }
}