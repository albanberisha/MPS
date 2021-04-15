<?php
include('config.php');
session_start();
error_reporting(0);
$message="empty";
$analyse=$_FILES['file2']['tmp_name'];
$analyseTypeId=$_POST['analyze'];
$patientIdName=$_POST['idPatient'];
$userid=$_SESSION['id'];
if(empty($analyseTypeId))
{
    echo $error="104";
}elseif(empty($patientIdName)){
    echo $error="105";
}else{
    list($patientPersonaleNumber, $patientid, $patientname, $patientsurname) = explode("-", $patientIdName);
    if(!checkPatientExistence($con,$patientPersonaleNumber))
    {
        echo $error="106";
    }else{
        if (is_uploaded_file($_FILES['file2']['tmp_name'])) 
  {
    $currentDirectory =dirname(__DIR__, 2) ;
    $uploadDirectory = "/uploads/";
    $fileExtensionsAllowed = ['jpeg','jpg','png','doc','docx','xlsx','pdf'];
    $fileName = $_FILES['file2']['name'];
        $fileSize = $_FILES['file2']['size'];
        $fileTmpName  = $_FILES['file2']['tmp_name'];
        $fileType = $_FILES['file2']['type'];
        
        $fileExtension = strtolower(end(explode('.',$fileName)));
        $date=date('j-m-y');
        $space="";
        $filenewname=$patientPersonaleNumber."-".$patientid."-".$analyseTypeId."-".$date."-".$space.".".$fileExtension;
    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        echo $error = "101";
      }elseif($fileSize > 4000000)
      {
        echo $error = "102";
      }else{
        $uploadPath = $currentDirectory . $uploadDirectory . basename($filenewname); 
        while (file_exists($uploadPath)) {
            $space=$space."0";
            $filenewname=$patientPersonaleNumber."-".$patientid."-".$analyseTypeId."-".$date."-".$space.".".$fileExtension;
            $uploadPath = $currentDirectory . $uploadDirectory . basename($filenewname); 
        } 
        $filenewname=$patientPersonaleNumber."-".$patientid."-".$analyseTypeId."-".$date."-".$space.".".$fileExtension;
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        if ($didUpload) {
            $filepath=basename($filenewname);
            $now=date(" Y-m-d H:i:sa");
            saveanalyse($con,$filepath,$analyseTypeId,$patientid,$now,$userid);
            echo "Analiza " . basename($filenewname) . " eshte ngarkuar";
          } else {
            echo "103";
          }
      }

}else{
    echo "100";
}

    }
}

function  saveanalyse($con,$filepath,$analyseTypeId,$patientid,$now,$userid)
{
    $query2 = mysqli_query($con,"INSERT INTO analyzes(documentPath,analyse_id,patientId,releaseDate,userId,status) 
            VALUES('$filepath','$analyseTypeId','$patientid','$now','$userid','1')");
             if (!$query2) {
                die(mysqli_error($con).$query2);
                 }else{
                    $extra = "../daily-raports.php"; //
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    echo "http://".$host.$uri."/".$extra."?add=success";
                 }
}


function checkPatientExistence($con,$patientid)
{
    if (preg_match("/[a-z]/i",$patientid)) {
       return false;
    }else{
        $query7 = mysqli_query($con, "SELECT patients.id, patients.name, patients.surname, patients.patientID FROM patients WHERE patients.status='1' and patients.patientID='$patientid'");
    if (!$query7) {
        die(mysqli_error($con) . $query7);
    } else { 
        $data7 = mysqli_fetch_array($query7);
        if($data7>0)
        {
            return true;
        }else{
            return false;
        }
    }
    }
}

    /*
    if (! in_array($fileExtension,$fileExtensionsAllowed)) {
        echo $error = "101";
      }elseif($fileSize > 4000000)
      {
        echo $error = "102";
      }else{
        $uploadPath = $currentDirectory . $uploadDirectory . basename($filenewname); 
        while (file_exists($uploadPath)) {
            $filenewname="1".$filenewname;
            $uploadPath = $currentDirectory . $uploadDirectory . basename($filenewname); 
        }
        $uploadPath = $currentDirectory . $uploadDirectory . basename($filenewname); 
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
        if ($didUpload) {
            echo "Analiza " . basename($filenewname) . " eshte ngarkuar";
          } else {
            echo "103";
          }
      }
      */
/*
echo $uploadPath;
if (is_uploaded_file($_FILES['file2']['tmp_name'])) 
  {
    $fileType = $_FILES['file2']['type'];
    if (($fileType != 'application/msword' && $fileType != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' && $fileType != 'image/png' &&$fileType != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' && $fileType!='application/pdf' && $fileType != 'image/jpg' && $fileType != 'image/png' && $fileType != 'image/jpeg')) {
        echo $error="101";
    }
    else{
        if ($_FILES['file2']['size'] > 500000) {
            echo "102";
          }else{
            $target_dir = "uploads/";
            $target_file = $target_dir .basename($_FILES['file2']['tmp_name']);
            //echo $target_file;
          }
        
    }
}else{
    echo "100";
}

 
if ($_FILES['my_upload']['size'] > 1000000) 
        {
          echo "102";
            exit;      
      }else{
        $directory=dirname(__DIR__, 2);
        $upload_file_name=$_FILES['file2']['tmp_name'];
        echo " $fileType";
        exit;
        $filename="emrifajllit".
        $dest=$directory.'/uploads/'. $fileType;
        if (move_uploaded_file($_FILES['file2']['tmp_name'], $dest)) 
    {
    	echo 'File Has Been Uploaded !';
    }
       
      }*/
