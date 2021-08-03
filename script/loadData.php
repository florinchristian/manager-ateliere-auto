<?php
    define('MAX_CLIENTI', 50);

    include 'connectDatabase.php';

    if ($_GET['type'] == 'nume_ateliere') {
        $sql = 'select nume from ateliere;';
        $result = $conn->query($sql);

        $useri = array();

        while($row = $result->fetch_assoc()) {
            $useri[] = $row['nume'];
        }

        echo json_encode($useri);
        die();
    }

    if ($_GET['type'] == 'load_useri_atelier') {

        session_start();

        $atelier = $_SESSION['user'];

        $sql = "select count(*) from useri where atelier='$atelier';";
        $result = $conn->query($sql);
        $nr_clienti = (int)$result->fetch_assoc()['count(*)'];

        $useri = array();

        if ($nr_clienti <= MAX_CLIENTI) {
            $sql = "select * from useri where atelier='$atelier';";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                $useri[] = $row;
            }
        } else {
            $start = $nr_clienti - MAX_CLIENTI;
            $sql = "select * from useri where atelier='$atelier' and id between $start and $nr_clienti;";

            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                $useri[] = $row;
            }
        }

        echo json_encode(array($_SESSION['user'], $useri));

        die();
    }

    if ($_GET['type'] == 'load_useri_admin') {

        $atelier = $_GET['atelier'];

        $sql = "select count(*) from useri where atelier='$atelier';";
        $result = $conn->query($sql);
        $nr_clienti = (int)$result->fetch_assoc()['count(*)'];

        $useri = array();

        if ($nr_clienti <= MAX_CLIENTI) {
            $sql = "select * from useri where atelier='$atelier';";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                $useri[] = $row;
            }
        } else {
            $start = $nr_clienti - MAX_CLIENTI;
            $sql = "select * from useri where atelier='$atelier' and id between $start and $nr_clienti;";

            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                $useri[] = $row;
            }
        }


        echo json_encode($useri);

        die();
    }

    if ($_GET['type'] == 'load_useri_filtered') {

        $atelier = $_GET['atelier'];
        $vin = $_GET['vin'];
        $seringa = $_GET['serie_seringa'];

        $vin_clause = ($vin == '') ? '' : " and vin='$vin'";
        $seringa_clause = ($seringa == '') ? '' : " and serie_seringa='$seringa'";

        $sql = "select * from useri where atelier='$atelier'".$vin_clause.$seringa_clause.";";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
            $useri[] = $row;
        }

        echo json_encode($useri);

        die();
    }

    if ($_GET['type'] == 'load_useri_filtered_atelier') {
        session_start();

        $atelier = $_SESSION['user'];
        $vin = $_GET['vin'];
        $seringa = $_GET['serie_seringa'];

        $vin_clause = ($vin == '') ? '' : " and vin='$vin'";
        $seringa_clause = ($seringa == '') ? '' : " and serie_seringa='$seringa'";

        $sql = "select * from useri where atelier='$atelier'".$vin_clause.$seringa_clause.";";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()) {
            $useri[] = $row;
        }

        echo json_encode($useri);

        die();
    }

    echo 'success';
?>