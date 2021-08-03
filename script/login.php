<?php
    include 'connectDatabase.php';

    $nume = $_POST['username'];

    $sql = "select * from ateliere where username='$nume';";

    $result = $conn->query($sql);
    $row =  $result->fetch_assoc();


    if ($result->num_rows == 0) {
        echo 'Utilizator invalid!';
    } else {

        if ($row['parola'] == $_POST['password']) {
            if ($row['enabled'] == 'no') {
                echo 'Atelierul pe care incerci sa-l accesezi nu este disponibil! Incearca mai tarziu!';
                die();
            }

            session_start();

            $_SESSION['user'] = $row['nume'];
            echo 'success';
        } else {
            echo 'Parola introdusa este gresita!';
        }
    }
?>