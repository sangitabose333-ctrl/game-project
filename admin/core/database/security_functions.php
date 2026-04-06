<?php
/**
 * Security Helper Functions
 * Created: 2025-10-12
 * Purpose: Centralized security functions for the application
 */

// ============================================
// PASSWORD SECURITY
// ============================================

/**
 * Hash password securely using bcrypt
 * @param string $password Plain text password
 * @return string Hashed password
 */
function securePasswordHash($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

/**
 * Verify password against hash
 * @param string $password Plain text password
 * @param string $hash Stored hash
 * @return bool True if password matches
 */
function securePasswordVerify($password, $hash) {
    return password_verify($password, $hash);
}

/**
 * Check if password needs rehashing (algorithm upgrade)
 * @param string $hash Stored hash
 * @return bool True if needs rehash
 */
function passwordNeedsRehash($hash) {
    return password_needs_rehash($hash, PASSWORD_BCRYPT, ['cost' => 12]);
}

// ============================================
// XSS PROTECTION
// ============================================

/**
 * Sanitize output to prevent XSS
 * @param string $string String to sanitize
 * @return string Sanitized string
 */
function safeOutput($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Alias for backward compatibility
 */
function safe_echo($string) {
    return safeOutput($string);
}

/**
 * Sanitize array of strings for output
 * @param array $array Array to sanitize
 * @return array Sanitized array
 */
function safeOutputArray($array) {
    return array_map('safeOutput', $array);
}

// ============================================
// CSRF PROTECTION
// ============================================

/**
 * Generate CSRF token
 * @return string CSRF token
 */
function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Get CSRF token (generates if not exists)
 * @return string CSRF token
 */
function getCSRFToken() {
    return generateCSRFToken();
}

/**
 * Validate CSRF token
 * @param string $token Token to validate
 * @return bool True if valid
 */
function validateCSRFToken($token) {
    if (empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Output CSRF token hidden input field
 * @return void
 */
function csrfTokenField() {
    echo '<input type="hidden" name="csrf_token" value="' . safeOutput(getCSRFToken()) . '">';
}

/**
 * Check POST request for CSRF token (throws exception if invalid)
 * @throws Exception If CSRF token is invalid
 * @return bool True if valid
 */
function requireCSRFToken() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        if (!validateCSRFToken($token)) {
            throw new Exception('CSRF token validation failed');
        }
    }
    return true;
}

// ============================================
// INPUT VALIDATION
// ============================================

/**
 * Validate mobile number (10 digits)
 * @param string $mobile Mobile number
 * @return bool True if valid
 */
function isValidMobile($mobile) {
    return preg_match('/^[0-9]{10}$/', $mobile) === 1;
}

/**
 * Validate email address
 * @param string $email Email address
 * @return bool True if valid
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Sanitize string input
 * @param string $string Input string
 * @return string Sanitized string
 */
function sanitizeString($string) {
    return trim(strip_tags($string));
}

/**
 * Validate password strength
 * @param string $password Password to validate
 * @param int $minLength Minimum length (default: 6)
 * @return array ['valid' => bool, 'message' => string]
 */
function validatePasswordStrength($password, $minLength = 6) {
    if (strlen($password) < $minLength) {
        return ['valid' => false, 'message' => "Password must be at least {$minLength} characters"];
    }
    // Add more rules as needed
    return ['valid' => true, 'message' => 'Password is valid'];
}

// ============================================
// FILE UPLOAD SECURITY
// ============================================

/**
 * Validate uploaded image file
 * @param array $file $_FILES array element
 * @param int $maxSize Max file size in bytes (default: 5MB)
 * @return array ['valid' => bool, 'message' => string]
 */
function validateImageUpload($file, $maxSize = 5242880) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    
    // Check if file was uploaded
    if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
        return ['valid' => false, 'message' => 'Invalid file upload'];
    }
    
    // Check file size
    if ($file['size'] > $maxSize) {
        return ['valid' => false, 'message' => 'File size exceeds maximum allowed size'];
    }
    
    // Check extension
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions)) {
        return ['valid' => false, 'message' => 'Invalid file extension'];
    }
    
    // Check MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mimeType, $allowedMimeTypes)) {
        return ['valid' => false, 'message' => 'Invalid file type'];
    }
    
    // Verify it's actually an image
    $imageInfo = @getimagesize($file['tmp_name']);
    if ($imageInfo === false) {
        return ['valid' => false, 'message' => 'File is not a valid image'];
    }
    
    return ['valid' => true, 'message' => 'File is valid', 'extension' => $extension, 'mime' => $mimeType];
}

