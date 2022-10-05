<?php

require_once('dbconn.php');

// Die Klasse Inkludieren
include_once('cartClass.php');

// Eine Neue Instanz der Klasse cart erstellen
$cart = new cart();

// Prüfen ob der Warenkorb besteht
$cart->initial_cart();
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


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
        <?php include('layouts/header.php'); ?>
        <div class="content">

            <title>Warenkorb</title>

            <?php if (empty($_SESSION['cart'])) {
                $cart->getCart();
            } ?>
        </div>

    </div>
    </div>

    <?php include('layouts/footer.php'); ?>

</body>

</html>