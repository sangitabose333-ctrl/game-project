<?php
require_once '../core/controller.php';
include 'functions/custom_function.php';

$output = $input = [];

$LOGIN_IP           = get_client_ip();
$to                 = GetValidMobileNum($client_whtasappno, $client_username);
$LOCATION_DETAILS   = GET_LOCATION_DETAILS($LOGIN_IP);
$my_location        = $LOCATION_DETAILS['city'] ?? '';
$input['username']  = post('username');
$input['password']  = post('password');
$encrypt_password   = entryptpassword($input['password']);

// $user_latitude      = isset($_POST['latitude']) ? floatval($_POST['latitude']) : null;
// $user_longitude     = isset($_POST['longitude']) ? floatval($_POST['longitude']) : null;



// if($user_latitude == null || $user_longitude == null) {
//     $output = responseError('Location access is required for login. Please enable location services in your browser.');
//     goto SEND_RESPOND;
// }


$output = responseFormErrors($input);

if($output['error']) 
{
    foreach ($output['errors'] as $key => $out) 
    {
        $output['errors'][$key] = preg_replace('/_/', ' ', $out[0]);
    }
    goto SEND_RESPOND;
}


if(!preg_match("/^[A-Za-z0-9_-]+$/",$input['username']))
{
    $output['status'] = 'fail';
    $output['errors']['username'] = 'Invalid username.';
}

if(!preg_match("/^[A-Za-z0-9$!@#$_-]+$/",$input['password']))
{
    $output['status'] = 'fail';
    $output['errors']['password'] = 'Invalid password.';
}

if($output['status'] == 'fail')
{
    goto SEND_RESPOND;
}




$adminUserExec   = $db->prepare('SELECT * FROM `admin` WHERE `username`=?');
$adminUserExec->execute(array($input['username']));
$existsAdminUser = $adminUserExec->rowCount();

if(!$existsAdminUser) 
{
    $output['status'] = 'fail';
    $output['errors']['username'] = 'Wrong username.';
    
    goto SEND_RESPOND;
}


$loginData = $adminUserExec->fetch(PDO::FETCH_ASSOC);
extract($loginData, EXTR_PREFIX_ALL ,'admin');

$to                 = GetValidMobileNum($admin_whatsapp_no, $admin_username);
$client_username    = $admin_username;


if(($admin_password != $input['password']))
{
    $output['status'] = 'fail';
    $output['errors']['password'] = 'Wrong password.';
    
    goto SEND_RESPOND;
}

// // Geolocation validation - check if user is within 1 km of allowed location


// // Get allowed location from admin table
// $adminLocationExec = $db->prepare('SELECT `allowed_latitude`, `allowed_longitude` FROM `admin` WHERE `id`=? LIMIT 1');
// $adminLocationExec->execute([$admin_id]);
// $adminLocationData = $adminLocationExec->fetch(PDO::FETCH_ASSOC);

// $allowedLat = !empty($adminLocationData['allowed_latitude']) ? floatval($adminLocationData['allowed_latitude']) : null;
// $allowedLon = !empty($adminLocationData['allowed_longitude']) ? floatval($adminLocationData['allowed_longitude']) : null;

// // If allowed location is set, validate user location
// if($allowedLat !== null && $allowedLon !== null)
// {
//     if($userLat === null || $userLon === null)
//     {
//         $output = responseError('Location access is required for login. Please enable location services in your browser.');
//         echo json_encode($output);
//         die;
//     }
    
//     // Check if user is within 1 km radius
//     if(!isLocationWithinRadius($userLat, $userLon, $allowedLat, $allowedLon, 1.0))
//     {
//         $output = responseError('You are not within the allowed location area. Please login from the authorized location.');
//         echo json_encode($output);
//         die;
//     }
// }






session_regenerate_id(true);
$_SESSION['ip_address']         = $LOGIN_IP;
$_SESSION['LAST_ACTIVITY']      = time();
$_SESSION['DS_NAME']            = $admin_name;
$_SESSION['DS_USERNAME']        = $admin_username;
$_SESSION['DS_USER_ID']         = $admin_id;
$_SESSION['DS_USER_PASSWORD']   = $admin_password;
$_SESSION['DS_USER_ROLE']       = ($admin_id == 1)?'Admin':'Sub Admin';




//Last login update
$updateLastLogin	=	$db->prepare('UPDATE `admin` SET lastlogin_at = NOW() where username=?');
$updateLastLogin->execute(array($input['username']));

//insert login details
$insertLoginDetails	=	$db->prepare('INSERT INTO `login_details`(`admin_id`, `login_time`, `login_date`, `location`, `login_ip`) VALUES (?,?,?,?,?)');
$insertLoginDetails->execute(array($admin_id, $ctime, $cdate, $my_location, $LOGIN_IP));

$output = responseRedirect('dashboard.php', 'Logged in Successfully');


SEND_RESPOND:
echo json_encode($output);die();

?>