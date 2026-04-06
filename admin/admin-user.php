<?php include('core/controller.php') ?>
<!DOCTYPE html>
<html class="no-js">
<head>
    <title>Admin Users - Admin</title>
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
                            <img src="<?= BASE_URL . '/assets/global/css/sidebar-fonts/admin-users.svg' ?>" height="20" width="20">
                            <span class="caption-subject bold uppercase">Admin users</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-bordered" id="dsbossTable">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>User Id</th>
                                    <th>Password</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal modal-styled fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green" style="width: 100%;">
                            <i class="icon-trash font-green"></i>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <span class="caption-subject bold uppercase">Delete Confirmation</span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Are you sure ! You want to delete this Game?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                        <button type="submit" id="delete" class="btn red btn-outline">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="dpbossModal" class="modal fade" tabindex="-1" data-width="400">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>

    <div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="msgmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="msgmodal">Role permissions <i class="fa fa-eye font-green" aria-hidden="true"></i></h5>
                    <button type="button" class="close" data-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    &#x2705; Market , &#x274C; Result, &#x2705;Guessing , &#x2705;Content , &#x274C;Profile
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'include/footer.php'; 
    include 'include/import-js-files.php'; 
    ?>
    <!--<script src="<?= BASE_URL . '/master/assets/global/admin-users-varsion2.js' ?>"></script>-->
    <script>
        /*****************Show admin-user datatable*******************/
var table = $('#dpbossTable').DataTable({
    "bProcessing": false,
    "bServerSide": true,
    "sServerMethod": "GET",
    "aaSorting": [[0, "desc"]],
    "sAjaxSource": "../../api/admin/admin-user.php",
    "aoColumns": [
        {"bVisible": true, "bSearchable": true, "bSortable": true},
        {"bVisible": true, "bSearchable": true, "bSortable": true},
        {"bVisible": true, "bSearchable": true, "bSortable": true},
        {"bVisible": true, "bSearchable": true, "bSortable": true},
        {"bVisible": true, "bSearchable": true, "bSortable": true},
        {"bVisible": true, "bSearchable": true, "bSortable": false}
    ],
    "fnRowCallback": function (nRow, aData, iDisplayIndex) {
        var row = $(nRow);
    }
});



/*****************************X********************************/
    </script>
</body>

</html>