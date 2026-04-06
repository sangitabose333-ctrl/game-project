//market up down
$('.up,.down').click(function () {
    
    var row = $(this).parents('tr:first');
    
    if ($(this).is('.up')) {
        row.insertBefore(row.prev());
    }else{
        row.insertAfter(row.next());
    }
});




// toggle password attr-val
$.fn.toggleAttr = function(attr, val1, val2) {
    return this.each(function() {
        const $this = $(this);
        const val = $this.attr(attr);
        $this.attr(attr, val === val1 ? val2 : val1);
    });
};



 

flatpickr("#time", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
});





/***************************************for hidden form***************************************/
function createForm(that)
{
    let dataSet = $(that)[0].dataset;
    
    let action = dataSet['formAttrAction'];
    let regExp = /^formData/i;
    
    let $form = $('<form />', { action: action, method: 'POST' });
    
    for(key in dataSet)
    {
        if(key.match(regExp))
        { 
            var field = key.replace(regExp, "").toLowerCase();
            $form.append($('<input />', { type: 'hidden', name: field, value: dataSet[key] }));
        }
    }
    
    $('body').append($form);
    $form.submit();
}
/*********************************************X***********************************************/



/**************************************for ON/OFF host/site***********************************/
function websiteStatus(st,msg,compid)
{
    var p = (st=='yes')?'OFF':'ON';

    $('#websiteStatus').find(".modal-body").html(`<p>Are you sure ${p} Your Site?</p>`);
    
    if(st=='yes'){ $('#websiteStatus').find(".modal-body").append(`<label for="username" class="control-label">Heading</label><input type="text" row="3" id="heading" name="heading" class="form-control input-sm" data-required="true" value="" ><label for="username" class="control-label">Message</label><textarea type="text" row="3" id="msg" name="phone_no" class="form-control input-sm" data-required="true" value="${msg}" >${msg}</textarea>`); }
    
    $('#websiteStatus').appendTo("body").modal('show');
    
    $("#webstatus_sub").click(function () {
        
        var msg = (st=='yes')?$('#msg').val():'';
        var head = (st=='yes')?$('#heading').val():'';
        
        // $.easyAjax({
        //     type: "POST",
        //     url: "websiteStatus.php",
        //     data: {'st':st, 'msg':msg, 'head':head, 'compid':compid},
        //     container: "#userUpdate",
        //     file:true,
        //     success: function(response) {
        //         $('#websiteStatus').modal('hide');
        //         $("#refwebst").load(window.location + " #refwebst");
        //         setTimeout(function(){window.location.reload();}, 1000);
        //     }
        // });
    })
}
/*********************************************X***********************************************/





/***************************************for Logout panel**************************************/
$(document).on('click','#logout-panel',function(){
    $.easyAjax({
        url: "../api/admin/logout.php",
        type: "POST",
        container: '#',
        data: {type: 'LOGOUT_PANEL'},
        file:true
    });
})
/*********************************************X***********************************************/



