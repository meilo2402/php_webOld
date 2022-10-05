<?php
setcookie("Kundennummer", "12345", time() + 2592000);
require_once('dbconn.php');

$sql = "SELECT * FROM products ORDER BY id";

if ($erg = $db->query($sql)) {
    while ($datensatz = $erg->fetch_object()) {
        $daten[] = $datensatz;
    }
}

print_r($datensatz);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop</title>

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
    <!-- div for page -->
    <div class="main">
        <?php
        include "layouts/header.php";
        ?>

        <!-- div for php -->
        <div class="content">
            <?php
            $headline = 'Herzlich willkommen';
            echo '<h1>' . $headline . '</h1>';
            ?>

            <div class="featured">
                <h2>Gadgets</h2>
                <p>Essential gadgets for everyday use</p>
            </div>
            <div class="recentlyadded content-wrapper">
                <h2>Recently Added Products</h2>
                <div class="products">
                    <?php foreach ($daten as $product) : ?>
                        <a href="index.php?page=product&id=<?= $product['id'] ?>" class="product">
                            <img src="imgs/<?= $product['image'] ?>" width="200" height="200" alt="<?= $product['name'] ?>">
                            <span class="name"><?= $product['name'] ?></span>
                            <span class="price">
                                &dollar;<?= $product['price'] ?>
                                <?php if ($product['quantity'] > 0) : ?>
                                    <span class="quantity">&dollar;<?= $product['quantity'] ?></span>
                                <?php endif; ?>
                            </span>
                        </a>
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