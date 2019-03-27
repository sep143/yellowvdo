<link rel="stylesheet" href="<?= base_url() ?>theme/backend/assets/message/message_v1.css">

<style>
    
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div style="">
                    <!--<button type="button" class="btn btn-rose">Messages</button>-->
                    <div class="row" id="starting">
                        <div class="col-md-10">
<!--                            <b>Chat Pending 
                            <div class="btn btn-warning btn-round">
                                <span>05</span>
                            </div>
                        </b>-->
                        </div>
                        <div class="col-md-2">
                            <!--<button type="button" class="btn btn-rose pull-right" id="filter"> <i class="fa fa-filter align-middle"></i> <span class="align-middle">Filter</span></button>-->
                        </div>
                    </div>
                    
                    <!--agar chat option on hone pr back button ko call krwayenge-->
                    <div class="row" id="back" style="display: none;">
                        <div class="col-md-12">
                            <a href="<?= site_url('admin/message/show'); ?>" class="btn btn-rose"> <i class="fa fa-backward"></i> Back</a>
                            <!--<button type="button" class="btn btn-rose pull-right" id="back"> <i class="fa fa-backward"></i> Back </button>-->
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        &nbsp;<br>

        <div id="chatUser">
            <!--Advertiser list in table view-->
            <div class="row">
                <div class="col-md-12" id="advertiser-list-table">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">list_alt</i>
                            </div>
                            <h4 class="card-title">Advertiser Chat List</h4>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
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
                                                        <a style="color: black;" class="nav-link" href="#" id="navbarDropdownMenuLink4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="notification">Status &nbsp;<i class="fa fa-caret-down"></i></span>
                                                        </a>
                                                        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink4" >
                                                            <a href="#" class="dropdown-item" id="status_1">Read</a>
                                                            <a href="#" class="dropdown-item" id="status_2">Unread</a>
<!--                                                            <a href="#" class="dropdown-item" id="status_0">Pending</a>
                                                            <a href="#" class="dropdown-item" id="status_4">Disapprove</a>
                                                            <a href="#" class="dropdown-item" id="status_5">Expired</a>-->
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
                                            </ul>
                                            <!--Filter div end-->
                                        </div>
                                    </div>
                                </div>
                            <!--filter end-->
                            <div class="material-datatables" id="filter_data">
                                <table id="message" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <!--<th>Advertiser ID</th>-->
                                            <th>Email</th>
                                            <th>Country</th>
                                            <th>Phone No.</th>
                                            <th>Status</th>
                                            <th>Received</th>
                                            <!--<th class="disabled-sorting text-right">Actions</th>-->
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        if($chat){
                                            foreach ($chat as $count=> $row):
                                                ?>
                                        <tr class="click-msg" style="cursor: pointer;" data-id="<?= $row->chatID; ?>" data-adid="<?= $row->AdsID; ?>" 
                                            data-name='<?= $row->FirstName.' '.$row->LastName; ?>'
                                            data-userid='<?= $row->user_id; ?>'
                                            data-image='<?= $row->Profile; ?>' >
                                            <td><?= $count+1; ?></td>
                                            <td><?= $row->FirstName.' '.$row->LastName; ?></td>
                                            <td><?= $row->UserName; ?></td>
                                            <td><?= $row->Country; ?></td>
                                            <td><?= $row->Phone; ?></td>
                                            
                                            <td><button class="btn btn-sm <?php if($row->stID == 0)
                                                {
                                                        echo 'btn-danger';
                                                }else if($row->stID == 1){
                                                    echo 'btn-success';
                                                }
                                                ?>" type="button"><?php if($row->stID == 0){ echo 'Inactive'; } else if($row->stID == 1){ echo 'Active';}?></button>
                                            </td>
                                            <td>
                                                <?php
                                                if($row->NotifyAdmin_c == 0){
                                                    $btn = 'btn-primary';
//                                                    $text = 'Read';
                                                    $text = 'Read';
                                                }else if($row->NotifyAdmin_c == 1){
                                                    $btn = 'btn-success';
                                                    $text = 'Unread';
                                                }
                                                ?>
                                                <span class="<?= $btn; ?>" style="border-radius: 10px; padding: 5px;"> &nbsp;<?= $text; ?>&nbsp; </span>
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
        </div>
        
        <div id="dataAjax">
            
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
<!--  Google Maps Plugin    -->
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
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
$(document).ready(function(){
    $('.click-msg').click(function(){
        var id = $(this).data('id');
        var adid = $(this).data('adid');
        var name = $(this).data('name');
        var userID = $(this).data('userid');
        var image = $(this).data('image');
       // alert('user-'+userID);
        $.ajax({
           url:'<?= site_url('chatting'); ?>',
           type:'post',
           data:{chat:'chat', name:name, user_id:userID,image:image},
           success:function(data){
               //alert('hello');
               $('#starting').hide();
               $('#chatUser').hide();
               $('#back').show();
               $('#dataAjax').html(data);
           }
        });
    });
});
</script>

<!--Datatable scripting useing at dashboard-->
    <script>
        $(document).ready(function () {
            $('#message').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }
            });

        });
    </script>
    
    
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
            data:{use:'message',id:id_search,from:dateFrom,to:dateTo,location:location,status:status},
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