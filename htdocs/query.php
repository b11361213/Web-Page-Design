<?php
    $CONN = new mysqli("localhost", "root", "", "form");
    mysqli_query($CONN, "SET NAMES utf8");

    if ($CONN -> connect_errno) {die("Failed to connect to MySQL: " . $CONN -> connect_error);} 

    $query = $_REQUEST["query"];

    if ($query == "retrieve") {
        if ($result = mysqli_query($CONN, "SELECT * FROM dataform")) {
            $rows = [];

            while($rowArray = $result -> fetch_assoc()) {
                $rows[] = $rowArray;
            }
            $element = [];
            $element["rows"] = $rows;
            // print_r( json_encode($element, JSON_UNESCAPED_UNICODE) );
            echo json_encode($element, JSON_UNESCAPED_UNICODE);
            $result -> free_result();
    }}
    if ($query == "modify") {
        $primaryKey = $_REQUEST["dataFormPrimaryKey"];
        $col = $_REQUEST["col"];
        $value = $_REQUEST["value"];

        if ($rows = mysqli_query($CONN, "UPDATE dataform SET {$col} = \"{$value}\" WHERE dataFormPrimaryKey = \"{$primaryKey}\"")) {
            $element = [];
            $element["Status"] = "modify succeeded";
            $element["rows"] = [];
            echo json_encode($element, JSON_UNESCAPED_UNICODE);
        }}

    $CONN -> close();
    /* 
    ======
    表格被分為欄位 (column) 及列位 (row)。每一列代表一筆資料，而每一欄代表一筆資料的一部份。
    ======
    */
    // [DAY 25 資料庫( SQL ) 建立表格 欄位介紹 - iT 邦幫忙::一起幫忙解決難題，拯救 IT 人的一天](https://ithelp.ithome.com.tw/articles/10226362)// [JSON Viewer Online Best and Free](https://jsonformatter.org/json-viewer)
?>