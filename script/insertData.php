<?php
    include 'connectDatabase.php';

    //              type: 'insert_user',
    //              nume: $('#nume').val(),
    //              prenume: $('#prenume').val(),
    //              telefon: $('#telefon').val(),
    //              email: $('#email').val(),
    //              vin: $('#vin').val(),
    //              serie_seringa: $('#serie-seringa').val(),
    //              observatii: $('#observatii').val()

    if ($_POST['type'] == 'insert_user') {

        session_start();

        $atelier = $_SESSION['user'];

        $nume = $_POST['nume'];
        $prenume = $_POST['prenume'];
        $telefon = $_POST['telefon'];
        $email = $_POST['email'];
        $vin = $_POST['vin'];
        $serie = $_POST['serie_seringa'];
        $obs = $_POST['observatii'];

        $calendar = $_POST['calendar'];

        if(strlen($nume) == 0) {
            echo 'Numele nu poate fi gol!';
            die();
        }

        if (strlen($prenume) == 0) {
            echo 'Prenumele nu poate fi gol!';
            die();
        }

        if (strlen($telefon) == 0) {
            echo 'Telefonul nu poate fi gol!';
            die();
        }

        if (strlen($vin) == 0) {
            echo 'VIN-ul nu poate fi gol!';
            die();
        }

        if (strlen($serie) == 0) {
            echo 'Seria nu poate fi goala!';
            die();
        }

        $sql = "select vin, serie_seringa from useri where vin='$vin' and serie_seringa='$serie' and atelier='$atelier';";
        $result = $conn->query($sql);
        if ($result->num_rows != 0) {
            echo 'Exista deja un client cu VIN-ul si seria introduse!';
            die();
        }
        

        $sql = "select count(*) from useri where atelier='$atelier';";
        $result = $conn->query($sql);
        $newId = (int)$result->fetch_assoc()['count(*)'] + 1;

        $sql = "insert into `useri`(`atelier`, `nume`, `prenume`, `telefon`, `email`, `vin`, `serie_seringa`, `observatii`, `calendar`, `id`) VALUES ('$atelier','$nume','$prenume','$telefon','$email','$vin','$serie','$obs','$calendar','$newId');";
        $conn->query($sql);

        echo 'success';
        die();
    }

    if ($_POST['type'] == 'insert_user_admin') {

        $atelier = $_POST['atelier'];

        $nume = $_POST['nume'];
        $prenume = $_POST['prenume'];
        $telefon = $_POST['telefon'];
        $email = $_POST['email'];
        $vin = $_POST['vin'];
        $serie = $_POST['serie_seringa'];
        $obs = $_POST['observatii'];

        $calendar = $_POST['calendar'];

        if(strlen($nume) == 0) {
            echo 'Numele nu poate fi gol!';
            die();
        }

        if (strlen($prenume) == 0) {
            echo 'Prenumele nu poate fi gol!';
            die();
        }

        if (strlen($telefon) == 0) {
            echo 'Telefonul nu poate fi gol!';
            die();
        }

        if (strlen($vin) == 0) {
            echo 'VIN-ul nu poate fi gol!';
            die();
        }

        if (strlen($serie) == 0) {
            echo 'Seria nu poate fi goala!';
            die();
        }

        $sql = "select vin, serie_seringa from useri where vin='$vin' and serie_seringa='$serie' and atelier='$atelier';";
        $result = $conn->query($sql);
        if ($result->num_rows != 0) {
            echo 'Exista deja un client cu VIN-ul si seria introduse!';
            die();
        }

        $sql = "select count(*) from useri where atelier='$atelier';";
        $result = $conn->query($sql);
        $newId = (int)$result->fetch_assoc()['count(*)'] + 1;

        $sql = "insert into `useri`(`atelier`, `nume`, `prenume`, `telefon`, `email`, `vin`, `serie_seringa`, `observatii`, `calendar`, `id`) VALUES ('$atelier','$nume','$prenume','$telefon','$email','$vin','$serie','$obs','$calendar','$newId');";
        $conn->query($sql);

        echo 'success';
        die();
    }

    if($_POST['type'] == 'insert_atelier') {

        $nume = $_POST['nume'];
        $username = $_POST['username'];
        $parola = $_POST['parola'];

        $sql = "select * from ateliere where nume='$nume';";
        $result = $conn->query($sql);

        if ($result->num_rows != 0) {
            echo 'Numele ales este deja luat!';
            die();
        }

        $sql = "select * from ateliere where username='$username';";
        $result = $conn->query($sql);

        if ($result->num_rows != 0) {
            echo 'Username-ul ales este deja luat!';
            die();
        }

        $sql = "insert into `ateliere`(`nume`, `username`, `parola`) VALUES ('$nume','$username','$parola');";
        $conn->query($sql);

        echo 'success';

        die();
    }
?>