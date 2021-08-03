<?php
    session_start();
    if (isset($_SESSION['user']) && $_SESSION['user'] == 'Super-Admin') {
        $file = fopen('edit-ateliere.html', 'r');
        echo fread($file, filesize('edit-ateliere.html'));
    } else {
        echo 'Forbidden';
    }
?>