<?php
include 'dtbconn.php';
?>
    <div class="row chatbox" id="Chatbox">
        <script>
            $(document).ready(function() {
                setInterval(function() {

                    $('#Messages').load('includes/messages.php');
                }, 50000);
            });
        </script>
        <div class="list-group-item d-flex profile-pic receiver-1">
            <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                <img alt="40x40" src="img/doctor.png">
            </a>
            <div class="media-body d-inline-flex">
                <h4 class="pmd-list-title name-surname Step-title">Alban Berisha</h4>
            </div>
            <a href="javascript:void(0)" class="closechat" id="closechat" onclick="closeChat()">×</a>
        </div>

        <div class="messages" id="Messages">
            <?php

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
    echo "<div style='text-align: center;'>Asnje mesazh per tu shfaqur</div>";
}

?>
        </div>

        <div class="type-send">
            <form method="post" id="message-form">
                <div class="form-group d-inline-flex" onsubmit="return false">
                    <textarea id="text-msg" class="form-control type-text" rows="1" name="text-type" id="text-type" placeholder="Sheno mesazhin"></textarea>
                    <button id="submit_btn" type="submit" name="submit" class="btn btn-primary btn-send">Dergo</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $("#message-form").on("submit", function(e) {
            var dataString = $(this).serialize();
            $message = $('#text-msg').val();
            if ($.trim($message) != '')
                $.ajax({
                    type: "POST",
                    url: "includes/process.php",
                    data: dataString,
                    success: function() {
                        $('#text-msg').val('');
                    }
                });


            e.preventDefault();
        });
    </script>