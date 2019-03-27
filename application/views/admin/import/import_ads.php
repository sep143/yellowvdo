<div class="content">
    <div class="content">
        <div class="container-fluid">
             <?= AlertMsg(); ?>           
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Import Ads
                                <a class="pull-right btn btn-info btn-xs" style="margin: 2px" href="<?php echo base_url();?>uploads/import/formate/upload2.xlsx"><i class="fa fa-file-excel-o"></i> Download Format</a>  
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('admin/import/save'); ?>" method="post" enctype="multipart/form-data">
                                <input type="file" name="userfile" accept=".xlsx, .xls">
                                <input type="hidden" name="importfile" value="1">
                                <input type="submit" value="Submit" class="btn btn-rose">
                            </form>
                            <?php
//$output = '';
//$output .= form_open_multipart('import/save');
//$output .= '<div class="row">';
//$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group">';
//$output .= form_label('Choose file', 'image');
//$data = array(
//    'name' => 'userfile',
//    'id' => 'userfile',
//    'class' => 'form-control filestyle',
//    'value' => '',
//    'data-icon' => 'false'
//);
//$output .= form_upload($data);
//$output .= '</div> <span style="color:red;">*Please choose an Excel file(.xls or .xlxs) as Input</span></div>';
//$output .= '<div class="col-lg-12 col-sm-12"><div class="form-group text-right">';
//$data = array(
//    'name' => 'importfile',
//    'id' => 'importfile-id',
//    'class' => 'btn btn-primary',
//    'value' => 'Import',
//);
//$output .= form_submit($data, 'Import Data');
//$output .= '</div>
//                        </div></div>';
//$output .= form_close();
//echo $output;
//?>
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