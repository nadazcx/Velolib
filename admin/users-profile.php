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
        </li><!-- End Search Icon-->

    
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
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-person"></i>
                <span>Mon Profile</span>
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
    <a class="nav-link collapsed" href="index.php">
      <i class="bi bi-grid"></i>
      <span>Tableau de bord
</span>
    </a>
  </li><!-- End Tableau de bord
 Nav -->

 


 


  
  <li class="nav-item">
    <a class="nav-link " href="#">
      <i class="bi bi-person"></i>
      <span>Profile</span>
    </a>
  </li><!-- End Profile Page Nav -->
</ul>

</aside>

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " >
          <i class="bi bi-grid"></i>
          <span>Tableau de bord
</span>
        </a>
      </li><!-- End Tableau de bord
 Nav -->


 

 

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

    

    </ul>

  </aside>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">ACCEUIL</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

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

              <h2><?php  echo $user_data['prenom'] . ' ' . $user_data['nom']; ?></h2>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Aperçu</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier Profile</button>
                </li>

              
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Changer mot de passe</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php  echo $user_data['prenom'] . ' ' . $user_data['nom']; ?></div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $user?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="upload.php" enctype="multipart/form-data">

                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                      
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
                        <div class="pt-2">          
                          <input class="form-control" type="file" name="uploadfile" value="Upload picture" /><i class="bi bi-upload"></i>
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" name="upload" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                

              
                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

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

