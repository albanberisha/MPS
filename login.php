<html>

<head>
    <meta charset="utf-8">
    <title>Kyqja</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
        <div class="login">
            <div class="text-center">
                <img src="img/hospital.svg" width="100px" height="100px" />
            </div>
            <div >
                <form method="post" name="login-form">
                    <div class="text-center">
                        <label class="col-form-label">Emaili ose ID:</label>
                        <input class = "form-control"  type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="Emaili ose ID" required />
                    </div>
                    <div class="text-center" >
                        <label class="col-form-label">Paswordi:</label>
                        <input class = "form-control"  type="password" name="password" placeholder="Paswordi" required />
                    </div>
                    <div class="text-center col-form-label">
                    <button class="btn-primary" style="width: 100%; border: 1px solid blue; border-radius: 5px; padding: 3px;">Kyquni</button>
                </div>
                </form>
            </div>
        </div>
</body>

</html>