<?php
require_once '../core/controller.php';
include 'functions/custom_function.php';


$ACTION = $_POST['ACTION'] ?? '';
$output = $input = [];

if (preg_match('/^(updateProfile|updatePassword|PROFILE_DETAILS)$/', $ACTION) == false) 
{
    $output = responseError('Server not working!');
    goto SEND_RESPONSE;
}


if($ACTION == 'PROFILE_DETAILS') 
{
    $updateProfileStmt  = $db->prepare('SELECT `name`, `username`, `whatsapp_no`, `password`, `email` FROM `admin` WHERE `id`=:id'); 
    $updateProfileStmt->execute(['id'=> $_SESSION['DS_USER_ID'] ]);
    $AMINUSER_DATA   = $updateProfileStmt->fetch(PDO::FETCH_ASSOC);

    $output             = responseSuccess('',['PROFILE_DETAILS'=>$AMINUSER_DATA]);
    goto SEND_RESPONSE;
}





if($ACTION == 'updateProfile') 
{
    $input['name']          = post('name');
    $username               = post('username');
    $input['email']         = post('email');
    
    $output = responseFormErrors($input);

    if($output['error']) {
        goto SEND_RESPONSE;
    }
    
    if (!preg_match('/^[a-zA-Z0-9\- ]*$/', $input['name'])) {
        $output['status'] = 'fail';
        $output['errors']['name'] = 'Invalid name!';
        goto SEND_RESPONSE;
    }
    
    if (!preg_match('/^[a-zA-Z0-9-_.@]*$/', $input['email'])) {
        $output['status'] = 'fail';
        $output['errors']['email'] = 'Invalid email!';
        goto SEND_RESPONSE;
    }

    
    $updateProfileStmt  = $db->prepare('UPDATE `admin` SET `name`=:name, `email`=:email WHERE `id`=:id'); 
    $updateProfileStmt->execute(['name'=>$input['name'], 'email'=>$input['email'], 'id'=> $_SESSION['DS_USER_ID'] ]);
    
    $SIGNAL_MESSAGE     = ($updateProfileStmt->rowCount() > 0)?"Profile Details Changed successfully":'';
    $output             = responseSuccess($SIGNAL_MESSAGE);
    goto SEND_RESPONSE;
}




if($ACTION == 'updatePassword') 
{
    $input['password']  = post('password');
    $input['cpassword'] = post('cpassword');
    
    $output = responseFormErrors($input);

    if($output['error']) {
        foreach ($output['errors'] as $key => $out) {
            $output['errors'][$key] = preg_replace('/c/', 'confirm ', $out[0]);
        }
        goto SEND_RESPONSE;
    }
    
    if(strlen($input['password']) < 5) 
    {
        $output['status'] = 'fail';
        $output['errors']['password'] = 'Password must be greater than 5 character';
        goto SEND_RESPONSE;
    }
    
    if($input['password'] != $input['cpassword'] ) 
    {
        $output['status'] = 'fail';
        $output['errors']['cpassword'] = 'Password and confirm password do not match';
        goto SEND_RESPONSE;
    } 
    
    
    $encrypt_password   = entryptpassword($input['password']);

    $updatePasswordStmt = $db->prepare('UPDATE `admin` SET `password` = ?, `encrypt_password` = ? WHERE id=?');
    $updatePasswordStmt->execute([$input['password'], $encrypt_password, $_SESSION['DS_USER_ID']]);

    $SIGNAL_MESSAGE     = ($updatePasswordStmt->rowCount() > 0)? 'Password Changed successfully': '';
    $output             = responseSuccess($SIGNAL_MESSAGE);
    goto SEND_RESPONSE;
}


SEND_RESPONSE:
echo json_encode($output); die;
