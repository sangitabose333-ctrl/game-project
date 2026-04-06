$(function() {
    if($("#visible_md").length) {
        $.ajax({
            type: 'POST',
            url: "../../api/get_ads_api.php",
            data: {"key": 'visible_md',"ads_status":'0'},
            success: function(response) {
                let result = JSON.parse(response);
                imageShow(result['visible_md'],'visible_md',0);
            }
        });
    }
});

function imageShow(imgArr, id, index){
    
    $(`#${id}`).attr("src", imgArr[index]['ads_image']); 
    $(`.${id}`).attr("href", imgArr[index]['ads_image']); 
    index++;
    if(imgArr.length<=index){ index=0; } 
    var run = setInterval(function (){ imageShow(imgArr, id, index);  clearInterval(run); }, 10000); 
}  