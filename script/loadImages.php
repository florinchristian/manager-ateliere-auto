<?php
    include 'connectDatabase.php';

    $vin = $_GET['vin'];
    $serie = $_GET['seringa'];
    $atelier = $_GET['atelier'];

    if (!isset($_GET['atelier'])) {
        session_start();

        $atelier = $_SESSION['user'];
    }

    $sql = "select path from images where atelier='$atelier' and vin='$vin' and serie_seringa='$serie';";
    $result = $conn->query($sql);

    $imagini = array();

    while($row = $result->fetch_assoc()) {
        $imagini[] = $row['path'];
    }

    echo json_encode($imagini);
?>