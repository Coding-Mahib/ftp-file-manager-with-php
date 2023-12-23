<!--
    "FTP FILE MANAGER" PROJECT USING PHP v1.2

    CREATED BY CODINGMAHIB
    EMAIL: mahibabrar123@gmail.com
-->
<?php
session_start();

if (isset($_SESSION["ftp_server"])){
	header("location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ftp File Manager</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./font-awesome/css/all.min.css">

    <link rel="shortcut icon" href="img/coding_mahib_32x32.png" type="image/png">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <a href="" class="navbar-brand"><i class="fas fa-file"></i> FTP File Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggler="collapse" data-bs-target="#menuBar" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="" class="nav-link mx-2 active" >Home</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="card bg-light text-center">
            <div class="card-header">Login to FTP</div>
            <div class="card-body">
                <div id="errorPL"></div>
                <form id="login">
                    <div class="display-flex" style="display: flex;padding: 10px;width: 100%">
                        <label for="server" style="text-align: left;width: 20%">FTP Server Address:</label>
                        <input type="text" name="server" id="server" class="form-control" style="width: 80%">
                    </div>
                    <div class="display-flex" style="display: flex;padding: 10px;width: 100%">
                        <label for="port" style="text-align: left;width: 20%">FTP Port:</label>
                        <input type="number" name="port" id="port" class="form-control" style="width: 80%">
                    </div>
                    <div class="display-flex" style="display: flex;padding: 10px;width: 100%">
                        <label for="port" style="text-align: left;width: 20%">FTP Username:</label>
                        <input type="text" name="username" id="username" class="form-control" style="width: 80%">
                    </div>
                    <div class="display-flex" style="display: flex;padding: 10px;width: 100%">
                        <label for="port" style="text-align: left;width: 20%">FTP Password:</label>
                        <input type="password" name="password" id="password" class="form-control" style="width: 80%">
                    </div>
                    <div class="display-flex" style="display: flex;padding: 10px;width: 100%;">
                        <button class="btn btn-success" style="">Login</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <script src="./bootstrap.min.js"></script>
    <script>
        const loginForm = document.querySelector('#login');
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            let errors = document.querySelector('#errorPL');
            let server = this.server.value;
            let port = this.port.value;
            let username = this.username.value;
            let password = this.password.value;

            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
                if (this.readyState === 4 && this.status === 200){
                    if (this.responseText !== "YES"){
                        if (this.responseText === "FTP_SERVER_CONNECTION_ERROR"){
                            let error = document.createElement('div');
                            error.classList.add("alert");
                            error.classList.add("alert-danger");
                            error.innerHTML = "<strong>FTP_SERVER_CONNECTION_ERROR:</strong> Can't connect to ftp server. Check your <b>Server address</b> and <b>port</b>";
                            errors.append(error);
                            setTimeout(clearErrors, 5000);
                        }else if(this.responseText === "FTP_LOGIN_INVALID"){
                            let error = document.createElement('div');
                            error.classList.add("alert");
                            error.classList.add("alert-danger");
                            error.innerHTML = "<strong>FTP_LOGIN_INVALID:</strong> Username or Password <b>Invalid</b>";
                            errors.append(error);
                            setTimeout(clearErrors, 5000);
                        }else{
                            let error = document.createElement('div');
                            error.classList.add("alert");
                            error.classList.add("alert-danger");
                            error.innerHTML = "<strong>UNKNOWN_ERROR:</strong> Please try again!";
                            errors.append(error);
                            setTimeout(clearErrors, 5000);
                        }
                    }else{
                        location.href = "home.php";
                    }
                }
            }
            xhr.open("POST", "xhr/login.php");
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("server=" + server + "&&port=" + port + "&&username=" + username + "&&password=" + password);
        });
        function clearErrors(){
            let errors = document.querySelector('#errorPL');
            errors.innerHTML = "";
        }
    </script>
</body>
</html>
