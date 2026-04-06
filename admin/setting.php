<?php include('core/controller.php') ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <title>Setting - Admin</title>
    <meta name="Description" content="<?=$site_desc?>">
    <meta name="Keywords" content="<?=$site_meta_keywords?>">
    <!--<link rel="icon" href="<?=$site_favicon?>" type=" v/x-icon">-->
    <?php include('include/import-css-files.php') ?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
<?php include 'include/header.php'; ?>
    <div class="page-container">
    <?php include 'include/sidebar.php'; ?>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green">
                        <img src="<?='assets/global/css/sidebar-fonts/sms-template.svg'?>" height="30" width="30">
                        <span class="caption-subject bold uppercase">Settings</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_3">
                            <div class="row profile-account">
                                <div class="col-md-3">
                                    <ul class="ver-inline-menu tabbable margin-bottom-10">

                                        <li class="active">
                                            <a data-toggle="tab" href="#tab_personal-info">
                                                <i class="fa fa-cog"></i> Personal info 
                                            </a>
                                            <span class="after"> </span>
                                        </li>
                                        
                                        <li>
                                            <a data-toggle="tab" href="#tab_change-password">
                                                <i class="fa fa-lock"></i> Change Password 
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a data-toggle="false" href="seo.php">
                                                <i class="fa fa-google"></i> SEO 
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a data-toggle="false" href="themes.php">
                                                <i class="fa fa-paint-brush"></i> Themes 
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a data-toggle="false" href="banner.php">
                                                <i class="fa fa-flag-checkered"></i> Banner 
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a data-toggle="false">
                                                <i class="fa fa-buysellads"></i> AdSense
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a data-toggle="false" href="#tab_change-password">
                                                <i class="fa fa-bell"></i> Notification Set
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a data-toggle="false" href="#">
                                                <i class="fa fa-comments"></i> Content
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                
                                <div class="col-md-9">
                                    <div class="tab-content">
                                        
                                        <!--Profile tab-Modal-->
                                        <div id="tab_personal-info" class="tab-pane active">
                                            <form id="updateProfile">
                                                <div class="form-group form-md-line-input ">
                                                    <input type="text" name="name" class="form-control" oninput="this.value = this.value.replace(/[^a-zA-Z0-9- ]/g, '')" placeholder="Name">
                                                    <label class="control-label">Name</label>
                                                    <span class="form-control-focus"> </span>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <input type="text" class="form-control placeholder-no-fix" name="username" oninput="this.value = this.value.replace(/[^a-zA-Z0-9- ]/g, '')" readonly placeholder="Enter user name" >
                                                    <label class="control-label">Username</label>
                                                    <span class="form-control-focus"> </span>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <input type="email" class="form-control placeholder-no-fix" name="email" oninput="this.value = this.value.replace(/[^a-zA-Z0-9-_.@]/g, '')" placeholder="Enter Email Address">
                                                    <label class="control-label">Email</label>
                                                    <span class="form-control-focus"> </span>
                                                </div>
                                                <div class="margiv-top-10">
                                                    <button type="submit" onclick="PROFILE_SETTING(`updateProfile`);return false" class="btn green btn-outline btn-sm" > Save Changes </button>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <!--password-change tab-Modal-->
                                        <div id="tab_change-password" class="tab-pane">
                                            <form accept-charset="UTF-8" id="updatePassword">
                                                <small class="text-danger"> Allow only these special characters: !, @, #, and $. </small>
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="password" class="form-control input-sm" name="password" oninput="this.value = this.value.replace(/[^a-zA-Z0-9$!@#$_-]/g, '')">
                                                    <label class="control-label">New Password</label>
                                                    <span class="form-control-focus"> </span>
                                                </div>
                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                    <input type="password" class="form-control input-sm" name="cpassword" oninput="this.value = this.value.replace(/[^a-zA-Z0-9$!@#$_-]/g, '')">
                                                    <label class="control-label">Confirm Password</label>
                                                    <span class="form-control-focus"> </span>
                                                </div>
                                                <div class="margin-top-10">
                                                    <button type="submit" class="btn green btn-outline btn-sm" onclick="PROFILE_SETTING(`updatePassword`);return false"> Change Password </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'include/footer.php'; 
include 'include/import-js-files.php'; 
?>
<script src="assets/custom-js/setting.js?v=1.2.0"></script>
</body>
</html>