<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>theme/backend/datatables/dataTables.bootstrap.css">

<style>
/*    table.dataTable thead tr th,
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
</style>

<div class="content">
    <div class="content">
        <div class="container-fluid">
            <!--Top to click button-->
            <div class="row">
                <div class="col-md-10">
                    <!--<button type="button" class="btn btn-success" id="advertiser-list">Advertisement List</button>-->
                    <a href="<?= site_url('admin/advertisement/list'); ?>" class="btn btn-success">Advertisement List</a>
                    <!--<button type="button" class="btn btn-rose" id="advertiser-add">New Add</button>-->
                    <a href="<?= site_url('admin/advertisement/add'); ?>" class="btn btn-rose">New Add</a>
                </div>
            </div>
            <!--Advertiser list in table view-->
            <div class="row">
                <div class="col-md-12" id="advertiser-list-table">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">list_alt</i>
                            </div>
                            <h4 class="card-title">Advertisement List</h4>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">
                               
                            </div>
                            <!--filter start-->
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
                                                        <a style="color: black;" class="nav-link" href="#" id="navbarDropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="notification">Category &nbsp;<i class="fa fa-caret-down"></i></span>
                                                        </a>
                                                        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink3" style="width: 200%;">
                                                            <div class="input-group input-group-sm" style="padding-left: 10px; padding-right: 10px;">
                                                                <input type="text" class="form-control" id="category" placeholder="Enter Category">&nbsp;&nbsp;
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
                                                            <a href="#" class="dropdown-item" id="status_1">Active</a>
                                                            <a href="#" class="dropdown-item" id="status_2">Inactive</a>
                                                            <a href="#" class="dropdown-item" id="status_0">Pending</a>
                                                            <a href="#" class="dropdown-item" id="status_4">Disapprove</a>
                                                            <a href="#" class="dropdown-item" id="status_5">Expired</a>
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
                                
                            <!--filter end-->
                            <div class="material-datatables table-responsive" id="filter_data">
                                <table id="advertisementTable" class="table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                                    <thead>
                                        <tr>
                                            <th class="disabled-sorting text-left" style="width:20px;">S.No</th>
                                            <th style="width:50px;">Date</th>
                                            <th style="width: 10px; word-wrap: break-word;">Title</th>
                                            <th style="width:50px;">Image</th>
                                            <th style="width:50px;">User Name</th>
                                            <th style="width:20px;">City</th>
                                            <th style="width:20px;">Country</th>
                                            <!--<th>Verify</th>-->
                                            <th style="width:20px;">Status</th>
                                            <th class="disabled-sorting text-right" style="width:20px;">Actions</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php
                                        if($ads_list){
                                            $i=0;
                                            foreach ($ads_list as $count=>$row):
//                                                if($row->StatusID != 6){
                                                ?>
                                        <tr>
                                            <td><?= $count+1; ?></td>
                                            <td><?= date('d-M-Y', strtotime($row->CreatedDT)); ?></td>
                                            <td><?= $row->CaptionLine; ?></td>
                                            <td>
                                                <?php
                                                if(!empty($row->image)){
                                                    $thumb_img = base_url().'uploads/ads/_thumb/'.$row->image;
                                                }else{
                                                    $thumb_img = base_url().'theme/web/images/banner_design.png';
                                                }
                                                ?>
                                                <img src="<?= $thumb_img; ?>" class="img img-responsive" style="width: 70px; height: 50px; object-fit: cover;">
<!--                                                <video style="width: 150px; height: auto;" controls>
                                                    <source src="<?= $video; ?>" >
                                                </video>-->
                                            </td>
                                            <td>
                                                <?= $row->FirstName.' '.$row->LastName; ?>
                                            </td>
                                            <td>
                                                <?= $row->City; ?>
                                            </td>
                                            <td><?= $row->Country; ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <?php if($row->StatusID == 1)
                                                    {
                                                        $btn = 'btn-success';
                                                        $text = 'Active';
                                                    }else if($row->StatusID == 2){
                                                        $btn = 'btn-warning';
                                                        $text = 'Inactive';
                                                    }else if($row->StatusID == 4){
                                                        $btn = 'btn-danger';
                                                        $text = 'Disapprove';
                                                    }else if($row->StatusID == 5){
                                                        $btn = 'btn-default';
                                                        $text = 'Expired';
                                                    }else if($row->StatusID == 0){
                                                        $btn = 'btn-info';
                                                        $text = 'Pending';
                                                    }
                                                    ?>
                                                  <button class="dropdown-toggle btn1 <?= $btn; ?> btn-round" id="cbtn<?= $row->ID; ?>" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?= $text; ?>
                                                  </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dropbtn<?= $row->ID; ?>">
                                                    <h6 class="dropdown-header">Change Status</h6>
                                                    <?php
                                                        if($text != 'Active' && $text != 'Pending'){
                                                            echo '<a class="dropdown-item" data-id='.$row->ID.' data-status="1" href="#" onclick="change_status(this)">Active</a>';
                                                        }

                                                        if($text != 'Inactive' && $text != 'Pending'){
                                                            echo '<a class="dropdown-item" data-id='.$row->ID.' data-status="2" href="#" onclick="change_status(this)">Inactive</a>';
                                                        }

                                                        if($text == 'Pending'){
                                                            echo '<a class="dropdown-item" data-id='.$row->ID.' data-status="1" href="#" onclick="change_status(this)">Approve</a>';
                                                        }

                                                        if($text != 'Disapprove'){
                                                            echo '<a class="dropdown-item" data-id='.$row->ID.' data-status="4" href="#" onclick="change_status(this)">Disapprove</a>';
                                                        }
                                                    ?>

                                                  </div>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <a href="<?= site_url('admin/advertisement/edit/'.$row->ID); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                                                <a href="<?= site_url('admin/view_ad/'.$row->ID); ?>" target="_blank" class="btn btn-link btn-info btn-just-icon" title="View ad"><i class="material-icons">visibility</i></a>
                                                <a href="#" class="btn btn-link btn-danger btn-just-icon" data-id='<?= $row->ID; ?>' data-status="3" onclick="change_status(this)"><i class="material-icons">delete</i></a>
                                            </td>
                                        </tr>
                                        <?php
//                                                }//statusid 6 wala data show nahi krwana he
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

        <div id="bootstrap-modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3>Change Profile Picture</h3>
                    </div>
                    <div class="modal-body">
<!--                        <div class="bootstrap-modal-cropper">
                            <img src="<?= base_url(); ?>theme/backend/image-crop/images/picture.jpg" alt="Picture" style="width:500px; height: auto;">
                        </div>-->
                        <div class="img-container bootstrap-modal-cropper">
                            <img id="image-view" src="<?= base_url(); ?>theme/backend/image-crop/images/picture.jpg" alt="Picture">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-method="rotate" id="left"> <i class="material-icons">rotate_left</i></button>
                        <button type="button" class="btn btn-default" data-method="rotate" id="right"> <i class="material-icons">rotate_right</i></button>
                        <div class="docs-buttons">
                            <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                            <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Import image with Blob URLs">
                                <span class="fa fa-upload"></span>
                            </span>
                        </label>
                        </div>
                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

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
    <!--  Google Maps Plugin    -->
    <!--<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>-->
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

    <!--For using country - state - city select-->
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>--> 
    <!--<script src="http://geodata.solutions/includes/countrystatecity.js"></script>-->
    <!--Click button then open required-->
       
   <!-- Scripts -->
<!--  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://fengyuanchen.github.io/js/common.js"></script>-->
<!--  <script src="<?= base_url(); ?>theme/backend/image-crop/js/cropper.js"></script>
  <script src="<?= base_url(); ?>theme/backend/image-crop/js/main.js"></script>-->
    
    <!--Datatable scripting useing at dashboard-->
    <script>
        $(document).ready(function () {
            $('#advertisementTable').DataTable({
                "pagingType": "full_numbers",
                
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
               // responsive: true,
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
                            columns: [ 0, 1, 2,4, 5,6,7 ]
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
 <!--Category Table in Active and deactive ajax-->
<script>
function change_status(current){
        var id = $(current).data('id');
        var status = $(current).data('status');
        
        //Active & Approve
        if(status == 1){
            $.ajax({
                url:'<?= site_url('free-ads-change_status'); ?>',
                type:'post',
                data:{id:id, value: '1'},
                success:function(data){
                   // alert(data);
                    $('#cbtn'+id).removeClass('btn-warning');
                    $('#cbtn'+id).removeClass('btn-danger');
                    $('#cbtn'+id).removeClass('btn-info');
                    $('#cbtn'+id).addClass('btn-success');
                    $('#cbtn'+id).text('Active');
                    $('#dropbtn'+id).html('<h6 class="dropdown-header">Change Status</h6>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="2" href="#" onclick="change_status(this)">Inactive</a>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="4" href="#" onclick="change_status(this)">Disapprove</a>\n\
                        ');
                    var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                                notify.update({'type': 'success', 'message': '<strong>Success</strong> Status Active'});
                        }, 1000);
//                    $(current).text('Inactive');
//                    $(current).data('status',2);
                }
            });
         //Inactive
        }else if(status == 2){
            $.ajax({
                url:'<?= site_url('free-ads-change_status'); ?>',
                type:'POST',
                data:{id:id, value: '2'},
                success:function(data){
                   // alert('data');
                    $('#cbtn'+id).removeClass('btn-success');
                    $('#cbtn'+id).removeClass('btn-danger');
                    $('#cbtn'+id).removeClass('btn-info');
                    $('#cbtn'+id).addClass('btn-warning');
                    $('#cbtn'+id).text('Inactive');
                    $('#dropbtn'+id).html('<h6 class="dropdown-header">Change Status</h6>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="1" href="#" onclick="change_status(this)">Active</a>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="4" href="#" onclick="change_status(this)">Disapprove</a>\n\
                        ');
                        var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                                notify.update({'type': 'warning', 'message': '<strong>Success</strong> Status Inactive'});
                        }, 1000);
                }
            });
        //disapprove
        }else if(status == 4){
            $.ajax({
                url:'<?= site_url('free-ads-change_status'); ?>',
                type:'POST',
                data:{id:id, value: '4'},
                success:function(data){
                   // alert('data');
                    $('#cbtn'+id).removeClass('btn-warning');
                    $('#cbtn'+id).removeClass('btn-info');
                    $('#cbtn'+id).removeClass('btn-success');
                    $('#cbtn'+id).addClass('btn-danger');
                    $('#cbtn'+id).text('Disapprove');
                    $('#dropbtn'+id).html('<h6 class="dropdown-header">Change Status</h6>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="1" href="#" onclick="change_status(this)">Active</a>\n\
                            <a class="dropdown-item" data-id='+id+' data-status="2" href="#" onclick="change_status(this)">Inactive</a>\n\
                        ');
                        var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                                notify.update({'type': 'danger', 'message': '<strong>Success</strong> Status Disapprove'});
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
                title: 'Delete Advertisement',
                content: 'This Advertisement and all associated data will be deleted. This is not reversible.',
                theme: 'modern',
                buttons: {
                    confirm: function () {
                       
                       $.ajax({
                            url:'<?= site_url('free-ads-change_status'); ?>',
                            type:'POST',
                            data:{id:id, value: '3'},
                            success:function(data){
                               // alert('delete');
                                $.confirm({
                                   //animation: 'zoom',
                                    icon:'fa fa-check-circle',
                                    title: 'Advertisement Deleted',
                                    content: 'The selected Advertisement and associated data was deleted.',
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
                content: 'The selected Advertisement and associated data delete no authorise user..',
                theme: 'modern',
                
            });          
        <?php
        }
         ?>
        }
        
    }
</script> 


<!--Filter script-->
<script>
$(document).ready(function(){
        var id_search;
        var dateFrom;
        var dateTo;
        var location;
        var status;
        var category;
    
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
    //category enter
    $('#category').on('keyup', function(event){
        event.preventDefault();
        category = $(this).val();
        filter_get();
    });
    //status
   //pending
   $('#status_0').on('click', function(){
        status = 6;
        filter_get();
   });
   //active
   $('#status_1').on('click', function(){
        status = 1;
        filter_get();
   });
   //inactive
   $('#status_2').on('click', function(){
        status = 2;
        filter_get();  
   });
   //disapprove
   $('#status_4').on('click', function(){
        status = 4;
        filter_get();  
   });
   //expired
   $('#status_5').on('click', function(){
        status = 5;
        filter_get();  
   });
    
    function filter_get(){
         $.ajax({
            url:'<?= site_url('filter'); ?>',
            type:'post',
            data:{use:'ads',id:id_search,from:dateFrom,to:dateTo,location:location,status:status,category:category},
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

<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script>
$("#downloadXls").click(function(){
  $("#advertisementTable").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Worksheet Name",
    filename: new Date(), //do not include extension
//    filename: new Date().getTime(), //do not include extension
    fileext: ".xlsx",
    exclude_img: true,
    exclude_links: true,
    exclude_inputs: false,
    //columns : [0,1,2]
//    exclude_links: true,
//    exclude: ".dntinclude",
//    exclude_inputs: true
    
  }); 
});
</script>