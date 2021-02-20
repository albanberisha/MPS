<div class="main-body">
    <div class="row gutters-sm">
        <div class="col-md-12">
            <div class="form-group">
                <label class="input-title" for="Hospitaanalyzes">
                    Shto nje analize te re:
                </label>
                <div style="margin-bottom: 10px;">
                    <button type="button" id="Newanalyse" class="left-marg  btn btn-primary"><span style="font-size: 15px;">&#43;</span> Shto</button>
                </div>
                <div id="New-analyse">
                </div>
            </div>
            <div class="card">
                <div style="padding-bottom: 0;">
                    <h6 class="panel-title panel-white text-center col-header">Qmimet e analizave</h6>
                </div>
                <div class="card-body card-top">
                    <table class="data-list min-height dignosis color-none">
                        <tbody>
                            <tr>
                                <th class="panel-title title3 ">
                                    Emri
                                </th>
                                <th class="panel-title title3 ">
                                Çmimi(€)
                                </th>
                                <th class="actionsh">
                                </th>
                            </tr>
                            <tr>
                                <td class="title3">
                                    A1t
                                </td>
                                <td class="title3">
                                   0.30
                                </td>
                                <td class=" actions" style="display: contents;">
                                <span class="edit-data" onclick="window.open('edit-analyse.php', '_self');"><img src="img/edit-icon.png"></span>
                                <span class="delete-data"><img src="img/delete-icon.png"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div style="padding-bottom: 0;">
                    <h6 class="panel-title panel-white text-center col-header">Qmimet e tjera</h6>
                </div>
                <div class="card-body card-top">
                    <table class="data-list min-height dignosis color-none">
                        <tbody>
                            <tr>
                                <th class="panel-title title3 ">
                                    Emri
                                </th>
                                <th class="panel-title title3 ">
                                Çmimi(€)
                                </th>
                                <th class="actionsh">
                                </th>
                            </tr>
                            <tr>
                                <td class="title3">
                                    Nate ne spital
                                </td>
                                <td class="title3">
                                  20
                                </td>
                                <td class=" actions" style="display: contents;">
                                <span class="edit-data" onclick="window.open('edit-hosp-pn.php', '_self');"><img src="img/edit-icon.png"></span>
                                <span class="delete-data"><img src="img/delete-icon.png"></span>
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
        $("#Newanalyse").click(function() {
            $("#New-analyse").load('includes/new-analyse.php');
        });
    });
</script>