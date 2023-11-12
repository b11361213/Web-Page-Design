<?php

session_start();

$CONN = new mysqli('localhost', 'root', '', 'form');
mysqli_query($CONN, "SET NAMES utf8");

if ($CONN -> connect_errno) {die('Failed to connect to MySQL: ' . $CONN -> connect_error);} 

$query = $_REQUEST['query'];

if ($query == 'retrieve') {
    $sqlQuery = "SELECT * FROM dataform";

    // return sql search result to --> $result
    if ($result = mysqli_query($CONN, $sqlQuery)) {
        
        // for $singleResult in $result
        $arrayResult = [];
        
        // append $singleResult to --> arrayResult
        while($singleResult = $result -> fetch_assoc()) { $arrayResult[] = $singleResult; }
        
        $element = [];
        $element['arrayResult'] = $arrayResult;
        // print_r( json_encode($element, JSON_UNESCAPED_UNICODE) );
        echo json_encode($element, JSON_UNESCAPED_UNICODE);
        $result -> free_result();
    }
}
if ($query == 'modify') {
    $dataFormPrimaryKey = $_REQUEST['dataFormPrimaryKey'];
    $col = $_REQUEST['col'];
    $value = $_REQUEST['value'];
    $sqlQuery = "UPDATE dataform SET {$col} = \"{$value}\" WHERE dataFormPrimaryKey = \"{$dataFormPrimaryKey}\"";

    if ($result = mysqli_query($CONN, $sqlQuery)) {
        $element = [];
        $element['status'] = 'query: '.$sqlQuery.' update succeeded';
        // $element['result'] = [];
        echo json_encode($element, JSON_UNESCAPED_UNICODE);
    }
}
if ($query == 'login') {
    $username = $_REQUEST['username']; $username = addslashes($username);
    $password = $_REQUEST['password'];
    $encryptedPassword = hash('sha256', 'encrypt'.$password);
    // [PHP: hash - Manual](https://www.php.net/manual/en/function.hash.php)
    // [php - Undefined function sha256() - Stack Overflow](https://stackoverflow.com/questions/8533530/undefined-function-sha256)
    $sqlQuery = "SELECT * FROM datamember WHERE dataMemberUsernameMemberText = \"{$username}\" AND dataMemberPasswordMemberText = \"{$encryptedPassword}\"";

    $result = mysqli_query($CONN, $sqlQuery);

    $n = 0;
    $arrayResult = [];
    while ($singleResult = $result -> fetch_assoc()) { $arrayResult[] = $singleResult; $n++; }

    $element = [];
    $element['arrayResult'] = $arrayResult;

    do {
        if ($n == 0) { $element['status'] = 'wrong username or password'; break; }
        if ($n > 1)  { $element['status'] = 'finded multiple result, need check database'; break; }
        $_SESSION['newSession'] = $arrayResult;
        $element['status'] = 'Login succeeded';
    } while(0);

    echo json_encode($element, JSON_UNESCAPED_UNICODE);
}

$CONN -> close();
/* 
======
表格被分為欄位 (column) 及列位 (row)。每一列代表一筆資料，而每一欄代表一筆資料的一部份。
======
*/
// [DAY 25 資料庫( SQL ) 建立表格 欄位介紹 - iT 邦幫忙::一起幫忙解決難題，拯救 IT 人的一天](https://ithelp.ithome.com.tw/articles/10226362)// [JSON Viewer Online Best and Free](https://jsonformatter.org/json-viewer)
?>