<?php
    include 'connectDatabase.php';

    if ($_POST['type'] == 'load') {
        $sql = "select * from ateliere";
        $result = $conn->query($sql);

        $ateliere = array();

        while ($row = $result->fetch_assoc()) {
            $ateliere[] = $row;
        }

        echo json_encode($ateliere);
        die();
    }


    //type: 'edit',
               //nume: values[0],
               //username: values[1],
               //parola: values[2],
               //current_user: current_username,
               //current_name: current_nume

    if ($_POST['type'] == 'edit') {
        $nume = $_POST['nume'];
        $username = $_POST['username'];
        $parola = $_POST['parola'];

        $current_username = $_POST['current_user'];
        $current_name = $_POST['current_name'];

        if (strlen(str_replace(' ', '', $nume)) == 0) {
            echo 'Trebuie sa alegi un nume!';
            die();
        }

        if (strlen(str_replace(' ', '', $username)) == 0) {
            echo 'Trebuie sa alegi un username!';
            die();
        }

        if (strlen(str_replace(' ', '', $parola)) == 0) {
            echo 'Trebuie sa alegi o parola!';
            die();
        }
        
        $sql = "select * from ateliere where nume='$nume';";
        $result = $conn->query($sql);


        if ($result->num_rows == 1 && $current_name != $nume) {
            echo 'Numele ales nu este valabil!';
            die();
        }

        $sql = "select * from ateliere where username='$username';";
        $result = $conn->query($sql);

        if ($result->num_rows == 1 && $current_username != $username) {
            echo 'Username-ul ales nu este valabil!';
            die();
        }

        $sql = "update ateliere set nume='$nume', username='$username', parola='$parola' where username='$current_username';";
        $conn->query($sql);

        $sql = "update useri set atelier='$nume' where atelier='$current_name';";
        $conn->query($sql);

        echo 'success';
        die();
    }

    if ($_POST['type'] == 'insert') {
        //echo json_encode($_POST);

        $nume = $_POST['name'];
        $username = $_POST['username'];
        $parola = $_POST['password'];

        if (strlen(str_replace(' ', '', $nume)) == 0) {
            echo 'Trebuie sa alegi un nume!';
            die();
        }

        if (strlen(str_replace(' ', '', $username)) == 0) {
            echo 'Trebuie sa alegi un username!';
            die();
        }

        if (strlen(str_replace(' ', '', $parola)) == 0) {
            echo 'Trebuie sa alegi o parola!';
            die();
        }

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

        $sql = "insert into `ateliere`(`nume`, `username`, `parola`, `enabled`) VALUES ('$nume','$username','$parola', 'yes');";
        $conn->query($sql);

        echo 'success';

        die();
    }

    if ($_POST['type'] == 'control') {
        //echo json_encode($_POST);

        $dict = array('true' => 'no', 'false' => 'yes');
        $value = $dict[ $_POST['value'] ];
        $username = $_POST['username'];

        $sql = "update ateliere set enabled='$value' where username='$username';";
        $conn->query($sql);

        echo 'success';
        die();
    }
?>