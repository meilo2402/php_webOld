<?php
// // session_start();
// $dbhost = "localhost";
// $dbuser = "root";
// $dbpass = "123";
// $database = "webshop";

// //Zeitzone setzen um Probleme beim Zugriff zu verhindern 
// date_default_timezone_set('Europe/Berlin');
// $db = mysqli_connect($dbhost, $dbuser, $dbpass, $database);
// $db->set_charset('utf8');

// if ($db->connect_errno) {
//   die('Datenbankverbindung fehlgeschlagen!');
// };

// if (mysqli_connect_errno()) {
//   printf("Connect failed: %s\n", mysqli_connect_error());
//   exit();
// }

// echo "Connected successfully";


try {
  $db = new PDO("mysql:dbname=webshop; host=localhost", 'root', '123');
  print "Datenbankverbindung erfolgreich!";
//   $sql = "SELECT * FROM `products`";
// //Rückgabe in einer variable speichern
// $rueckgabe = $db -> query($sql);
// //alle Daten all Array in die Variable $products speichern 
// $products = $rueckgabe-> fetchAll(PDO::FETCH_ASSOC);



  // $db = null;
} catch (PDOException $e) {
  print $e->getMessage();
}
