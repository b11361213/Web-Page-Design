<?php
    require "query_cp2.php";
    $CONN = new mysqli("localhost", "root", "", "form2");
    mysqli_query($CONN, "SET NAMES utf8");

    if ($CONN -> connect_errno) {die("Failed to connect to MySQL: " . $CONN -> connect_error);} 

    $query = $_REQUEST["query"];

    if ($query == "rebuild") {
        mysqli_query($CONN, "DROP TABLE IF EXISTS `form2`");
        mysqli_query($CONN, $tableQuery);
    }

    $CONN -> close();
?>