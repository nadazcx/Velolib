<?php
if (isset($_POST['submit'])) {
  $conn = mysqli_connect('localhost', 'root', '', 'velolib') or die(mysqli_error($conn));
  if ($conn) {
      

      // Generate new ID
      $query = "SELECT MAX(CAST(SUBSTR(IDVELO, 2) AS UNSIGNED)) AS max_id FROM velo";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $max_id = $row['max_id'];
      $new_id = 'V' . ((int)$max_id + 1);
      
      
      $iborne= $_POST['idBorne'];
      $modele = $_POST['modele'];
      $date = $_POST['date'];
      $vitesse=0;
    

      $sql = "INSERT INTO velo (IDVELO, IDBORNE, MODELEVELO, DATEAJOUTVELO, KILOMETRAGEACTUEL, VITESSEMAXACTUELLE, VITESSEMOYACTUELLE) 
        VALUES (?,?,?,?,?,?,?)";
      $stmt=mysqli_prepare($conn,$sql);
      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssss", $new_id,$iborne,$modele,$date,$vitesse,$vitesse,$vitesse);
        mysqli_stmt_execute($stmt);
       
        header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
     
    } else {
        echo "Failed to prepare statement: " . mysqli_error($conn);
    }
    
  } else {
      echo "Failed to connect to database.";
  }
  mysqli_close($conn);
} else {
  echo "Failed to submit form.";
}


?>