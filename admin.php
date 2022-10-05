<?php
require_once('dbconn.php');

session_start();

$sql = $db->prepare('SELECT * FROM products ORDER BY id');
$sql->execute();
// Fetch the product from the database and return the result as an Array
$products = $sql->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['save'])) {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $type = trim($_POST['type']);
    $descr = trim($_POST['descr']);
    $quantity = trim($_POST['quantity']);
    $img = trim($_POST['img']);

    //Wenn kein Fehler dann speichern
    if (!$error) {
        $statement = $db->prepare("INSERT INTO products (name, price ,type ,descr ,quantity ,img ) VALUES (:email, :price, :type, :descr ,:quantity ,:img)");
        $result = $statement->execute(array('name' => $name, 'price' => $price, 'type' => $type, 'descr' => $descr, 'quantity' => $quantity, 'img' => $img));

        if ($result) {
            echo 'Produkt wurde erfolgreich hinzugefügt.'; //echo 'Produkt wurde erfolgreich hinzugefügt. <a href="login.php">Zum Login</a>';
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<body>
    <style>
        body {
            font-family: 'Gowun Dodum', sans-serif;
            background-color: #EAEDF8;
            margin: 0;
        }

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

                <h1>Produkte</h1>


                <table id="products" data-role="table" class="ui-responsive" data-mode="columntoggle" data-column-btn-text="Spalten">
                    <thead>
                        <tr>
                            <th data-priority="1">Name</th>
                            <th data-priority="2">Preis</th>
                            <th data-priority="3">Typ</th>
                            <!-- <th data-priority="3">Lagerbestand</th>

                        <th data-priority="3"></th> -->

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($products as $product) {
                        ?>
                            <tr>
                                <!-- <td>
                            ?php
                            // echo '<a data-ajax="false" data-role="button" href="details.php?id=';
                            echo $product->id;
                            // echo '"></a>';
                            ?>
                        </td> -->

                                <!-- <td> -->
                                    <!-- ?php
                                    // echo '<a data-ajax="false" data-role="button" href="details.php?id=';
                                    // echo $product["name"];
                                    // echo '"></a>';
                                    ?> -->
                                </td>

                                <td class="tabellentext">
                                    <?php echo $product["price"] . " €"; ?>
                                </td>

                                <td class="tabellentext">
                                    <?php echo $product["type"]; ?>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
















                <form method="post">
                    <div class="container">
                        <!-- style="width:500px;" -->
                        <h3>Produkt hinzufügen</h3>
                        <label>Name</label>
                        <input type="text" name="text" id="name">
                        <br>
                        <label>Preis</label>
                        <input type="number" name="price" id="price">
                        <br>
                        <label>Typ</label>
                        <input type="text" name="type" id="type">
                        <br>
                        <label>Beschreibung</label>
                        <input type="text" name="descr" id="descr">
                        <br>
                        <label>Lagerstand</label>
                        <input type="number" name="quantity" id="quantity">
                        <br>
                        <label>Image</label>
                        <input type="file" name="img" id="img">

                        <input type="submit" name="save" id="save" class="btn btn-info" value="Speichern" />
                    </div>
                </form>
            </div>
        </div>
        <?php include('layouts/footer.php'); ?>

    </body>

</html>