<!-- Store all function  -->

<?php 
require_once('db_credentials.php');
function db_connect(){
    $connection = mysqli_connect(DB_SERVER, DB_NAME,DB_USER, DB_PASS);
    return $connection;
}
?>