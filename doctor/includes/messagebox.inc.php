<?php
session_start();
include('config.php');
$from  = $_POST['f'];
$myid = $_SESSION['id'];

?>
<div class="row chatbox" id="Chatbox" style="display: inline;">
   <div class="list-group-item d-flex profile-pic receiver-1">
      <?php
      $query = mysqli_query($con, "SELECT id, name, surname, privilege, online,photo from users WHERE status='1' and id='$from'");
      if (!$query) {
         die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
      } else {
         $data = mysqli_fetch_array($query);
         if ($data > 0) {
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
               <h4 class="pmd-list-title name-surname Step-title"><?php echo htmlentities($data['name']) ?> <?php echo htmlentities($data['surname']) ?></h4>
            </div>
            <a href="javascript:void(0)" class="closechat" id="closechat" onclick="closeChat()">×</a>

      <?php
         }
      }
      ?>
</div>
<script>
            $(document).ready(function() {
               from=<?php echo $from; ?>;
                setInterval(function() {

                  $.ajax({
                    method: "POST",
                    url: "includes/messages.inc.php",
                    data: {
                        f: from,
                        ff: acc
                    }
                })
                .done(function(response) {
                     $("#Messages").html(response);
                });
            return false;
                }, 1000);
            });
        </script>
<div class="messages" id="Messages">
            <?php
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
        </div><div class="type-send">
            <form method="POST" id="message-form" enctype="multipart/form-data">
                <div class="form-group d-inline-flex" onsubmit="return false">
                    <textarea id="text-msg" name='message' class="form-control type-text" rows="1" name="text-type" id="text-type" placeholder="Sheno mesazhin"></textarea>
                    <button id="submit_btn" type="submit" name="submit" class="btn btn-primary btn-send">Dergo</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $("#message-form").submit(function(e) {
         var from='<?php echo $myid ?>';
         var to='<?php echo $from; ?>';
         e.preventDefault();
         var myform = document.getElementById("message-form");
        var fd = new FormData(myform);
        fd.append('from',from);
        fd.append('to',to);
            $message = $('#text-msg').val();
            if ($message==='')
            {
            }else{
               $.ajax({
                  url: "includes/process.php",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                method: 'POST'
            })
            .done(function(response) {
               $('#text-msg').val('');
            });
        }
      });
    </script>