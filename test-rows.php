<?php
include 'dtbconn.php';

$sqlQuery = "SELECT * FROM tbl_marks";
$result=mysqli_query($conn,$sqlQuery);

if(mysqli_num_rows($result)>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
        echo "<div>";
        echo "<div class='inline'>";
        echo $row['student_id']; 
        echo "</div>";
        echo "<div class='inline'>";
        echo $row['student_name'];
        echo "</div>";
        echo "<div class='inline'>";
        echo $row['marks'];
        echo "</div>";
        echo "</div>";
    }

}else{
    echo "nuk ka te dhena";
}

  
?>