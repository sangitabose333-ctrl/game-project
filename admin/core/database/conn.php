<?php
// ============================================
// SECURITY ENHANCEMENTS ADDED: 2025-10-12
// ============================================

// Configure secure session BEFORE session_start()
ini_set('session.cookie_httponly', 1);      // Prevent JavaScript access to session cookie
ini_set('session.use_only_cookies', 1);     // Force cookies only (no URL sessions)
ini_set('session.cookie_samesite', 'Strict'); // Prevent CSRF via cookies

// Set secure flag if using HTTPS
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}

ini_set('session.use_strict_mode', 1);      // Reject uninitialized session IDs

session_start();

date_default_timezone_set('Asia/Kolkata');

$GET_BASEPATH =  realpath(dirname(__FILE__));
$BASE_PATH  = preg_replace('/(public_html\/).*/', '$1', $GET_BASEPATH);

define('BASE_PATH', $BASE_PATH);

require_once 'functions.php';
require_once 'security_functions.php';  // Security helper functions

// Set security headers
setSecurityHeaders();
$GLOBALS['HOST']        = "localhost";
$GLOBALS['USERNAME']    = "dsboss_db_sevicess_2026";
$GLOBALS['PASSWORD']    = "m)f7N)h?CFI_";
$GLOBALS['DATABASE']    = "dsboss_2026";
$encryptionType         = 'sha1';
$db                     = connectDatabase();
$DEFINER                = GET_DEFINER();

define('DEFINER', $DEFINER);



// $ASSIGN_TO_ROLES = (isset($_SESSION['adminlog']))? PERMISSION_ROLES(): [];
?>
