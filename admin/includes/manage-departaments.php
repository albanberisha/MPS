<div class="main-body">
    <div class="row gutters-sm">
        <div class="col-md-12">
            <div class="form-group">
                <label class="input-title" for="HospitalDepartaments">
                    Shto nje departament te ri:
                </label>
                <div style="margin-bottom: 10px;">
                    <button type="button" id="NewDepartament" class="left-marg  btn btn-primary"><span style="font-size: 15px;">&#43;</span> Shto</button>
                </div>
                <div id="New-departament">
                </div>
            </div>
            <div class="card">
                <div style="padding-bottom: 0;">
                    <h6 class="panel-title panel-white text-center col-header">Departamentet</h6>
                </div>
                <div class="card-body card-top">
                    <table class="data-list min-height dignosis color-none">
                        <tbody>
                            <tr>
                                <th class="panel-title title3 ">
                                    Emri
                                </th>
                                <th class="actionsh">
                                </th>
                            </tr>
                            <tr>
                                <td class="title1">
                                    Urologji
                                </td>
                                <td class=" actions" style="margin-top: -10px;">
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
        $("#NewDepartament").click(function() {
            $("#New-departament").load('includes/new-departament.php');
        });
    });
</script>