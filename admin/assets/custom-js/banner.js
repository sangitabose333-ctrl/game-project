const fileInput = document.getElementById("fileUpload");
const preview = document.getElementById("preview");
const removeBtn = document.getElementById("removeImg");
const uploadContent = document.getElementById("uploadContent");

fileInput.addEventListener("change", function () {
    
    $(`[name="file"]`).parent().removeAttr("style");
    $(`[name="file"]`).parent().find('.help-block').text('');

    const file = this.files[0];

    if(file){
        preview.src = URL.createObjectURL(file);
        preview.style.display = "block";
        removeBtn.style.display = "block";
        uploadContent.style.display = "none";

        preview.onload = () => URL.revokeObjectURL(preview.src);
    }
});


removeBtn.addEventListener("click", function(){

    preview.src = "";
    preview.style.display = "none";

    removeBtn.style.display = "none";
    uploadContent.style.display = "block";

    fileInput.value = "";
});




/******************save banner*******************/
function SAVE_BANNER()
{
    $.easyAjax({
            url: `api/banner.php`,
        type: "POST",
        container: `#BannerForm`,
        data: {ACTION:'SAVE_BANNER'},
        file:true,
        success: function (response){
            
            if(response.status == 'success') {
                BANNER_DETAILS(); //CALL-Func
                $(`#BannerForm`)[0].reset();
                $(`#removeImg`).trigger('click');
            }
            
            if(response.status == 'fail') {
                let errors = response.errors;
                
                $.each(errors,function(key, val){
                    if(key == 'file') {
                        $(`[name="${key}"]`).parent().css("border-color", "red");
                    }
                })
            }
        }
    });
}
/************************X************************/




/************************delete banner************************/
$("#delete").click(function () {
    let dsboss_id = $(`#banner-modal`).find(`#dsboss_id`).val();
    $.easyAjax({
        url: `api/banner.php`,
        type: "POST",
        container: `#`,
        data: {ACTION:'DELETE_BANNER', 'dsboss_id':dsboss_id},
        file:true,
        success: function (response) {
            if(response.status == 'success') {
                BANNER_DETAILS();
                $(`#banner-modal`).modal('hide');
            }
        }
    });
})
/****************************X********************************/




/*****************show banner list****************/
BANNER_DETAILS(); //CALL-Func
function BANNER_DETAILS()
{
    $.easyAjax({
        url: `api/banner.php`,
        type: "POST",
        container: `#`,
        data: {ACTION:'BANNER_DETAILS'},
        file:true,
        success: function (response){
            
            $("#banner-container").html('');
            let BANNER_LIST = response.BANNER_LIST;
            
            $.each(BANNER_LIST,function(key,items) {
                
                let bannerlink = items.link;

                let bannerRow = $("<div>").addClass("banner-row d-flex justify-content-between mb-15");
                
                let leftDiv = $("<div>");
                
                let fileIcon = $("<span>").attr({"data-toggle": "modal","data-target": "#banner-modal","data-action": 'show',"data-banner": items.banner,"data-link": bannerlink}).append($("<i>").addClass("fa fa-files-o"));

                leftDiv.append(fileIcon);
                
                let removeBtn = $("<span>").addClass("remove-file").attr({"data-toggle": "modal","data-target": "#banner-modal","data-action": 'delete','data-deleteid':`${items.id}`}).append($("<i>").addClass("fa fa-times-circle-o"));
                
                let fileText = $("<span>").text(bannerlink.replace(/^(.{20})(.+)/, '$1...'));
                
                bannerRow.append(leftDiv, fileText, removeBtn);
                
                $("#banner-container").append(bannerRow);
            })
            
        }
    });
}
/************************X************************/




/*************Dynamicly modal content*************/
$('#banner-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    let action = button.data('action');
    
    if(action == 'show')
    {
        let preview = button.data('banner');
        let link = button.data('link');
        
        $(`.modal-footer`).addClass(`hidden`);
        
        $(this).find(`.modal-body`).html(`
        <div class="row">
            <div class="col-sm-12" style="text-align: center;">
                <img src='${preview}' style='height: 100%;width: 100%;'/>
                <p>${link}</p>
            </div>
        </div>
        `)
    }
    
    if(action == 'delete')
    {
        let deleteID = button.data('deleteid');
        $(`.modal-footer`).removeClass(`hidden`);
    
        $(this).find(`.modal-body`).html(`
        <div class="row">
            <div class="col-md-12">
                <p>Are you sure ! You want to delete this?</p>
                <input type="hidden" value="${deleteID}" id="dsboss_id" />
            </div>
        </div>
        `)
    }
})
/************************X************************/