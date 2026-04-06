<?php
require_once '../core/controller.php';

if($_POST['type'] == 'LOGOUT_PANEL') 
{
    setcookie ('DS_USERNAME', null, time() - 3600, '/');
    setcookie ('DS_USER_PASSWORD', null, time() - 3600, '/');
    setcookie ('DS_USER_ID', null, time() - 3600, '/');
    
    session_destroy();
    $output = responseRedirect('/', 'Logged OUT Successfully');
    echo json_encode($output);die;
}

?>