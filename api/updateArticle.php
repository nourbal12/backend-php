<?php 
include '../allow_header.php';
include '../db_connexion.php';
include '../article.php';




 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "phpcrud";



$db = new DbConnexion($servername, $username, $password, $dbname);
$conn = $db->getConnexion();

    
$article = new Article($conn);
$article->update($_GET['id'],file_get_contents('php://input'));
  
?>