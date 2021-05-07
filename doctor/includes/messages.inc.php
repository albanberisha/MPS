
<?php
session_start();
include('config.php');
$from  = $_POST['f'];
$myid = $_SESSION['id'];
$stat  = $_POST['ff'];
if(strcmp($stat,'1')==0)
            {
                $queryup=mysqli_query($con,"UPDATE messages SET status='1' WHERE msgfrom='$from' and msgto='$myid'");
            }
$query1 = mysqli_query($con, "SELECT * FROM messages WHERE msgfrom='$from' and msgto='$myid' UNION SELECT * FROM messages WHERE msgfrom='$myid' and msgto='$from'  ORDER BY ID DESC ");
if (!$query1) {
    die(mysqli_error($con) . $query1);
} else {
    $message = 'Asnje mesazh per tu shfaqur';
    while ($row = mysqli_fetch_assoc($query1)) {
        $message = "";
        echo "<div class='msg'>";
        if ($row['msgfrom'] == $myid) {
            if($row['status']==1)
            {
                
                echo  "<div class='me seenmessage'>" . $row['message'] . "<span class='receiver-time'>" . $row['datetime'] . "</span></div>";
            }else{
                echo  "<div class='me'>" . $row['message'] . "<span class='receiver-time'>" . $row['datetime'] . "</span></div>";
            }
           
        } else {
            echo  "<div class='receiver'>" . $row['message'] . "<span class='receiver-time'>" . $row['datetime'] . "</span></div>";
        }
        echo "</div>";
    }
}
?>