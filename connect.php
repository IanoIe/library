<?php
// Creer Connexion
   $host = 'localhost';
   $dbname = 'library';
   $user = 'root';
   $pass = 'Mamae13';
   try {
       $pdo = new PDO("mysql:host=$host;dbname=$dbname;chartset=utf8", $user, $pass);
       echo "Connexion réussie <br>";
    } catch (PDOException $e) {
       echo "Erreur de connexion : <br>". $e->getMessage();
    }
?>