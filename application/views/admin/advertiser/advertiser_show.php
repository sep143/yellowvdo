<link rel="stylesheet" href="<?= base_url(); ?>theme/backend/build/css/intlTelInput.css">
<!--<link rel="stylesheet" href="<?= base_url(); ?>theme/backend/build/css/demo.css">-->

 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>theme/backend/datatables/dataTables.bootstrap.css">
<!--<link rel="stylesheet" href="<?= base_url() ?>theme/backend/datatables/dataTables.bootstrap.css">-->

<link rel="stylesheet" href="<?= base_url() ?>theme/backend/assets/css/navbar.css">

<!--Image crop option--> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.0/cropper.min.css">
<link rel="stylesheet" href="https://demo.hazzardweb.com/filepicker2/assets/css/filepicker.css">

<style>
/*    table.dataTable thead tr th,
    table.dataTable tbody tr td {
    white-space: nowrap;
}
table.dataTable thead tr th,
table.dataTable tbody tr td {
    word-wrap: break-word;
    word-break: break-all;
    min-width: 100px;
}*/

.dataTables_scroll
{
    overflow:auto;
}
/*.btn.btn-just-icon{
    min-width: 24px;
    width: 24px;
}*/
@media (min-width: 1200px) {
	.dateRangeDiv {
		min-width: 200%;
	}
}
@media (min-width: 992px) {
	.dateRangeDiv {
		min-width: 200%;
	}
}
@media (min-width: 591px) {
	.dateRangeDiv {
		min-width: 220%;
	}
}

.crop-btn { width: 93px; } .delete-btn { width: 99px; }
</style>


<!--Filter script-->
<script>
$(document).ready(function(){
        var id_search;
        var dateFrom;
        var dateTo;
        var location;
        var status;
    
    $('#id_search').on('keyup', function(event){
        event.preventDefault();
        id_search = $(this).val();
        filter_get();
    });
    
    //from date select
    $('#dateFrom').on('keyup', function(event){
        event.preventDefault();
        dateFrom = $(this).val();
       
    });
    
    //to date select
    $('#dateTo').on('keyup', function(event){
        event.preventDefault();
        dateTo = $(this).val();
       
    });
    //set date
    $('#set_date').on('click', function(event){
        event.preventDefault();
        dateFrom = $('#dateFrom').val();
        dateTo = $('#dateTo').val();
        filter_get();
    });
    //location enter
    $('#location').on('keyup', function(event){
        event.preventDefault();
        location = $(this).val();
        filter_get();
    });
    //status
   
   $('#status_1').on('click', function(){
        status = 1;
        filter_get();
   });
   $('#status_2').on('click', function(){
        status = 2;
        filter_get();  
   });
   $('#status_0').on('click', function(){
        status = 0;
        filter_get();  
   });
    
    function filter_get(){
         $.ajax({
            url:'<?= site_url('filter'); ?>',
            type:'post',
            data:{use:'user',id:id_search,from:dateFrom,to:dateTo,location:location,status:status},
            success:function(data){
                $('#filter_data').empty();
                $('#filter_data').html(data);                
            }
        });
    }
    
    //remove filter
    $('#remove_filter').click(function(){
        window.location.reload();
    });
    
});

