<?php
include('config.php');

$userid = $_POST['id'];
$table = $_POST['table'];


if (strcmp($table, "users-receptionists") == 0) {
    deletereceptionist($con, $userid);
} elseif (strcmp($table, "infirmiers") == 0) {
    deleteinfirmier($con, $userid);
} elseif (strcmp($table, "staff") == 0) {
    deletestaff($con, $userid);
}elseif (strcmp($table, "medicaments") == 0) {
    $medid=$userid;
    deletemedicament($con, $medid);
}


function deletereceptionist($con, $id)
{
    $query = mysqli_query($con, "UPDATE users SET status='2' WHERE id='$id' ");
    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
    } else {
        $query = mysqli_query($con, " SELECT id, name, surname, username from users where status=1 and privilege='receptionist'");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $count = 1;
            while (($data = mysqli_fetch_array($query))) {
?>
                <tr>
                    <td class="did">
                        <?php echo $count; ?>
                    </td>
                    <td class="dname">
                        <?php echo htmlentities($data['name']); ?>
                    </td>
                    <td class="dsname">
                        <?php echo htmlentities($data['surname']); ?>
                    </td>
                    <td class="dspec">
                        <?php echo htmlentities($data['username']); ?>
                    </td>
                    <td class=" actions">
                        <span class="edit-data">
                            <a href="edit-receptionist.php?id=<?php echo $data['id'] ?>&edit=receptionist">
                                <img src="img/edit-icon.png"> </a>
                        </span>
                        <span class="delete-data">
                            <a href="#" onclick="deleteuser(<?php echo $data['id'] ?>);">
                                <img src="img/delete-icon.png">
                            </a>
                        </span>
                    </td>
                </tr>
            <?php
                $count++;
            }
        }
    }
}


function deleteinfirmier($con, $id)
{
    $query = mysqli_query($con, "UPDATE users SET status='2' WHERE id='$id' ");
    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
    } else {
        $query = mysqli_query($con, " SELECT users.id, users.name, users.surname, departaments.depname from users, infirmiers ,departaments where (infirmiers.userId=users.id and users.status=1) and infirmiers.depId=departaments.id");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $count = 1;
            while (($data = mysqli_fetch_array($query))) {
            ?>

                <tr>
                    <td class="iid">
                        <?php echo $count; ?>
                    </td>
                    <td class="iname">
                        <?php echo htmlentities($data['name']); ?> </td>
                    <td class="isname">
                        <?php echo htmlentities($data['surname']); ?> </td>
                    <td class="idep">
                        <?php echo htmlentities($data['depname']); ?>
                    </td>
                    <td class=" actions">
                        <span class="edit-data">
                            <a href="edit-infirmier.php?id=<?php echo $data['id'] ?>&edit=infirmier">
                                <img src="img/edit-icon.png"> </a>
                        </span>
                        <span class="delete-data">
                            <a href="#" onclick="deleteuser(<?php echo $data['id'] ?>);">
                                <img src="img/delete-icon.png">
                            </a>
                        </span>
                    </td>
                </tr>
            <?php
                $count++;
            }
        }
    }
}

function deletestaff($con, $id)
{
    $query = mysqli_query($con, "UPDATE additional_staff SET status='2' WHERE id='$id' ");
    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
    } else {
        $query = mysqli_query($con, " SELECT additional_staff.id, additional_staff.name, additional_staff.surname, hospital_additional_staff.name as pos_name from additional_staff, hospital_additional_staff where additional_staff.status=1 and additional_staff.position=hospital_additional_staff.id ");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $count = 1;
            while (($data = mysqli_fetch_array($query))) {
            ?>
                <tr>
                    <td class="sid">
                        <?php echo $count; ?>
                    </td>
                    <td class="sname">
                        <?php echo htmlentities($data['name']); ?>
                    </td>
                    <td class="ssname">
                        <?php echo htmlentities($data['surname']); ?>
                    </td>
                    <td class="spos">
                        <?php echo htmlentities($data['pos_name']); ?>

                    </td>
                    <td class=" actions">
                        <span class="edit-data">
                            <a href="edit-staf.php?id=<?php echo $data['id'] ?>&edit=staff">
                                <img src="img/edit-icon.png"> </a>
                        </span>
                        <span class="delete-data">
                            <a href="#" onclick="deletestaf(<?php echo $data['id'] ?>);">
                                <img src="img/delete-icon.png">
                            </a>
                        </span>
        <?php
                $count++;
            }
        }
    }
}

function deletemedicament($con, $medid)
{
    $query = mysqli_query($con, "UPDATE medicaments SET status='2' WHERE id='$medid' ");
    if (!$query) {
        die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
    } else {
        $query = mysqli_query($con, "SELECT * from medicaments where status='1' ORDER BY quantity-lowStock ASC");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $count = 1;
            while (($data = mysqli_fetch_array($query))) {
                $today = date("Y-m-d");
                if ($data['expired_date'] <= $today) {
        ?>
                    <tr style="background-color: red; color:white;">
                    <?php
                } elseif($data['lowStock']>=$data['quantity']) {
                    ?>
                    <tr style="color:red;">
                    <?php
                }else{
                    ?>
                    <tr>
                    <?php
                }
                    ?>
                        <td class="mid">
                            <?php
                            echo $count; ?>
                        </td>
                    <?php
                    ?>
                    <td class="medname">
                        <?php echo htmlentities($data['name']); ?>
                    </td>
                    <td class="expdate">
                        <?php
                        $today = date("Y-m-d");
                        echo htmlentities($data['expired_date']); ?>
                    </td>
                    <td class="desc">
                    <?php echo htmlentities($data['quantity']); ?> [<?php echo htmlentities($data['lowStock']); ?>]
                    </td>
                    <td class=" actions">
                        <span class="edit-data">
                            <a href="edit-medicament.php?id=<?php echo $data['id'] ?>&edit=medicament">
                                <img src="img/edit-icon.png"> </a>
                        </span>
                        <span class="delete-data">
                            <a href="#" onclick="deletemedicament(<?php echo $data['id'] ?>);">
                                <img src="img/delete-icon.png">
                            </a>
                        </span>
                    </td>
                    </tr>
            <?php
                $count++;
            }
        }
    }
}
        ?>