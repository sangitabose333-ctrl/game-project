<div class="page-footer">
    <div class="page-footer-inner"> 
        <?=$createby ?? ''?> <a target="_blank" href="https://www.dpboss.in"><?=$creator ?? ''?></a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>

<div id="websiteStatus" class="modal modal-styled fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green" style="width: 100%;">
                    <img src="../include/sidebar-icon/site-icon.svg" height="20" width="20">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <span class="caption-subject bold uppercase"> Confirmation</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Are you sure ! You want to delete this Game?</p>
                        </div>
                    </div>
                    <label for="username" class="control-label">Message</label><textarea type="text" row="3" id="msg" name="phone_no" class="form-control input-sm" data-required="true" value="'+msg+'" ></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
                    <button type="submit" id="webstatus_sub" class="btn red btn-outline">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="securityModal" class="modal fade" tabindex="-1" data-width="400">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

