<?php include('core/controller.php') ?>
<!DOCTYPE html>
<html class="no-js">

<head>
    <title>Admin Panel | Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="Description" content="<?= $desc ?? '' ?>">
    <meta name="Keywords" content="<?= $metakey ?? '' ?>">
    <link rel="icon" href="<?= $favurl ?? '' ?>" type="image/x-icon">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/style/login.css?v=1.2" rel="stylesheet" type="text/css" />
    <link href="assets/style/custom.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/css/components-md.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="assets/plugins/froiden-helper/css/helper.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="login">
    <div class="logo">  
        <a href="javascript:;">
            <img src="<?= $adminlogo ?? '' ?>" alt="<?= $webname ?? '' ?>" width="150px" />  
        </a>
    </div>
    <div class="content">
        <form id="login-form" autocomplete="off">
            <h3 class="form-title font-green">Sign In</h3>
            <div id="error"></div>

            <div class="form-group form-md-line-input">
                <label class="control-label visible-ie8 visible-ie9">Username</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" oninput="this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, '')" onkeypress="if(this.value.length==10) return false" placeholder="Username" name="username" autocomplete="new-username" />
                <span class="form-control-focus"> </span>
            </div>

            <div class="form-group form-md-line-input loginPassword">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" oninput="this.value = this.value.replace(/[^a-zA-Z0-9$!@#$_-]/g, '')" onkeypress="if(this.value.length==10) return false" placeholder="Password" name="password" autocomplete="new-password" />
                <span class="form-control-focus"> </span>
                <button type="button" class="eye-show-btn"><i class="fa fa-eye-slash font-green"></i></button>
                <small class="text-danger"> Allow only these special characters: !, @, #, and $. </small>
            </div>

            <div class="form-actions">
                <button type="button" class="btn green uppercase btn-xs btn-outline" onclick="login();">Login</button>
            </div>
            <span class="mt-2">You want Reset your Password ? <a href="#">Click Here</a></span>
        </form>
    </div>
    <script src="assets/plugins/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/froiden-helper/js/helper.js" type="text/javascript"></script>
    <script src="assets/global/js/custom_script.js"></script>    
    <script src="assets/custom-js/login.js?v=1.2.0"></script>
</body>

</html>