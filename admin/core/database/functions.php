<?php

    /*
     * Function to connect to the database. If Database connection fails throw error
     */

    function connectDatabase() {
        try {
            // Ensure the GLOBALS variables are properly set
            if (!isset($GLOBALS["DATABASE"], $GLOBALS["HOST"], $GLOBALS["USERNAME"], $GLOBALS["PASSWORD"])) {
                throw new Exception("Database configuration not set properly.");
            }
    
            // Corrected DSN string with charset placed correctly
            $dsn = "mysql:host={$GLOBALS["HOST"]};dbname={$GLOBALS["DATABASE"]};charset=utf8mb4";
            
            // Attempt to establish a PDO connection
            $db = new PDO($dsn, $GLOBALS["USERNAME"], $GLOBALS["PASSWORD"]);
            
            // Set PDO error mode to exception for better error handling
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
            return $db;
        } catch (PDOException $ex) {
            // Log the error for debugging
            error_log("PDO Error: " . $ex->getMessage());
    
            // Redirect to the install page
            header("Location: maintenance/");
            exit();
        } catch (Exception $ex) {
            // Handle other errors
            error_log("Error: " . $ex->getMessage());
            header("Location: maintenance/");
            exit();
        }
    }
    
    
    function GET_DEFINER()
    {
        $INFORMATION_SCHEMA_STMT = $GLOBALS['db']->prepare("SELECT TABLE_NAME, DEFINER FROM information_schema.VIEWS WHERE TABLE_SCHEMA = ?");
        $INFORMATION_SCHEMA_STMT->execute([ $GLOBALS['DATABASE'] ]);    $INFORMATION_SCHEMA_DATA = $INFORMATION_SCHEMA_STMT->fetch(PDO::FETCH_ASSOC);
        $DEFINER = $INFORMATION_SCHEMA_DATA['DEFINER'] ?? '';
        
        return $DEFINER ?? '';
    }


    /*
     * Function to resize the uploaded image
     */

    function resize($target, $w, $h, $ext)
    {
        list($w_orig, $h_orig) = getimagesize($target);

        $img = '';
        $ext = strtolower($ext);
        if ($ext == "gif") {
            $img = imagecreatefromgif($target);
        } else if ($ext == "png") {
            $img = imagecreatefrompng($target);
        } else {
            $img = imagecreatefromjpeg($target);
        }
        $tci = imagecreatetruecolor($w, $h);

        imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
        imagejpeg($tci, $target, 80);
    }


    /*
     * Function to get data from another website url
     */

    function getCurlData($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $curlData = curl_exec($curl);
        curl_close($curl);

        return $curlData;
    }


    function post($post)
    {
        return trim($_POST[$post]);
    }

    function get($get)
    {
        return trim($_GET[$get]);
    }

/** Return success response
 * @param $messageOrData
 * @return array
 */
 function responseSuccess($messageOrData, $data = null)
{
    $response = [
        'status' => 'success'
    ];

    if (!empty($messageOrData) && !is_array($messageOrData)) {
        $response['message'] = $messageOrData;
    }

    if (is_array($data)){
        $response = array_merge($data, $response);
    }

    if (is_array($messageOrData)) {
        $response = array_merge($messageOrData, $response);
    }

    return $response;
}

/** Return error response
 * @param $message
 * @return array
 */

function responseError($message, $errorName = null, $errorData = [])
{
    return 
    [
        'status' => 'fail',
        'error_name' => $errorName,
        'data' => $errorData,
        'message' => $message
    ];
}

/** Return validation error
 * @return array
 */
function responseFormErrors($input)
{
    $output = [];
    $error = false;

    foreach ($input as $key => $value) {

        if($input[$key] == '') {
            $output['errors'][$key] = array($key.' required.');
            $error = true;
        }
    }

    if($error) {
        return [
            'error' => $error,
            'status' => 'fail',
            'errors' => $output['errors']
        ];
    }
    else {
        return [
            'error' => $error,
            'status' => 'success',
            'errors' => $output
        ];
    }


}

function responseRedirect($url, $message = null, $target = '_self')
{
    if ($message) {
        return [
            'status' => 'success',
            'message' => $message,
            'action' => 'redirect',
            'url' => $url,
            'target' => $target
        ];
    }
    else {
        return [
            'status' => 'success',
            'action' => 'redirect',
            'url' => $url,
            'target' => $target
        ];
    }
}

/**
 * Generate a new unique file name
 * @param string $current_file_name
 * @return string new file name
 */
function generateNewFileName($currentFileName)
{
    $ext = end((explode('.', $currentFileName['name'])));
    $newName = md5(microtime());

    return $newName . '.' . $ext;
}


function generateNewFileNameByName($currentFileName)
{
    $ext = end((explode('.', $currentFileName)));
    $newName = md5(microtime());

    return $newName . '.' . $ext;
}


// function PERMISSION_ROLES(): array
// {
//     $PERMISSION_ROLES_STMT = $GLOBALS['db']->prepare("SELECT admin_role.role_name from admin INNER JOIN admin_role on admin.role=admin_role.parent_id where admin.id=?");
//     $PERMISSION_ROLES_STMT->execute([ $_SESSION['adminlog'] ]);    $PERMISSION_ROLES_DATA = $PERMISSION_ROLES_STMT->fetchAll(PDO::FETCH_ASSOC);
//     $rolesList = array_column($PERMISSION_ROLES_DATA, 'role_name');
    
//     return $rolesList;
// }


function responseErrorRedirect($url, $message = null)
{
    if ($message) {
        return [
            'status'    => 'fail',
            'message'   => $message,
            'action'    => 'redirect',
            'url'       => $url
        ];
    }
    else {
        return [
            'status'    => 'fail',
            'action'    => 'redirect',
            'url'       => $url
        ];
    }
}