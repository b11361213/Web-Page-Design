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
mysqli_query($CONN, "SET NAMES utf8");

if ($CONN -> connect_errno) {die('Failed to connect to MySQL: ' . $CONN -> connect_error);} 

$query = $_REQUEST['query'];

if ($query == 'rebuild') {
    $passwd = hash('sha256', 'encrypt'.'testPwd');
    // $passwd = hash('sha256', 'encrypt'.'isihasi1484');

    mysqli_query($CONN, "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';");
    mysqli_query($CONN, "START TRANSACTION;");
    mysqli_multi_query($CONN, $tableQuery);
    free_result($CONN);

    $tables = ['form', 'member'];
    for ($i = 0; $i < 2; $i++) {
        $settingArray = setting($tables[$i]);
        mysqli_query($CONN, $settingArray[0]);
        mysqli_query($CONN, $settingArray[1]);
        // create table
    }
    mysqli_query($CONN, "
    INSERT INTO `dataform` (`dataFormPrimaryKey`, `dataFormDateOfApplicationDate`, `dataFormApplyForPurposeChoice`, `dataFormApplicantFormText`, `dataFormIdentityCardNumberFormText`, `dataFormContactNumberFormText`, `dataFormPhoneNumberFormText`, `dataFormResidenceFormChoice`, `dataFormAddressFormText`)".
    "VALUES (NULL, current_timestamp(), 'dataFormFirstTime', 'Aikawa Manabi', 'A200000000', '02-0000-0000', '0900-000-000', '台北市', '台北市大安區臥龍街100號');
    ");
    mysqli_query($CONN, "
    INSERT INTO `datamember` (`dataMemberPrimaryKey`, `dataMemberAccountCreationDateDate`, `dataMemberUsernameMemberText`, `dataMemberPasswordMemberText`, `dataMemberEmailMemberText`)".
    "VALUES (NULL, current_timestamp(), 'testUsr', '{$passwd}', 'test@mail.test');
    ");
    // mysqli_query($CONN, "
    // INSERT INTO `datamember` (`dataMemberPrimaryKey`, `dataMemberAccountCreationDateDate`, `dataMemberUsernameMemberText`, `dataMemberPasswordMemberText`, `dataMemberEmailMemberText`)".
    // "VALUES (NULL, current_timestamp(), 'AikawaManabi', '{$passwd}', 'aikawa5158@yahoo.co.jp');
    // ");
}

$CONN -> close();
?>