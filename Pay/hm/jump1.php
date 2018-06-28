<?php
$url = $_GET['url'];
?>

<script>
function is_weixn(){  
        var ua = navigator.userAgent.toLowerCase();  
        if(ua.match(/MicroMessenger/i)=="micromessenger") {  
            return true;  
        } else {  
            return false;  
        }  
    }  
if(is_weixn())
{
    alert("ffff");
}
else

	window.location.href="<?php echo $url;?>"

</script>


