<?php
// Get the 4 most recently added products

include_once("dbconn.php");
$sql = $db->prepare('SELECT * FROM products ORDER BY date_added'); // $stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');

$sql->execute();
$products = $sql->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkte</title>

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
            <div class="recentlyadded content-wrapper">
                <h2>Produkte</h2>
                <div class="products">
                    <?php foreach ($products as $product) : ?>
                        <!-- <a href="index.php?page=product&id=<?= $product['id'] ?>" class="product"> -->
                        <a href="productPage.php?page=product&id=<?= $product['id'] ?>" class="product">
                            <!-- <img src="imgs/<?= $product['img'] ?>" width="200" height="200" alt="<?= $product['name'] ?>"> -->
                            <span class="name"><?= $product['name'] ?></span>
                            <span class="price">
                                &euro;<?= $product['price'] ?>
                            </span>
                            
                            <span class="descr">
                                <?php if (strlen($product['descr']) > 0) : ?>
                                    <span class="descr"><?= $product['descr'] ?></span>
                                <?php endif; ?>
                            </span>
                        </a>
                        <br>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
    <?php
    include "layouts/footer.php";
    ?>

</body>

</html>