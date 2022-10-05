<?php
include_once("dbconn.php");

// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $sql = $db->prepare('SELECT * FROM products WHERE id = ?');
    $sql->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $sql->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


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

    <div class="product content-wrapper">
        <img src="imgs/<?= $product['img'] ?>" width="500" height="500" alt="<?= $product['name'] ?>">
        <div>
            <h1 class="name"><?= $product['name'] ?></h1>
            <span class="price">
                &euro;<?= $product['price'] ?>
            </span>
            <form action="index.php?page=cart" method="post">
                <input type="number" name="quantity" value="1" min="1" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
                <!-- <input type="text" name="descr" value="<?= $product['descr'] ?>"> -->
                <input type="submit" value="Add To Cart">
            </form>
            <div class="description">
                <?= $product['descr'] ?>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php
    include "layouts/footer.php";
    ?>

</body>

</html>