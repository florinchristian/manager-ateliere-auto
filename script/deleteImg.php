<?php
    include 'connectDatabase.php';

    $path = "/var/www/clients/client1/web6/web";

    //echo json_encode($_POST);
    $atelier = $_POST['atelier'];
    $vin = $_POST['vin'];
    $seringa = $_POST['seringa'];
    $img = $_POST['path'];

    if(!isset($_POST['atelier'])) {
        session_start();

        $atelier = $_SESSION['user'];
    }

    $sql = "delete from images where atelier='$atelier' and vin='$vin' and serie_seringa='$seringa' and path='$img';";
    $conn->query($sql);

    unlink($path.$img);

    $sql = "select count(*) from images where atelier='$atelier' and vin='$vin' and serie_seringa='$seringa';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ((int)$row['count(*)'] == 0) {
        $sql = "update useri set images='no' where atelier='$atelier' and vin='$vin' and serie_seringa='$seringa';";
        $conn->query($sql);
    }
?> 