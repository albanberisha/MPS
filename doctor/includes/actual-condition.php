<div class="main-body">
    <div class="col-md-12" style="margin-bottom: 10px;">
        <div class="card">
            <button type="button" class="actualcond">Shenjat Vitale</button>
            <div class="content1">
                <div class="panel-body">
                    <div class="form-group vital-signs">
                        <label class="input-title">Rrahjet e zemres:
                            <input type="number" readonly="readonly" id="HartRate" class="form-control1 vitalsigns" placeholder="24"></label>
                    </div>
                    <div class="form-group vital-signs">
                        <label class="input-title">Presioni i gjakut:
                            <input type="number" readonly="readonly" id="Bloodpressure" class="form-control1 vitalsigns" style="min-width:120px" placeholder="24"></label>
                    </div>
                    <div class="form-group vital-signs">
                        <label class="input-title">Frekuenca e frymëmarrjes:
                            <input type="number" readonly="readonly" id="Respiratoryrate" class="form-control1 vitalsigns" placeholder="24"></label>
                    </div>
                    <div class="form-group vital-signs">
                        <label class="input-title">Temperatura:
                            <input type="number" readonly="readonly" id="Temperature" class="form-control1 vitalsigns" placeholder="24"></label>
                    </div>
                    <div class="form-group vital-signs">
                        <label class="input-title">Sasia e oksigjenit:
                            <input type="number" readonly="readonly" id="OxygenSuration" class="form-control1 vitalsigns" placeholder="24"></label>
                    </div>
                    <div class="form-group vital-signs">
                        <label class="input-title">Pesha:
                            <input type="number" readonly="readonly" id="Weight" class="form-control1 vitalsigns" placeholder="24"></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <button type="button" class="actualcond">Personi pergjegjes per futjen e te dhenave</button>
            <div class="content1">
                <div class="panel-body">
                    <div class="div-inlineflex">
                        <div class="form-group">
                            <label class="input-title">Emri</label>
                            <input type="text" id="nameInfo" readonly="readonly" value="Arton" class="form-control" placeholder="Sheno emrin">
                        </div>
                        <div class="form-group">
                            <label class="input-title">Mbiemri</label>
                            <input type="text" id="surnameInfo" readonly="readonly" value="Bajra" class="form-control" placeholder="Sheno mbiemrin">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-title">Data</label>
                        <input type="date" readonly="readonly" class="form-control" id="Infostart-date" name="infotart_date" value="12.14.2020" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .actualcond {
        background-color: rgb(165, 165, 165);
        color: white;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: 2px solid rgb(59, 59, 59);
        border-radius: 0.2em;
        text-align: left;
        outline: none;
        font-size: 15px;
    }

    .active1,
    .actualcond:hover {
        background-color: rgb(92, 92, 92);
    }

    .content1 {
        padding: 0 18px;
        display: none;
        overflow: hidden;
        background-color: #f1f1f1;
    }
</style>

<script>
    var coll = document.getElementsByClassName("actualcond");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active1");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>