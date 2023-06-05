<?php
function get_location_data_php($conn, $user_email) {
  $query = "SELECT l.*, s.ADRESSESTATION
            FROM location l
            JOIN borne b ON b.IDBORNE = l.IDBORNEDEPOT
            JOIN station s ON s.IDSTATION = b.IDSTATION
            JOIN utilisateur u ON u.IDUTILISATEUR = l.IDUTILISATEUR
            WHERE u.EMAILUTILISATEUR = ?";

  $stmt = mysqli_prepare($conn, $query);

  if (!$stmt) {
    error_log("Error preparing statement: " . mysqli_error($conn));
    return null;
  }

  mysqli_stmt_bind_param($stmt, "s", $user_email);

  if (!mysqli_stmt_execute($stmt)) {
    error_log("Error executing statement: " . mysqli_error($conn));
    return null;
  }

  $result = mysqli_stmt_get_result($stmt);

  if (!$result) {
    error_log("Error getting result: " . mysqli_error($conn));
    return null;
  }

  $data = array();

  while ($row = mysqli_fetch_assoc($result)) {
    $date = date("d/m/Y H:i:s", strtotime($row['HEUREDEPOT']));
    $address = $row['ADRESSESTATION'];
    $max_speed = $row['VITESSEMAXDEPOT'];

    $data[] = array(
      "date" => $date,
      "address" => $address,
      "max_speed" => $max_speed
    );
  }

  mysqli_stmt_close($stmt);

  return $data;
}
?>
