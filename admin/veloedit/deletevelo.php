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
        

    
        // Construct the SQL statement
        $sql = "DELETE FROM velo WHERE IDVELO = '$id'";
    
        // Execute the SQL statement
        if (mysqli_query($conn, $sql)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            echo "Error deleting row: " . mysqli_error($conn);
        }
    
        // Close the database connection
        mysqli_close($conn);
    } else {
        echo "ID parameter not found";
    }

?>
