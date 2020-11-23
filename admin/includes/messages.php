<?php
include 'dtbconn.php';
$sqlQuery = "SELECT * FROM messages1 ORDER BY ID DESC ";
$result=mysqli_query($conn,$sqlQuery);
$rowcount=mysqli_num_rows($result);
if($rowcount>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
        echo "<div class='msg'>";
        if($row['Nga']==1)
        {
         echo  "<div class='me'>".$row['mesage']."<span class='receiver-time'>".$row['data']."</span></div>";
        }
        else{
         echo  "<div class='receiver'>".$row['mesage']."<span class='receiver-time'>".$row['data']."</span></div>";
        }
        echo "</div>";
    }

}else{
    echo "nuk ka te dhena";
}

?>