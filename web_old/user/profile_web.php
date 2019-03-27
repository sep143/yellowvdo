<link rel="stylesheet" href="<?= base_url(); ?>theme/backend/build/css/intlTelInput.css">

<div class="col-sm-9">
    <?= AlertMsg(); ?>
    <div class="widget my-profile margin-bottom-none">
        <div class="widget-header">
            <h1>Edit Profile</h1>
        </div>
        <div class="widget-body">
            <form id="profile_submit" action="<?= site_url('update_profile'); ?>" method="post" enctype="multipart/form-data">
                <div class="row">
<!--                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <label class="control-label">Username <span class="required">*</span></label>
                                    <input class="form-control border-form" type="text" value="John Doe" placeholder="John Doe" disabled="">
                                 </div>
                              </div>-->
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Email Address <span class="required">*</span></label>
                            <input class="form-control border-form" type="email" value="<?= $user_data->UserName; ?>" placeholder="example@gmail.com" disabled="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">First Name <span class="required">*</span></label>
                            <input class="form-control border-form" type="text" name="first_name" value="<?= $user_data->FirstName; ?>" placeholder="Enter First Name">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Last Name <span class="required">*</span></label>
                            <input class="form-control border-form" type="text" name="last_name" value="<?= $user_data->LastName; ?>" placeholder="Enter Last Name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Phone Number <span class="required">*</span></label>
                    <div class="input-group">
                        <!--<span class="input-group-addon">+<?= $user_data->CountryCode; ?></span>-->
                        <input type="text" class="form-control border-form" name="phone" id="phone" value="<?= $user_data->Phone; ?>" maxlength="13" required="required" placeholder="e.g. +911234567890">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="control-label">Address <span class="required">*</span></label>
                            <input class="form-control border-form input-controls" id="searchInput" type="text" name="address" value="<?= $user_data->Address; ?>" placeholder="Enter Address">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Country <span class="required">*</span></label>
                            <input class="form-control border-form" type="text" id="country" placeholder="Country Name" name="country" value="<?= $user_data->Country; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">State <span class="required">*</span></label>
                            <input class="form-control border-form" type="text" id="administrative_area_level_1" placeholder="State Name" name="state" value="<?= $user_data->State; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">City <span class="required">*</span></label>
                            <input class="form-control border-form" type="text" id="locality" placeholder="City Name" name="city" value="<?= $user_data->City; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Post Code <span class="required">*</span></label>
                            <input class="form-control border-form" type="text" id="postal_code" placeholder="Enter Post Code" name="postCode" value="<?= $user_data->PostCode; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Landmark Address <span class="required"></span></label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="LandmarkAddress" value="<?= $user_data->LandmarkAddress; ?>" placeholder="How do you want coustomer to rich you.">
                                <!--<input type="text" name="LandmarkAddress" class="form-control" placeholder="How do you want coustomer to rich you." >-->
                                <div class="input-group-addon" data-toggle="tooltip" data-placement="left" title="1st floor in abc building take first right. opp xyz office.">
                                    <i class="fa fa-info-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <!--For google map div start-->
                        <!--<input id="searchInput" class="input-controls" type="text" placeholder="Enter a location">-->
                        <div class="map" id="map" style="width: 100%; height: 460px; margin-top: 40px;"></div>
                        <div class="form_area">
                            <?php
                            $lt[0] = '';
                            $lt[1] = '';
                            if(!empty($user_data->LatLong)){
                                $lt = explode(',', $user_data->LatLong);
                            }

                            ?>
                            <input type="hidden" name="location" id="location">
                            <input type="hidden" name="lat" id="lat" value="<?php echo $lt[0]; ?>">
                            <input type="hidden" name="lng" id="lng" value="<?php echo $lt[1]; ?>">
                        </div>
                        <!--For google map div end-->
                                          
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
                    </div>
                </div>
                
                <?php
                if($user_data->Profile != null){
                    if (strpos($user_data->Profile, 'http') === false){
                        $user_data->Profile = base_url() . 'uploads/profile/' . $user_data->Profile;
                    }
                }else{
                    $user_data->Profile = base_url().'theme/web/images/img_avatar.png';
                }
                
                
//                else{
//                    $user_data->Profile = base_url().'theme/web/images/img_avatar.png';
//                }
//                if($user_data->RegisterType == 3){
//                    if(!empty($user_data->Profile)){
//                        $profile_img = base_url().'uploads/profile/'.$user_data->Profile;
//                    }else{
//                        $profile_img = base_url().'theme/web/images/img_avatar.png';
//                    }
//
//
//                }else if($user_data->RegisterType == 1 || $user_data->RegisterType == 2){
//                    $profile_img = $user_data->Profile;
//                }

                ?>
                
                <div class="form-group">
                    <label class="control-label">Profile Image</label>
                    <input type="file" class="filestyle" name="profile_image" onchange="loadFile(event)" accept="image/x-png,image/gif,image/jpeg">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <img src="<?= $user_data->Profile; ?>" id="output" width="100px" class="img img-circle shadow-sm"/>
                </div>
                
                <script>
                    var loadFile = function(event) {
                      var output = document.getElementById('output');
                      output.src = URL.createObjectURL(event.target.files[0]);
                    };
                  </script>
                
<!--                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Password <span class="required">*</span></label>
                            <input class="form-control border-form" type="password" value="" placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Confirm Password <span class="required">*</span></label>
                            <input class="form-control border-form" type="password" value="" placeholder="Enter Password">
                        </div>
                    </div>
                </div>-->
                <div class="form-group margin-bottom-none">
                    <div class="text-right">
                        <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Save Update </button>
                        <!--<button class="btn btn-danger" type="submit"><i class="fa fa-close"></i> Cancel</button>-->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
</div>
</section>

<!-- End Settings -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script src="<?= base_url(); ?>theme/backend/build/js/intlTelInput.js"></script>
  <script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      autoHideDialCode: false,
        formatOnDisplay: false,
        nationalMode: false,
      onlyCountries: ['au', 'in'],
      utilsScript: "<?= base_url(); ?>theme/backend/build/js/utils.js",
    });
  </script>

    
<!--<script src="<?php echo base_url();?>theme/js/jquery.mask.js"></script>-->
  <!--Current location set-->
<script>
//    $("#phone").mask("9999999999");
$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(initialize);
    }else{ 
        $('#location').html('Geolocation is not supported by this browser.');
    }
});
</script>
    
    <!--for google map script-->
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
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    
    <?php
    if(!empty($user_data->LatLong)){
        echo 'var latlng = new google.maps.LatLng('.$user_data->LatLong.');';
    }else{
        echo 'var latlng = new google.maps.LatLng(latitude,longitude);';
    }
    ?>
        
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