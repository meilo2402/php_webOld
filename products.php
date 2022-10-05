<?php
// setcookie("Kundennummer", "234Produkt", time() + 2592000);
require_once('dbconn.php');

session_start(); //Session-Cookie
// print_r($_SESSION);

// echo "<h1>Datenbank auslesen um " . date("H:i:s") . "</h1>";

$sql = "SELECT * FROM `products`";

//mysqli
// $products = array();
// $i = 0;
// foreach($db -> query($sql) as $inhalt){
//     $products[$i] = $inhalt[$i];
//     $i++;
// }

//Rückgabe in einer variable speichern
$rueckgabe = $db -> query($sql);
//alle Daten all Array in die Variable $products speichern 
$products = $rueckgabe-> fetchAll(PDO::FETCH_ASSOC);


// Ausgabe der Daten mit print_r()
// if ($erg = $db->query($sql)) {
//  	if ($erg->num_rows) {
// 		print_r($erg->num_rows);
// 		$ds_gesamt = $erg->num_rows;
// 		$erg->free();
// 	}

// if ($erg = $db->query($sql)) {
//     while ($datensatz = $erg->fetch_object()) {
//         $daten[] = $datensatz;
//     }
// }
// }
// echo '<pre>';
print_r($products);
// exit;

// $total_products = $pdo->query('SELECT * FROM products')->rowCount();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <style>
        #products {
            width: 50%;
            border-collapse: collapse;
            border: 1px solid;
           
        }

        th {
            height: 70px;
            text-align: left;
        }

        th,
        td {
            padding: 15px;
            border: 1px solid;
        }

        .tabellentext {
            vertical-align: middle !important;
        }

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
                    foreach ($products as $inhalt) {
                    ?>
                        <tr>
                            <!-- <td>
                            <?php
                            // echo '<a data-ajax="false" data-role="button" href="details.php?id=';
                            echo $inhalt->id;
                            // echo '"></a>';
                            ?>
                        </td> -->
                            <td>

                                <?php
                                // echo '<a data-ajax="false" data-role="button" href="details.php?id=';
                                echo $inhalt["name"];
                                // echo '"></a>';
                                ?>
                            </td>
                            <td class="tabellentext">
                                <?php echo $inhalt["price"]." €"; ?>
                            </td>
                            <td class="tabellentext">
                                <?php echo $inhalt["type"]; ?>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>



                </tbody>
            </table>
        </div>
    </div>
</body>

</html>