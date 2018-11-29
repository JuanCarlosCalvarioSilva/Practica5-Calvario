<?php
header("Content-type: application/json; charset=utf-8");

if (isset($_POST['token'])){

    $token = $_POST['token'];

    $link = mysql_connect('localhost','root','','test');
    if(!$link){
        die('Could not connect: ',mysql_error());
    }
    echo 'Connected successfully';
    mysql_select_db('test') or die (mysql_error());

    $results = mysql_query("INSERT INTO push(token,fecha) VALUES('$token','$fecha')");
    if (!$result){
        die('error: ', mysql_error());
    }else
        echo('token guardado');

    mysql_close($link);
}
?>