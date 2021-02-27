<?php
include('config.php');
?>

<div class="main-body">
    <div class="row gutters-sm">
        <div class="col-md-12">
            <div class="form-group">
                <label class="input-title" for="HospitalDepartaments">
                    Shto nje departament te ri:
                </label>
                <div id="New-departament">
                    <div class="card">
                        <div class="form-group">
                            <form id="addDep_form" method="post">
                                <div class="form-group">
                                <label class="input-title" for="DepRoom">Shenoni emrin e departamentit</label>
                                <input type="text" id="DepName" class="form-control" placeholder="Sheno emrin e departamentit">
                                    <p id="ResponseDepAdd" style="color:red;"></p>
                                </div>
                                <div class="form-group" style="margin-top: 10px;"><button type="submit" class="btn btn-primary">Shto</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div style="padding-bottom: 0;">
                    <h6 class="panel-title panel-white text-center col-header">Departamentet</h6>
                </div>
                <div class="card-body card-top">
                    <p id="Response" style="color:red;"></p>
                    <table class="data-list min-height dignosis color-none">
                        <tbody id="Departaments">
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
                                        <td>
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
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#NewDepartament").click(function() {
            var html = '<div class="card"> <div class="form-group"><form  id="addDep_form" method="post"><div class="form-group"><label class="input-title" for="DepRoom">Shenoni emrin e departamentit</label><input type="text" id="DepName" class="form-control" placeholder="Sheno emrin e departamentit">  <p id="ResponseDepAdd" style="color:red;"></p></div><div class="form-group" style="margin-top: 10px;"><button type="submit" class="btn btn-primary">Shto</button></div></form></div></div>';
            //$("#New-departament").html(html);
        });
    });
</script>
<script type="text/javascript">
    function deletedep($id, $row) {
        $('#ResponseDepAdd').html("");
        $confirm = confirm('A jeni te sigurte qe deshironi ta fshini departamentin?');
        //console.log('my message' + $confirm);
        if ($confirm) {
            $.ajax({
                    method: "POST",
                    url: "includes/delete-departament.inc.php",
                    data: {
                        id: $id,
                        row: $row
                    }
                })
                .done(function(response) {
                    if (response == 1) {
                        $('#Response').html("Departamenti nuk mund te fshihet sepse ka dhoma aktive ne te.");
                    } else {
                        $("#Departaments").html(response);
                        $('#Response').html("Fshierja u krye me sukses.");
                        //$("#"+response).load('includes/delete-departament.inc.php #'+response,"");
                    }
                });
            return false;
        } else {
            $('#Response').html("Fshierja u anulua.");
        }
    }
    $("#addDep_form").submit(function(e) {
        e.preventDefault();
        $('#Response').html("");
        $depname = $('#DepName').val();
        if ($depname == "") {
            $('#ResponseDepAdd').html("Emri i departamentit nuk mund te jete i zbrazet!");
        } else {
            var patt = new RegExp("^[a-zA-Z0-9_. -]*$"); //only letters, numbers and -
            var res = patt.test($depname);
            if (res) {
                $confirm = confirm('A deshironi ta shtoni departamentin: ' + $depname + ' ?');
                if ($confirm) {
                    $.ajax({
                            method: "POST",
                            url: "includes/add-departament.inc.php",
                            data: {
                                name: $depname
                            }
                        })
                        .done(function(response) {
                            if (response == "error") {
                                $('#ResponseDepAdd').html("Departamenti ekziston!.");
                            } else {
                                $("#Departaments").html(response);
                                $('#ResponseDepAdd').html("Shtimi u krye me sukses.");
                            }

                        });
                    return false;
                } else {
                    $('#ResponseDepAdd').html("Shtimi u anulua.");
                }
            } else {
                $('#ResponseDepAdd').html("Emri i departamentit mund te permbaje: shkronja, numra dhe -");
            }
        }
    });

    function depExists($name) {
        $query = mysqli_query($con, "SELECT * from departaments WHERE depstatus=1");

        if (!$query) {
            die("E pamundur te azhurohen te dhenat: ".mysqli_connect_error());
        } else {
            if ($data = mysqli_fetch_array($query)) {
                return true;
            } else {
                return false;
            }
        }
    }
</script>