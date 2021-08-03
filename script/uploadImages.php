<?php
    include 'connectDatabase.php';

    $path = "/var/www/clients/client1/web6/web/images/";
    $atelier = $_POST['atelier'];
    $vin = $_POST['vin'];
    $serie = $_POST['seringa'];

    if (!isset($_POST['atelier'])) {
        session_start();
        $atelier = $_SESSION['user'];
    }

    $md5 = md5($atelier.$vin.$serie);

    //mkdir('images/', 0777, true);

    $sql = "update useri set images='yes' where atelier='$atelier' and vin='$vin' and serie_seringa='$serie';";
    $conn->query($sql);

    foreach($_FILES as $key) {
        
        if (!is_dir($path.$md5)) {
            mkdir($path.$md5, 0777, true);
        }

        $fname = $key['name'];

        move_uploaded_file($key['tmp_name'], $path.$md5."/".$fname);
        //echo $key['tmp_name'];

        $file_path = "/images/$md5/$fname";

        $sql = "insert into `images`(`atelier`, `vin`, `serie_seringa`, `path`) VALUES ('$atelier','$vin','$serie','$file_path');";

        $conn->query($sql);
    }
?>