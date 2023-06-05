<?php
if (isset($_POST['submit'])) {
  $conn = mysqli_connect('localhost', 'root', '', 'velolib') or die(mysqli_error($conn));
  if ($conn) {
      

      // Generate new ID
      $query = "SELECT MAX(CAST(SUBSTR(IDSTATION, 2) AS UNSIGNED)) AS max_id FROM station";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $max_id = $row['max_id'];
      $new_id = 'S' . ((int)$max_id + 1);
      
      
  
      $modele = $_POST['modele'];
      $date = $_POST['date'];
      $vitesse=0;
      echo $modele,$date,$new_id;
    

      $sql = "INSERT INTO station (IDSTATION,ADRESSESTATION,	DATEAJOUTSTATION)  VALUES (?,?,?)";
      $stmt=mysqli_prepare($conn,$sql);
      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $new_id,$modele,$date);
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