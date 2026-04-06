<?php include('core/controller.php') ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <title>Dashboard - Admin</title>
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
            <div class="page-head margin-bottom-5">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>Dashboard
                        <small>activities &amp; statistics</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            
            <div class="row">
                <!--Market-->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue-soft" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-line-chart"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup">0</span>
                                    </div>
                                    <div class="desc"> Total Market </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue-sharp" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-link"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup">0</span></div>
                                    <div class="desc"> Active Market </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 blue-dark" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-chain-broken"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup">0</span>
                                    </div>
                                    <div class="desc"> Inactive Market </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!--Starline-->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 yellow" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup">0</span>
                                    </div>
                                    <div class="desc"> Total Starline </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 yellow-gold" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup">0</span></div>
                                    <div class="desc"> Active Starline </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 yellow-casablanca" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-spinner"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup">0</span>
                                    </div>
                                    <div class="desc">Inactive Starline</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                
                <!--Disawar-->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple-intense" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-cubes"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup">0</span>
                                    </div>
                                    <div class="desc"> Total Disawar </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple-studio" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-arrows"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup">0</span></div>
                                    <div class="desc"> Active Disawar </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-v2 purple-sharp" href="javascript:;">
                                <div class="visual">
                                    <i class="fa fa-times"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup">0</span>
                                    </div>
                                    <div class="desc"> Inactive Disawar </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 <?=$sendMsgVisiblity?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <span class="caption-subject font-green bold uppercase">Map and Data</span>
                                    </div>
                                </div>
                                <div class="portlet-body"></div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="portlet light bordered">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption">
                                        <span class="caption-subject font-green bold uppercase">Revenue</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <canvas id="revenueChart"></canvas>
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
