<?php
require_once '../core/controller.php';
include 'functions/custom_function.php';


$path = 'assets/img/site-files/';
$file_upload_icon = 'assets/global/css/sidebar-fonts/file-upload.png';
$ACTION = $_POST['ACTION'] ?? '';
$output = $input = [];

if (preg_match('/^(SEO_DETAILS|SAVE_SEO)$/', $ACTION) == false) 
{
    $output = responseError('Server not working!');
    goto SEND_RESPONSE;
}




/*------------------FETCH SEO DETAILS------------------*/
if($ACTION == 'SEO_DETAILS')  
{
    $seoStmt = $db->prepare("SELECT * FROM `seo` WHERE 1");
    $seoStmt->execute(); $seoData = $seoStmt->fetch(PDO::FETCH_ASSOC);
    
    $seoDetails =  
    [
        'url'               => $seoData['url'] ?? '', 
        "address"           => $seoData['address'] ?? '', 
        "map"               => $seoData['map'], 
        "site_description"  => $seoData['site_description'] ?? '', 
        "meta_keywords"     => $seoData['meta_keywords'] ?? '', 
        "google_analytics"  => $seoData['google_analytics'] ?? '', 
        "webname"           => $seoData['webname'] ?? '', 
        "phone"             => $seoData['phone'] ?? '', 
        "whatsapp"          => $seoData['whatsapp'] ?? '', 
        "og_title"          => $seoData['og_title'] ?? '', 
        "search_console"    => $seoData['search_console'] ?? '', 
        "og_desc"           => $seoData['og_desc'] ?? '', 
        "image_web_logo"    => (file_exists('../../'.$path.($seoData['web_logo'] ?? '')))?$path.$seoData['web_logo']:$file_upload_icon, 
        "image_admin_logo"  => (file_exists('../../'.$path.($seoData['admin_logo'] ?? '')))?$path.$seoData['admin_logo']:$file_upload_icon, 
        "image_favicon"     => (file_exists('../../'.$path.($seoData['favicon'] ?? '')))?$path.$seoData['favicon']:$file_upload_icon,
        "image_og_img"      => (file_exists('../../'.$path.($seoData['og_img'] ?? '')))?$path.$seoData['og_img']:$file_upload_icon,
        "email"             => $seoData['email'] ?? '',
        "telegram"          => $seoData['telegram'] ?? ''
    ]; 
            
    $output = responseSuccess('',['SEO_DATA'=>$seoDetails]);
    goto SEND_RESPONSE;
}
/*--------------------------X--------------------------*/




