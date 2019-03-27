<link rel="stylesheet" href="<?= base_url(); ?>theme/backend/build/css/intlTelInput.css">
<div class="content">
    <div class="content">
        <div class="container-fluid">
             <?= AlertMsg(); ?>           
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Edit User <a href="<?= site_url('admin/setting/user_role'); ?>" class="btn btn-sm btn-rose pull-right"><i class="material-icons">fast_rewind</i>Back</a></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/setting/update_role_user/'.$user_role->ID); ?>" method="post">
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label></label>
                                        <select class="form-control" name="role">
                                            <option value="3" <?php echo ($user_role->Role == 3)?'selected':''; ?> >Admin</option>
<!--                                            <option value="4" <?php echo ($user_role->Role == 4)?'selected':''; ?>>Accounted</option>
                                            <option value="5" <?php echo ($user_role->Role == 5)?'selected':''; ?> >Other</option>-->
                                        </select>
                                    </div>
                                </div>&nbsp;<br>
                                <div class="row">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="row form-group">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating">First Name</label>
                                                <input type="text" class="form-control" name="fname" value="<?= set_value('fname', $user_role->FirstName); ?>">
                                                <div style="color:red;"><?= form_error('fname'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="row form-group">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating">Last Name</label>
                                                <input type="text" class="form-control" name="lname" value="<?= set_value('lname', $user_role->LastName); ?>">
                                                <div style="color:red;"><?= form_error('lname'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="row form-group">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating">Email ID</label>
                                                <input type="email" class="form-control" name="email" value="<?= $user_role->UserName; ?>" disabled="">
                                                <div style="color:red;"><?= form_error('email'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="row form-group">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating">Phone</label>
                                                <!--<input type="text" class="form-control" name="phone" >-->
                                                <input type="text" class="form-control" name="phone" required="true" id="phone" maxlength="13" value="<?= set_value('phone', $user_role->Phone); ?>">
                                                <div style="color:red;"><?= form_error('phone'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="row form-group">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating">New Password</label>
                                                <input type="password" class="form-control" id="pass1" name="password" onkeyup="checkPass(); return false;">
                                                <div style="color:red;"><?= form_error('password'); ?></div>
                                                <div id="error-nwl"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="row form-group">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating">Confirm New Password</label>
                                                <input type="password" class="form-control" id="pass2" name="cpassword" >
                                                <div style="color:red;"><?= form_error('cpassword'); ?></div>
                                                <div id="error-nw2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <input type="submit" class="btn btn-rose pull-right" name="submit" >
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
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
    <!--<script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery-jvectormap.js"></script>-->
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

<script src="<?= base_url(); ?>theme/backend/build/js/intlTelInput.js"></script>
  <script>
    var input = document.querySelector("#phone");
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