<?php 
include('database/conn.php');
$cdate          = date('Y-m-d');
$ctime          = date('H:i:s');
$cdatetime      = date('Y-m-d H:i:s');
$cdateformat    = date('d / m / Y');


//Header
$currentDomain          = $_SERVER['SERVER_NAME'];
$sourceUrl              = (strpos($currentDomain, 'www.') !== false)?substr($currentDomain,4):$currentDomain; 
$sourceUrl              = preg_replace('/^admin\./', '', $sourceUrl);
$BASE_URL               = "https://www.$sourceUrl";
$CURRENT_FULLURL        = $_SERVER['PHP_SELF'];
define('BASE_URL', $BASE_URL);
$CURRENT_PAGE           = pathinfo(basename($CURRENT_FULLURL), PATHINFO_FILENAME);


// login authenticated
if (preg_match('/^admin\./', $currentDomain)) {
    if(!preg_match('#api/#', $CURRENT_FULLURL)) {
        if(isset($_SESSION['DS_USER_ID']) && $CURRENT_PAGE =='index') {
            header('location: https://admin.dsbossservice.com/dashboard.php');
        }else if (!isset($_SESSION['DS_USER_ID']) && $CURRENT_PAGE !='index') {
            header('location:https://admin.dsbossservice.com');
        }
    }
}


// site owner details
$ownerQuery                 = $db->prepare("SELECT * FROM `admin` WHERE `id`=1");
$ownerQuery->execute();
$ownerDetail                = $ownerQuery->fetch(PDO::FETCH_ASSOC);
$owner_name                 = $ownerDetail['name'] ?? '';
$owner_username             = $ownerDetail['username'] ?? '';
$owner_email                = $ownerDetail['email'] ?? '';
$owner_whatsapp_no          = $ownerDetail['whatsapp_no'] ?? '';



// seo details
$seoqry                 = $db->prepare("select s.`url`, s.`site_title`, s.`site_description`, s.`meta_keywords`, s.`google_analytics`, s.`search_console`, s.`webname`, s.`favicon`, s.`phone`, s.`whatsapp`, s.`telegram`, s.`og_title`, s.`og_desc`, s.`og_img`, s.`web_logo`, s.`admin_logo`, s.`email`, s.`address`, s.`map` FROM (SELECT 1 as id) t LEFT JOIN `seo` s ON s.id = t.id ");
$seoqry->execute();
$seoqryf                = $seoqry->fetch(PDO::FETCH_ASSOC);
extract($seoqryf, EXTR_PREFIX_ALL , "seo");

$site_weburl                 = $seo_url ?? '';
$site_webname                = $seo_webname ?? '';
$site_title                  = $site_title ?? '';
$site_desc                   = $site_description ?? '';
$site_meta_keywords          = $meta_keywords ?? '';
$site_favicon                = ($seo_favicon)?BASE_URL."/assets/img/$seo_favicon":'';
$site_index_favurl           = substr($sourceUrl,6);
$site_email                  = $seo_email ?? $sourceUrl;
$site_phone                  = $seo_phone ?? '';
$site_whatsapp               = $seo_whatsapp ?? '';
$site_telegram               = $seo_telegram ?? '';
$site_adminlogo              = ($seo_admin_logo)?BASE_URL."/assets/img/$seo_admin_logo":'';
$site_weblogo                = $seo_web_logo ?? '';
$site_address                = ($seo_address)?html_entity_decode($seo_address):'Kalyan West, Mumbai , 421301';
$site_mapTag                 = ($seo_map)?html_entity_decode(stripslashes($seo_map)):'';   
$site_search_console         = ($seo_search_console)?strval(html_entity_decode(stripslashes($seo_search_console))):'';
$site_search_console         = (preg_match('/content="([^"]+)"/', $seo_search_console, $matches))? $matches[1] : $seo_search_console;
$seo_google_analytics        = ($seo_google_analytics)?stripslashes(html_entity_decode($seo_google_analytics)):'';
$gtag                        = $seo_google_analytics;

