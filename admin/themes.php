<?php include('admin/core/controller.php') ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <title>Themes - Admin</title>
    <meta name="Description" content="<?=$site_desc?>">
    <meta name="Keywords" content="<?=$site_meta_keywords?>">
    <!--<link rel="icon" href="<?=$site_favicon?>" type=" v/x-icon">-->
    <?php include('include/import-css-files.php') ?>
    <style>@media (max-width:1000px){.banner-clear,.logo_head p{position:absolute!important}.theme_top_sec,.theme_top_sec_2{transform:rotate(317deg);-webkit-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);-moz-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.banner-clear{background:0 0!important;border:none!important;top:10px!important;right:0!important;font-size:16px!important}.logo_head h3{font-size:13px!important;color:#000!important;font-weight:700!important;text-transform:uppercase!important;text-align:center!important;margin:0!important}.logo_head p{width:auto!important;float:right!important;top:-7px!important;right:30px!important;background:#fff!important;padding:0 8px!important;color:#ed008d!important;font-size:7px!important}.theme_head_title{margin:3px!important;font-size:11px!important}.theme_btn{padding:1em!important;font-size:5px!important;width:14em!important;background:#36c6d3!important;color:#fff!important;border-radius:5px!important;text-decoration:none!important;border:none!important}.theme_top_sec,.theme_top_sec_2,.theme_top_sec_3{width:131px;display:inline-block;position:relative;left:-62px;top:-33px;padding:45px 0 0;text-align:center;z-index:1}.theme_title{color:#fa9f04!important;font-size:12px!important;font-weight:700!important;margin:0!important}.theme_top_sec{background:#36c6d3;-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.theme_top_sec h4,.theme_top_sec_2 h4,.theme_top_sec_3 h4{font-size:7px;color:#fff;font-weight:700}.theme_top_sec_2{background:#03a216;-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.theme_top_sec_3{transform:rotate(317deg);-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);-webkit-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);-moz-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}}@media (min-width:1000px){.banner-clear,.logo_head p{position:absolute!important}.theme_top_sec,.theme_top_sec_2{transform:rotate(317deg);-webkit-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);-moz-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.banner-clear{background:0 0!important;border:none!important;top:10px!important;right:0!important;font-size:17px!important}.logo_head h3{font-size:14px!important;color:#000!important;font-weight:700!important;text-transform:uppercase!important;text-align:center!important;margin:0!important}.logo_head p{width:auto!important;float:right!important;top:-7px!important;right:30px!important;background:#fff!important;padding:0 8px!important;color:#ed008d!important;font-size:8px!important}.theme_head_title{margin:3px!important;font-size:12px!important}.theme_btn{padding:1em!important;font-size:6px!important;width:12em!important;background:#36c6d3!important;color:#fff!important;border-radius:5px!important;text-decoration:none!important;border:none!important}.theme_top_sec,.theme_top_sec_2,.theme_top_sec_3{width:140px;display:inline-block;position:relative;left:-64px;top:-32px;padding:45px 0 0;text-align:center;z-index:1}.theme_title{color:#fa9f04!important;font-size:12px!important;font-weight:700!important;margin:0!important}.theme_top_sec{background:#36c6d3;-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.theme_top_sec h4,.theme_top_sec_2 h4,.theme_top_sec_3 h4{font-size:8px;color:#fff;font-weight:700}.theme_top_sec_2{background:#03a216;-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.theme_top_sec_3{transform:rotate(317deg);-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);-webkit-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);-moz-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}}@media (min-width:1100px){.banner-clear,.logo_head p{position:absolute!important}.theme_top_sec,.theme_top_sec_2{transform:rotate(317deg);-webkit-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);-moz-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.banner-clear{background:0 0!important;border:none!important;top:8px!important;right:0!important;font-size:21px!important}.logo_head h3{font-size:16px!important;color:#000!important;font-weight:700!important;text-transform:uppercase!important;text-align:center!important;margin:0!important}.logo_head p{width:auto!important;float:right!important;top:-7px!important;right:30px!important;background:#fff!important;padding:0 8px!important;color:#ed008d!important;font-size:10px!important}.theme_head_title{margin:3px!important;font-size:15px!important}.theme_btn{padding:1em!important;font-size:8px!important;width:89px!important;background:#36c6d3!important;color:#fff!important;border-radius:5px!important;text-decoration:none!important;border:none!important}.theme_top_sec,.theme_top_sec_2,.theme_top_sec_3{width:145px;display:inline-block;position:relative;left:-64px;top:-30px;padding:45px 0 0;text-align:center;z-index:1}.theme_title{color:#fa9f04!important;font-size:15px!important;font-weight:700!important;margin:0!important}.theme_top_sec{background:#36c6d3;-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.theme_top_sec h4,.theme_top_sec_2 h4,.theme_top_sec_3 h4{font-size:9px;color:#fff;font-weight:700}.theme_top_sec_2{background:#03a216;-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.theme_top_sec_3{transform:rotate(317deg);-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);-webkit-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);-moz-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}}@media (min-width:1200px){.theme_top_sec,.theme_top_sec_2{transform:rotate(317deg);-webkit-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);-moz-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.banner-clear{background:0 0!important;border:none!important;position:absolute!important;top:9px!important;right:0!important;font-size:24px!important}.logo_head h3{font-size:20px!important;color:#000!important;font-weight:700!important;text-transform:uppercase!important;text-align:center!important;margin:0!important}.theme_head_title{margin:2px!important;font-size:20px!important}.theme_btn{padding:6px!important;font-size:11px!important;width:115px!important;background:#36c6d3!important;color:#fff!important;border-radius:5px!important;text-decoration:none!important;border:none!important}.theme_title{color:#fa9f04!important;font-size:18px!important;font-weight:700!important;margin:0!important}.theme_top_sec{width:151px;display:inline-block;background:#36c6d3;position:relative;left:-62px;top:-27px;padding:45px 0 0;text-align:center;z-index:1;-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.theme_top_sec_2,.theme_top_sec_3{width:145px;display:inline-block;position:relative;left:-62px;top:-27px;padding:45px 0 0;text-align:center;z-index:1}.theme_top_sec h4{font-size:11px;color:#fff;font-weight:700}.theme_top_sec_2{background:#03a216;-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}.theme_top_sec_2 h4,.theme_top_sec_3 h4{font-size:9px;color:#fff;font-weight:700}.theme_top_sec_3{transform:rotate(317deg);-ms-transform:rotate(45deg);-webkit-transform:rotate(316deg);-webkit-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);-moz-box-shadow:10px 9px 27px 3px rgba(0,0,0,.27);box-shadow:10px 9px 27px 3px rgba(0,0,0,.27)}}.theme_btn_icon,.theme_text{position:relative!important}.theme_text{width:100%!important;height:100%!important;display:flex!important;top:1rem!important}.theme_buy_btn{width:50%!important;margin-top:0!important;display:inline-block!important;text-align:center!important;float:right!important}.theme_btn_icon{font-size:1rem!important;top:0!important;left:0!important}.theme_color_dark{width:100%;height:19rem;display:inline-block;border-radius:10px;border:1px solid #c2cad8;overflow:hidden;padding-bottom:12px}.theme_color_dark img{width:100%;height:12rem;margin-bottom:10px}.default-banner{font-size:140px;color:#5e2dd8;margin-top:60px}.banner-clear{background:0 0;border:none;position:absolute;top:16px;right:11px}.portlet.light{padding:12px 20px 15px;background-color:#fff;width:100%;float:left}.modal-dialog{width:330px;margin:30px auto}.modal-body{padding:0 15px}.col_payment{width:100%;margin:0;text-align:center}</style>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
<?php include 'include/header.php'; ?>
<div class="page-container">
    <?php include 'include/sidebar.php'; ?>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title tabbable-line">
                                <div class="caption">
                                    <span class="caption-subject font-green bold uppercase">Theme Color</span>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 20px;">
                               
                                <div class='col-md-6'>
                                    <div class='theme_color_dark'>
                                        <div class='theme_top_sec_2'><h4>active now</h4></div>
                                        <div class='body_sec_theme'>
                                            <img src='../assets/img/themes/black.png' alt='Dpboss Dark Theme'>
                                            <div class='theme_body_text'>
                                                <h2 class='theme_title'>DARK <span class='text-primary'><small>Theme</small></span></h2>
                                                <div class='theme_text'>
                                                    <div style='width: 50%;'>
                                                        <h3 class='theme_head_title'>FREE <small> COST</small></h3>
                                                    </div>
                                                    <div class='theme_buy_btn'>
                                                        <button class='theme_btn' data-toggle='modal' data-target='#myModal' id=''>
                                                            <i class='fa fa-check theme_btn_icon' aria-hidden='true'></i> &nbsp; active now
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='theme_color_dark'>
                                        <div class='theme_top_sec_2'><h4>active now</h4></div>
                                        <div class='body_sec_theme'>
                                            <img src='../assets/img/themes/default.png' alt='Dpboss Dark Theme'>
                                            <div class='theme_body_text'>
                                                <h2 class='theme_title'>DARK <span class='text-primary'><small>Theme</small></span></h2>
                                                <div class='theme_text'>
                                                    <div style='width: 50%;'>
                                                        <h3 class='theme_head_title'>FREE <small> COST</small></h3>
                                                    </div>
                                                    <div class='theme_buy_btn'>
                                                        <button class='theme_btn' data-toggle='modal' data-target='#myModal' id=''>
                                                            <i class='fa fa-check theme_btn_icon' aria-hidden='true'></i> &nbsp; active now
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='theme_color_dark'>
                                        <div class='theme_top_sec_2'><h4>active now</h4></div>
                                        <div class='body_sec_theme'>
                                            <img src='../assets/img/themes/green.png' alt='Dpboss Dark Theme'>
                                            <div class='theme_body_text'>
                                                <h2 class='theme_title'>DARK <span class='text-primary'><small>Theme</small></span></h2>
                                                <div class='theme_text'>
                                                    <div style='width: 50%;'>
                                                        <h3 class='theme_head_title'>FREE <small> COST</small></h3>
                                                    </div>
                                                    <div class='theme_buy_btn'>
                                                        <button class='theme_btn' data-toggle='modal' data-target='#myModal' id=''>
                                                            <i class='fa fa-check theme_btn_icon' aria-hidden='true'></i> &nbsp; active now
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='theme_color_dark'>
                                        <div class='theme_top_sec_2'><h4>active now</h4></div>
                                        <div class='body_sec_theme'>
                                            <img src='../assets/img/themes/olive-green.png' alt='Dpboss Dark Theme'>
                                            <div class='theme_body_text'>
                                                <h2 class='theme_title'>DARK <span class='text-primary'><small>Theme</small></span></h2>
                                                <div class='theme_text'>
                                                    <div style='width: 50%;'>
                                                        <h3 class='theme_head_title'>FREE <small> COST</small></h3>
                                                    </div>
                                                    <div class='theme_buy_btn'>
                                                        <button class='theme_btn' data-toggle='modal' data-target='#myModal' id=''>
                                                            <i class='fa fa-check theme_btn_icon' aria-hidden='true'></i> &nbsp; active now
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-6'>
                                    <div class='theme_color_dark'>
                                        <div class='theme_top_sec_2'><h4>active now</h4></div>
                                        <div class='body_sec_theme'>
                                            <img src='../assets/img/themes/white.png' alt='Dpboss Dark Theme'>
                                            <div class='theme_body_text'>
                                                <h2 class='theme_title'>DARK <span class='text-primary'><small>Theme</small></span></h2>
                                                <div class='theme_text'>
                                                    <div style='width: 50%;'>
                                                        <h3 class='theme_head_title'>FREE <small> COST</small></h3>
                                                    </div>
                                                    <div class='theme_buy_btn'>
                                                        <button class='theme_btn' data-toggle='modal' data-target='#myModal' id=''>
                                                            <i class='fa fa-check theme_btn_icon' aria-hidden='true'></i> &nbsp; active now
                                                        </button>
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
        </div>
    </div>
</div>


<?php
include 'include/footer.php'; 
include 'include/import-js-files.php'; 
?>

</body>
</html>