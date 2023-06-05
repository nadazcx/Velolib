<?php
session_start();
if(!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: ../login.html");
    exit();
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Baskalty</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

 <?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "velolib";
 $conn = mysqli_connect($servername, $username, $password, $dbname);

 
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
       }}
          
 ?> 
 

  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block" style="color: white; text-indent: 25px;">Baskalty</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

   
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li>

    
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            
            <?php

$email = $_SESSION['email'];

$db = mysqli_connect("localhost", "root", "", "velolib");

// Check if user has uploaded an image
$sql = "SELECT * FROM image WHERE email='$email'";
$result = mysqli_query($db, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // User has uploaded an image, display it
    $row = mysqli_fetch_assoc($result);
    $image_path = "../image/" . $row['filename'];
} else {
    // User has not uploaded an image, display a default image
    $image_path = "assets/img/profile-img.jpg";
}
?>

<img src="<?php echo $image_path; ?>" alt="Profile" class="rounded-circle">
            
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php  echo $user_data['prenom'][0] . '. ' . $user_data['nom']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php  echo $user_data['prenom'] . ' ' . $user_data['nom']; ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" >
                <i class="bi bi-person"></i>
                <span>Administrateur</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

          
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Deconnexion</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header>

  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link  collapsed" href="adminstation.php">
          <i class="bi bi-grid"></i>
          <span>Stations</span>
        </a>
      </li><!-- End Dashboard Nav -->


 

 

      <li class="nav-item">
        <a class="nav-link collapsed" href="admin.php">
          <i class="bi bi-person"></i>
          <span>Vélos</span>
        </a>
      </li><!-- End Profile Page Nav -->
      <li class="nav-item">
    <a class="nav-link  " href="adminborne.php">
      <i class="bi bi-person"></i>
      <span>Utilisateurs</span>
    </a>

    

    </ul>

  </aside><!-- End Sidebar-->

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " >
          <i class="bi bi-grid"></i>
          <span>Modifier les stations
</span>
        </a>
      </li><!-- End Tableau de bord
 Nav -->


 

 

      <li class="nav-item">
        <a class="nav-link collapsed" href="admin.php">
          <i class="bi bi-person"></i>
          <span>Modifier les vélos</span>
        </a>
      </li><!-- End Profile Page Nav -->

    

    </ul>

  </aside>
  <main id="main" class="main">

<div class="pagetitle">
  <h1>Table Borne</h1>
  
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-20">
      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Modifier </button>
            </li>

         

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
              
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "velolib";
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        if ($statement = mysqli_prepare($conn, "SELECT  
                        IDUTILISATEUR,	PRENOMUTILISATEUR,	NOMUTILISATEUR	,DATENAISSANCE	,NUMEROTELEPHONE FROM utilisateur")) {
                            mysqli_stmt_execute($statement);
                            $result = mysqli_stmt_get_result($statement);
                            if (mysqli_num_rows($result) > 0) {
                                // Display table header
                                echo "<table>";
                                echo "<tr>";
                                while ($fieldinfo = mysqli_fetch_field($result)) {
                                    echo "<th>" . $fieldinfo->name . "</th>";
                                }
                            
                                echo "</tr>";
                            
                                // Display table data
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<form method='POST' action='stationedit/updatestation.php'>";
                                    foreach ($row as $key => $value) {
                                        echo "<td><input type='text' name='$key' value='$value'></td>";
                                    }
                                    echo "<td>";
                               
                                    
                                }
                                echo "</table>";
                            }
                            
                            else {
                                echo "No data found.";
                            }}
                                
                        ?> 
                 

            </div>

            

          
            </div>

  
          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>
</section>
                  

</main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Baskalty</span></strong>. All Rights Reserved
    </div>
  
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

