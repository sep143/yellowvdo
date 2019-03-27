<!--<script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>-->
<link rel="stylesheet" href="<?= base_url(); ?>theme/backend/build/css/intlTelInput.css">
<style>
    p{
        color: red;
    }
    .intl-tel-input {
        position: relative;
        display: block;
    }
</style>
<!-- Breadcumb -->
      <section class="breadcumb_area">
         <div class="container">
            <div class="row">
               <div class="col-xs-12 text-center">
                  <div class="breadcumb_section">
                     <div class="page_title">
                         <h3 style="color:#000;">Sign Up</h3>
                     </div>
                     <div class="page_pagination">
                        <ul>
                            <li><a href="<?= site_url(); ?>">Home</a></li>
                           <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                           <li>Sign Up</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End Breadcumb -->

<!-- Login -->
<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-lg-2">&nbsp;</div>
            <div class="col-md-8 col-lg-8">
                <div class="login-panel widget">
                    <div class="login-body">
                        <form action="<?= site_url('user_register'); ?>" method="post" >
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">First Name <span class="required">*</span></label>
                                        <input type="text" name="fname" placeholder="First Name" value="<?= set_value('fname'); ?>" class="form-control" required="">
                                        <div><?= form_error('fname'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Last Name <span class="required">*</span></label>
                                        <input type="text" name="lname" placeholder="Last Name" value="<?= set_value('lname'); ?>" class="form-control" required="">
                                        <div><?= form_error('lname'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Mobile No. <span class="required"></span></label><br>
                                        <!--<input type="text" name="mobile" placeholder="Mobile No." maxlength="10" value="<?= set_value('mobile'); ?>" class="form-control">-->
                                        <input type="text" name="mobile" id="whatsappNo" placeholder="e.g. 9000000001" class="form-control border-form" value="<?= set_value('mobile'); ?>">
                                        <div><?= form_error('mobile'); ?></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Email <span class="required">*</span></label>
                                        <input type="text" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>" class="form-control" required="">
                                        <div><?= form_error('email'); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Password <span class="required">*</span></label>
                                        <input type="password" name="password" placeholder="Password" class="form-control" id="pass1" onkeyup="checkPass(); return false;" required="">
                                        <div><?= form_error('password'); ?></div>
                                        <div id="error-nwl">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password <span class="required">*</span></label>	
                                        <input type="password" name="cpassword" placeholder="Confirm Password" class="form-control" id="pass2"  required="">
                                        <div><?= form_error('cpassword'); ?></div>
                                        <div id="error-nw2">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label">Address <span class="required">*</span></label>
                                        <input type="text" name="full_address" id="searchInput" class="form-control input-controls" required="true">
                                        <input type="hidden" id="administrative_area_level_1" name="state">
                                        <input type="hidden" name="location" id="location">
                                        <input type="hidden" name="lat" id="lat">
                                        <input type="hidden" name="lng" id="lng">
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4">
                                        <label class="control-label">City <span class="required">*</span></label>
                                        <input class="field form-control" name="city" id="locality" disabled="true" required="true"/>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Country <span class="required">*</span></label>
                                    <input class="field form-control" name="country" id="country" disabled="true" required="true"/>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Post Code <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="postCode" id="postal_code" required="true">
                                </div>
                                
                                
                            </div>
                            <!--<input type="hidden" id="map">-->
                            <div class="map" id="map" style="width: 100%; height: 160px; margin-top: 0px;"></div>
                                                        
                 <!--google map api using to resend data in input tag then this use-->
<table id="address">
<tr>
 <!--<td class="label">Street address</td>-->
 <td class="slimField">
     <input type="hidden" class="field" id="street_number" disabled="true"/></td>
 <td class="wideField" colspan="2">
     <input type="hidden" class="field" id="route" disabled="true"/></td>
</tr>
</table>
                 &nbsp;<br>
                            <div class="form-group">
                                <p style="font-size:10px; text-align:center; color:#000;">By logging in you agree to our <a href="#" target="_blank">Terms & Services</a> and <a href="#" target="_blank">Privacy Policies</a>.</p>
                                <!--<button type="submit" class="btn btn-block btn-lg btn-primary">Sign Up</button>-->
                                <input type="submit" value="Sign Up" name="submit" class="btn btn-block btn-lg btn-primary1">
                            </div>
                        </form>
                    </div>
                    <hr>
                    
                    <div class="login-with-sites text-center">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <a href="<?php echo $this->facebook->login_url(); ?>" style="color: white;" class="btn-facebook btn-size login-icons btn-lg btn-block">
                                    <i class="fa fa-facebook"></i>&emsp;&nbsp; Login With Facebook
                                </a>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <a href="<?php echo $this->googleplus->loginURL(); ?>" style="color: white;" class="btn-google btn-size login-icons btn-lg btn-block">
                                    <i class="fa fa-google"></i>&emsp;&nbsp; Login With Google&emsp;
                                </a>
                            </div>
                        </div>
                    </div>
<!--                    <div class="login-footer">
                        <div class="checkbox checkbox-primary pull-left">
                            <input id="checkbox2" type="checkbox" >
                            <label for="checkbox2">
                                I Agree with Term and Conditions
                            </label>
                        </div>
                    </div>-->
                </div>
                <p class="text-center margin-bottom-none"><a href="<?= site_url('login'); ?>"><strong>Have an account? </strong></a></p>
            </div>
            <div class="col-md-2 col-lg-2">&nbsp;</div>
        </div>
    </div>
</section>
<!-- End Login -->
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>-->
<script src="<?= base_url(); ?>theme/backend/build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#whatsappNo");
    window.intlTelInput(input, {
      autoHideDialCode: false,
        formatOnDisplay: false,
        nationalMode: false,
      onlyCountries: ['au', 'in'],
      utilsScript: "<?= base_url(); ?>theme/backend/build/js/utils.js",
    });
  </script>

<script>
function checkPass()
{
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    var message1 = document.getElementById('error-nwl');
    var message = document.getElementById('error-nw2');
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
 	
    if(pass1.value.length > 7)
    {
//        pass1.style.backgroundColor = goodColor;
        message.style.color = goodColor;
//        message.innerHTML = "character number ok!"
    }
    else
    {
//        pass1.style.backgroundColor = badColor;
        message.style.color = badColor;
        message1.innerHTML = " Password must contain at least 8 characters!"
        return;
    }
  
    if(pass1.value == pass2.value)
    {
//        pass2.style.backgroundColor = goodColor;
//        message.style.color = goodColor;
//        message.innerHTML = "ok !";
        message1.innerHTML = '';
    }
	else
    {
//        pass2.style.backgroundColor = badColor;
//        message.style.color = badColor;
//        message.innerHTML = " These passwords don't match";
        message1.innerHTML = '';
    }
$(document).ready(function(){
   $('#pass2').on('keyup', function(){
       var pass1 = $('#pass1').val();
       var pass2 = $('#pass2').val();
//       alert(pass2);
       if(pass1 == pass2){
           $('#error-nw2').html('Match');
           $('#error-nw2').css('color','green');
       }else{
           $('#error-nw2').html('passwords don\'t match');
           $('#error-nw2').css('color','red');
       }
   }); 
});

}


</script>

   
<script>
/* script */
 var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
      };
function initialize(position) {
       
//    var latitude = position.coords.latitude;
//    var longitude = position.coords.longitude;
    
   var latlng = new google.maps.LatLng(24.580327,73.7221453);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: false,
      anchorPoint: new google.maps.Point(0, -29)
   });
   
    var input = document.getElementById('searchInput');
   // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var geocoder = new google.maps.Geocoder();
    var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        
    var infowindow = new google.maps.InfoWindow();   
        autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
       
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);          
    
        bindDataToForm(place.formatted_address,place.geometry.location.lat(),place.geometry.location.lng());
        infowindow.setContent(place.formatted_address);
        infowindow.open(map, marker);
       
    });
    
    autocomplete.addListener('place_changed', fillInAddress);
    
    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }
      
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    // this function will work on marker move event into map 
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (results[0]) {        
              bindDataToForm(results[0].formatted_address,marker.getPosition().lat(),marker.getPosition().lng());
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
          }
        }
        });
    });
}
function bindDataToForm(address,lat,lng){
   document.getElementById('location').value = address;
   document.getElementById('lat').value = lat;
   document.getElementById('lng').value = lng;
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>