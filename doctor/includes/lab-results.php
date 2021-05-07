<?php
session_start();
error_reporting(0);
include('config.php');
$patient = null;
if (isset($_GET['view'])) {
    $patient = $_GET['id'];
}
$query = mysqli_query($con, "SELECT patients.id from patients WHERE patients.status=1 and patients.id='$patient' UNION SELECT patients.id FROM patients WHERE patients.id='$patient' and patients.id IN( SELECT deaths.patientId FROM deaths)");
if (!$query) {
    die(mysqli_error($con) . $query);
} else {
    $data = mysqli_fetch_array($query);
    if ($data > 0) {
        $query6 = mysqli_query($con, "SELECT analyzes.id, analyzes.releaseDate,pricing_list.id as pricid,pricing_list.name as analysename,users.id as userid,users.name,users.surname,analyzes.documentPath from analyzes,users,pricing_list where analyzes.analyse_id=pricing_list.id and analyzes.status='1' and analyzes.userId=users.id and analyzes.patientId='$patient' ORDER BY releaseDate DESC");
        if (!$query6) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
?>
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-12">
                        <div class="card">
                            <div style="padding-bottom: 0;">
                                <h6 class="panel-title panel-white text-center col-header">Rezultatet nga laboratori</h6>
                            </div>
                            <div class="card-body card-top">
                                <table class="data-list min-height dignosis color-none">
                                    <tbody>
                                        <tr>
                                            <th class="panel-title title2">
                                                Data:
                                            </th>
                                            <th class="panel-title title2 ">
                                                Laboratoristi:
                                            </th>
                                            <th class="panel-title title2 ">
                                                Emri i analizes:
                                            </th>
                                            <th class="panel-title title2 ">
                                                Analiza:
                                            </th>
                                        </tr>
                                        <?php
                                        $message = "Asnje per tu shfaqur.";
                                        while ($data6 = mysqli_fetch_array($query6)) {
                                            $message = "";
                                        ?>
                                            <tr>
                                                <td class="title2">
                                                <?php  echo htmlentities($data6['releaseDate']) ?>
                                                </td>
                                                <td class="title2">
                                                <?php  echo htmlentities($data6['name']) ?>  <?php  echo htmlentities($data6['surname']) ?>
                                                </td>
                                                <td class="title2">
                                                <?php  echo htmlentities($data6['analysename']) ?>
                                                </td>
                                                <td class="title2">
                                                <?php
                                                $filenewname=$data6['documentPath'];
                                                $extra = "../../uploads"; //
                        $host = $_SERVER['HTTP_HOST'];
                        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                                                ?>
                                                    <a href="<?php echo "http://".$host.$uri."/".$extra."/".$filenewname;?>">Analiza</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        echo "<tr><td>" . $message . "</td></tr>";
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>





<?php
        }
    } else {
        echo "Te dhena te panjohura.";
    }
}
?>