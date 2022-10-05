<?php
try {
  session_start();
  $db = new PDO("mysql:dbname=webshop; host=localhost", 'root', '123');
  print "Datenbankverbindung erfolgreich!";
} catch (PDOException $e) {
  print $e->getMessage();
}
