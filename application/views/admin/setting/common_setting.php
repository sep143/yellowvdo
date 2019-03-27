<div class="content">
    <div class="content">
        <div class="container-fluid">
             <?= AlertMsg(); ?>           
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Change Password</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/SettingController/change_password'); ?>" method="post">
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label class="bmd-label-floating">Old Password</label>
                                        <input type="password" class="form-control" name="old_password" >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label class="bmd-label-floating">New Password</label>
                                        <input type="password" class="form-control" id="pass1" name="password" onkeyup="checkPass(); return false;">
                                        <!--<div style="color:red;"><?= form_error('password'); ?></div>-->
                                            <div id="error-nwl"></div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label class="bmd-label-floating">Confirm New Password</label>
                                        <input type="password" class="form-control" id="pass2" name="cpassword" >
                                        <!--<div style="color:red;"><?= form_error('cpassword'); ?></div>-->
                                            <div id="error-nw2"></div>
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
                <div class="col-md-6 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Image Limit Set </h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/SettingController/set_image_limit'); ?>" method="post">
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label class="">Set Number of max image limit</label>
                                        <!--<input type="text" class="form-control" name="old_password" >-->
                                        <select class="form-control" name="image_limit" style="margin-top: 20px;">
                                            <option value="1" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 1)? 'selected' : ''; } ?> >1 Image</option>
                                            <option value="2" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 2)? 'selected' : ''; } ?>>2 Image</option>
                                            <option value="3" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 3)? 'selected' : ''; } ?> >3 Image</option>
                                            <option value="4" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 4)? 'selected' : ''; } ?> >4 Image</option>
                                            <option value="5" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 5)? 'selected' : ''; } ?> >5 Image</option>
                                            <option value="6" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 6)? 'selected' : ''; } ?> >6 Image</option>
                                            <option value="7" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 7)? 'selected' : ''; } ?> >7 Image</option>
                                            <option value="8" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 8)? 'selected' : ''; } ?> >8 Image</option>
                                            <option value="9" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 9)? 'selected' : ''; } ?> >9 Image</option>
                                            <option value="10" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 10)? 'selected' : ''; } ?> >10 Image</option>
                                            <option value="11" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 11)? 'selected' : ''; } ?> >11 Image</option>
                                            <option value="12" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 12)? 'selected' : ''; } ?> >12 Image</option>
                                            <option value="13" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 13)? 'selected' : ''; } ?> >13 Image</option>
                                            <option value="14" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 14)? 'selected' : ''; } ?> >14 Image</option>
                                            <option value="15" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 15)? 'selected' : ''; } ?> >15 Image</option>
                                            <option value="16" <?php if(!empty($image_limit->Config)) { echo ($image_limit->Config == 16)? 'selected' : ''; } ?> >16 Image</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row form-group" style="margin-top: 115px;">
                                    <div class="col-md-12 col-xs-12">
                                        <!--<label>Confirm New Password</label>-->
                                        <input type="submit" class="btn btn-rose pull-right" name="submit" >
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Change ads payment</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/SettingController/change_payment'); ?>" method="post">
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label class="bmd-label-floating">Per ad payment</label>
                                        <input type="text" class="form-control calculate" name="amt" id="amt" value="<?= $payment->Amt; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label class="bmd-label-floating">Tax % </label>
                                        <input type="text" class="form-control calculate" name="tax" id="tax" value="<?= $payment->Tax; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <label class="bmd-label-floating">Grant total</label>
                                        <input type="text" class="form-control" name="total" id="total" value="<?= $payment->Total; ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-12 col-xs-12">
                                        <input type="submit" class="btn btn-rose pull-right" name="submit" >
                                    </div>
                                </div>
                            </form>
                            
                            <script>
                            $(document).ready(function(){
                                $('.calculate').on('keyup', function(){
                                    var amt = $('#amt').val();
                                    var tax = $('#tax').val();
                                    var total = ((amt * tax) / 100);
//                                    var gtotal = amt + total;
//                                    $('#total').val(gtotal);
                                    $.ajax({
                                        url:'<?= site_url('admin/SettingController/calculation'); ?>',
                                        type:'post',
                                        data:{amt:amt,tax:tax},
                                        success:function(data){
                                            $('#total').val(data);
//                                            console.log(data);
                                        }
                                    });
                                    
                                });
                            });
                            </script>
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