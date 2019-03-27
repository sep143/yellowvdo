<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>theme/backend/datatables/dataTables.bootstrap.css">

<style>
/*     table.dataTable thead tr th,
    table.dataTable tbody tr td {
    white-space: nowrap;
}
table.dataTable thead tr th,
table.dataTable tbody tr td {
    word-wrap: break-word;
    word-break: break-all;
    min-width: 120px;
}*/

.dataTables_scroll
{
    overflow:auto;
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person_add</i>
                            </div>
                            <h4 class="card-title"> View Advertiser <a href="<?= site_url('admin/advertiser/edit/'.$advertiser->ID); ?>" class="btn btn-warning btn-sm pull-right">Edit</a><a href="<?= site_url('admin/advertiser/show'); ?>" class="btn btn-rose btn-sm pull-right">Back</a></h4>
                        </div><hr>
                        <div class="card-body">
                            <div class="col-md-12">
                                <?php
                                if ($advertiser) {
                                    ?>
                                    <table id="" class="table table-hover table-bordered table-striped">
                                        <tr>
                                            <td style="width: 220px;">User ID</td><td style="width: 20px;">:</td>
                                            <td><?= $advertiser->UserName ?></td>
                                            <td rowspan="4" style="width: 20px;" class="text-center">
                                                <?php
                                                if ($advertiser->Profile != null && strpos($advertiser->Profile, 'http') === false){
                                                        $advertiser->Profile = base_url() . 'uploads/profile/' . $advertiser->Profile;
                                                    }else{
                                                        $advertiser->Profile = base_url().'theme/web/images/img_avatar.png';
                                                    }
                                                ?>
                                                <img src="<?= $advertiser->Profile; ?>" style="width: 180px; height: auto; border: 1px solid lightgray;">
                                               <p>Join Date<br>
                                                <b><?= date('h:i A, d-M-Y', strtotime($advertiser->CreatedDT)); ?></b></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 220px;">First Name</td><td style="width: 20px;">:</td>
                                            <td><?= $advertiser->FirstName ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 220px;">Last Name</td><td style="width: 20px;">:</td>
                                            <td><?= $advertiser->LastName ?></td>
                                            <!--Colspan 3 end-->
                                        </tr>
                                        <tr>
                                            <td style="width: 220px;">Phone No.</td><td style="width: 20px;">:</td>
                                            <td colspan=""><?= $advertiser->Phone ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <td style="width: 220px;">Address</td><td style="width: 20px;">:</td>
                                            <td colspan="4"><?php if(!empty($advertiser->Address)) echo $advertiser->Address ?> 
                                                <?php echo ', City :'.$advertiser->City; ?>
                                                <?php echo ', State :'.$advertiser->State; ?>
                                                <?php echo ', Country :'.$advertiser->Country;?>
                                                <?php echo ', Pin Code : '.$advertiser->PostCode; ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 220px;">Account Register </td><td style="width: 20px;">:</td>
                                            <td colspan="4">
                                                <?php
                                                if($advertiser->RegisterType == 1){
                                                    echo 'Facebook';
                                                }else if($advertiser->RegisterType == 2){
                                                    echo 'Google';
                                                }else{
                                                    echo 'Normal Register';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-rose btn-sm" id="ads" data-id='<?= $advertiser->ID; ?>'>Ads</button>
                                        <button class="btn btn-rose btn-sm" id="dua_pay" data-id='<?= $advertiser->ID; ?>'>Pending Payments</button>
                                        <button class="btn btn-rose btn-sm" id="transitions" data-id='<?= $advertiser->ID; ?>'>Transaction</button>
                                    </div>
                                </div>
                                <!--this advertiser of all advertisement-->
                                <div id="dataView">
                                    
                                </div>
                                    <?php
                                } else {
                                    echo 'No Data found!!!';
                                }
                                ?>
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
    
    <!--ads and transitions click then get data advertiser type to get-->
<script>
$(document).ready(function(){
    $('#ads').click(function(){
        var id = $(this).data('id');
        var type = 'ads';
        //alert(id);
        $('#dataView').empty();
        $.ajax({
            url:'<?= site_url('admin/RegisterController/getByid_advertisement'); ?>',
            type:'post',
            data:{id:id, type:type},
            success:function(data){
                $('#dataView').html(data);
                $('#ads').addClass('btn-success');
                $('#ads').removeClass('btn-rose');
                $('#dua_pay').addClass('btn-rose');
                $('#dua_pay').removeClass('btn-success');
                $('#transitions').addClass('btn-rose');
                $('#transitions').removeClass('btn-success');
            }
        });
    });
    $('#dua_pay').click(function(){
        var id = $(this).data('id');
        var type = 'dua_pay';
        //alert(id);
        $('#dataView').empty();
        $.ajax({
            url:'<?= site_url('admin/RegisterController/getByid_advertisement'); ?>',
            type:'post',
            data:{id:id, type:type},
            success:function(data){
                $('#dataView').html(data);
                $('#ads').addClass('btn-rose');
                $('#ads').removeClass('btn-success');
                $('#dua_pay').removeClass('btn-rose');
                $('#dua_pay').addClass('btn-success');
                $('#transitions').addClass('btn-rose');
                $('#transitions').removeClass('btn-success');
            }
        });
    });
    //all trasitions 
    $('#transitions').click(function(){
        var id = $(this).data('id');
        var type = 'transitions';
        $('#dataView').empty();
        $.ajax({
            url:'<?= site_url('admin/RegisterController/getByid_advertisement'); ?>',
            type:'post',
            data:{id:id, type:type},
            success:function(data){
                $('#dataView').html(data);
                $('#ads').addClass('btn-rose');
                $('#ads').removeClass('btn-success');
                $('#dua_pay').addClass('btn-rose');
                $('#dua_pay').removeClass('btn-success');
                $('#transitions').addClass('btn-success');
                $('#transitions').removeClass('btn-rose');
            }
        });
    });
    
});
</script>
    
    
  
  