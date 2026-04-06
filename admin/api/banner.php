<?php
require_once '../core/controller.php';
include 'functions/custom_function.php';


$path = 'assets/img/banner/';
$ACTION = $_POST['ACTION'] ?? '';
$output = $input = [];

if (preg_match('/^(BANNER_DETAILS|SAVE_BANNER|DELETE_BANNER)$/', $ACTION) == false) 
{
    $output = responseError('Server not working!');
    goto SEND_RESPONSE;
}





/*------------------FETCH SEO DETAILS------------------*/
if($ACTION == 'BANNER_DETAILS')  
{
    $bannerList = [];
    $bannerStmt = $db->prepare("SELECT id, banner, IF(link!='',link,'NAN') as link FROM `web_banner` ORDER BY id DESC");
    $bannerStmt->execute(); $bannerData = $bannerStmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($bannerData as $items) 
    {
        $banner = '../../'.$path.$items['banner'];
        
        if (file_exists($banner)) 
        {
            $bannerList[] =  
            [
                'id'        => $items['id'] ?? '', 
                "link"      => $items['link'] ?? '', 
                "banner"    => $banner
            ]; 
        }
                
        
    }
    $output = responseSuccess('',['BANNER_LIST'=>$bannerList]);
    goto SEND_RESPONSE;
}
/*---------------------------X--------------------------*/




/*-------------------BANNER DATA SAVE-------------------*/
if($ACTION == 'SAVE_BANNER') 
{
    $fileArr    = ['file'];
    $link       =  post('link');
    $file       = $_FILES['file'];
    
    
    if(!secureValue($link))
    { 
        $output['status'] = 'fail';
        $output['errors']['link'] = "Invalid value link";
        goto SEND_RESPONSE;
    }
    
    if($link !='' && preg_match('/^(https?:\/\/)[a-z0-9.-]+\.[a-z]{2,}(\/[^\s]*)?$/i', $link) == false)
    {
        $output['status'] = 'fail';
        $output['errors']['link'] = 'Invalid Url';
    }
    
    if($file["name"]=='')
    {
        $output['status'] = 'fail';
        $output['errors']['file'] = 'Please upload File';
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
    
    

    

    $file_name = $file["name"];
    $temp_name = $file["tmp_name"];
    
    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    
    $file_rename = 'banner_'.time().'.'.$extension;
    move_uploaded_file($temp_name, '../../'.$path.$file_rename);
    
    

    
    $addNewBannerStmt = $db->prepare("INSERT INTO `web_banner`(`banner`, `link`) VALUES (:banner, :link)");
    $addNewBannerStmt->execute(array('link'=>$link, 'banner'=>$file_rename));
    
    $output = responseSuccess('updated successfully');
    goto SEND_RESPONSE;

}
/*--------------------------X---------------------------*/




/*--------------------DELETE BANNER --------------------*/
if($ACTION == 'DELETE_BANNER') 
{
    $delID    = $_POST['dsboss_id'];
    
    
    if(!secureValue($delID))
    { 
        $output = responseError('Server not working!');
        goto SEND_RESPONSE;
    }
    
    if(preg_match('/^\d+$/', $delID) == false)
    {
        $output = responseError('Server not working!');
        goto SEND_RESPONSE;
    }
    
    
    
    
    $deleteBannerStmt = $db->prepare("DELETE FROM `web_banner` WHERE `id`=:id");
    $deleteBannerStmt->execute(array('id'=>$delID));
    
    $output = responseSuccess('Deleted successfully');
    goto SEND_RESPONSE;

}
/*--------------------------X---------------------------*/



SEND_RESPONSE:
echo json_encode($output); die;




?>
