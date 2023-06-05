<?php
if (isset($_POST['submit'])) {
  $conn = mysqli_connect('localhost', 'root', '', 'velolib') or die(mysqli_error($conn));
  if ($conn) {
      echo "Connexion réussie<br>";

      // Generate new ID
      $query = "SELECT MAX(CAST(SUBSTR(idUtilisateur, 2) AS UNSIGNED)) AS max_id FROM utilisateur";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $max_id = $row['max_id'];
      $new_id = 'U' . ((int)$max_id + 1);

      $nom = $_POST['nom'];
      $prenom = $_POST['prenom'];
      $gender = $_POST['gender'];
      $num = $_POST['num'];
      $email = $_POST['email'];
      $date = $_POST['birthday'];
      $mdp = $_POST['pwd'];

      $stmt = mysqli_prepare($conn, "INSERT INTO utilisateur (idUtilisateur, prenomUtilisateur, nomUtilisateur, dateNaissance, numeroTelephone, sexe, emailUtilisateur, mdpUtilisateur) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssss", $new_id, $prenom, $nom, $date, $num, $gender, $email, $mdp);
        mysqli_stmt_execute($stmt);
        header("Location: ../login.html?success=true");
        echo "Nouvel utilisateur inséré avec succès.";
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