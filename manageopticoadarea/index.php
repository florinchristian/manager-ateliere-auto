<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        $file = fopen('logare.html', 'r');
        echo fread($file, filesize('logare.html'));
    } else {
        if ($_SESSION['user'] == 'Super-Admin') {
            $file = fopen('admin.html', 'r');
            echo fread($file, filesize('admin.html'));
        } else {
            $file = fopen('atelier.html', 'r');
            echo fread($file, filesize('atelier.html'));
        }
    }
?>