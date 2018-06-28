$(".mask").hide();
$(".md-overlay").hide();

if(navigator.userAgent.indexOf("MSIE")>0){
    if(navigator.userAgent.indexOf("MSIE 6.0")>0){
        $(".mask").show();
        $(".md-overlay").show();
        $(".closeMask").hide();

    }
    if(navigator.userAgent.indexOf("MSIE 7.0")>0){
        $(".mask").show();
        $(".md-overlay").show();
        $(".closeMask").hide();

    }
    if(navigator.userAgent.indexOf("MSIE 8.0")>0 && !window.innerWidth){
        $(".mask").show();
        $(".md-overlay").show();

        $(".closeMask").click(
            function(){
                $(".mask").hide();
                $(".md-overlay").hide();
            });
    }

}