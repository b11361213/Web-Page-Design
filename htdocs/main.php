<?php
    $CONN = new mysqli("localhost", "root", "", "form");
    mysqli_query($CONN, "SET NAMES utf8");

    $rows = mysqli_query($CONN, "SELECT * FROM dataform");
    while($row = $rows -> fetch_assoc()) {
        print_r($row);
    }
    $rows -> free_result();
    $CONN -> close();
?>