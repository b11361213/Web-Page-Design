<?php
    $CONN = new mysqli("localhost", "root", "", "form");
    mysqli_query($CONN, "SET NAMES utf8");

    if ($CONN -> connect_errno) {die("Failed to connect to MySQL: " . $CONN -> connect_error);} 

    $query = $_REQUEST["query"];

    if ($query == "retrieve") {
    if ($rows = mysqli_query($CONN, "SELECT * FROM dataform")) {
        $cols = [];

        while($row = $rows -> fetch_assoc()) {
            $cols[] = $row;
        }
        $element = [];
        $element["cols"] = $cols;
        // print_r( json_encode($row, JSON_UNESCAPED_UNICODE) );
        echo json_encode($element, JSON_UNESCAPED_UNICODE);
        $rows -> free_result();
    }
    }



    $CONN -> close();
    // [JSON Viewer Online Best and Free](https://jsonformatter.org/json-viewer)
?>