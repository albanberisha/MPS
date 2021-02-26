<?php
session_start();
error_reporting(0);
include("config.php");

function loginerror()
{
    $_SESSION['errmsg'] = "Emaili ose username i gabuar.";

}

function userlog($con, $userId, $username, $loginDate, $loginTime, $status)
{

    $sql="INSERT INTO userlog(userId,username,loginDate,loginTime,status) values(?,?,?,?,?)";
    $stmt=mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        echo "Probleme me databaze.";
    }else{
        mysqli_stmt_bind_param($stmt,"sssss",$userId, $username, $loginDate, $loginTime, $status);
        mysqli_stmt_execute($stmt);
    }
    //$log = mysqli_query($con, "INSERT INTO userlog(userId,username,loginDate,loginTime,status) values('$userId','$username','$loginDate','$loginTime','$status')");
}



if (isset($_POST['submit'])) {

    $user_username = mysqli_real_escape_string($con,$_POST['username']);
    $user_pasword =mysqli_real_escape_string($con,$_POST['password']);
    $date = date("Y-m-d");
    $time = date("h:i:sa");
    $status = 0;

    $sql="SELECT * FROM users WHERE email=?";
    $stmt=mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($con,$stmt))
    {
        echo "Error: ". $con->error;
    }else{

        mysqli_stmt_bind_param($stmt,"s",$user_username);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        $num = mysqli_fetch_array($result);

        if($num>0)
        {
            $dbpass = $num['password'];
            if (password_verify($user_pasword, $dbpass)) {
                $extra = "/admin2/dashboard.php"; //
                $_SESSION['login'] = $num['username'];
                $_SESSION['id'] = $num['id'];
                $host = $_SERVER['HTTP_HOST'];
                $uip = $_SERVER['REMOTE_ADDR'];
                $status = 1;
                userlog($con, $num['id'], $num['username'], $date, $time, $status);
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                header("location:http://$host$uri/$extra?login=success");;
                exit();
            }else{

            }
        }else{

        }
    }

    $ret = mysqli_query($con, "SELECT * FROM users WHERE email='" . $_POST['username'] . "'");
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        $dbpass = $num['password'];
        if (password_verify($user_pasword, $dbpass)) {
            print($num['username']);
            $extra = "admin2/dashboard.php"; //
            $_SESSION['login'] = $num['username'];
            $_SESSION['id'] = $num['id'];
            $host = $_SERVER['HTTP_HOST'];
            $uip = $_SERVER['REMOTE_ADDR'];
            $status = 1;
            userlog($con, $num['id'], $num['username'], $date, $time, $status);
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("location:http://$host$uri/$extra?login=success");;
            exit();
        } else {
            userlog($con, $num['id'], $num['username'], $date, $time, $status);
            loginerror();
        }
    } else {
        $ret = mysqli_query($con, "SELECT * FROM users WHERE username='" . $_POST['username'] . "'");
        $num = mysqli_fetch_array($ret);
        if ($num > 0) {
            $dbpass = $num['password'];
            if (password_verify($user_pasword, $dbpass)) {
                $extra = "admin/dashboard.php"; //
                $_SESSION['login'] = $num['username'];
                $_SESSION['id'] = $num['id'];
                $host = $_SERVER['HTTP_HOST'];
                $uip = $_SERVER['REMOTE_ADDR'];
                $status = 1;
                userlog($con, $num['id'], $num['username'], $date, $time, $status);
                $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                header("location:http://$host$uri/$extra?login=success");
                exit();
            } else {
                userlog($con, $num['id'], $num['username'], $date, $time, $status);
                loginerror();
            }
        } else {
            loginerror();
        }
    }
}
?>