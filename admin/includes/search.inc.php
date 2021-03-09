<?php
include('config.php');

$user_name = $_POST['name'];
$table = $_POST['table'];

if (strcmp($table, "doctors") == 0) {
    searchdoctor($con, $user_name);
} elseif (strcmp($table, "users-receptionists") == 0) {
    searchreceptionist($con, $user_name);
} elseif (strcmp($table, "infirmiers") == 0) {
    searchinfirmier($con, $user_name);
} elseif (strcmp($table, "patients") == 0) {
    $patient_name = $user_name;
    searchpatient($con, $patient_name);
}elseif(strcmp($table, "staff") == 0) {
    $staf_name = $user_name;
    searchstaff($con, $staf_name);
}elseif(strcmp($table, "session-logs") == 0) {
    searchuser_logs($con, $user_name);
}elseif(strcmp($table, "medicaments") == 0) {
    $medname=$user_name;
    searchmedicaments($con,  $medname);
}



function searchdoctor($con, $user_name)
{
    if (empty($user_name) || (!preg_match("/^([a-zA-Z' ]+)$/", $user_name))) {
        echo $error = "error";
    } else {
        $query = mysqli_query($con, "SELECT users.id as id,users.name as name, users.surname as surname, doctors.specialties as spetialities, specialties.description as spetialitiesname from users,doctors, specialties where (doctors.userId=users.id and users.status=1) and(specialties.id=doctors.specialties) and users.name like '%$user_name%'");
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
                        <?php echo htmlentities($data['spetialitiesname']); ?>
                    </td>
                    <td class=" actions">
                        <span class="edit-data">
                            <a href="includes/edit-doctor.php?id=<?php echo $data['id'] ?>&edit=doctor">
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




function searchreceptionist($con, $user_name)
{
    if (empty($user_name) || (!preg_match("/^([a-zA-Z' ]+)$/", $user_name))) {
        echo $error = "error";
    } else {
        $query = mysqli_query($con, "SELECT id, name, surname, username from users where status=1 and privilege='receptionist' and users.name like '%$user_name%'");
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

function searchinfirmier($con, $user_name)
{
    if (empty($user_name) || (!preg_match("/^([a-zA-Z' ]+)$/", $user_name))) {
        echo $error = "error";
    } else {
        $query = mysqli_query($con, " SELECT users.id, users.name, users.surname, departaments.depname from users, infirmiers ,departaments where (infirmiers.userId=users.id and users.status=1) and infirmiers.depId=departaments.id and users.name like '%$user_name%'");
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

function searchpatient($con, $patient_name)
{
    if (empty($patient_name) || (!preg_match("/^([a-zA-Z' ]+)$/", $patient_name))) {
        echo $error = "error";
    } else {
        $query = mysqli_query($con, "SELECT id, name, surname, phone, gender from patients where status='1' and name like '%$patient_name%'");
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $count = 1;
            while (($data = mysqli_fetch_array($query))) {
            ?>
                <tr>
                    <td class="pid">
                        <?php echo $count; ?>
                    </td>
                    <td class="pname">
                        <?php echo htmlentities($data['name']); ?>

                    </td>
                    <td class="psname">
                        <?php echo htmlentities($data['surname']); ?>
                    </td>
                    <td class="pcontact">
                        <?php echo htmlentities($data['phone']); ?>

                    </td>
                    <td class="pgender">
                        <?php echo htmlentities($data['gender']); ?>

                    </td>
                    <td class="actions">
                        <span class="edit-data">
                            <a href="view-patient.php?id=<?php echo $data['id'] ?>&view=patient">
                                <img src="img/eye-icon.png"> </a>
                        </span>
                    </td>
                </tr>
<?php
                $count++;
            }
        }
    }
}


function searchstaff($con, $staff_name)
{
    if (empty($staff_name) || (!preg_match("/^([a-zA-Z' ]+)$/", $staff_name))) {
        echo $error = "error";
    } else {
        $query = mysqli_query($con, " SELECT additional_staff.id, additional_staff.name, additional_staff.surname, hospital_additional_staff.name as pos_name from additional_staff, hospital_additional_staff where additional_staff.status=1 and additional_staff.position=hospital_additional_staff.id and additional_staff.name like '%$staff_name%' ");
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

function searchuser_logs($con, $user_name)
{
    if (empty($user_name) || (!preg_match("/^(?=.{5,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $user_name))) {
        echo $error = "error";
    } else {
        $query=mysqli_query($con,"SELECT * from userlog where username like '%$user_name%' ORDER BY id DESC ");
                        
        if (!$query) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $cnt=1;
          while(($data=mysqli_fetch_array($query)) && $cnt<100)
          {
            ?>
            <tr>
            <td class="logId"><?php echo $cnt;?></td>
            <td class="userId"><?php echo $data['userId'];?></td>
            <td class="uusername"><?php echo $data['username'];?></td>
            <td class="logintime"><?php echo $data['loginDate'];?></td>
            <td class="loginhour"><?php echo $data['loginTime'];?></td>
            <td class="statusLog
            <?php
            if($data['status']==1)
            {
                ?>
                text-success">
                <?php
                echo "Sukses.";
            }else{
                ?>
                text-danger">
                <?php
                echo "Pa sukses.";
            }
            ?>
            </td>
             </tr>
            <?php  
            $cnt=$cnt+1;
          }
        }
    }
}

function searchmedicaments($con,  $medname)
{
    if (empty($medname)) {
        echo $error = "error";
    } else {
        $query = mysqli_query($con, "SELECT * from medicaments where status='1' and name like '%$medname%' ORDER BY quantity-lowStock ASC");
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