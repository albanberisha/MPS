<?php
include 'dtbconn.php';
?>
    <!DOCTYPE html>
    <html>

    <head>
        <rel <title>Display all records from Database</title>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
            <script>
                $(document).ready(function() {
                    setInterval(function() {

                        $('#table').load('test-rows.php');
                    }, 59900);
                });
            </script>
            <style>
                .inline {
                    display: inline-block;
                }
            </style>
    </head>

    <body>
        <div id="table">
            <?php

$sqlQuery = "SELECT * FROM tbl_marks";
$result=mysqli_query($conn,$sqlQuery);
$rowcount=mysqli_num_rows($result);
print_r($rowcount);
if($rowcount>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
        echo $rowcount;
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
        </div>

    </body>

    </html>