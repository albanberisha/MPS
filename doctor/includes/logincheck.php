<?php
function check_login()
{
    include("includes/config.php");
    $privilege="doctor";
    $username=$_SESSION['login'];
    $sql="SELECT * From users WHERE username=? and privilege=? and status=1";
    $stmt=mysqli_stmt_init($con);
    //prepare the prepared statement
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        echo "Probleme me arunzhim te te dhenave.";
    }else{

        //Bind parameters to the placeholder
        mysqli_stmt_bind_param($stmt, "ss",$username,$privilege);
        //run parameters inside database
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
       $num=mysqli_fetch_assoc($result);
        if($num==0)
        {	
            $host = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra="../index.php";		
            $_SESSION["login"]="";
            header("Location: http://$host$uri/$extra");
        }
    }
}
/*
$sql1=mysqli_query($con,"SELECT * FROM users WHERE username='".$_SESSION['login']."' and privilege='admin'");
$num = mysqli_fetch_array($sql1);
if($sql1)
{
   
    if($num==0)
        {	
            $host = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $extra="../index.php";		
            $_SESSION["login"]="";
            header("Location: http://$host$uri/$extra");
        }

}else{
    echo "Probleme me databaze";
}
*/
?>