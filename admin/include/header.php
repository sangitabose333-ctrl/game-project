<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="/">
                <span class="logo-default">
                    <?=$adminlogoHtml?>
                </span>
            </a>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <div class="page-top">
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"> </li>
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="username username-show-on-mobile"> <?=$_SESSION['DS_NAME']?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li><a href="settings"><i class="icon-user"></i> My Profile </a></li>
                            <li><a href="settings"><i class="icon-settings"></i> Setting </a></li>
                            <li class="divider"> </li>
                            <li><a href="javascript:void(0)" id="logout-panel"><i class="icon-key"></i> Log Out </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="web-mentain <?=($_SESSION['DS_USER_ID'] != "1")?'d-none':''?>" id="refwebst">
            <div class="<?=($websiteStatus == 'yes')?'Website-on':'Website-OFF'?>">
                <a onclick="<?= ($websiteStatus!='yes' && $companyid && !$webupdated_by)? 'disabled':"websiteStatus(`$websiteStatus`,`$websiteMassage`,`$companyid`)"?>"><img src="../../assets/img/<?=($websiteStatus == 'yes')?'turn-on.png':'turn-off.png'?>" ></a>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
