<div class=" container-fullw">
                <div class="panel-body">
                    <div class="panel-heading">
                        <h5 class="panel-title">Te dhenat e spitalit</h5>
                    </div>
                    <div class="panel-form">
                        <form>
                            <div class="circle form-group">
                                <div class="input-formimg">
                                    <img id="preview" class="circle" src="img/hospital.svg">
                                </div>
                            </div>
                            <div class="form-group">
                                <form method="post" id="image-form" style="width: 30px;">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" style="display: none;" disabled placeholder="Ngarkoni fotografi" id="file">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary btn-change">Ndryshoni logon</button>
                                        </div>
                                        <span class="text-info" style="margin-left: 90px;">*preferohet formati .svg </span>
                                    </div>
                                    <input type="file" name="img[]" class="file" accept=".svg">
                                </form>
                            </div>
                            <div class="div-inlineflex">
                                <div class="form-group">
                                    <label class="input-title">Emri i spitalit</label>
                                    <input type="text" id="nameHospital" class="form-control" value="Qendra Klinike Universitare e Kosoves">
                                </div>
                                <div class="form-group">
                                    <label class="input-title">Shkurtesa</label>
                                    <input type="text" id="shortName" class="form-control" value="QKUK">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="input-title">Adresa</label>
                                <input type="text" class="form-control" id="adressAdmin" name="adresshospital" placeholder="Adresa">
                            </div>
                            <div class="form-group" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-primary">Ndrysho</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>