<?php
session_start();
error_reporting(0);
include("includes/config.php");

function validation($form_data)
{
    $form_data = trim(stripcslashes(htmlspecialchars($form_data)));
    return $form_data;
}

function loginerror()
{
    $_SESSION['errmsg'] = "Emaili ose username i gabuar.";
    $extra = "index.php";
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("location:http://$host$uri/$extra");
    exit();
}

function userlog($con, $userId, $username, $loginDate, $loginTime, $status)
{

    $log = mysqli_query($con, "INSERT INTO userlog(userId,username,loginDate,loginTime,status) values('$userId','$username','$loginDate','$loginTime','$status')");
}
$sql = mysqli_query($con, "SELECT * FROM hospital_details");
$num = mysqli_fetch_array($sql);
if ($num > 0) {
} else {
    $logofirst = addslashes(file_get_contents("img/hospital-logo.png"));
    $sql = mysqli_query($con, "INSERT INTO hospital_details(name, initials, logo) VALUES ('Qendra Klinike Universitare e Kosoves', 'QKUK','$logofirst')");
    if ($sql) {
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
$sql = mysqli_query($con, "SELECT * FROM users");
$num = mysqli_fetch_array($sql);
if ($num > 0) {
} else {
    $psw = 'admin';
    $photo = addslashes(file_get_contents("img/empty-img.png"));
    $password = password_hash($psw, PASSWORD_BCRYPT);
    $sql = mysqli_query($con, "INSERT INTO users(username, password, privilege,photo) VALUES ('admin', '$password', 'admin','$photo')");
    if ($sql) {
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}



if (isset($_POST['submit'])) {
    $user_username = $_POST['username'];
    $user_pasword = $_POST['password'];

    $date = date("Y-m-d");
    $time = date("h:i:sa");
    $status = 0;

    $ret = mysqli_query($con, "SELECT * FROM users WHERE email='" . $_POST['username'] . "'");
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        $dbpass = $num['password'];
        if (password_verify($user_pasword, $dbpass)) {
            print($num['username']);
            $extra = "admin/dashboard.php"; //
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
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Kyqja</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    </style>
</head>

<body>
    <div class="login">
        <div class="text-center">
            <?php
            $query = "SELECT * FROM hospital_details";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_array($result);
            if($row['logo']==Null)
            {}else{
            echo '  
                     <img src="data:image/jpeg;base64,' . base64_encode($row['logo']) . '" height="100" width="100" />  
                     ';
                    }
            ?>
        </div>
        <div>
            <form method="post" name="login-form">
                <p>
                    <span style="color:red;"><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg'] = ""); ?></span>
                </p>
                <div class="text-center">
                    <label class="col-form-label">Emaili ose Username:</label>
                    <input class="form-control" type="text" name="username" placeholder="Emaili ose username" required />
                </div>
                <div class="text-center">
                    <label class="col-form-label">Paswordi:</label>
                    <input class="form-control" type="password" name="password" placeholder="Paswordi" />
                </div>
                <div class="text-center col-form-label">
                    <button type="submit" name="submit" class="btn-primary" style="width: 100%; border: 1px solid blue; border-radius: 5px; padding: 3px;">Kyquni</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>