$defaultlogoName             = trim($sourceUrl);
$df_prefix_arr               = (preg_match('/\s/', $defaultlogoName))? explode(' ', $defaultlogoName): [];
$df_prefix                   = (isset($df_prefix_arr[0]) && trim($df_prefix_arr[0]))? ucwords($df_prefix_arr[0]): ucwords(substr($defaultlogoName, 0, 2));
     
$otherDefaultlogoName        = (isset($df_prefix_arr[0]) && trim($df_prefix_arr[0]))? preg_replace('/^\S+\s*/', '', $defaultlogoName):preg_replace('/^../', '', $defaultlogoName);
     
$defaultlogo                 = "<strong>{$df_prefix}</strong><span>{$otherDefaultlogoName}</span>";
     
$adminlogoHtml               = (trim($seo_admin_logo) == '' || !file_exists('/'.$seo_admin_logo)) ?"<div class='dpboss-logo' style='margin-top: -30px;'> $defaultlogo </div>" : "<img src='{$adminlogo}' width='150' alt='{$webname}' />";
$adminlogoLoginForm          = (trim($seo_admin_logo) == '' || !file_exists('/'.$seo_admin_logo)) ?"<div class='dpboss-logo'font-size: 35px;'> $defaultlogo </div>" : "<img src='{$adminlogo}' width='150' />";
     
$og_title                    = $seo_og_title ?? '';    
$og_desc                     = $seo_og_desc ?? '';    
$og_img                      = $seo_og_img ?? '';    

     
//Footer     
$devlopby                    = "Dsboss TM";
$devlopurl                   = $BASE_URL;




// site maintenance
$site_maintenance_query = $db->prepare("SELECT * FROM `maintenance_site` WHERE `status`='1'");
$site_maintenance_query->execute();
$site_maintenance_data  = $site_maintenance_query->fetch(PDO::FETCH_ASSOC);
$websiteStatus          = $site_maintenance_data['status'] ?? '';
$websiteMassage         = htmlentities(str_replace("\r\n", "", ($site_maintenance_data['message'] ?? '')));
$websiteHeading         = $site_maintenance_data['heading'] ?? '';


// themes
$themeDataQuery         = $db->prepare("SELECT * FROM `web_themes` WHERE `status`='1'");
$themeDataQuery->execute();
$themeData              = $themeDataQuery->fetch(PDO::FETCH_ASSOC);
$active_theme           = $themeData['theme_name'] ?? 'style.css';
// $header_color_code      = GET_THEME_COLOR_CODE($active_theme);


// Banner
$bannerDataQuery        = $db->prepare("SELECT * FROM `web_banner`");
$bannerDataQuery->execute();
$bannerData             = $bannerDataQuery->fetch(PDO::FETCH_ASSOC);
$banner_img             = $bannerData['banner'] ?? '';
$banner_link            = $bannerData['link'] ?? '';


// onesignal
$onesignalStmt          = $db->prepare("SELECT * FROM `onesignal_notification`");
$onesignalStmt->execute();
$onesignalData          = $onesignalStmt->fetch(PDO::FETCH_ASSOC);
$onesignalAppId         = $onesignalData['app_id'] ?? '';
$onesignalAuthKey       = $onesignalData['auth_key'] ?? '';




// Ensure theme color function exists before use
if (!function_exists('GET_THEME_COLOR_CODE')) {
    function GET_THEME_COLOR_CODE($themeColor='')
    {
        switch ($themeColor) {
            case 'black':  
                return "#000000";
              break;
            case 'green':
                return "#E3FFBE";
              break;
            case 'white':
                return "#FFFFFF";
            case 'olive_green':
                return "#008B8B";
              break;
            default:
                return "#fc9";
        }
    }
}




//Avoid warning and notice in error log
error_reporting(E_ERROR | E_PARSE);




?>

