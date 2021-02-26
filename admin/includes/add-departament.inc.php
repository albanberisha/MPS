<?php
include('config.php');

$depname = $_POST['name'];
$query = mysqli_query($con, "SELECT * From departaments WHERE depname='$depname' and depstatus=1");
if (!$query) {
    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
} else {
    if($data = mysqli_fetch_array($query)>0)
    {
        echo "error";  
    }else{
        $query1 = mysqli_query($con, "INSERT INTO departaments(depname, depstatus) VALUES('$depname',1)");
        if (!$query1) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
            $query2 = mysqli_query($con, "SELECT * from departaments WHERE depstatus=1");

        if (!$query2) {
            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
        } else {
    ?>
            <tr>
                <th class="panel-title title3 ">
                    Emri
                </th>
                <th class="actionsh">
                </th>
            </tr>
            <?php
            $query = mysqli_query($con, "SELECT * from departaments WHERE depstatus=1");
    
            if (!$query) {
                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
            } else {
                $cnt = 1;
                while (($data = mysqli_fetch_array($query))) {
    
            ?>
                    <tr id="<?php echo $cnt; ?>">
                        <td class="title1">
                            <?php echo htmlentities($data['depname']); ?>
                        </td>
                        <td class=" actions" style="margin-top: -10px;">
                            <span class="delete-data">
                                <a href="#" onclick="deletedep(<?php echo $data['id'] ?>,<?php echo $cnt ?>);">
                                    <img style="margin-top: -15px;" src="img/delete-icon.png">
                                </a>
                            </span>
                        </td>
                    </tr>
    <?php
                    $cnt = $cnt + 1;
                }
            }
        }
        }
    }
}

?>