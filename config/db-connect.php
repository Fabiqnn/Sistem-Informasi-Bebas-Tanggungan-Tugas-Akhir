<?php
    $serverName = "DESKTOP-1HF1HOA";
    $database = "BebasTanggunganTA";
    $uid = "";
    $pass = "";

    $connect = array (
        "Database" => $database,
        "Uid" => $uid,
        "PWD" => $pass
    );

    $conn = sqlsrv_connect($serverName, $connect);

    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }
?>