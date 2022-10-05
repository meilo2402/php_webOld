<?php
require_once('dbconn.php');
// include("...php");
// REGISTER
if (isset($_POST["register"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        echo '<script>alert("Both Fields are required")</script>';
    } else {
        try {
            $sql = 'INSERT INTO users(user_id, username, firstname, lastname, adress, email, password, type) VALUES( :user_id, :username,:firstname,:lastname,:adress,:email,:password,:type)';

            $statement = $db->prepare($sql);

            $username = trim($_POST["username"]);
            $firstname = trim($_POST["firstname"]);
            $lastname = trim($_POST["lastname"]);
            $password = trim($_POST["password"]);
            $type = "User";
            $email = trim($_POST["email"]);
            $adress = trim($_POST["adress"]);

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $check = $statement->execute([
                'user_id' => uniqid(),
                'username' => $username,
                'firstname' => $firstname,
                'lastname' =>  $lastname,
                'password' => $hashed_password,
                'type' => $type,
                'email' => $email,
                'adress' => $adress
            ]);

            if ($check === true) {
                print "Sie haben sich erfolgreich registriert!";
            }
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}



if (isset($_POST["login"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        echo '<script>alert("Both Fields are required")</script>';
    } else {
        try {
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            $sql = "SELECT password FROM users WHERE username = '$username'";
            print_r($sql);
            $rueckgabe = $db->query($sql);
            $ergebnis = $rueckgabe->fetchAll(PDO::FETCH_ASSOC);
            print_r($ergebnis);

            if (password_verify($password, $ergebnis["password"])) {
                header("location:entry.php");
            }else{
                echo '<script>alert("Wrong User Details")</script>';
            }


        } catch (PDOException $e) {
            print $e->getMessage();
        }




        // $query = "SELECT * FROM users WHERE username = '$username'";
        // $result = mysqli_query($db, $query);
        // // print_r("result login " . $result);
        // if (mysqli_num_rows($result) > 0) {

        //     while ($row = mysqli_fetch_array($result)) {
        //         print_r(password_verify($password, $row["password"]));
        //         if (password_verify($password, $row["password"])) {
        //             //return true;  
        //             $_SESSION["username"] = $username;
        //             header("location:entry.php");
        //         } else {
        //             //return false;  
        //             echo '<script>alert("Wrong User Details")</script>';
        //         }
        //     }
        // } else {
        //     echo '<script>alert("Wrong User Details")</script>';
        // }
        // }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
    <!-- div for page -->

    <div class="main">
        <?php
        include "layouts/header.php";
        ?>


        <!-- div for php -->
        <div class="content">

            <br /><br />
            <div class="container" style="width:500px;">
                <!-- <h3 align="center">Registrierung</h3> -->
                <br />
                <?php
                if (isset($_GET["action"]) == "login") {
                ?>
                    <h3 align="center">Login</h3>
                    <br />
                    <form method="post">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" />
                        <br />

                        <label>Enter Password</label>
                        <input type="password" name="password" class="form-control" />
                        <br />

                        <input type="submit" name="login" value="Login" class="btn btn-info" />
                        <br />

                        <p align="center"><a href="signup.php">Registrieren</a></p>
                        <p align="center"><a href="adminLogin.php?action=login">Admin Login</a></p>

                    </form>

                <?php
                } else {
                ?>

                    <br />
                    <form method="post">
                        <h3 align="center">Registrieren</h3>

                        <label>Username</label>
                        <input type="text" name="username" class="form-control" />
                        <br />
                        <label>Passwort</label>
                        <input type="text" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
                        <br />

                        <label>Vorname</label>
                        <input name="firstname" type="text" class="form-control">
                        <br />

                        <label>Nachname</label>
                        <input name="lastname" type="text" class="form-control">
                        <br />

                        <label>E-Mail</label>
                        <input name="email" type="email" class="form-control">
                        <br />

                        <label>Adresse</label>
                        <input name="adress" type="text" class="form-control">
                        <br />

                        <input type="submit" name="register" value="Registrieren" class="btn btn-info" />
                        <br />
                        <p align="center"><a href="signup.php?action=login">Login</a></p>
                        <p align="center"><a href="adminLogin.php?action=login">Admin Login</a></p>

                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    include "layouts/footer.php";
    ?>
</body>

</html>