/*--------------------SEO DATA SAVE--------------------*/
if($ACTION == 'SAVE_SEO') 
{
    $ExistSEOStmt = $db->prepare('SELECT * FROM `seo`');
    $ExistSEOStmt->execute();
    $ExistSEO = $ExistSEOStmt->rowCount();
    
    if(!$ExistSEO) {
        $AddSEOStmt = $db->prepare('INSERT INTO `seo`(`url`) VALUES (?)');
        $AddSEOStmt->execute([$BASE_URL]);
    }
    

    $SecurityFields     = ['webname','email','og_title','og_desc','phone','whatsapp','telegram','site_description','google_analytics','address','map','search_console'];
    $fileArr            = ['web_logo','admin_logo','favicon','og_img'];
    
        
    $url                =   post('url');
    $webname            =   post('webname');
    $email              =   post('email');
    $phone              =   post('phone');
    $whatsapp           =   post('whatsapp');
    $telegram           =   post('telegram');
    $og_title           =   post('og_title');
    $og_desc            =   post('og_desc');
    $site_description   =   post('site_description');
    $meta_keywords      =   post('meta_keywords');
    $google_analytics   =   post('google_analytics');
    $address            =   post('address');
    $map                =   post('map');
    $search_console     =   post('search_console');
    
    
    foreach($SecurityFields as $field)
    {
        $value = $_POST["$field"] ?? '';
        
        if(!secureValue($value))
        { 
            $output['status'] = 'fail';
            $output['errors'][$field] = "Invalid value $field";
        }
    }
    
    if($output['error']) {
        goto SEND_RESPONSE;
    }
    
    
    if($url !='' && preg_match('/^(https?:\/\/)[a-z0-9.-]+\.[a-z]{2,}(\/[^\s]*)?$/i', $url) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['url'] = 'Invalid Url';
    }
    
    if($webname !='' && preg_match('/^[a-zA-Z0-9]+([ .-][a-zA-Z0-9]+)*$/i', $webname) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['webname'] = 'Invalid Webname';
    }
    
    if($email !='' && is_Email($email) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['email'] = 'Invalid E-mail ID';
    }
    
    if($phone!='' && !isContactNumber($phone))
    {
        $output['status'] = 'fail';
        $output['errors']['phone'] = 'Invalid Mobile Number';
    }
    
    if($whatsapp!='' && !isMobile($whatsapp))
    {
        $output['status'] = 'fail';
        $output['errors']['whatsapp'] = 'Invalid Whatsaap Number';
    }
    
    if($telegram!='' && preg_match('/^[a-zA-Z][a-zA-Z0-9_]{4,31}$/', $telegram) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['telegram'] = 'Invalid Telegram ';
    }
    
    if($og_title!='' && preg_match('/^[a-z0-9][a-z0-9 .,\-!?:\'"]{5,58}[a-z0-9]$/i', $og_title) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['og_title'] = 'Invalid OG Title ';
    }
    
    if($og_desc!='' && preg_match('/^[a-zA-Z0-9 .,\-!?:\'"\(\)]{10,160}$/i', $og_desc) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['og_desc'] = 'Invalid OG Description ';
    }
    
    if($google_analytics!='' && preg_match('/^G-[A-Z0-9]{6,12}$/i', $google_analytics) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['google_analytics'] = 'Invalid Google Analytics ';
    }
    
    if($search_console!='' && preg_match('/^[a-zA-Z0-9_-]{3,100}$/i', $search_console) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['search_console'] = 'Invalid Search Console ';
    }
   
    if($map!='' && preg_match('/^AIza[a-zA-Z0-9_-]{3,35}$/i', $map) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['map'] = 'Invalid Site Map ';
    }
    
    if($address!='' && preg_match('/^[a-zA-Z0-9\s,.\-\/#]{5,200}$/', $address) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['address'] = 'Invalid Address ';
    }
    
    if($site_description!='' && preg_match('/^[a-z0-9 .,!?:;\'"\-\(\)]{10,500}$/i', $site_description) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['site_description'] = 'Invalid Site Description ';
    }
    
    if($meta_keywords!='' && preg_match('/^[a-z0-9 ,.-]{3,500}$/i', $meta_keywords) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['meta_keywords'] = 'Invalid Meta Keywords ';
    }
    
    
    foreach($fileArr as $imgfile)
    {
        $imgResponse = ImagesValidate($_FILES[$imgfile], $imgfile);

        if(!$imgResponse['status'])
        { 
            $output['status'] = 'fail';
            $output['errors'][$imgfile] = $imgResponse['msg'];
        }
    }
    
    
    
    if($output['status'] == 'fail') {
        goto SEND_RESPONSE;
    }
    
    

    foreach($fileArr as $imgfile){ seoImagesUpdate($_FILES[$imgfile], $imgfile);}

    
    $seoUpdate = $db->prepare("UPDATE `seo` SET `url`=:url, `site_description`=:site_description, `address`=:address, `map`=:map, `meta_keywords`=:meta_keywords, `google_analytics`=:google_analytics, `search_console`=:search_console, `webname`=:webname, `phone`=:phone, `whatsapp`=:whatsapp, `telegram`=:telegram, `og_title`=:og_title, `og_desc`=:og_desc, `email`=:email, `date`=:date where 1");
    $seoUpdate->execute(array('url'=>$url, 'site_description'=>$site_description, 'address'=>$address, 'map'=>$map, 'meta_keywords'=>$meta_keywords, 'google_analytics'=>$google_analytics, 'search_console'=>$search_console, 'webname'=>$webname, 'phone'=>$phone, 'whatsapp'=>$whatsapp, 'telegram'=>$telegram, 'og_title'=>$og_title, 'og_desc'=>$og_desc, 'email'=>$email, 'date'=>$cdate));
    
    $output = responseSuccess('updated successfully');
    goto SEND_RESPONSE;

}
/*--------------------------X--------------------------*/




//seo image update
function seoImagesUpdate($file, $fieldname)
{
    global $db, $path;
    
    if($file["name"]!=''){
        
        $oldImgExe = $db->prepare("select * from seo  where 1");
        $oldImgExe->execute(); $oldImgGET = $oldImgExe->fetch(PDO::FETCH_ASSOC);
        
        $filepath = '../../'.$path.$oldImgGET[$fieldname];
        if(file_exists($filepath)){ unlink($filepath); }

        $file_name = $file["name"];
        $temp_name = $file["tmp_name"];
        
        $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        
        $file_rename = $fieldname.'_'.time().'.'.$extension;
        move_uploaded_file($temp_name, '../../'.$path.$file_rename);
        
        $updateSeo = $db->prepare("update seo set `$fieldname`=? where 1");
        $updateSeo->execute(array($file_rename));
    }
}





SEND_RESPONSE:
echo json_encode($output); die;




?>
