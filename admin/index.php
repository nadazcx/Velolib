<?php
session_start();
if(!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: ../login.html");
    exit();
} 
?>
<?php
// Retrieve email from session
$user = $_SESSION['email'];

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "velolib";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve total expenses for user
$query = "SELECT SUM(TIME_TO_SEC(TIMEDIFF(l.HEUREDEPOT, l.HEUREPRISE))/1800 * ta.TARIFABONNEMENT)/2 AS TOTAL_DEPENSE
 FROM location l JOIN utilisateur u ON u.IDUTILISATEUR = l.IDUTILISATEUR 
 JOIN abonnement a ON a.IDUTILISATEUR = u.IDUTILISATEUR 
 JOIN typeAbonnement ta ON ta.IDTYPEABONNEMENT = a.IDTYPEABONNEMENT 
 WHERE u.EMAILUTILISATEUR = ? ;
";
          
if ($statement = mysqli_prepare($conn, $query)) {
    mysqli_stmt_bind_param($statement, "s", $user);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);

    // Check if query execution was successful
    if (!$result) {
        $error_msg = mysqli_stmt_error($statement);
        error_log("Error executing query: $error_msg");
        $depense = 0;
    } else {
        // Check if user has made at least one bike rental
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $depense = number_format($row['TOTAL_DEPENSE'],2);
        } else {
            $depense = 0;
        }
    }
} else {
    $depense = 0;
}

// Close database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en"><?php

if(!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: ../login.html");
    exit();
} 
?>

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

  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "velolib";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
 
  
  
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
        $conn->close();
           
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
<span class="d-none d-md-block dropdown-toggle ps-2"><?php  echo $user_data['prenom'][0] . '. ' . $user_data['nom']; ?></span>          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php  echo $user_data['prenom'] . ' ' . $user_data['nom']; ?></h6>
             
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>Mon profile</span>
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

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Tableau de bord</span>
        </a>
      </li><!-- End Dashboard Nav -->


 

 

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

    

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Tableau de bord</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">ACCEUIL</a></li>
          <li class="breadcrumb-item active">Tableau de bord</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
         
            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Depenses <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class='bx bx-coin-stack' ></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $depense ?></h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-7 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Votre abonnement actuel</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>Courte Durée</h6>
                     

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">

                
                <div class="card-body">
                  <h5 class="card-title">Rapport <span></span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>
                  <?php

$conn = mysqli_connect("localhost", "root", "", "velolib");

$sql = "SELECT VITESSEMAXDEPOT, DATEPRISE FROM location";
$result = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['DATEPRISE']] = $row['VITESSEMAXDEPOT'];
}

$chart_data = [];
foreach ($data as $date => $max_speed) {
    $chart_data[] = [
        'name' => $date,
        'data' => [$max_speed]
    ];
}

if (empty($chart_data)) {
    $chart_data[] = [
        'name' => 'No Data',
        'data' => [0]
    ];
}

$chart_data_json = json_encode($chart_data);

?>

<!-- Render the chart -->
<div id="reportsChart"></div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#reportsChart"), {
      series: <?= $chart_data_json ?>,
      chart: {
        height: 350,
        type: 'area',
        toolbar: {
          show: false
        },
      },
      markers: {
        size: 4
      },
      colors: ['#4154f1', '#2eca6a', '#ff771d'],
      fill: {
        type: "gradient",
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.3,
          opacityTo: 0.4,
          stops: [0, 90, 100]
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2
      },
      xaxis: {
        type: 'datetime',
        categories: <?= json_encode(array_keys($data)) ?>
      },
      tooltip: {
        x: {
          format: 'dd/MM/yyyy HH:mm'
        },
      }
    }).render();
  });
</script>



                </div>

              </div>
            </div><!-- End Reports -->

      
      
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                
               
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Activité recente <span>| Cette Année </span></h5>

              <div class="activity">

            

                <?php
// Retrieve email from session


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "velolib";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Assuming you have already established a database connection
$query = "SELECT l.HEUREPRISE, l.HEUREDEPOT, s.ADRESSESTATION ,l.DATEPRISE
          FROM location l 
          JOIN utilisateur u ON u.IDUTILISATEUR = l.IDUTILISATEUR 
          JOIN borne b ON b.IDBORNE = l.IDBORNEPRISE 
          JOIN station s ON s.IDSTATION = b.IDSTATION 
          WHERE u.EMAILUTILISATEUR = ?";
          
if ($statement = mysqli_prepare($conn, $query)) {
    mysqli_stmt_bind_param($statement, "s", $user);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }   if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          $debut = $row['HEUREPRISE'];
          $fin = $row['HEUREDEPOT'];
          $adresse = $row['ADRESSESTATION'];
          $date=$row['DATEPRISE'];
          $duree = round((strtotime($fin) - strtotime($debut)) / 60);
          $activity_text = "Location à $adresse ($duree minutes)";
          echo '<div class="activity-item d-flex">';
          echo '<div class="activite-label">' . $date ," à ",$debut. ' </div>';
          echo '<i class="bi bi-circle-fill activity-badge text-danger align-self-start"></i>';
          echo '<div class="activity-content">' . $activity_text . '</div>';
          echo '</div><!-- End activity item-->';
      }
  }
 else{
  echo '<div class="activity-content"> Pas de location récente </div>';


 }
} else {
    die("Error preparing query: " . mysqli_error($conn));
}

$conn->close();
?>       
                </div><!-- End activity item-->

              </div>

            </div>
          </div><!-- End Recent Activity -->

          <!-- Budget Report -->
         
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
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