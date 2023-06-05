<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "velolib";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if (isset($_POST["id"])) {
        $id = $_POST["id"];
        $modele = $_POST['ADRESSESTATION'];
        $date = $_POST['DATEAJOUTSTATION'];
        echo $modele ,$date , $id;
        
        // Construct the SQL statement
        $sql = "UPDATE station SET ADRESSESTATION='$modele'  ,DATEAJOUTSTATION='$date' WHERE IDSTATION='$id'";
    
        // Execute the SQL statement
        if (mysqli_query($conn, $sql)) {
           header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            echo "Error deleting row: " . mysqli_error($conn);
        }
    

    
        mysqli_close($conn);
    } else {
        echo "ID parameter not found";
    }

?>
