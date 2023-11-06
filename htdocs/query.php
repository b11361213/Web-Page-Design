<?php
require 'table-query.php';

function setting($table) { 
    $upper = ucfirst($table);
    $setting001 = <<<EOD
    ALTER TABLE `data{$table}`
        ADD PRIMARY KEY (`data{$upper}PrimaryKey`);
    EOD;
    $setting002 = <<<EOD
    ALTER TABLE `data{$table}`
        MODIFY `data{$upper}PrimaryKey` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
    EOD;
    return array($setting001, $setting002);
}
function free_result($CONN) {
    while (mysqli_more_results($CONN) && mysqli_next_result($CONN)) {
        if (mysqli_use_result($CONN) instanceof mysqli_result) {
            mysqli_free_result($CONN);
        }
    }
}

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

    if ($rows = mysqli_query($CONN, "UPDATE dataform SET {$col} = \"{$value}\" WHERE dataFormPrimaryKey = \"{$dataFormPrimaryKey}\"")) {
        $element = [];
        $element['Status'] = 'modify succeeded';
        // $element['rows'] = [];
        echo json_encode($element, JSON_UNESCAPED_UNICODE);
    }
}
if ($query == 'rebuild') {
    mysqli_query($CONN, 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
    mysqli_query($CONN, 'START TRANSACTION;');
    mysqli_multi_query($CONN, $tableQuery);
    free_result($CONN);

    $tables = ['form', 'member'];
    for ($i = 0; $i < 2; $i++) {
        $settingArray = setting($tables[$i]);
        mysqli_query($CONN, $settingArray[0]);
        mysqli_query($CONN, $settingArray[1]);
        // create table
    }
    mysqli_query($CONN, '
    INSERT INTO `dataform` (`dataFormPrimaryKey`, `dataFormDateOfApplicationDate`, `dataFormApplyForPurposeChoice`, `dataFormApplicantFormText`, `dataFormIdentityCardNumberFormText`, `dataFormContactNumberFormText`, `dataFormPhoneNumberFormText`, `dataFormResidenceFormChoice`, `dataFormAddressFormText`)'.
    'VALUES (NULL, current_timestamp(), "dataFormFirstTime", "Aikawa Manabi", "A200000000", "02-0000-0000", "0900-000-000", "台北市", "台北市大安區臥龍街100號");
    ');
    mysqli_query($CONN, '
    INSERT INTO `datamember` (`dataMemberPrimaryKey`, `dataMemberAccountCreationDateDate`, `dataMemberUsernameMemberText`, `dataMemberPasswordMemberText`, `dataMemberEmailMemberText`)'.
    'VALUES (NULL, current_timestamp(), "Aikawa Manabi", "isihasi1484", "aikawa5158@yahoo.co.jp");
    ');
}

$CONN -> close();
/* 
======
表格被分為欄位 (column) 及列位 (row)。每一列代表一筆資料，而每一欄代表一筆資料的一部份。
======
*/
// [DAY 25 資料庫( SQL ) 建立表格 欄位介紹 - iT 邦幫忙::一起幫忙解決難題，拯救 IT 人的一天](https://ithelp.ithome.com.tw/articles/10226362)// [JSON Viewer Online Best and Free](https://jsonformatter.org/json-viewer)
?>