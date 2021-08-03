<?php
    include 'connectDatabase.php';

    $atelier = $_GET['atelier'];
    $vin = $_GET['vin'];
    $seringa = $_GET['seringa'];

    if (!isset($_GET['atelier'])) {
        session_start();

        $atelier = $_SESSION['user'];
    }

    $sql = "delete from useri where atelier='$atelier' and vin='$vin' and serie_seringa='$seringa';";
    $conn->query($sql);

    $sql = "select path from images where atelier='$atelier' and vin='$vin' and serie_seringa='$seringa';";
    $result = $conn->query($sql);

    $path = "/var/www/clients/client1/web6/web/";

    while ($row = $result->fetch_assoc()) {
        unlink($path.$row['path']);
    }

    $sql = "delete from images where atelier='$atelier' and vin='$vin' and serie_seringa='$seringa';";
    $conn->query($sql);
?>