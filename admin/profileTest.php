<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "velolib";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("La connexion a échoué :" . mysqli_connect_error());
} else {
    session_start();
    if ($_SESSION['email'] !== "") {
        $user = $_SESSION['email'];
        if ($statement = mysqli_prepare($conn, "SELECT PRENOMUTILISATEUR, NOMUTILISATEUR, DATENAISSANCE, NUMEROTELEPHONE, SEXE FROM utilisateur WHERE EMAILUTILISATEUR = ?")) {
            mysqli_stmt_bind_param($statement, "s", $user);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            if (mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                $user_data = array(
                    'prenom' => $user_data['PRENOMUTILISATEUR'],
                    'nom' => $user_data['NOMUTILISATEUR'],
                    'date_naissance' => $user_data['DATENAISSANCE'],
                    'telephone' => $user_data['NUMEROTELEPHONE'],
                    'sexe' => $user_data['SEXE']
                );
                

                 
                 header("Location: ../admin/users-profile.php");
                exit();
            } else {
                echo "Error: No user found with that email address.";
            }
            mysqli_stmt_close($statement);
        } else {
            echo "Error: Unable to prepare SQL statement.";
        }
    }
    mysqli_close($conn);
}
?>