</script>
<div class="content">
    <div class="">
        <div class="container-fluid">

            <!--Top to click button-->
            <div class="row">
                <div class="col-md-10">
                    <button type="button" class="btn btn-success" id="advertiser-list">Advertiser List</button>
                    <button type="button" class="btn btn-rose" id="advertiser-add">Add</button>
                </div>
            </div>
            <?= AlertMsg(); ?>
            
            <!--Advertiser list in table view-->
            <div class="row">
                <div class="col-md-12" id="advertiser-list-table">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">list_alt</i>
                            </div>
                            <h4 class="card-title">Advertiser List</h4>
                        </div>
                        <div class="card-body">

                            <div class="toolbar">
                                <!--Here you can write extra buttons/actions for the toolbar--> 
                                
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <!--Filter div start-->
                                            <ul class="nav navbar-default ">
                                                <li style="border-right: 2px solid lightgray;">
                                                    <div class="dropdown">
                                                        <a style="color: black;" class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="notification"><b>Filter</b></span>
                                                        </a>
                                                    </div>
                                                </li>
                                                <li class="" >
                                                    <div class="dropdown">
                                                        <a style="color: black;" id="id_search_color" class="nav-link" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="notification">ID &nbsp;<i class="fa fa-caret-down"></i></span>
                                                        </a>
                                                        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink1">
                                                            <div class="input-group input-group-sm" style="padding-left: 10px; padding-right: 10px;">
                                                                <input type="text" class="form-control" id="id_search" placeholder="ID">&nbsp;&nbsp;
                                                                <div class="input-group-prepend" >
                                                                    <span class="input-group-text" style="cursor: pointer; color: skyblue;"><i class="fa fa-close"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="">
                                                    <div class="dropdown">
                                                        <a style="color: black;" class="nav-link" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="notification">Date Range &nbsp;<i class="fa fa-caret-down"></i></span>
                                                        </a>
                                                        <div class="dropdown-menu col-lg-12 col-md-12 col-xs-12 dateRangeDiv" aria-labelledby="navbarDropdownMenuLink2">
                                                            <div class="input-group input-group-sm" style="padding-left: 10px; padding-right: 10px;">
                                                                <small style="margin-top: 5px;">From</small> &nbsp;&nbsp; 
                                                                    <input type="text" id="dateFrom" class="form-control datepicker" value="<?= date('m/d/Y'); ?>">&nbsp;&nbsp;
                                                                <small style="margin-top: 5px;">To</small>&nbsp;&nbsp;
                                                                    <input type="text" id="dateTo" class="form-control datepicker" value="<?= date('m/d/Y'); ?>">&nbsp;&nbsp;
                                                                <div class="input-group-prepend" >
                                                                    <span class="input-group-text" id="set_date" style="cursor: pointer; color: skyblue;"><i class="fa fa-arrow-right"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="">
                                                    <div class="dropdown">
                                                        <a style="color: black;" class="nav-link" href="#" id="navbarDropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="notification">Location &nbsp;<i class="fa fa-caret-down"></i></span>
                                                        </a>
                                                        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink3" style="width: 200%;">
                                                            <div class="input-group input-group-sm" style="padding-left: 10px; padding-right: 10px;">
                                                                <input type="text" class="form-control" id="location" placeholder="Enter Location">&nbsp;&nbsp;
                                                                <div class="input-group-prepend" >
                                                                    <span class="input-group-text" style="cursor: pointer; color: skyblue;"><i class="fa fa-close"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="">
                                                    <div class="dropdown">
                                                        <a style="color: black;" class="nav-link" href="#" id="navbarDropdownMenuLink4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="notification">Status &nbsp;<i class="fa fa-caret-down"></i></span>
                                                        </a>
                                                        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink4" >
                                                                <a href="#" class="dropdown-item" id="status_0">Clear</a>
                                                                <a href="#" class="dropdown-item" id="status_1">Active</a>
                                                                <a href="#" class="dropdown-item" id="status_2">Inactive</a>
<!--                                                                <ul class="list-group">
                                                                    <li class="list-group-item">Active</li>
                                                                    <li class="list-group-item">Inactive</li>
                                                                </ul>-->
                                                            
                                                        </div>
                                                    </div>
                                                </li>
                                                <li style="border-left: 2px solid lightgray;">
                                                    <div class="dropdown" id="remove_filter">
                                                        <a style="color: black;" class="nav-link" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="notification"><b>Remove Filter</b></span>
                                                        </a>
                                                    </div>
                                                </li>
