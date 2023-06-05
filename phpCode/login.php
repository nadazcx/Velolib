<?php


if (isset($_POST["submit"])){
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="velolib";
    $conn=mysqli_connect($servername,$username,$password,$dbname);
    if(!$conn){
        die("La connexion a échoué :".mysqli_connect_error());
    }
    $email=$_POST['email'];
    $pwd=$_POST['pwd'];
    $sql="SELECT * FROM utilisateur WHERE emailUtilisateur=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result !== false && mysqli_num_rows($result)>0){      
        $row=mysqli_fetch_assoc($result);
        $actualPass=$row['MDPUTILISATEUR'];
        if($actualPass==$pwd){
            session_start();
            $_SESSION['email']=$email;
            if($email=="admin@gmail.com"){
            header("Location: ../admin/admin.php");
            exit();
            }
        
            header("Location: ../admin/users-profile.php");
            echo 'good';
            exit;
        }
        else{
            
            header("Location: ../login.html?attempt=true");
        }
    }
    else {
        echo 'bad';
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
   echo 'failed to submit';
}

?>