 <div class="card-header">
     <p>Admin | Ndrysho Detajet e Doktorrit </p>
 </div>
 <div class=" container-fullw">
     <div class="panel-body">
         <div class="panel-heading">
             <h5 class="panel-title">Alban Berisha</h5>
             <div class="info-panel">
                 <div class="d-inline-flex">
                     <h6 class="panel-title">Regjistruar me:</h6>
                     <p class="reg-date">21.12.2020</p>
                 </div>
                 <div class="d-inline-flex">
                     <h6 class="panel-title">Hera e fundit e perditesimit:</h6>
                     <p class="update-date">21.12.2020</p>
                 </div>
             </div>
         </div>

         <div class="panel-form">

             <form>
                 <div class="circle form-group">
                     <div class="input-formimg">
                         <img id="preview" class="circle" src="img/doctor.png">
                     </div>
                 </div>
                 <div class="form-group">
                     <form method="post" id="image-form">
                         <div class="input-group my-3">
                             <input type="text" class="form-control" disabled placeholder="Ndryshoni fotografine" id="file">
                             <div class="input-group-append">
                                 <button type="button" class="browse btn btn-primary">Ngarkoni...</button>
                             </div>
                         </div>
                         <input type="file" name="img[]" class="file" accept="image/*">
                     </form>
                 </div>
                 <div class="form-group">
                     <label class="input-title" for="DoctorPositon">
                         Pozita
                     </label>
                     <select name="Doctorposition" class="form-control doctorposition" required="true">
                         <option selected>Doktorr</option>
                         <option>Doktorr laboratori</option>

                     </select>
                 </div>
                 <div class="div-inlineflex">
                     <div class="form-group">
                         <label class="input-title">Emri i doktorrit</label>
                         <input type="text" id="nameDoc" class="form-control" placeholder="Sheno emrin e doktorrit" value="Alban">
                     </div>
                     <div class="form-group">
                         <label class="input-title">Mbiemri i doktorrit</label>
                         <input type="text" id="surnameDoc" class="form-control" placeholder="Sheno mbiemrin e doktorrit" value="Berisha">
                     </div>
                 </div>
                 <div class="div-inlineflex">
                     <div class="form-group">
                         <label class="input-title">Datelindja</label>
                         <input type="date" class="form-control" id="Docstart-date" name="docstart_date" value="2018-07-22">
                     </div>
                     <div class="form-group">
                         <label class="input-title">Gjinia</label>
                         <div class="input-title-btn">
                             <input type="radio" name="docgender" value="male" checked> Mashkull<br>
                             <input type="radio" name="docgender" value="female"> Femër
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="input-title">Adresa</label>
                     <input type="text" class="form-control" id="adressDoc" name="adressdoc" placeholder="Adresa" value="Rruga Xheladin Hana, Prishtine">
                 </div>
                 <div class="form-group">
                     <label class="input-title">Numri i telefonit</label>
                     <input class="form-control" id="phone-number" value="38349549509">
                 </div>
                 <div class="form-group">
                     <label class="input-title" for="DoctorSpecialization">
                         Specializimi
                     </label>
                     <select name="Doctorspecialization" class="form-control" required="true">
                         <option value="">Selekto Specializimin</option>
                         <option selected>Alban</option>

                     </select>
                 </div>
                 <div class="form-group">
                     <label class="input-title" for="DoctorDepartament">
                         Departamenti
                     </label>
                     <select name="Doctordepartament" class="form-control" required="true">
                         <option value="">Selekto departamentin</option>
                         <option selected>Lindjet</option>

                     </select>
                 </div>
                 <div class="form-group">
                     <label class="input-title">Adresa e klinikes</label>
                     <input type="text" id="adressKDoc" class="form-control" placeholder="Sheno adresen e klinikes se doktorrit" value="Prishtine, Kosove">
                 </div>
                 <div class="form-group">
                     <label class="input-title">Tarifa e konsultes me mjekun</label>
                     <div class="input-group mb-3">
                         <div class="input-group-prepend">
                             <span class="input-group-text">&#8364</span>
                         </div>
                         <input type="number" class="form-control" placeholder="Tarifa e konsultes me mjekun" value="30">
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="input-title">Emaili</label>
                     <input type="email" readonly="readonly" class="form-control" name="docemail" value="a@gmail.com" required="required">
                 </div>
                 <div class="form-group">
                     <label class="input-title">Username</label>
                     <input type="text" class="form-control" name="docusername" placeholder="Username" value="Alban1999">
                 </div>
                 <div class="form-group" style="margin-top: 10px;">
                     <button type="submit" class="btn btn-primary">Ndrysho</button>
                 </div>
             </form>
         </div>
     </div>
 </div>