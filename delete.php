<?php
include("connect.php"); 

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"]; 
    echo "ID recebido: $id<br>";
}


if (isset($_GET["id"])) {
    $id = (int) $_GET["id"]; 

    try {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur de suppression : " . $e->getMessage();
        die();
    }
}

  header("Location: /indexAdmin.php"); 
  die();
?>
