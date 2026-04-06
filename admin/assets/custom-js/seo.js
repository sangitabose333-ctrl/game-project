SEO_DETAILS(); //CALL-Func


/*------------Validate Google Analytics code-----------*/
function validateGA(input,that) {

    const pattern = /^G-[A-Z0-9]{6,12}$/i;
    var input = input.trim();
    
    if (pattern.test(input) || input=='') {
        $(that).parent().removeClass('has-error');
        $(that).parent().find(`.help-block`).text('');
    } else {
        $(that).parent().addClass('has-error');
        $(that).parent().find(`.help-block`).text('Invalid ID. Format should be like G-XXXXXXX');
    }
}
/*--------------------------X--------------------------*/





/*-------------Validate Search Console code------------*/
function validateCode(input,that) {
    
    const pattern = /^[a-zA-Z0-9_-]{10,}$/;
    
    if (pattern.test(input) || input=='') {
        $(that).parent().removeClass('has-error');
        $(that).parent().find(`.help-block`).text('');
    } else {
        $(that).parent().addClass('has-error');
        $(that).parent().find(`.help-block`).text('valid verification value');
    }
}
/*--------------------------X--------------------------*/





/*---------------Validate Google Map Key---------------*/
function validateGoogleMapsKey(input,that) {
    const pattern = /^AIza[0-9A-Za-z_-]+$/;
    var input = input.trim();
    
    if (pattern.test(input) || input == '') {
        $(that).parent().removeClass('has-error');
        $(that).parent().find(`.help-block`).text('');
        return;
    } else {
        $(that).parent().addClass('has-error');
        $(that).parent().find(`.help-block`).text('Invalid API Key');
    }
    
    
    // $(that).parent().find(`.help-block`).text("Checking key...");
    
    
    // // Remove old script if exists
    // const oldScript = document.getElementById("gmaps-script");
    // if (oldScript) oldScript.remove();
    
    // // Step 2: Load Google Maps API
    // const script = document.createElement("script");
    // script.id = "gmaps-script";
    // script.src = `https://maps.googleapis.com/maps/api/js?key=${input}&callback=gmapsCallback`;
    
    // window.gmapsCallback = function () {
    //     $(that).parent().removeClass('has-error');
    //     $(that).parent().find(`.help-block`).text('');
    // };
    
    // script.onerror = function () {
    //     $(that).parent().addClass('has-error');
    //     $(that).parent().find(`.help-block`).text('PI Key is invalid or not usable');
    // };
    
    // document.body.appendChild(script);
}
/*--------------------------X--------------------------*/





/*--------------------SHOW SEO DATA--------------------*/
function SEO_DETAILS() {
    $.easyAjax({
        url: `api/seo.php`,
        type: "POST",
        container: "#",
        data: {'ACTION': 'SEO_DETAILS'},
        file:true,
        success: function(response) {
            console.log(response)
            var n = 1;
            const filters = response.SEO_DATA;
            for (var key in filters) {
                if (key.includes("image")) {
                    $(`#${key}`).html(`<img src="../${filters[key]}" height="60" id="blah${n}">`);
                    n++;
                } else {
                    if (key == 'meta_keywords') {
                        $(`[name="${key}"]`).tagsinput('removeAll');
                        let metaKeyword = filters[key].trim();
                        $(`[name="${key}"]`).attr('value', metaKeyword);
                        $(`[name="${key}"]`).tagsinput('add', metaKeyword);
                    } else {
                        $(`[name="${key}"]`).val(decodeHTMLEntities(filters[key]));
                    }
                }
            }
        }
    });
}
/*--------------------------X--------------------------*/





/*-----------------DECODE HTML ENTITIES----------------*/
function decodeHTMLEntities(text) {
    var entities = [
        ['amp', '&'],
        ['apos', '\''],
        ['#x27', '\''],
        ['#x2F', '/'],
        ['#39', '\''],
        ['#47', '/'],
        ['lt', '<'],
        ['gt', '>'],
        ['nbsp', ' '],
        ['quot', '"'],
        ['#039', "'"]
    ];

    if (text != null) {
        for (var i = 0, max = entities.length; i < max; ++i) {
            text = text.replace(new RegExp('&' + entities[i][0] + ';', 'g'), entities[i][1]);
        }
    }
    return text;
}
/*--------------------------X--------------------------*/




/*---------------------SAVE SEO DATA-------------------*/
function updateSite() {
    var metaValues = [];

    $('.bootstrap-tagsinput .tag').each(function () {
        metaValues.push($(this).text());
    });
    $(`[name="meta_keywords"]`).attr('value', metaValues.join(','));

    $.easyAjax({
        url: `api/seo.php`,
        type: "POST",
        container: "#siteUpdate",
        data: {'ACTION': 'SAVE_SEO'},
        file: true,
        success: function (response) {
            if (response.status == "success") {
                SEO_DETAILS()
            }
        }
    });
}
/*--------------------------X--------------------------*/
