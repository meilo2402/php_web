<?php
require_once('dbconn.php');
// include("...php");

if (isset($_GET['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = $db->prepare("SELECT * FROM users WHERE email = :email");
    //führt das prepared statement aus 
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        die('Login erfolgreich.<a href="userView.php"></a>');
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <style>
        body {
            font-family: 'Gowun Dodum', sans-serif;
            background-color: #EAEDF8;
            margin: 0;
        }

        /* mit flex werden die beiden divs im main-div nebeneinander angezeigt */
        .main {
            display: flex;
        }

        .content {
            width: 70%;
            margin-top: 80px;
            margin-right: 32px;
            background-color: white;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="main">
        <?php
        include "layouts/header.php";
        ?>
        <div class="content">

            <?php
            if (isset($errorMessage)) {
                echo $errorMessage;
            }
            ?>
            <div class="container" style="width:500px;">
                <form action="?login=1" method="post">

                    <h3 align="center">Login</h3>
                    E-Mail:<br>
                    <input type="email" size="40" maxlength="250" name="email"><br><br>

                    Passwort:<br>
                    <input type="password" size="40" maxlength="250" name="password" ><br>

                    <input type="submit" value="Abschicken" class="btn btn-info">
                    <br>
                    <p align="center"><a href="adminLogin.php?action=login">Admin Login</a></p>
                </form>

            </div>
        </div>
    </div>
    <?php
    include "layouts/footer.php";
    ?>
</body>

</html>