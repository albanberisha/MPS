<?php
include('config.php');
session_start();
error_reporting(0);
$userid = $_POST['id'];
$table = $_POST['table'];

if (strcmp($table, "analyzes") == 0) {
    $analyzeid=$userid;
    deleteanalyzes($con, $analyzeid);
}elseif (strcmp($table, "analyzes-report") == 0) {
    $analyzeid=$userid;
    deleteanalyzereport($con, $analyzeid);
}else{
    $echo="error";
}

function deleteanalyzes($con, $analyzeid)
{
    $query=mysqli_query($con,"UPDATE analyzes SET status='2' WHERE id='$analyzeid'");
    if (!$query) {
        die(mysqli_error($con).$query);
    } else {
        $userid=$_SESSION['id'];
        $query2 = mysqli_query($con,"SELECT analyzes.id,analyzes.patientId,analyzes.releaseDate,patients.name,patients.surname,patients.patientID,pricing_list.name as analysedesc from patients,analyzes,pricing_list WHERE analyzes.patientId=patients.id and analyzes.analyse_id=pricing_list.id and pricing_list.status='1' and analyzes.status='1' and analyzes.userId='$userid' and DATE(analyzes.releaseDate) = CURDATE() ORDER BY id DESC");
         if (!$query2) {
            die(mysqli_error($con).$query2);
             }else{
                 $count=1;
                while ($data2 = mysqli_fetch_array($query2)) {
                    $count
                    ?>
                    <tr>
                            <td class="rezid">
                            <?php echo $count; ?>
                            </td>
                            <td class="rezdesc">
                            <?php echo htmlentities($data2['patientID']) ?>
                            </td>
                            <td class="rezdate">
                            <?php echo htmlentities($data2['analysedesc']) ?>
                            </td>
                            <td class="rezdept">
                            <?php echo htmlentities($data2['releaseDate']) ?>
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
function deleteanalyzereport($con, $analyzeid)
{
    $query=mysqli_query($con,"UPDATE analyzes SET status='2' WHERE id='$analyzeid'");
    if (!$query) {
        die(mysqli_error($con).$query);
    } else {
        $userid=$_SESSION['id'];
        $query2 = mysqli_query($con,"SELECT analyzes.id, patients.id as patientId,patients.patientID as personalnumber,analyzes.analyse_id,pricing_list.name as analyzename,analyzes.releaseDate,patients.name, patients.surname from patients,analyzes,pricing_list where analyzes.patientId=patients.id and analyzes.analyse_id=pricing_list.id and analyzes.status='1' and patients.status='1' and pricing_list.status='1' ORDER BY analyzes.releaseDate DESC");
         if (!$query2) {
            die(mysqli_error($con).$query2);
             }else{
                 $count=1;
                while ($data2 = mysqli_fetch_array($query2)) {
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