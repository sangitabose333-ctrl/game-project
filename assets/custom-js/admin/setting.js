/**************Update user details****************/
function PROFILE_SETTING(id)
{
    $.easyAjax({
        url: "../../api/admin/profile-setting.php",
        type: "POST",
        container: `#${id}`,
        data: {ACTION:id},
        file:true,
        success: function (response){
            if(id != 'updateProfile') { $(`#${id}`)[0].reset(); }
            GET_PROFILE_DETAILS(); // CALL-Func
        }
    });
}
/************************X************************/



/**************Update user details****************/

GET_PROFILE_DETAILS(); // CALL-Func

function GET_PROFILE_DETAILS()
{
    $.easyAjax({
        url: "../../api/admin/profile-setting.php",
        type: "POST",
        container: `#`,
        data: {ACTION: 'PROFILE_DETAILS'},
        file:true,
        success: function (response) {
            console.log(response)
            if(response.PROFILE_DETAILS) 
            {
                let PROFILE_DETAILS = response.PROFILE_DETAILS;
                
                $.each(PROFILE_DETAILS,function(key,val){
                    
                    if($(`[name="${key}"]`).length)  
                    {
                        $(`[name="${key}"]`).val(`${val}`)
                        
                    } else if($(`#${key}`).length) 
                    {
                        $(`#${key}`).val(`${val}`);
                        $(`#${key}`).text(`${val}`);
                    }
                })
            }
        }
    });
}
/************************X************************/