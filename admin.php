<?php
// setcookie("Kundennummer", "234Produkt", time() + 2592000);
require_once('dbconn.php');

session_start(); //Session-Cookie
// print_r($_SESSION);

// echo "<h1>Datenbank auslesen um " . date("H:i:s") . "</h1>";

$sql = "SELECT * FROM users ORDER BY id";

// Ausgabe der Daten mit print_r()
// if ($erg = $db->query($sql)) {
//  	if ($erg->num_rows) {
// 		print_r($erg->num_rows);
// 		$ds_gesamt = $erg->num_rows;
// 		$erg->free();
// 	}

if ($erg = $db->query($sql)) {
    while ($datensatz = $erg->fetch_object()) {
        $daten[] = $datensatz;
    }
}
// }
// echo '<pre>';
// print_r($daten);
// exit;
?>



<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<body>
    <style>
        #user {
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

                <form method="post">
                    <div class="container" style="width:500px;">
                        <h3>Produkt hinzufügen</h3>
                        <label>Name</label>
                        <input type="text" name="name" id="name">
                        <label>Preis</label>
                        <input type="number" name="price" id="price">
                        <label>Typ</label>
                        <input type="text" name="type" id="type">
                        <label>Beschreibung</label>
                        <input type="text" name="descr" id="descr">
                        <label>Lagerstand</label>
                        <input type="number" name="quantity" id="quantity">
                        <label>Image</label>
                        <input type="file" name="img" id="img">

                        <input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
                    </div>
                </form>


                <?php


                if (isset($_POST['save'])) {

                    //Process the image that is uploaded by the user
                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                    if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
                        echo "The file " . basename($_FILES["imageUpload"]["name"]) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }


                    //TODO
                    $img = basename($_FILES["img"]["name"], ".jpg"); // used to store the filename in a variable
                    $name = mysqli_real_escape_string($db, trim($_POST["name"]));
                    $price = trim($_POST["price"]);
                    $type = mysqli_real_escape_string($db, trim($_POST["type"]));
                    $descr = mysqli_real_escape_string($db, trim($_POST["descr"]));
                    $quantity =  trim($_POST["quantity"]);

                    //storind the data in your database
                    $query = "INSERT INTO products VALUES ('$name','$price','$type','$descr','$quantity','$img')";
                    mysqli_query($db, $query);

                    echo "Your add has been submited, you will be redirected to your account page in 3 seconds....";
                    // header("Refresh:3; url=account.php", true, 303);
                }
                ?>


                <br>

                <h1>User</h1>
                <table id="user" data-role="table" class="ui-responsive" data-mode="columntoggle" data-column-btn-text="Spalten">
                    <thead>
                        <tr>
                            <th data-priority="1">Vorname</th>
                            <th data-priority="2">Nachname</th>
                            <th data-priority="3">Username</th>
                            <th data-priority="3">Adresse</th>
                            <th data-priority="3">E-mail</th>
                            <th data-priority="3">Typ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($daten as $inhalt) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $inhalt->firstname; ?>
                                </td>
                                <td>
                                    <?php echo $inhalt->lastname; ?>
                                </td>
                                <td>
                                    <?php
                                    echo $inhalt->username;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $inhalt->adress; ?>
                                </td>
                                <td>
                                    <?php echo $inhalt->email; ?>
                                </td>
                                <td>
                                    <?php echo $inhalt->type; ?>
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








<!-- <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                     <a href="#"><strong><span class="fa fa-dashboard"></span> User List</strong></a> 
                     https://webdamn.com/user-management-system-with-php-mysql/ 
                    <h1>User</h1>

                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="col-md-2" align="right">
                                <button type="button" name="add" id="addUser" class="btn">Add</button>
                            </div>
                        </div>
                    </div>
                </div> -->








<!-- DIALOG USER BEARBEITEN
                <div id="userModal" class="modal fade">
                    <div class="modal-dialog">
                        <form method="post" id="userForm">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    <h4 class="modal-title"><i class="fa fa-plus"></i> User bearbeiten</h4>
                                </div>
                                FIRSTNAME
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="firstname" class="control-label">Vorname*</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Vorname" required>
                                    </div>
                                     LASTNAME
                                    <div class="form-group">
                                        <label for="lastname" class="control-label">Nachname</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nachname">
                                    </div>
                                     EMAIL 
                                    <div class="form-group">
                                        <label for="email" class="control-label">Email*</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                                    </div>
                                     PASSWORD TODO HASH 
                                    <div class="form-group" id="passwordSection">
                                        <label for="password" class="control-label">Password*</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    </div>
                                     USER TYPE 
                                    <div class="form-group">
                                        <label for="user_type" class="control-label">User Type</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="type" id="general" value="general" required>User
                                        </label>;
                                        <label class="radio-inline">
                                            <input type="radio" name="type" id="administrator" value="administrator" required>Administrator
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="userid" id="userid" />
                                    <input type="hidden" name="action" id="action" value="updateUser" />
                                    <input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  -->