<?php
include('config.php');

?>
<div class="main-body">
    <div class="row gutters-sm">
        <div class="col-md-12">
            <div class="form-group">
                <label class="input-title" for="Hospitaanalyzes">
                    Shto nje analize te re:
                </label>
                <div id="New-analyse">
                    <div class="card">
                        <div class="form-group">
                            <form id="addAnalyse_form" method="post">
                                <div class="form-group">
                                    <label class="input-title" for="AnalyseName">
                                        Shenoni emrin e analizes
                                    </label>
                                    <input type="text" id="AnalyseName" class="form-control" placeholder="Sheno emrin e analizes">
                                    <p id="ResponseAnalyseAdd" style="color:red;"></p>
                                </div>
                                <div class="form-group">
                                    <label class="input-title">
                                        Çmimi</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">€</span>
                                        </div>
                                        <input type="number" step="0.01" min="0" id="AnalysePrice" class="form-control" placeholder="Çmimi i analizes" value="0.30">
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 10px;">
                                    <button type="submit" class="btn btn-primary">Shto</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <p id="ResponseAnalyseDelete" style="color:red;"></p>
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Qmimet e analizave</h5>
                    </div>
                    <table class="data-list min-height">
                        <tr class="table-head ">
                            <td class="deph">Emri</td>
                            <td class="deph">Çmimi(€)</td>
                            <td class="actionsh">
                        </tr>
                    </table>
                    <table class="data-list">
                    <tbody id="Analyses">
                        <?php
                        $query = mysqli_query($con, "SELECT * From pricing_list WHERE status=1 && description='Analyse'");
                        if (!$query) {
                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                        } else {
                            while (($data = mysqli_fetch_array($query))) {
                        ?>
                                <tr>
                                    <td class="dep">
                                        <?php echo htmlentities($data['name']); ?>
                                    </td>
                                    <td class="dep">
                                        <?php echo htmlentities($data['price']); ?>
                                    </td>
                                    <td class=" actions" >
                                        <span class="edit-data" >
                                        <a href="edit-analyse.php?id=<?php echo $data['id'] ?>&edit=analyse" >
                                        <img src="img/edit-icon.png">                                            </a>
                                        </span>
                                        <span class="delete-data">
                                            <a href="#" onclick="deleteanalyse(<?php echo $data['id'] ?>,<?php echo '\''.$data['name'].'\'' ?> );">
                                                <img src="img/delete-icon.png">
                                            </a>
                                        </span>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <p id="ResponseAnalyseDelete" style="color:red;"></p>
                <div class="panel-body no-padding">
                    <div class="panel-heading">
                        <h5 class="panel-title panel-white text-center">Qmimet e tjera</h5>
                    </div>
                    <table class="data-list min-height">
                        <tr class="table-head ">
                            <td class="deph">Emri</td>
                            <td class="deph">Çmimi(€)</td>
                            <td class="actionsh">
                        </tr>
                    </table>
                    <table class="data-list">
                    <tbody id="Other">
                        <?php
                        $query = mysqli_query($con, "SELECT * From pricing_list WHERE status=1 && description!='Analyse'");
                        if (!$query) {
                            die("E pamundur te azhurohen te dhenat: " . mysqli_connect_error());
                        } else {
                            while (($data = mysqli_fetch_array($query))) {
                        ?>
                                <tr>
                                    <td class="dep">
                                        <?php echo htmlentities($data['name']); ?>
                                    </td>
                                    <td class="dep">
                                        <?php echo htmlentities($data['price']); ?>
                                    </td>
                                    <td class=" actions" >
                                        <span class="edit-data">
                                        <a href="edit-hosp-pn.php?id=<?php echo $data['id'] ?>&edit=other" >
                                        <img src="img/edit-icon.png">                                            </a>
                                        </span>
                                    </td>
                                </tr>
                        <?php
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
    $("#addAnalyse_form").submit(function(e) {
        e.preventDefault();
        $('#ResponseAnalyseAdd').html("");
        $ananame = $('#AnalyseName').val();
        $anaprice = $('#AnalysePrice').val();
        if ($ananame == "") {
            $('#ResponseAnalyseAdd').html("Emri nuk duhet te jete i zbrazet.");
        } else {
            var patt = new RegExp("^[a-zA-Z0-9_. -/]*$"); //only letters, numbers, - dhe /
            var res = patt.test($ananame);
            if (res) {
                $confirm = confirm('A deshironi ta shtoni analizen: ' + $ananame + '?');
                if ($confirm) {
                    $.ajax({
                            method: "POST",
                            url: "includes/add-analyse.inc.php",
                            data: {
                                name: $ananame,
                                price: $anaprice
                            }
                        })
                        .done(function(response) {
                            if (response == "error") {
                                $('#ResponseAnalyseAdd').html("Analiza ekziston!.");
                            } else {
                                $("#Analyses").html(response);
                                $('#ResponseAnalyseAdd').html("Shtimi u krye me sukses.");
                            }

                        });
                    return false;

                } else {
                    $('#ResponseAnalyseAdd').html("Shtimi u anulua.");
                }
            } else {
                $('#ResponseAnalyseAdd').html("Emri i analizes mund te permbaje: shkronja, numra, - dhe /.");

            }
        }
    });
    function deleteanalyse($id,$name)
    {$('#ResponseAnalyseAdd').html("");
        $confirm = confirm('A jeni te sigurte qe deshironi ta fshini analizen: ?');
        if ($confirm) {
            $.ajax({
                    method: "POST",
                    url: "includes/delete-analyse.inc.php",
                    data: {
                        id: $id
                    }
                })
                .done(function(response) {
                        $("#Analyses").html(response);
                        $('#ResponseAnalyseDelete').html("Fshierja u krye me sukses.");                    
                });
            return false;
        } else {
            $('#Response').html("Fshierja u anulua.");
        }
    }
    function deleteother($id)
    {

    }
</script>