<?php
session_start();
include('../includes/config.php');
$myid = $_SESSION['id'];

?>
<script>
function loaddata(from)
{
    alert(from);
}
</script>
    <div class="row chatbox" id="Chatbox" style="display: inline;">
    <script>
            $(document).ready(function() {
                setInterval(function() {

                    $('#MSEq').load('includes/chatbox.php?from=<?php echo $from?>&view=message');
                }, 10000);
            });
        </script>
        <div class="list-group-item d-flex profile-pic receiver-1">
        <?php
       $query = mysqli_query($con, "SELECT id, name, surname, privilege, online,photo from users WHERE status='1' and id='$from'");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $data = mysqli_fetch_array($query);
            if($data>0)
            {
            ?>
            <a href="javascript:void(0);" class="pmd-avatar-list-img" title="profile-link">
                    <?php
                    if ($data['photo'] == Null) {
                    ?>
                        <img alt="40x40" src="../img/empty-img.png">
                    <?php
                    } else {

                        echo '<img alt="40x40" src="data:image/jpeg;base64,' . base64_encode($data['photo']) . '" />  ';
                    }
                    ?>
                </a>
            <div class="media-body d-inline-flex">
                <h4 class="pmd-list-title name-surname Step-title"><?php echo htmlentities($data['name'])?> <?php echo htmlentities($data['surname'])?></h4>
            </div>
            <a href="javascript:void(0)" class="closechat" id="closechat" onclick="closeChat()">×</a>
    
            <?php
             }
        }
        ?>
        
        </div>

        <div class="messages" id="Messages">
            <?php
            
            $query1=mysqli_query($con,"SELECT * FROM messages WHERE msgfrom='$from' and msgto='$myid' UNION SELECT * FROM messages WHERE msgfrom='$myid' and msgto='$from'  ORDER BY ID DESC ");
            if(!$query1)
            {
                die(mysqli_error($con).$query1);
            }else{
                $message='Asnje mesazh per tu shfaqur';
                while($row=mysqli_fetch_assoc($query1))
                {
                    $message="";
                    echo "<div class='msg'>";
       if($row['msgfrom']==$myid)
       {
        echo  "<div class='me'>".$row['message']."<span class='receiver-time'>".$row['datetime']."</span></div>";
       }
       else{
        echo  "<div class='receiver'>".$row['message']."<span class='receiver-time'>".$row['datetime']."</span></div>";
       }
       echo "</div>";
                }

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