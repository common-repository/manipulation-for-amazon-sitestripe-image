var $ = jQuery.noConflict();
var img_width = "";
var btn_color = "";

$(document).ready(function(){
    $.ajax({
        type:"POST",
        url:'/wp-admin/admin-ajax.php',
        data: {
            action: 'imas_get_val',
            option_name: 'imas_img_width'
        },
        success: function(response) {
            trim_rsp = response.substring(0, response.length - 1);
            rsp_arr = trim_rsp.split(',')
            btn_color = rsp_arr[0]
            img_width = rsp_arr[1]
            $("img[src*='//ws-na.amazon-adsystem.com'").css({width:img_width + "%",margin:"0 auto",display:"block"})
            amz_link = $("a[href*='www.amazon.com'").attr("href")
            $("img[src*='ir-na'").after('<div class="wp-block-button aligncenter"><a class="wp-block-button__link" href="' + amz_link + '">Check price on Amazon now!</a></div>')
            $(".wp-block-button__link").css("background-color", btn_color)
        },
        error: function(errorThrown){
            console.log(errorThrown);
        }
    })
});