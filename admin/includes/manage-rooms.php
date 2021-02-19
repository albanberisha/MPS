<div class="main-body">
    <div class="row gutters-sm">
        <div class="col-md-12">
            <div class="form-group">
                <label class="input-title" for="HospitalDepartaments">
                    Shto nje dhome te re:
                </label>
                <div style="margin-bottom: 10px;">
                    <button type="button" id="NewRoom" class="left-marg  btn btn-primary"><span style="font-size: 15px;">&#43;</span> Shto</button>
                </div>
                <div id="New-room">
                </div>
            </div>
            <div class="form-group">
                <label class="input-title" for="HospitalDepartaments">
                    Shto nje shtrat te ri:
                </label>
                <div style="margin-bottom: 10px;">
                    <button type="button" id="Newbed" class="left-marg  btn btn-primary"><span style="font-size: 15px;">&#43;</span> Shto</button>
                </div>
                <div id="New-bed">
                </div>
            </div>
            <div class="form-group">
                <label class="input-title" for="HospitalDepartaments">
                    Departamentet
                </label>
                <select name="hospitalDepartaments" class="form-control" required="true">
                    <option selected="" value="">Selekto departamentin</option>
                    <option>Urgjence</option>
                    <option>Emergjence</option>
                    <option>Urologji</option>
                </select>
            </div>
            <div class="card">
                <div style="padding-bottom: 0;">
                    <h6 class="panel-title panel-white text-center col-header">Dhomat</h6>
                </div>
                <div class="card-body card-top">
                    <table class="data-list min-height dignosis color-none">
                        <tbody>
                            <tr>
                                <th class="panel-title title1">
                                    Numri i dhomes
                                </th>
                                <th class="panel-title title3 ">
                                    Departamenti
                                </th>
                                <th class="panel-title title3 date">
                                    Data e krijimit
                                </th>
                                <th class="actionsh">
                                </th>
                            </tr>
                            <tr>
                                <td class="title1">
                                    1
                                </td>
                                <td class="title3">
                                    Emergjence
                                </td>
                                <td class="title3 date">
                                    12.11.2020
                                </td>
                                <td class=" actions" style="margin-top: -10px;">
                                    <span class="delete-data"><img style="margin-top: -15px;" src="img/delete-icon.png"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="title1">
                                    2
                                </td>
                                <td class="title3">
                                    Emergjence
                                </td>
                                <td class="title3 date">
                                    12.11.2020
                                </td>
                                <td class=" actions" style="margin-top: -10px;">
                                    <span class="delete-data"><img style="margin-top: -15px;" src="img/delete-icon.png"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="title1">
                                    3
                                </td>
                                <td class="title3">
                                    Emergjence
                                </td>
                                <td class="title3 date">
                                    12.11.2020
                                </td>
                                <td class=" actions">
                                    <span class="delete-data"><img style="margin-top: -15px;" src="img/delete-icon.png"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#NewRoom").click(function() {
            $("#New-room").load('includes/new-room.php');
        });
        $("#Newbed").click(function() {
            $("#New-bed").load('includes/new-bed.php');
        });
    });
</script>