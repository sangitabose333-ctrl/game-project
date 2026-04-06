<?php
function entryptpassword($password){
    global $encryptionType;
    if($encryptionType == 'sha1') {
        return $password = sha1($password);
    
    } elseif ($encryptionType == 'md5') {
        return $password = md5($password);
    }
}



function GetValidMobileNum($whatsappNo, $mobileNo)
{
    if(preg_match('/^[6-9][0-9]{9}$/i', $whatsappNo))
    {
        return $whatsappNo;
    }
    elseif(preg_match('/^[6-9][0-9]{9}$/i', $mobileNo))
    {
        return $mobileNo;
    }
    else
    {
        return false;
    }
}




//form string FILTER-SANITIZER
function sanitizeFilterString($arr){
    global $_POST;
     
    $data = [];
    foreach($arr as $str){
        $data[$str] = filter_var($_POST[$str], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    }
    return $data;
}



//valid Email ID Check
function isEmail($arr){
    global $_POST;
     
    foreach($arr as $data){
        if(!filter_var($_POST[$data], FILTER_SANITIZE_EMAIL)){
            return false;
        }
    }
    return true;
}



//isset Global in array keys
function issetCheck(){
    global $_POST, $isArr;

    foreach($isArr as $data){
        if(!isset($_POST[$data])){
            return false;
        }
    }
    
    return true;
}



//valid Global in array keys mobile number
function isContactNumber($value)
{
    if($value !='' && !preg_match('/^\+?[0-9\s\-\(\)]{7,15}$/', $value)){
        return false;
    }
    
    return true;
}



//valid Global in array keys mobile number
function isMobile($value)
{
    global $_POST;

    if($value !='' && !preg_match('/^(?:\+91|91)?[6-9][0-9]{9}$/', $value)){
        return false;
    }
    
    return true;
}




function is_Email($email)
{
    if ($email!='' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}



//Global in array keys empty values
function emptyCheck(){
    global $_POST, $isArr;
    
    foreach($isArr as $data){
        $val = trim($_POST[$data]);
        if(empty($val)){
            return false;
        }
    }
    
    return true;
}



function secureValue($value,$allow=''){
    if(trim($value)!=''){
        $value = addslashes(strip_tags(trim($value), $allow));
        $value = preg_replace('/(<\?php\s*[^\?]+\s*\?>)|(<\?php|<\?=)\s*/', '', $value);
        return $value;
    }else{
        return true;
    }
}



function file_isset(){
    global $_FILES,$fileArr;
    
    foreach($fileArr as $data){
        if(!isset($_FILES[$data])){
            return false;
        }
    }
    return true;
}




function domainLetter($domain_name){
    $domain_name = str_replace(array('https', 'www.', '//', ':','.'), ' ', $domain_name);
    return strtoupper(preg_replace('~\S\K\S*\s*~u', '', $domain_name));
}




//checking phone number 
function GetValidPhoneNumb($phone, $whatsaapno){
    return (preg_match('/^[0-9]{10}+$/', $phone))?$phone:$whatsaapno;   
}



function stringTOslug($string){
    return strtolower(preg_replace("/-+/","-",preg_replace('/[^A-Za-z0-9\-]/',"-",trim($string))));
}




function searchString($string,$search){
    if(preg_match("/{$search}/i", $string)) { return 1;}else{ return 0;}
}



function randString($n) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}

function getServerIp() {
    if (!empty($_SERVER['SERVER_ADDR'])) {
        return $_SERVER['SERVER_ADDR'];
    } elseif (!empty($_SERVER['LOCAL_ADDR'])) {
        return $_SERVER['LOCAL_ADDR'];
    } else {
        $hostname = gethostname();
        return gethostbyname($hostname);
    }
}



// Function to get the user's IP address
function get_client_ip() 
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}




//post data api
function postDataApi($post=[], $auth_url=null){
    
    $ch = curl_init($auth_url);
    curl_setopt($ch, CURLOPT_URL, $auth_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['token: !@86gangaBB']);
    $response = curl_exec($ch);
    curl_close($ch);
    
    return json_decode($response,true);  
}




function encrypt($data, $key = null, $iv = null)
{
    $key    = ($key)?$key:openssl_random_pseudo_bytes(32);
    $iv     = ($iv)?$iv:openssl_random_pseudo_bytes(16);

    $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);

    $hex_encrypted = bin2hex($encrypted);
    $hex_encrypted = str_replace(['+', '-', ' '], '', $hex_encrypted);
    
    return [
        'encrypted' => $hex_encrypted,
        'key' => bin2hex($key),
        'iv' => bin2hex($iv)
    ];
}





function decrypt($encrypted_data, $key_hex, $iv_hex)
{
    $key    = hex2bin($key_hex);
    $iv     = hex2bin($iv_hex);

    $encrypted_data = str_replace(['+', '-', ' '], '', $encrypted_data);
    $decoded_encrypted = hex2bin($encrypted_data);

    $decrypted = openssl_decrypt($decoded_encrypted, 'AES-256-CBC', $key, 0, $iv);
    
    return $decrypted;
}






function GET_LOCATION_DETAILS($ip = ''): array
{
    if(!empty($ip))
    {
        $access_key = '647b6144198e1e'; 
        
        $url = "http://ipinfo.io/{$ip}/json?token={$access_key}";
        
        $response = file_get_contents($url);
        
        $location_data = json_decode($response, true);
    }

    $ip         = (isset($location_data['ip']))? NORMALIZER($location_data['ip']) : '';
    $region     = (isset($location_data['region']))? NORMALIZER($location_data['region']) : '';
    $country    = (isset($location_data['country']))? NORMALIZER($location_data['country']) : '';
    $loc        = (isset($location_data['loc']))? NORMALIZER($location_data['loc']) : '';
    $city       = (isset($location_data['city']))? NORMALIZER($location_data['city']) : '';
   

    $response = [ 'ip'=>$ip, 'city'=>$city, 'region'=>$region, 'country'=>$country, 'loc'=>$loc ];
    
    return $response;
}



function NORMALIZER($string='')
{
    if (!extension_loaded('intl')) {
        return 'The intl extension is not enabled in your PHP installation.';
        exit;
    }

    $normalized_string = normalizer_normalize($string, Normalizer::FORM_D);

    $final_string = preg_replace('/[\x{0300}-\x{036f}]/u', '', $normalized_string);

    return $final_string;
}




//seo image update
function ImagesValidate($file, $fieldname){
    global $db;
    
    if($file["name"]!='') {
      
        $file_name = $file["name"];
        $temp_name = $file["tmp_name"];
        $max_size = 5242880; // 5MB
        
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $file_type = $finfo->file($temp_name);
        
        $allowed_image_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'];
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        
        if(in_array($file_type, $allowed_image_types) )
        {
            if(!in_array($extension, preg_filter('!image/!', '', $allowed_image_types)))
            {
                return ['status'=>false, 'msg'=>'Please upload jpg, jpeg, png, gif or webp image'];
            } 
            else 
            {
                if (!is_uploaded_file($temp_name)) {
                    return ['status'=>false, 'msg'=>'Invalid file upload'];
                }
        
                if ($file['size'] > $max_size) {
                    return ['status'=>false, 'msg'=>'File size exceeds maximum allowed (5MB)'];
                }
            }
        }
        else
        {
            $msg = (searchString($file_type,'image'))?'Please upload jpg, jpeg, png, gif or webp image':'Please upload an image file';
            return ['status'=>false, 'msg'=>$msg];
        }
    }
    return ['status'=>true, 'msg'=>'success'];
    
}
?>