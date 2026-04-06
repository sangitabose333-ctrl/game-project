/**********************************Toggle Password**********************************/
$(`.eye-show-btn`).on('click', function ()
{
    $(this).find('i').toggleClass('fa-eye-slash fa-eye');
    $(`[name="password"]`).toggleAttr('type', 'password', 'text');
});
/*****************************************X*****************************************/




/***************************Login with PASSWORD**************************/
function login() {

    $.easyAjax({
        url: `api/login.php`,
        type: "POST",
        container: "#login-form",
        messagePosition: "inline",
        file:true
    });
}
/*****************************************X*****************************************/