/**
 * Generate safe filename
 * @param string $originalName Original filename
 * @param string $prefix Prefix for filename
 * @return string Safe filename
 */
function generateSafeFilename($originalName, $prefix = '') {
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $timestamp = time();
    $random = bin2hex(random_bytes(8));
    return $prefix . $timestamp . '_' . $random . '.' . $extension;
}

// ============================================
// RATE LIMITING
// ============================================

/**
 * Check rate limit for an action
 * @param string $action Action identifier
 * @param int $limit Maximum attempts
 * @param int $timeWindow Time window in seconds
 * @return bool True if within limit, false if exceeded
 */
function checkRateLimit($action, $limit = 5, $timeWindow = 60) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $key = "ratelimit_{$action}_{$ip}";
    
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = ['count' => 0, 'time' => time()];
    }
    
    $data = $_SESSION[$key];
    
    // Reset if time window passed
    if (time() - $data['time'] > $timeWindow) {
        $_SESSION[$key] = ['count' => 1, 'time' => time()];
        return true;
    }
    
    // Check limit
    if ($data['count'] >= $limit) {
        return false;
    }
    
    // Increment counter
    $_SESSION[$key]['count']++;
    return true;
}

// ============================================
// SECURE RANDOM TOKEN GENERATION
// ============================================

/**
 * Generate secure random token
 * @param int $length Length in bytes (will be doubled in hex)
 * @return string Random token
 */
function generateSecureToken($length = 32) {
    return bin2hex(random_bytes($length));
}

// ============================================
// SQL INJECTION PREVENTION HELPERS
// ============================================

/**
 * Check if string contains SQL injection patterns (basic check)
 * @param string $string String to check
 * @return bool True if suspicious patterns found
 */
function containsSQLInjectionPattern($string) {
    $patterns = [
        '/(\bUNION\b.*\bSELECT\b)/i',
        '/(\bSELECT\b.*\bFROM\b)/i',
        '/(\bINSERT\b.*\bINTO\b)/i',
        '/(\bDELETE\b.*\bFROM\b)/i',
        '/(\bDROP\b.*\bTABLE\b)/i',
        '/(\bEXEC\b|\bEXECUTE\b)/i',
        '/(--|\#|\/\*)/i'
    ];
    
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $string)) {
            return true;
        }
    }
    
    return false;
}

// ============================================
// SECURE HEADERS
// ============================================

/**
 * Set security headers
 * @return void
 */
function setSecurityHeaders() {
    // Prevent clickjacking
    header('X-Frame-Options: SAMEORIGIN');
    
    // Prevent MIME sniffing
    header('X-Content-Type-Options: nosniff');
    
    // Enable XSS filter
    header('X-XSS-Protection: 1; mode=block');
    
    // Referrer policy
    header('Referrer-Policy: strict-origin-when-cross-origin');
    
    // HTTPS strict transport security (uncomment if using HTTPS)
    // header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    
    // Content Security Policy (basic - customize as needed)
    // header("Content-Security-Policy: default-src 'self'");
}

// ============================================
// SESSION SECURITY
// ============================================

/**
 * Initialize secure session
 * @return void
 */
function initSecureSession() {
    // Set secure session parameters before session_start()
    if (session_status() === PHP_SESSION_NONE) {
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.cookie_samesite', 'Strict');
        
        // Only set secure flag if using HTTPS
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            ini_set('session.cookie_secure', 1);
        }
        
        session_start();
    }
}

/**
 * Regenerate session ID (call after login)
 * @return void
 */
function regenerateSession() {
    session_regenerate_id(true);
}

?>