<!--                                                <li style="border-left: 2px solid lightgray;">
                                                    <div class="dropdown" id="downloadXls">
                                                        <a style="color: black; cursor: pointer;" class="nav-link" >
                                                            <span class="notification"><b>Download</b></span>
                                                        </a>
                                                    </div>
                                                </li>-->
                                            </ul>
                                            <!--Filter div end-->
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="material-datatables" id="filter_data">
                                
                                <table id="advertiser" class="table table-striped table-no-bordered table-hover dt-responsive" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Email </th>
                                            <th>Country</th>
                                            <th>A/C Type</th>
                                            <th>Status</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        if($advertiser_list){
                                            foreach ($advertiser_list as $count=> $value):
                                                ?>
                                        <tr>
                                            <td><?= $count+1; ?></td>
                                            <td><?= date('d-M-Y', strtotime($value->CreatedDT)); ?></td>
                                            <td> <?php echo $value->FirstName.' '.$value->LastName; ?></td>
                                            <td><?= $value->UserName; ?></td>
                                            <td><?= $value->Country; ?></td>
                                            <td><?php 
                                                if($value->AccountType == 1){
                                                    echo 'Paybal';
                                                }else if($value->AccountType == 0){
                                                    echo 'Free';
                                                }
                                             ?></td>
                                            <td><button class="btn btn-sm <?php if($value->StatusID == 0)
                                                {
                                                        echo 'btn-danger';
                                                }else if($value->StatusID == 1){
                                                    echo 'btn-success';
                                                }
                                                ?>" data-id="<?= $value->ID; ?>" data-status="<?= $value->StatusID; ?>" onclick="change_status(this)" type="button"><?php if($value->StatusID == 0){ echo 'Inactive'; } else if($value->StatusID == 1){ echo 'Active';}?></button>
                                            </td>
                                            <td class="text-right">
                                                <a href="<?= site_url('admin/advertiser/edit/'.$value->ID); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                                                <a href="<?= site_url('admin/advertiser/view/'.$value->ID); ?>" class="btn btn-link btn-info btn-just-icon "><i class="material-icons">visibility</i></a>
                                                <a href="#" class="btn btn-link btn-danger btn-just-icon" data-id='<?= $value->ID; ?>' data-status="3" onclick="change_status(this)"><i class="material-icons">delete</i></a>
                                            </td>
                                        </tr>
                                        <?php
                                            endforeach;
                                        }
                                        ?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-6 -->
            </div>
            
            <!--New advertiser add then oprn form start-->
            <div class="row" style="display: none;" id="advertiser-add-form">
                <div class="col-md-12">&nbsp;<br>
                    <label>Admin Side New Create Advertiser</label>
                </div>
                <div class="col-md-12">
                    <form id="RegisterValidation" action="<?= site_url('advertiser_add'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="card ">
                            <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">person_add</i>
                                </div>
                                <h4 class="card-title"> Add Advertiser </h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> First Name *</label>
                                            <input type="text" class="form-control" name="first_name" required="true">
                                            <div style="color:red;"><?= form_error('first_name'); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Last Name *</label>
                                            <input type="text" class="form-control" name="last_name" required="true">
                                            <div style="color:red;"><?= form_error('last_name'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Email ID *</label>
                                            <input type="email" class="form-control" name="email" required="true">
                                            <div style="color:red;"><?= form_error('email'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-xa-12">
                                        <div class="form-group">
                                            <label for="examplePassword" class="bmd-label-floating"> Password *</label>
                                            <input type="password" class="form-control" required="true" id="pass1" onkeyup="checkPass(); return false;" name="password">
                                            <div style="color:red;"><?= form_error('password'); ?></div>
                                            <div id="error-nwl">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="examplePassword1" class="bmd-label-floating"> Confirm Password *</label>
                                            <input type="password" class="form-control" required="true" id="pass2" name="password_confirmation">
                                            <div style="color:red;"><?= form_error('password_confirmation'); ?></div>
                                            <div id="error-nw2">&nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-8 col-xs-12">
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class=""> Address * </label><br>
                                                    <input type="text" name="address" id="searchInput" class="form-control input-controls" required="true">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12" >
                                                <div class="">
                                                <label class="bmd-label-floating"> Country *</label>
                                                <input class="field form-control" name="country" id="country" disabled="true" required="true"/>
                                                
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating"> State *</label>
                                                <input class="field form-control" name="state" id="administrative_area_level_1" disabled="true" required="true"/>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating"> City *</label>
                                                <input class="field form-control" name="city" id="locality" disabled="true" required="true"/>
                                                
                                            </div>
                                        </div>
                                        &nbsp;<br>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class=""> Post Code *</label>
                                                    <input type="text" class="form-control" name="postCode" id="postal_code" required="true">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp;<br>
<!--                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="">Landmark Address </label>
                                                    <input type="text" name="LandmarkAddress" class="form-control" >
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
                                        <input type="hidden" name="lat" id="lat">
                                        <input type="hidden" name="lng" id="lng">
                                    </div>

                                        <!--For google map div end-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-xs-12">
                                        <label class="bmd-label-floating">Phone No.</label>
                                        <input type="text" class="form-control" name="phone" required="true" id="phone" maxlength="13">
                                    </div>
                                    <div class="col-md-7 col-xs-12 form-group">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-12" style="margin-top: 10px;">
                                                <label class="bmd-label-floating">Account Type</label>
                                            </div>
                                            <div class="col-md-9 col-xs-12">
                                                <select class="form-control" name="typeAc">
                                                    <option value="0">Free</option>
                                                    <option value="1">Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                </div>
                                
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <!--<label class="bmd-label-floating">Profile Image</label>-->
                                        <div class="col-md-12">
                                            <h4 class="title">Profile Image</h4>
                                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail img-circle">
                                                    <!--<img src="<?= base_url(); ?>theme/backend/assets/img/placeholder.jpg" alt="Profile Image">-->
                                                    <img src="<?= base_url(); ?>theme/backend/assets/img/img_avatar.png" alt="Profile Image">
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
                                </div><hr>
                                    <div class="category form-category col-md-12">* Required fields</div>
                                
                                </div>
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
                                <input type="hidden" name="dial-code" id="dial-code">
                                <button type="submit" class="btn btn-rose">Submit</button>
                            </div>
                        </div>
                    </form>
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
            <!--New advertiser add then oprn form End-->
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
    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>  
<!--password match and cherector--> 
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

    
    <!--Category Table in Active and deactive ajax-->
<script>
function change_status(current){
        var id = $(current).data('id');
        var status = $(current).data('status');
        //alert(status);
        if(status == 1){
            $.ajax({
                url:'<?= site_url('advertiser_change_status'); ?>',
                type:'post',
                data:{id:id, value: '0'},
                success:function(data){
                   // alert(data);
                    $(current).removeClass('btn-success');
                    $(current).addClass('btn-danger');
                    $(current).text('Inactive');
                    $(current).data('status',0);
                   var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                              notify.update({'type': 'danger', 'message': '<strong>Success</strong> Advertiser Inactive'});
                                //window.location.reload();
                        }, 1000);
                }
            });
        }else if(status == 0){
            $.ajax({
                url:'<?= site_url('advertiser_change_status'); ?>',
                type:'POST',
                data:{id:id, value: '1'},
                success:function(data){
                   // alert('data');
                    $(current).removeClass('btn-danger');
                    $(current).addClass('btn-success');
                    $(current).text('Active');
                    $(current).data('status',1);
                   var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                              notify.update({'type': 'success', 'message': '<strong>Success</strong> Advertiser Active'});
                                //window.location.reload();
                        }, 1000);
                }
            });
        //delete
        }else if(status == 3){
        <?php
        if($this->session->userdata('log_role') == 1){
        ?>
                  // alert('delete');     
            $.confirm({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'Delete Advertiser',
                content: 'This Advertiser and all associated data will be deleted. This is not reversible.',
                theme: 'modern',
                buttons: {
                    confirm: function () {
                       
                       $.ajax({
                            url:'<?= site_url('advertiser_change_status'); ?>',
                            type:'POST',
                            data:{id:id, value: '3'},
                            success:function(data){
                               // alert('delete');
                                $.confirm({
                                   //animation: 'zoom',
                                    icon:'fa fa-check-circle',
                                    title: 'Advertiser Deleted',
                                    content: 'The selected Advertiser and associated data was deleted.',
                                    theme: 'modern',
                                    buttons:{
                                        Ok: function(){
                                            window.location.reload();
                                        }
                                    }
                               });
                            }
                        });
                       
                    },
                    cancel: function () {
                        //$.alert('Canceled!');
                    },
                    
                }
            });
         <?php
        }else{
            ?>
              $.alert({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'No authorise',
                content: 'This Advertiser and all associated data will be deleted. This is not reversible.',
                theme: 'modern',
                
            });          
        <?php
        }
         ?>
        }
    }
