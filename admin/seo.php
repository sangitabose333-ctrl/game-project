<?php include('core/controller.php') ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <title>Search Engine - Admin</title>
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
                            <i class="fa fa-search font-green"></i>
                            <span class="caption-subject bold uppercase">SEO Tools</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="responsive">
                            <form id="siteUpdate">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Url">Url</label>
                                            <input type="text" class="form-control" name="url" placeholder="URl" oninput="this.value = this.value.replace(/(<([^>]+)>)/ig, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, '')" />
                                            <div class="help-block help-block-error "></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="Website-Name">Website Name</label>
                                            <input type="text" class="form-control" name="webname" placeholder="Title" oninput="this.value = this.value.replace(/(<([^>]+)>)/ig, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, '')" />
                                            <div class="help-block help-block-error "></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="Email">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Your email" oninput="this.value = this.value.replace(/[^a-zA-Z0-9@._-]/g, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, '')"/>
                                            <div class="help-block help-block-error "></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="Phone">Phone</label>
                                            <input type="text" class="form-control" maxlength="15" minlength="7" name="phone" placeholder="Phone Number" oninput="this.value = this.value.replace(/[^0-9+\s\-\(\)]/g, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, '')" />
                                            <div class="help-block help-block-error "></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="whatsapp">whatsapp </label>
                                            <input type="number" class="form-control" onkeypress="if(this.value.length==10)return false" name="whatsapp" placeholder="Whatsapp" oninput="this.value = this.value.replace(/\D/g, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, '')" />
                                            <div class="help-block help-block-error "></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Telegram </label>
                                            <input type="text" class="form-control" name="telegram" placeholder="Telegram" minlength="4" maxlength="31" oninput="this.value = this.value.replace(/[^a-zA-Z0-9_]/g, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, '')">
                                            <div class="help-block help-block-error "></div>
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="OG-Title">OG Title</label>
                                            <input type="text" class="form-control" name="og_title" placeholder="OG Title" minlength="3" maxlength="60" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 .,!?:'&quot;-]/g, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, '')" />
                                            <div class="help-block help-block-error "></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="OG-Description">OG Description</label>
                                            <input type="text" class="form-control" name="og_desc" placeholder="OG Description" minlength="10" maxlength="160" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 .,!?:'&quot;-]/g, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, '')" />
                                            <div class="help-block help-block-error "></div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="Google-Analytics">Google Analytics</label>
                                            <input type="text" class="form-control text-uppercase" name="google_analytics" placeholder="Enter GA ID (G-XXXXXXX)" maxlength="14" oninput="this.value = this.value.replace(/[^a-zA-Z0-9-]/g, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, ''); validateGA(this.value,this)" />
                                            <div class="help-block help-block-error "></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="Search-Console">Search Console</label>
                                            <input type="text" class="form-control" name="search_console" placeholder="Search Console" maxlength="100" oninput="this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, ''); validateCode(this.value,this) " />
                                            <div class="help-block help-block-error "></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="site-map">Map</label>
                                            <input type="text" class="form-control" name="map" placeholder="Enter MAP-CODE (AIza...)" maxlength="35" oninput="this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, '').replace(/(<\?php|<\?=)\s*/, '').replace(/<\?php\s*[^\?]+\s*\?>/, ''); validateGoogleMapsKey(this.value,this) " />
                                            <div class="help-block help-block-error "></div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="analytics">Address</label>
                                            <textarea class="form-control textarea-size" name="address" rows="3" minlength="5" maxlength="200" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 .,-]/g, '').replace( /<(?!br\s*\/?)[^>]+>/g, '').replace(/(<\?php\s*[^\?]+\s*\?>)|(<\?php|<\?=)\s*/, '')"></textarea>
                                            <div class="help-block help-block-error "></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Sit-Description">Site Description </label>
                                            <textarea class="form-control textarea-size" name="site_description" rows="3" minlength="10" maxlength="500" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 .,!?:;'&quot;-]/g,'').replace(/(<([^>]+)>)/ig, '').replace(/(<\?php\s*[^\?]+\s*\?>)|(<\?php|<\?=)\s*/, '')"></textarea>
                                            <div class="help-block help-block-error "></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="Meta-keyword">Meta keywords</label>
                                            <div class="console">
                                                <input type="text" data-role="tagsinput" id="inputTag" name="meta_keywords" minlength="3" maxlength="500" oninput="this.value = this.value.replace(/[^a-zA-Z0-9 .,-]/g,'').replace(/(<([^>]+)>)/ig, '').replace(/(<\?php\s*[^\?]+\s*\?>)|(<\?php|<\?=)\s*/, '')">
                                            </div>
                                            <div class="help-block help-block-error "></div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="custom-sec-logo">
                                                <div class="custom-head-logo">
                                                    <h3>Web Logo</h3>
                                                    <p class="mb-0">Width: 220px / Height: 60px</p>
                                                </div>
                                                <div class="custom-img" id="image_web_logo">
                                                    <img src="../assets/global/css/sidebar-fonts/file-upload.png" height="60" id="blah1">                                                
                                                </div>
                                                <div class="custom-logo-text">
                                                    <h6>Upload Web Logo</h6>
                                                </div>
                                                <input type="file" class="form-control custom-input-file" name="web_logo" onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="custom-sec-logo">
                                                <div class="custom-head-logo">
                                                    <h3>Admin Logo</h3>
                                                    <p class="mb-0">Width: 150px / Height: 35px</p>
                                                </div>
                                                <div class="custom-img" id="image_admin_logo">
                                                    <img src="../assets/global/css/sidebar-fonts/file-upload.png" height="60" id="blah2">                                                
                                                </div>
                                                <div class="custom-logo-text">
                                                    <h6>Upload Admin Logo</h6>
                                                </div>
                                                <input type="file" class="form-control custom-input-file" name="admin_logo" onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="custom-sec-logo">
                                                <div class="custom-head-logo">
                                                    <h3>Fav Icon</h3>
                                                    <p class="mb-0">Width: 500px / Height: 500px</p>
                                                </div>
                                                <div class="custom-img" id="image_favicon">
                                                    <img src="../assets/global/css/sidebar-fonts/file-upload.png" height="60" id="blah3">                                                
                                                </div>
                                                <div class="custom-logo-text">
                                                    <h6>Upload Fav Icon</h6>
                                                </div>
                                                <input type="file" class="form-control custom-input-file" name="favicon" onchange="document.getElementById('blah3').src = window.URL.createObjectURL(this.files[0])" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="custom-sec-logo">
                                                <div class="custom-head-logo">
                                                    <h3>Og Image</h3>
                                                    <p class="mb-0">Width: 220px / Height: 60px</p>
                                                </div>
                                                <div class="custom-img" id="image_og_img">
                                                    <img src="../assets/global/css/sidebar-fonts/file-upload.png" height="60" id="blah4">
                                                </div>
                                                <div class="custom-logo-text">
                                                    <h6>Upload Og Image</h6>
                                                </div>
                                                <input type="file" class="form-control custom-input-file" name="og_img" onchange="document.getElementById('blah4').src = window.URL.createObjectURL(this.files[0])" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="divided-div">
                                    <button class="btn btn-primary updateBtn" type="button" name="submit" onclick="updateSite();">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="AIpromptModal" class="modal modal-styled fade" tabindex="-1" role="dialog" aria-labelledby="AIpromptModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green" style="width: 100%;">
                            ðŸš€
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <span class="caption-subject bold uppercase">AI Generate</span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div id="lottieAnimation" class="lottie-animation d-none"></div>
                            <div class="col-md-12 prompt-form">
                                <div class="">
                                    <label for="prompt" class="control-label">Prompt<span class="text-danger">*</span></label>
                                    <textarea name="prompt" class="form-control input-sm auto-grow" rows="4" oninput="autoExpandTextarea()"></textarea>
                                    <span class="form-control-focus"> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                        <button type="button" id="generateAIContent" class="btn success btn-outline">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'include/footer.php'; 
    include 'include/import-js-files.php'; 
    ?>
    
    <script src="assets/custom-js/seo.js?v=1.2.0"></script>
</body>