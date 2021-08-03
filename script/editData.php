<?php
    include 'connectDatabase.php';

    //type:'admin',
      //         atelier: $('#selector-atelier').val(),
        //       telefon: values[0],
          //     email: values[1],
            //   vin: values[2],
              // serie: values[3],
               //obs: values[4]

    if ($_POST['type'] == 'admin') {

        $atelier = $_POST['atelier'];
        $telefon = $_POST['telefon'];
        $email = $_POST['email'];
        $vin = $_POST['vin'];
        $serie = $_POST['serie'];
        $obs = $_POST['obs'];

        //$current_vin = $_POST['vin_curent'];
        //$current_serie = $_POST['serie_curenta']; 

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

        $vin_curent = $_POST['vin_curent'];
        $serie_curenta = $_POST['serie_curenta'];
        

        $sql = "select vin, serie_seringa from useri where vin='$vin' and serie_seringa='$serie' and atelier='$atelier';";
        $result = $conn->query($sql);

        //echo $result->num_rows." $vin_curent $vin | $serie_curenta $serie";
        //die();

        if ( $result->num_rows >= 1 && ($vin_curent != $vin || $serie_curenta != $serie) ){
            echo 'Exista deja un client cu VIN-ul si seria introduse!';
            die();
        }

        $sql = "update useri set telefon='$telefon', email='$email', vin='$vin', serie_seringa='$serie', observatii='$obs' where vin='$vin_curent' and serie_seringa='$serie_curenta' and atelier='$atelier';";

        $conn->query($sql);

        $sql = "update images set vin='$vin', serie_seringa='$serie' where vin='$vin_curent' and serie_seringa='$serie_curenta' and atelier='$atelier';";
        
        $conn->query($sql);

        echo 'success';
    }

    if ($_POST['type'] == 'atelier') {
      session_start();

      $atelier = $_SESSION['user'];

      $telefon = $_POST['telefon'];
      $email = $_POST['email'];
      $vin = $_POST['vin'];
      $serie = $_POST['serie'];
      $obs = $_POST['obs'];

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

      $vin_curent = $_POST['vin_curent'];
      $serie_curenta = $_POST['serie_curenta'];

      $sql = "select vin, serie_seringa from useri where vin='$vin' and serie_seringa='$serie' and atelier='$atelier';";
      $result = $conn->query($sql);

      //echo $result->num_rows." $vin_curent $vin | $serie_curenta $serie";
      //die();

      if ( $result->num_rows >= 1 && ($vin_curent != $vin || $serie_curenta != $serie) ){
          echo 'Exista deja un client cu VIN-ul si seria introduse!';
          die();
      }
      
      $sql = "update useri set telefon='$telefon', email='$email', vin='$vin', serie_seringa='$serie', observatii='$obs' where vin='$vin_curent' and serie_seringa='$serie_curenta' and atelier='$atelier';";

      $conn->query($sql);

      $sql = "update images set vin='$vin', serie_seringa='$serie' where vin='$vin_curent' and serie_seringa='$serie_curenta' and atelier='$atelier';";
        
      $conn->query($sql);

      echo 'success';
  }
?>