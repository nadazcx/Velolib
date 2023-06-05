
<?php
error_reporting(0);

$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {

  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];
  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  $newfilename = uniqid() . '.' . $extension;
  $folder = "../image/" . $newfilename;
  session_start();
  $email = $_SESSION['email']; // Get the user's email from the session
  $db = mysqli_connect("localhost", "root", "", "velolib");

  // Get all the submitted data from the form
  $sql = "INSERT INTO image (filename, email) VALUES ('$newfilename', '$email')";

  // Execute query
  mysqli_query($db, $sql);
  if(mysqli_affected_rows($db) > 0) {
    ?>
    <script>
      console.log("SQL executed successfully!");
    </script>
    <?php
  } else {
    ?>
    <script>
      console.log("Failed to execute SQL!");
    </script>
    <?php
  }
  
  // Now let's move the uploaded image into the folder: image
  if (move_uploaded_file($tempname, $folder)) {
      echo "<h3> Image uploaded successfully!</h3>";
  } else {
      echo "<h3> Failed to upload image!</h3>";
  }
  header("Location: ../admin/users-profile.php" );

}
?>