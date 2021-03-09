<?php
include('config.php');

?>
<div class="main-body">
    <div class="row gutters-sm">
        <div class="col-md-12">
            <div class="form-group">
                <label class="input-title" for="HospitalDepartaments">
                    Shto nje dhome te re:
                </label>
                <div id="New-room">
                    <div class="card">
                        <p id="ResponseRoom" style="color:red;"></p>

                        <div class="form-group">
                            <?php
                            $query = mysqli_query($con, "SELECT * from departaments WHERE depstatus=1");
                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                            } else {
                                $data = mysqli_fetch_array($query);
                                if ($data > 0) {
                            ?>
                                    <form id="addroom_form" method="post">
                                        <div class="form-group">
                                            <label class="input-title" for="DepRoom">
                                                Zgjedh departamentin:
                                            </label>
                                            <select name="DepRoom" id="DepRoom" class="form-control doctorposition" required="true">
                                                <option value="">Zgjedh departamentin</option>
                                                <?php
                                                $query = mysqli_query($con, "SELECT * from departaments WHERE depstatus=1");

                                                if (!$query) {
                                                    die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                                                } else {
                                                    $cnt = 1;
                                                    while (($data = mysqli_fetch_array($query))) {
                                                ?>
                                                        <option value="<?php echo htmlentities($data['id']) ?>"><?php echo htmlentities($data['depname']) ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group" style="margin-top: 10px;">
                                            <button type="submit" class="btn btn-primary">Shto</button>
                                        </div>
                                    </form>
                                <?php

                                } else {
                                ?>
                                    <p>Asnje departament per tu shfaqur.</p>
                            <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="input-title" for="HospitalDepartaments">
                    Shto nje shtrat te ri:
                </label>
                <div id="New-bed">
                    <div class="card">
                        <p id="ResponseBed" style="color:red;"></p>
                        <div class="form-group">
                            <?php
                            $query = mysqli_query($con, "SELECT * from rooms where roomstatus='1'");
                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                            } else {
                                $data = mysqli_fetch_array($query);
                                if ($data > 0) {
                            ?>
                                    <form id="addbed_form" method="post">
                                        <div class="form-group">
                                            <label class="input-title" for="BedRoom">
                                                Zgjedh dhomen:
                                            </label>
                                            <select name="BedRoom" id="BedRoom" class="form-control doctorposition" required="true">
                                                <option value="">Zgjedh dhomen:</option> <?php
                                                                                            $query1 = mysqli_query($con, "SELECT departaments.depname, rooms.id from rooms ,departaments WHERE rooms.roomstatus='1' && rooms.depId=departaments.id");

                                                                                            while (($data1 = mysqli_fetch_array($query1))) {
                                                                                            ?>
                                                    <option value="<?php echo htmlentities($data1['id']); ?>">Dhoma nr:<?php echo htmlentities($data1['id']) ?> <?php echo htmlentities($data1['depname']) ?></option>
                                                <?php
                                                                                            }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group" style="margin-top: 10px;">
                                            <button type="submit" class="btn btn-primary">Shto</button>
                                        </div>
                                    </form>
                                <?php
                                } else {
                                ?>
                                    <p>Asnje dhome per tu shfaqur.</p>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="input-title" for="HospitalDepartaments">
                    Filtro sipas departamenteve:
                </label>
                <form id="filter_form" method="post">
                    <select name="filterDepartaments" id="filterDepartaments" class="form-control doctorposition" required="true">
                        <option value="all">Të gjitha</option>
                        <?php
                        $query = mysqli_query($con, "SELECT * from departaments WHERE depstatus=1");

                        if (!$query) {
                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                        } else {
                            $cnt = 1;
                            while (($data = mysqli_fetch_array($query))) {
                        ?>
                                <option value="<?php echo htmlentities($data['id']) ?>"><?php echo htmlentities($data['depname']) ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <div class="form-group" style="margin-top: 10px;">
                        <button type="submit" class="btn btn-primary">filtro</button>
                    </div>
                    <form>
            </div>
            <div class="row gutters-sm " id="pdf">
                <div class="col-md-6 mb-3">
                <p id="ResponseBedDelete" style="color:red;"></p>
                    <div class="panel-body no-padding">
                        <div class="panel-heading">
                            <h5 class="panel-title panel-white text-center">Shtreterit</h5>
                        </div>
                        
                        <table class="data-list min-height">
                            <tr class="table-head ">
                                <td class="bidh">Numri i shtratit</td>
                                <td class="ridh">Numri i dhomes</td>
                                <td class="deph">Departamenti</td>
                                <td class="actionsh">
                            </tr>
                        </table>
                        <table class="data-list" id="Beds">
                            <?php
                            $query = mysqli_query($con, "SELECT beds.id as bedid, rooms.id as roomid, departaments.depname as depname
                        from beds JOIN rooms JOIN departaments 
                        where beds.bedstatus=rooms.roomstatus=departaments.depstatus=1 &&(beds.roomId=rooms.id && rooms.depId=departaments.id)  ORDER BY beds.id ASC");

                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                            } else {
                                $cnt = 1;
                                while (($data = mysqli_fetch_array($query))) {
                            ?>
                                    <tr>
                                        <td class="bid">
                                            <?php echo htmlentities($data['bedid']); ?>
                                        </td>
                                        <td class="rid">
                                            <?php echo htmlentities($data['roomid']); ?>
                                        </td>
                                        <td class="dep">
                                            <?php echo htmlentities($data['depname']); ?>
                                        </td>
                                        <td class=" actions" style="margin-top: -10px;">
                                            <span class="delete-data">
                                                <a href="#" onclick="deletebed(<?php echo $data['bedid'] ?>);">
                                                    <img style="margin-top: -15px;" src="img/delete-icon.png">
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                <p id="ResponseRoomDelete" style="color:red;"></p>
                    <div class="panel-body no-padding">
                        <div class="panel-heading">
                            <h5 class="panel-title panel-white text-center">Dhomat</h5>
                        </div>
                        <table class="data-list min-height">
                            <tr class="table-head ">
                                <td class="bidh">Numri i dhomes</td>
                                <td class="ridh">Numri i shtreterve</td>
                                <td class="deph">Departamenti</td>
                                <td class="actionsh">
                            </tr>
                        </table>
                        <table class="data-list" id="Rooms">
                            <?php
                            $query = mysqli_query($con, "SELECT rooms.id as roomid, count(beds.id) as numofbeds, departaments.depname as depname from beds JOIN rooms JOIN departaments WHERE beds.bedstatus=rooms.roomstatus=departaments.depstatus=1 && (beds.roomId=rooms.id && rooms.depId=departaments.id) GROUP BY rooms.id UNION (SELECT DISTINCT rooms.id, 0, departaments.depname from rooms, departaments WHERE (rooms.roomstatus=1 && rooms.depId=departaments.id ) && rooms.id NOT IN (SELECT DISTINCT beds.roomId from beds)) ORDER BY roomid ASC");

                            if (!$query) {
                                die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                            } else {
                                while (($data = mysqli_fetch_array($query))) {
                            ?>
                                    <tr>
                                        <td class="bid">
                                            <?php echo htmlentities($data['roomid']); ?>
                                        </td>
                                        <td class="rid">
                                            <?php echo htmlentities($data['numofbeds']); ?>
                                        </td>
                                        <td class="dep">
                                            <?php echo htmlentities($data['depname']); ?>
                                        </td>
                                        <td class=" actions" style="margin-top: -10px;">
                                            <span class="delete-data">
                                                <a href="#" onclick="deleteroom(<?php echo $data['roomid'] ?>);">
                                                    <img style="margin-top: -15px;" src="img/delete-icon.png">
                                                </a>
                                            </span>
                                        </td>

                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#addroom_form").submit(function(e) {
        e.preventDefault();

        $depid = document.getElementById('DepRoom').value;
        $('#ResponseRoom').html("");
        $confirm = confirm('A jeni te sigurte qe deshironi ta shtoni dhomen?');
        if ($confirm) {
            $.ajax({
                    method: "POST",
                    url: "includes/add-room.inc.php",
                    data: {
                        depid: $depid
                    }
                })
                .done(function(response) {
                    //$("#Rooms").html(response);
                    filter("all");
                    $('#ResponseRoom').html("Shtimi u krye me sukses.");
                });
            return false;
        } else {
            $('#ResponseRoom').html("Shtimi u anulua.");
        }

    });

    $("#addbed_form").submit(function(e) {
        e.preventDefault();

        $roomid = document.getElementById('BedRoom').value;
        $('#ResponseBed').html("");
        $confirm = confirm('A jeni te sigurte qe deshironi ta shtoni shtratin?');
        if ($confirm) {
            $.ajax({
                    method: "POST",
                    url: "includes/add-bed.inc.php",
                    data: {
                        roomid: $roomid
                    }
                })
                .done(function(response) {
                    // $("#Beds").html(response);
                    filter("all");
                    $('#ResponseBed').html("Shtimi u krye me sukses.");
                });
            return false;
        } else {
            $('#ResponseBed').html("Shtimi u anulua.");
        }

    });
    
    $("#filter_form").submit(function(e) {
        e.preventDefault();

        $filter = document.getElementById('filterDepartaments').value;
        filter($filter);
    });
    function deletebed($bedid) {
        $confirm = confirm('A jeni te sigurte qe deshironi ta fshini shtratin numer: '+$bedid+' ?');
        if ($confirm) {
            $.ajax({
                    method: "POST",
                    url: "includes/delete-bed.inc.php",
                    data: {
                        bedid: $bedid
                    }
                })
                .done(function(response) {
                    // $("#Beds").html(response);
                    if(response==1)
                    {
                        $('#ResponseBedDelete').html("Fshierja nuk mund te behet pasi qe ka pacient aktiv ne ate shtrat.");
                    }else
                    {
                        filter("all");
                    $('#ResponseBedDelete').html("Fshierja u krye me sukses.");
                    }
                });
            return false;
        } else {
            $('#ResponseBedDelete').html("Fshierja u anulua.");
        }
       
    }
    function filter($filter) {

        $.ajax({
                method: "POST",
                url: "includes/filter.inc.php",
                data: {
                    filter: $filter
                }
            })
            .done(function(response) {
                $("#pdf").html(response);
            });
        return false;
    }    

    function deleteroom($roomid) {
        $confirm = confirm('A jeni te sigurte qe deshironi ta fshini dhomen me numer: '+$roomid+' ?');
        if ($confirm) {
            $.ajax({
                    method: "POST",
                    url: "includes/delete-room.inc.php",
                    data: {
                        roomid: $roomid                    
                    }
                })
                .done(function(response) {
                    // $("#Beds").html(response);
                    if(response==1)
                    {
                        $('#ResponseRoomDelete').html("Fshierja nuk mund te behet pasi qe ka shtretër ne ate dhome.");
                    }else
                    {
                        filter("all");
                    $('#ResponseRoomDelete').html("Fshierja u krye me sukses.");
                    }
                });
            return false;
        } else {
            $('#ResponseRoomDelete').html("Fshierja u anulua.");
        }
    }
</script>