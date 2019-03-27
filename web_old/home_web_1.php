<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<h1>web site</h1>
<?php echo date('H:i:s');?>
<a href="<?= site_url('login'); ?>">Login</a>

<br>
<p>Your Location: <span id="location"></span></p>

<br>
<hr>
<h3>Complete handler</h3>
<div class="feedback-box-complete"></div>
<h4>Log (complete)</h4>
<ol id="log_complete"></ol>

<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=279480146028802&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '279480146028802',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>


<script>
$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
    }else{ 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});

function showLocation(position){
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    $.ajax({
        type:'POST',
        //url:'getLocation.php',
        url:'<?= site_url('welcome/getLocation'); ?>',
        //data:'latitude='+latitude+'&longitude='+longitude,
        data:{lat:latitude, long:longitude},
        success:function(msg){
           // alert(msg);
            if(msg){
               $("#location").html(msg);
            }else{
                $("#location").html('Not Available');
            }
        }
    });
}
</script>
<!--Using this script header file in Notification show count-->
<script>
setInterval('get_fb_complete();',1000); 
    
//Autometically ajax call
function get_fb_complete(){
    //$('#log_complete').append('<li>get_fb() ran</li>');
    var feedback = $.ajax({
        type: "POST",
        url: '<?= site_url('welcome/check'); ?>',
        data:{data:'Hello'},
        async: false,
        success:function(data){
            //alert(data);
            $('#log_complete').html(data);
        }
    });

    //$('div.feedback-box-complete').html('complete feedback');
}

</script>
<br>
<!--facebook share-->
<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=279480146028802&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