</script>
    
    <!--Click button then open required-->
    <script>
        $(document).ready(function () {
            $('#advertiser-list').click(function () {
                $('#advertiser-list-table').show('slow');
                $('#advertiser-add-form').hide('slow');

                $(this).removeClass('btn-rose');
                $(this).addClass('btn-success');
                $('#advertiser-add').removeClass('btn-success');
                $('#advertiser-add').addClass('btn-rose');
                $('.navbar-brand').text('List');
            });

            $('#advertiser-add').click(function () {
                $('#advertiser-list-table').hide('slow');
                $('#advertiser-add-form').show('slow');

                $(this).removeClass('btn-rose');
                $(this).addClass('btn-success');
                $('#advertiser-list').removeClass('btn-success');
                $('#advertiser-list').addClass('btn-rose');
                $('.navbar-brand').text('Create New Advertiser');
            });
        });
    </script>

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
                },
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Data export',
                        text:'Export data',
                        exportOptions: {
                            columns: [ 0, 1, 2,3,4, 5,6 ]
                        }
                }
//                    'copy', 'csv', 'excel', 'pdf', 'print'
//                    'excel'
                ]
//                dom: 'Bfrtip',
//                buttons: [
//                    'copy', 'csv', 'excel', 'pdf', 'print'
//                ]
            });
            $('.btn-group').css({
                'position':'absolute',
                'margin':'0px 0px',
            });
            $('#filter_data .btn-secondary').addClass('btn-success btn-sm');
        });
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
  
  
  <script>
        $(document).ready(function () {
            $('.select2-container').css('width', '83%');
            $('.select2-container').addClass('pull-right');
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
    
   var latlng = new google.maps.LatLng(latitude,longitude);
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

<!--image crop script code-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.0/cropper.min.js"></script>

    <script src="https://demo.hazzardweb.com/filepicker2/assets/js/filepicker.js"></script>
    <script src="https://demo.hazzardweb.com/filepicker2/assets/js/filepicker-drop.js"></script>
    <script src="https://demo.hazzardweb.com/filepicker2/assets/js/filepicker-crop.js"></script>
    <script src="https://demo.hazzardweb.com/filepicker2/assets/js/filepicker-camera.js"></script>
    
    <script>
        /*global $*/

        var cropBtn = $('.crop-btn');
        var deleteBtn = $('.delete-btn');

        $('#filepicker').filePicker({
            url:'<?php echo site_url('filepicker') ?>',
            acceptedFiles: /(\.|\/)(gif|jpe?g|png)$/i,
            plugins: ['drop', 'camera', 'crop'],
            crop: {
                aspectRatio: 1, // Square
                showBtn: cropBtn
            }
        })
        .on('add.filepicker', function (e, data) {
            var file = data.files[0];

            if (file.error) {
                e.preventDefault();
                alert(file.error);
            }
        })
        .on('done.filepicker', function (e, data) {
            // Here the file has been uploaded.
            var file = data.files[0];

            if (file.error) {
                alert(file.error);
            } else {
                // Show the crop modal.
                $(this).filePicker().plugins.crop.show(file.url);
            }
        })
        .on('cropsave.filepicker', function (e, file) {
            // Here the image has been cropped.

            // Update the avatar image.
            $('.avatar').attr('src', file.versions.avatar.url +'?'+ new Date().getTime());

            // Update the button fileurl.
            cropBtn.data('fileurl', file.url).show();
            deleteBtn.data('file', file.name).show();
        })
        .on('fail.filepicker', function () {
            alert('Oops! Something went wrong.');
        });

        // When clicking on the delete button delete the file.
        deleteBtn.on('click', function () {
            // Delete the file.
            $('#filepicker').filePicker().delete($(this).data('file'));

            // Reset default avatar.
            $('.avatar').attr('src', 'https://www.gravatar.com/avatar/?d=mm&s=300');

            // Hide crop and delete buttons.
            cropBtn.hide();
            deleteBtn.hide();
        });
    </script>
    
    <script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script>
$("#downloadXls").click(function(){
  $("#advertiser").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Worksheet Name",
    filename: new Date(), //do not include extension
//    filename: new Date().getTime(), //do not include extension
    fileext: ".xlsx",
    exclude_img: true,
//    exclude_links: true,
//    exclude: ".dntinclude",
//    exclude_inputs: true
  }); 
});
</script>