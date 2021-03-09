<?php
session_start();
include('config.php');
$myid = $_SESSION['id'];
?>
        <ul class="list-group pmd-list pmd-card-list pmd-inset-divider">
            <?php
            $query = mysqli_query($con, "SELECT id, name, surname, privilege, online,photo from users WHERE status='1' and id!='$myid' order By online DESC, name ASC");
            if (!$query) {
                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
            } else {
                while (($data = mysqli_fetch_array($query))) {
            ?>
                    <li id="user-row" class="list-group-item d-flex profile-pic new-ntf" onclick="openChat()">
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
                        <div class="media-body">
                            <h4 class="pmd-list-title name-surname Step-title"> <?php echo htmlentities($data['name']); ?> <?php echo htmlentities($data['surname']); ?></h4>
                            <p class="pmd-list-subtitle position"> <?php echo htmlentities($data['privilege']); ?></p>
                        </div>
                        <?php
                        if ($data['online'] == 1) {
                        ?>
                            <div class=" status">
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class=" status-offline">
                            </div>
                        <?php
                        }
                        ?>
                    </li>

            <?php
                }
            }
            ?>
        </ul>