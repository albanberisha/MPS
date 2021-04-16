<?php
include('config.php');
session_start();
error_reporting(0);
$message="empty";

$analyse=$_FILES['file2']['tmp_name'];


$analyseId=$_POST['analyseId'];
$patientPersonaleNumber=$_POST['personalnumberPat'];
$patientid=$_POST['patientId'];
$analyseTypeId=$_POST['analyze'];
$date=date('j-m-y');
$space="";
$userid=$_SESSION['id'];

if (is_uploaded_file($_FILES['file2']['tmp_name'])) {
    $currentDirectory = dirname(__DIR__, 2);
    $uploadDirectory = "/uploads/";
    $fileExtensionsAllowed = ['jpeg', 'jpg', 'png', 'doc', 'docx', 'xlsx', 'pdf'];
    $fileName = $_FILES['file2']['name'];
    $fileSize = $_FILES['file2']['size'];
    $fileTmpName  = $_FILES['file2']['tmp_name'];
    $fileType = $_FILES['file2']['type'];

    $fileExtension = strtolower(end(explode('.', $fileName)));
    $date = date('j-m-y');
    $space = "";
    $filenewname = $patientPersonaleNumber . "-" . $patientid . "-" . $analyseTypeId . "-" . $date . "-" . $space . "." . $fileExtension;
    if (!in_array($fileExtension, $fileExtensionsAllowed)) {
      echo $error = "101";
    } elseif ($fileSize > 4000000) {
      echo $error = "102";
    } else {
      $uploadPath = $currentDirectory . $uploadDirectory . basename($filenewname);
      while (file_exists($uploadPath)) {
        $space = $space . "0";
        $filenewname = $patientPersonaleNumber . "-" . $patientid . "-" . $analyseTypeId . "-" . $date . "-" . $space . "." . $fileExtension;
        $uploadPath = $currentDirectory . $uploadDirectory . basename($filenewname);
      }
      $filenewname = $patientPersonaleNumber . "-" . $patientid . "-" . $analyseTypeId . "-" . $date . "-" . $space . "." . $fileExtension;
      $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
      if ($didUpload) {
        $filepath = basename($filenewname);
        $now = date(" Y-m-d H:i:sa");
        updateanalyse($con, $filepath, $analyseTypeId, $patientid, $now, $userid,$analyseId);
        echo "Analiza " . basename($filenewname) . " eshte ngarkuar";
      } else {
        echo "103";
      }

    }
}else {
    echo "100";
  }

function  updateanalyse($con,$filepath,$analyseTypeId,$patientid,$now,$userid,$analyseId)
{
    $query2 = mysqli_query($con,"UPDATE analyzes SET documentPath='$filepath', releaseDate='$now',userId='$userid'WHERE id='$analyseId'");
             if (!$query2) {
                die(mysqli_error($con).$query2);
                 }else{
                    $extra = "../daily-raports.php"; //
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    echo "http://".$host.$uri."/".$extra."?add=success";
                 }
}