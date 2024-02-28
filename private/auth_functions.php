<?php 
function log_in_admin($admin){

    session_regenerate_id();
    $_SESSION['admin_id'] =$admin['id'];
    $_SESSION['last_login'] = time();
    return true;
}


?>