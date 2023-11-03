<?php
    require 'table-query.php';
    $setting001 = <<<EOD
    ALTER TABLE `dataform`
        ADD PRIMARY KEY (`dataFormPrimaryKey`);
    EOD;
    $setting002 = <<<EOD
    ALTER TABLE `dataform`
        MODIFY `dataFormPrimaryKey` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
    EOD;


    $CONN = new mysqli('localhost', 'root', '', 'form');
    mysqli_query($CONN, 'SET NAMES utf8');

    if ($CONN -> connect_errno) {die('Failed to connect to MySQL: ' . $CONN -> connect_error);} 

    $query = $_REQUEST['query'];

    if ($query == 'retrieve') {
        if ($result = mysqli_query($CONN, 'SELECT * FROM dataform')) {
            $rows = [];

            while($rowArray = $result -> fetch_assoc()) {
                $rows[] = $rowArray;
            }
            $element = [];
            $element['rows'] = $rows;
            // print_r( json_encode($element, JSON_UNESCAPED_UNICODE) );
            echo json_encode($element, JSON_UNESCAPED_UNICODE);
            $result -> free_result();
        }
    }
    if ($query == 'modify') {
        $dataFormPrimaryKey = $_REQUEST['dataFormPrimaryKey'];
        $col = $_REQUEST['col'];
        $value = $_REQUEST['value'];

        if ($rows = mysqli_query($CONN, 'UPDATE dataform SET {$col} = "{$value}" WHERE dataFormPrimaryKey = "{$dataFormPrimaryKey}"')) {
            $element = [];
            $element['Status'] = 'modify succeeded';
            // $element['rows'] = [];
            echo json_encode($element, JSON_UNESCAPED_UNICODE);
        }
    }
    if ($query == 'rebuild') {
        mysqli_query($CONN, 'DROP TABLE IF EXISTS `dataform`;');
        mysqli_query($CONN, 'DROP TABLE IF EXISTS `datamember`;');
        mysqli_query($CONN, 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
        mysqli_query($CONN, 'START TRANSACTION;');
        mysqli_multi_query($CONN, $tableQuery);

        mysqli_query($CONN, $setting001);
        mysqli_query($CONN, $setting002);
        mysqli_query($CONN, 'COMMIT;');
        // create table
        
        // mysqli_query($CONN, 'INSERT INTO `dataform` (`dataFormPrimaryKey`, `dataFormDateOfApplicationDate`, `dataFormApplyForPurposeChoice`, `dataFormApplicantFormText`, `dataFormIdentityCardNumberFormText`, `dataFormContactNumberFormText`, `dataFormPhoneNumberFormText`, `dataFormResidenceFormChoice`, `dataFormAddressFormText`) VALUES (NULL, current_timestamp(), "dataFormFirstTime", "Aikawa Manabi", "A200000000", "02-0000-0000", "0900-000-000", "台北市", "台北市大安區臥龍街100號");');
    }

    $CONN -> close();
    /* 
    ======
    表格被分為欄位 (column) 及列位 (row)。每一列代表一筆資料，而每一欄代表一筆資料的一部份。
    ======
    */
    // [DAY 25 資料庫( SQL ) 建立表格 欄位介紹 - iT 邦幫忙::一起幫忙解決難題，拯救 IT 人的一天](https://ithelp.ithome.com.tw/articles/10226362)// [JSON Viewer Online Best and Free](https://jsonformatter.org/json-viewer)
?>