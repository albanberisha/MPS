<?php
include('config.php');

$user_name = $_POST['name'];
$table = $_POST['table'];
if (strcmp($table, "patients") == 0) {
    $patient_name = $user_name;
    searchpatient($con, $patient_name);
} elseif (strcmp($table, "searchanalyse") == 0) {
    $analyze = $user_name;
    searchanalyze($con, $analyze);
} else {
    echo $error = "error";
}

function searchpatient($con, $patient_name)
{
    if (empty($patient_name) || (!preg_match("/^([a-zA-Z' ]+)$/", $patient_name))) {
        echo $error = "error";
    } else {
        $query = mysqli_query($con, "SELECT id, name, surname, phone, gender,patientId from patients where status='1' and name like '%$patient_name%'LIMIT 100");
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
                        <?php echo htmlentities($data['patientId']); ?>

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

function searchanalyze($con, $analyze)
{
    $isnanme=true;
    $ispersonalid=false;
    if(empty($analyze))
    {
        echo "error";
    }else{
        if(preg_match("/[a-z]/i", $analyze)){
            $isnanme=true;
            $ispersonalid=false;
         }else{
            $isnanme=false;
            $ispersonalid=true;
         }

         if($isnanme)
         {
            $query = mysqli_query($con,"SELECT analyzes.id, patients.id as patientId,patients.patientID as personalnumber,analyzes.analyse_id,pricing_list.name as analyzename,analyzes.releaseDate,patients.name, patients.surname from patients,analyzes,pricing_list where analyzes.patientId=patients.id and analyzes.analyse_id=pricing_list.id and analyzes.status='1' and patients.status='1' and pricing_list.status='1' and patients.name like '%$analyze%' ORDER BY analyzes.releaseDate DESC LIMIT 100"); 
        }else{
            $query = mysqli_query($con,"SELECT analyzes.id, patients.id as patientId,patients.patientID as personalnumber,analyzes.analyse_id,pricing_list.name as analyzename,analyzes.releaseDate,patients.name, patients.surname from patients,analyzes,pricing_list where analyzes.patientId=patients.id and analyzes.analyse_id=pricing_list.id and analyzes.status='1' and patients.status='1' and pricing_list.status='1' and patients.patientID like '%$analyze%' ORDER BY analyzes.releaseDate DESC LIMIT 100"); 
        }
        if (!$query) {
            die(mysqli_error($con).$query);
             }else{
                 $count=1;
                while ($data2 = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                            <td class="rezid">
                            <?php echo htmlentities($data2['personalnumber']) ?>
                            </td>
                            <td class="rezdesc">
                            <?php echo htmlentities($data2['analyzename']) ?>
                            </td>
                            <td class="rezdate">
                            <?php echo htmlentities($data2['releaseDate']) ?>
                            </td>
                            <td class="rezdept">
                            <?php echo htmlentities($data2['name']) ?> <?php echo htmlentities($data2['surname']) ?> 
                            </td>
                            <td class="actions">
                                <span class="edit-data">
                                            <a href="edit-result.php?id=<?php echo $data2['id'] ?>&edit=analyze">
                                                <img src="img/edit-icon.png"> </a>
                                        </span>
                                <span class="delete-data">
                                            <a href="#" onclick="deleteanalyze(<?php echo $data2['id'] ?>);">
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