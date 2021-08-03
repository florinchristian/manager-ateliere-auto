<?php
    function check_spam($connection, $ip) {
        $sql = "delete from history where timp < (UNIX_TIMESTAMP() - 3600);";
        $connection->query($sql);

        $sql = "select count(*) from history where ip='$ip';";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        $count = (int)$row['count(*)'];

        if ($count <=5 ) {
            $timp = time();
            $sql = "insert into history(ip, timp) values('$ip','$timp');";
            $connection->query($sql);

            return;
        }

        echo 'spam';
        die();
    }

    include 'connectDatabase.php';

    check_spam($conn, $_SERVER['REMOTE_ADDR']);

    $vin = $_GET['vin'];
    $sql = "select * from useri where vin='$vin';";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo 'no_data';
        die();
    }

    $useri = array();

    while($row = $result->fetch_assoc()) {
        $useri[] = $row;
    }

    echo json_encode($useri);
?>