<?php include('core/controller.php') ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <title>Banners - Admin</title>
    <meta name="Description" content="<?=$site_desc?>">
    <meta name="Keywords" content="<?=$site_meta_keywords?>">
    <!--<link rel="icon" href="<?=$site_favicon?>" type=" v/x-icon">-->
    <?php include('include/import-css-files.php') ?>
    <link href="assets/global/css/banner.css" rel="stylesheet" type="text/css" />
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
                        <img src="<?='/assets/global/css/sidebar-fonts/banner-icon.svg'?>" height="30" width="30">
                        <span class="caption-subject bold uppercase">Banners</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-sm-8 center-content">
                            <form id="BannerForm">
                                <div class="form-group">
                                    <div class="upload-box">
                                        <input type="file" id="fileUpload" name="file" accept="image/*">
                                        <img id="preview" />
                                        <span class="remove-img" id="removeImg">✖</span>
                                        <div class="upload-content" id="uploadContent">
                                            <div class="icon">📤</div>
                                            <label for="fileUpload" class="upload-btn">Choose Image</label>
                                        </div>
                                    </div>
                                    <div class="help-block help-block-error "></div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="Link">Link</label>
                                    <input type="text" class="form-control" name="link" placeholder="Link" oninput="this.value = this.value.replace(/(<([^>]+)>)/ig, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, '')" />
                                    <div class="help-block help-block-error "></div>
                                </div>
                                
                                <button class="btn btn-primary btn-lg btn-block mb-btn" type="button" name="submit" onclick="SAVE_BANNER();">Submit</button>
                            </form>
                        </div>
                        <div class="col-sm-8 center-content">
                            <div id="banner-container"> <!--BANNER LIST--> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="banner-modal" class="modal modal-styled fade" tabindex="-1" role="dialog" aria-labelledby="banner-modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green" style="width: 100%;">
                        <button type="button" class="close" data-dismiss="modal">X</button>
                        <span class="caption-subject bold uppercase">Banner</span>
                    </div>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer hidden">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                    <button type="submit" id="delete" class="btn red btn-outline">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'include/footer.php'; 
include 'include/import-js-files.php'; 
?>
<script src="assets/custom-js/banner.js?v=1.2.0"></script>
</body>
</html>