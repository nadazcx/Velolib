<?php

$servername="localhost";
$username="root";
$password="";
$dbname="velolib";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
       die("La connexion a échoué :".mysqli_connect_error());
 }

else{

session_start();
if ($_SESSION['email'] !== "") {
    $user = $_SESSION['email'];
    $query = "SELECT PRENOMUTILISATEUR, NOMUTILISATEUR, DATENAISSANCE, NUMEROTELEPHONE, SEXE, EMAILUTILISATEUR WHERE EMAILUTILISATEUR = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_data = mysqli_fetch_assoc($result);
    var_dump($user_data);
}
mysqli_close($conn);
}

?>
