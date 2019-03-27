<link rel="stylesheet" href="<?= base_url(); ?>theme/backend/build/css/intlTelInput.css">
<style type="text/css">
div.fileinput-preview > img {
width: 100px!important;
height: 100px!important;
object-fit: cover;
}
</style>
<div class="content">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    
                    <!--<button type="button" class="btn btn-rose" id="advertiser-add">Add</button>-->
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">&nbsp;<br>
                    <?= AlertMsg(); ?>
                    <label>Admin Side Edit Advertiser</label>
                </div>
                <div class="col-md-12">
                    <?php
                    if($advertiser){
                    ?>
                    <form id="RegisterValidation" action="<?= site_url('advertiser_edit'); ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $advertiser->ID; ?>" name="id">
                        <div class="card ">
                            <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">person_add</i>
                                </div>
                                <h4 class="card-title"> Edit Advertiser <a href="<?= site_url('admin/advertiser/show'); ?>" class="btn btn-rose btn-sm pull-right">Back</a></h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> First Name *</label>
                                            <input type="text" class="form-control" name="first_name" required="true" value="<?= $advertiser->FirstName; ?>" disabled="">
                                            <div style="color:red;"><?= form_error('first_name'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Last Name *</label>
                                            <input type="text" class="form-control" name="last_name" required="true" value="<?= $advertiser->LastName; ?>" disabled="">
                                            <div style="color:red;"><?= form_error('last_name'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Email ID *</label>
                                            <input type="email" class="form-control" name="email" required="true" value="<?= $advertiser->UserName; ?>" disabled="">
                                            <div style="color:red;"><?= form_error('email'); ?></div>
                                        </div>
                                    </div>
                                </div>
<!--                                <div class="row">
                                    <div class="col-md-6 col-xa-12">
                                        <div class="form-group">
                                            <label for="examplePassword" class="bmd-label-floating"> Password *</label>
                                            <input type="password" class="form-control" id="examplePassword" required="true" name="password">
                                            <div style="color:red;"><?= form_error('password'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="examplePassword1" class="bmd-label-floating"> Confirm Password *</label>
                                            <input type="password" class="form-control" id="examplePassword1" required="true" equalTo="#examplePassword" name="password_confirmation">
                                            <div style="color:red;"><?= form_error('password_confirmation'); ?></div>
                                        </div>
                                    </div>
                                </div>-->
                                
                                <div class="row">
                                    <div class="col-md-8 col-xs-12">
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="">Business Address * </label><br>
                                                    <input type="text" name="address" id="searchInput" class="form-control input-controls" value="<?= $advertiser->Address; ?>" required="true">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12" >
                                                <div class="">
                                                <label class="bmd-label-floating"> Country *</label>
                                                <input class="field form-control" name="country" id="country" value="<?= $advertiser->Country; ?>" required="true"/>
                                                
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating"> State *</label>
                                                <input class="field form-control" name="state" id="administrative_area_level_1" value="<?= $advertiser->State; ?>" required="true"/>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating"> City *</label>
                                                <input class="field form-control" name="city" id="locality" value="<?= $advertiser->City; ?>" required="true"/>
                                                
                                            </div>
                                        </div>
                                        &nbsp;<br>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class=""> Post Code *</label>
                                                    <input type="text" class="form-control" name="postCode" id="postal_code" value="<?= $advertiser->PostCode; ?>" required="true">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp;<br>
<!--                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="">Landmark Address </label>
                                                    <input type="text" name="LandmarkAddress" class="form-control" value="<?= $advertiser->LandmarkAddress; ?>">
                                                    <textarea class="form-control" required="" name="businessAddress" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>-->
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <!--For google map div start-->
                                        <!--<input id="searchInput" class="input-controls" type="text" placeholder="Enter a location">-->
                                        <div class="map" id="map" style="width: 100%; height: 360px; margin-top: 40px;"></div>
                                     <div class="form_area">
                                        <input type="hidden" name="location" id="location">
                                        
                                        <?php
                                        $lt[0] = '';
                                        $lt[1] = '';
                                        if(!empty($advertiser->LatLong)){
                                            $lt = explode(',', $advertiser->LatLong);
                                        }
                                        
                                        ?>
                                        <input type="hidden" name="lat" id="lat"  value="<?php echo $lt[0]; ?>">
                                        <input type="hidden" name="lng" id="lng" value="<?php echo $lt[1]; ?>">
                                    </div>

                                        <!--For google map div end-->
                                    </div>
                                </div>
                                
                                <div class="row">
                                    
                                    <div class="col-md-5 col-xs-12">
                                        <div class="">
                                            <label class="bmd-label-floating">Phone No.</label>
                                            <input type="tel" class="form-control" name="phone" required="true" id="phone1" value="<?= $advertiser->Phone; ?>" maxlength="13">
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-xs-12 form-group">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-12" style="margin-top: 10px;">
                                                <label class="bmd-label-floating">Account Type</label>
                                            </div>
                                            <div class="col-md-9 col-xs-12">
                                                <select class="form-control" name="typeAc">
                                                    <option value="0" <?php if($advertiser->AccountType == 0) echo 'selected';?> >Free</option>
                                                    <option value="1" <?php if($advertiser->AccountType == 1) echo 'selected';?> >Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <!--<label class="bmd-label-floating">Profile Image</label>-->
                                        <div class="">
                                            <h4 class="title">Profile Image</h4>
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-circle">
                                                    <?php
                                                    if ($advertiser->Profile != null && strpos($advertiser->Profile, 'http') === false){
                                                        $advertiser->Profile = base_url() . 'uploads/profile/' . $advertiser->Profile;
                                                    }else{
                                                        $advertiser->Profile = base_url().'theme/backend/assets/img/img_avatar.png';
                                                    }
                                                    
                                                    
//                                                    if(!empty($advertiser->Profile)){
//                                                        if($advertiser->RegisterType == 1 || $advertiser->RegisterType == 2){
//                                                            $profile = $advertiser->Profile;
//                                                        }else{
//                                                            $profile = base_url().'uploads/profile/'.$advertiser->Profile;
//                                                        }
//                                                    }else{
//                                                        $profile = base_url().'theme/backend/assets/img/img_avatar.png';
//                                                    }
                                                    ?>
                                                    
                                                    <img src="<?= $advertiser->Profile; ?>" style="height: 100px!important; width: 100px!important; object-fit: cover;" alt="Profile Image">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                                <div>
                                                    <span class="btn btn-round btn-rose btn-file">
                                                        <span class="fileinput-new">Add Photo</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="profile_image" accept="image/x-png,image/gif,image/jpeg"/>
                                                    </span>
                                                    <br />
                                                    <a href="#" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                &nbsp;<br><br>                        
                                <div class="category form-category">* Required fields</div>
                                <div class="category form-category">&nbsp;<br></div>
                            </div>
                            <div class="card-footer text-right">
                                <div class="form-check mr-auto">
<!--                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="" required> Subscribe to newsletter
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>-->
                                </div>
                                <input type="hidden" name="dial-code" id="dial-code" value="<?= $advertiser->CountryCode; ?>">
                                <button type="submit" class="btn btn-rose">Submit</button>
                            </div>
                        </div>
                    </form>
                    <?php
                    }else{
                        echo 'No Data found!!!';
                    }
                    ?>
                </div>
            </div>
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
</div>


  <!--   Core JS Files   -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>theme/backend/assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>theme/backend/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/perfect-scrollbar.jquery.min.js" ></script>
    <!-- Plugin for the momentJs  -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/moment.min.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/sweetalert2.js"></script>
    <!-- Forms Validations Plugin -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery.validate.min.js"></script>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-selectpicker.js" ></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery.dataTables.min.js"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-tagsinput.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery-jvectormap.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/nouislider.min.js" ></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/arrive.min.js"></script>
    
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="http://buttons.github.io/buttons.js"></script>
    <!-- Chartist JS -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/material-dashboard.min40a0.js?v=2.0.2" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?= base_url(); ?>theme/backend/assets/demo/demo.js"></script>

  
    <!--Datatable scripting useing at dashboard-->
    <script>
        $(document).ready(function () {
            $('#advertiser').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                //responsive: true,
                "scrollX": true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }
            });

        });
    </script>
    
    <script src="<?= base_url(); ?>theme/backend/build/js/intlTelInput.js"></script>
  <script>
    var input = document.querySelector("#phone1");
    window.intlTelInput(input, {
        autoHideDialCode: false,
        formatOnDisplay: false,
        nationalMode: false,
      onlyCountries: ['au', 'in'],
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
      // initialCountry: "auto",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
      // separateDialCode: true,
      utilsScript: "<?= base_url(); ?>theme/backend/build/js/utils.js",
    });
  </script>
  
  <script>
      $(document).ready(function(){
          var code = $('#country-listbox li').data('dial-code');
          $('#dial-code').val(code);
        //default code = 1 but select to click ul->li then new code generate and save DB
        $('#country-listbox li').click(function(){
            var code = $(this).data('dial-code');
            //alert(code);
            $('#dial-code').val(code);
        }); 
          
      });
  </script>
  
   <!--Current location set-->
<script>
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
    
   var latlng = new google.maps.LatLng(<?= $advertiser->LatLong; ?>);
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
  
  