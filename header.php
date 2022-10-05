<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->

    <style>
        .menubar {
            width: 20%;
            background-color: #746CF5;
            margin-right: 32px;
            padding-top: 80px;
            height: 50vmax;
            /* vh = viewport */
        }

        /* CSS für alle a-Elemente im Menü*/
        .menubar a {
            display: block;
            text-decoration: none;
            /* entfernt den "Link"-Style */
            color: white;
            padding: 8px;
            display: flex;
            align-items: center;
        }

        /* .menubar img {
            margin-right: 8px;
        } */

        .menubar a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .title {
            background-color: white;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            height: 60px;
            box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
            padding-left: 50px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <!-- div for website title -->
    <div class="title">
        <h1>Webshop</h1>
    </div>

    <?php
    $page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
    ?>
    <!-- div for menubar -->
    <div class="menubar">
        <!-- <a href="index.php?page=start"><img src="img/home.svg"> Start</a> -->
        <a href="index.php"> Start</a>
        <a href="products.php"> Produkte </a>
        <!-- <a href="index.php?page=login"> Login </a> -->
        <a href="signup.php"> Login / Registrierung </a>
        <a href="cart.php"> Warenkorb </a>
        <a href="admin.php"> Admin </a>
    </div>
    <!-- </div> -->
</body>

</html>