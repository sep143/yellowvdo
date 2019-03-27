<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>theme/backend/datatables/dataTables.bootstrap.css">

<style>
    table.dataTable thead tr th,
    table.dataTable tbody tr td {
    white-space: nowrap;
}
table.dataTable thead tr th,
table.dataTable tbody tr td {
    word-wrap: break-word;
    word-break: break-all;
    /*min-width: 120px;*/
}

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
</style>

<div class="content">
    <div class="content">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-md-12" id="advertiser-list-table">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">list_alt</i>
                            </div>
                            <h4 class="card-title">Reminder Advertisement List <button class="pull-right btn btn-rose" id="sendReminder">Send Reminder</button></h4>
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
                            <div class="material-datatables" id="filter_data">
                                <table id="advertisementPendingTable" class="table table-striped table-no-bordered table-hover dt-responsive" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="select_all" value="1" id="example-select-all">
                                            </th>
                                            <th class="disabled-sorting text-left">S.No</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Picture</th>
                                            <th>User Name</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <!--<th>Status</th>-->
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($ads_list) {
                                            foreach ($ads_list as $count => $row):
                                                ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="id[]" value="<?=$row->ID; ?>">
                                                    </td>
                                                    <td><?= $count + 1; ?></td>
                                                    <td><?= date('d-M-Y', strtotime($row->CreatedDT)); ?></td>
                                                    <td><?= $row->CaptionLine; ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($row->image)) {
                                                            $thumb_img = base_url() . 'uploads/ads/_thumb/' . $row->image;
                                                        } else {
                                                            $thumb_img = base_url() . 'theme/web/images/banner_design.png';
                                                        }
                                                        ?>
                                                        <img src="<?= $thumb_img; ?>" class="img img-responsive" style="width: 70px; height: 70px; object-fit: cover;">
                                                        <!--                                                <video style="width: 150px; height: auto;" controls>
                                                                                                            <source src="<?= $video; ?>" >
                                                                                                        </video>-->
                                                    </td>
                                                    <td>
                                                        <?= $row->FirstName . ' ' . $row->LastName; ?>
                                                    </td>
                                                    <td>
                                                        <?= $row->City; ?>
                                                    </td>
                                                    <td><?= $row->Country; ?></td>
                        <!--                            <td>
                                                        <button class="btn btn-sm <?php
                                                    if ($row->StatusID == 0) {
                                                        echo 'btn-danger';
                                                    } else if ($row->StatusID == 1) {
                                                        echo 'btn-success';
                                                    }
                                                    ?>" data-id="<?= $row->ID; ?>" data-status="<?= $row->StatusID; ?>" onclick="change_status(this)" type="button"><?php if ($row->StatusID == 0) {
                                                echo 'Inactive';
                                            } else if ($row->StatusID == 1) {
                                                echo 'Active';
                                            } ?></button>
                                                    </td>-->
                                                    <td class="text-right">
                                                        <a href="<?= site_url('admin/advertisement/edit/' . $row->ID); ?>" class="btn btn-link btn-success btn-just-icon"><i class="material-icons">edit</i></a>
                                                        <a href="#" class="btn btn-link btn-danger btn-just-icon" data-id='<?= $row->ID; ?>' data-status="3" onclick="change_status(this)"><i class="material-icons">delete</i></a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-notify/0.2.0/css/bootstrap-notify.css"></script>
 
     <!--Datatable scripting useing at dashboard-->

    <script>
    $(document).ready(function (){
   var table = $('#advertisementPendingTable').DataTable({
//      'ajax': {
//         'url': '/lab/articles/jquery-datatables-how-to-add-a-checkbox-column/ids-arrays.txt'
//      },
      'columnDefs': [{
         'targets': 0,
         'searchable': false,
         'orderable': false,
         'className': 'dt-body-center',
       //  'render': function (data, type, full, meta){
       //      return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
        // }
      }],
      'order': [[1, 'asc']],
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Data export',
                        text:'Export data',
                        exportOptions: {
                            columns: [ 1, 2,3,5,6,7 ]
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
       // });

   // Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
   //alert('all data'); //Top to select then all rows checked
      // Get all rows with search applied
      var rows = table.rows({ 'search': 'applied' }).nodes();
      // Check/uncheck checkboxes for all rows in the table
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });

   // Handle click on checkbox to set state of "Select all" control
   $('#advertisementPendingTable tbody').on('change', 'input[type="checkbox"]', function(){
       //alert('single row');
      // If checkbox is not checked
      if(!this.checked){
          
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
             
            // Set visual state of "Select all" control
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });

   // Handle form submission event
    $('#sendReminder').on('click', function(){
    var val = [];
        $(':checkbox:checked').each(function(i){
            val[i] = $(this).val();
        }); 
        for(let j=0;j<val.length;j++) {
            var id = val[j];
                $.ajax({
                    url:'<?= site_url("send_reminder_mail"); ?>',
                    type:'POST',
                    dataType:'JSON',
                    data:{id:val[j],type:'reminder'},
                    success:function(data){
                        var notify = $.notify('<strong>Send</strong> Reminder to selected advertiser', {
                        allow_dismiss: false,
                        showProgressbar: true
                        });

                        setTimeout(function() {
                        notify.update({'type': 'success', 'message': data['msg'], 'progress': 25});
                        }, 1000);
                    },
                    error:function(data){
                        console.log(data);
                    }
                });
        }
    });

});
    </script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
 <!--Category Table in Active and deactive ajax-->
<script>
function change_status(current){
        var id = $(current).data('id');
        var status = $(current).data('status');
        //alert(status);
        if(status == 1){
            $.ajax({
                url:'<?= site_url('free-ads-change_status'); ?>',
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
                              notify.update({'type': 'danger', 'message': '<strong>Success</strong> Advertisement Inactive'});
                                //window.location.reload();
                        }, 1000);
                }
            });
        }else if(status == 0){
            $.ajax({
               // url:'<?= site_url('free-ads-change_status'); ?>',
                type:'POST',
                data:{id:id, value: '1'},
                success:function(data){
                    alert('data');
                    $(current).removeClass('btn-danger');
                    $(current).addClass('btn-success');
                    $(current).text('Active');
                    $(current).data('status',1);
                   var notify = $.notify('<strong>Process...</strong>', {
                        allow_dismiss: false,
                        showProgressbar: false
                    });

                        setTimeout(function() {
                              notify.update({'type': 'success', 'message': '<strong>Success</strong> Advertisement Active'});
                                //window.location.reload();
                        }, 1000);
                }
            });
        //delete
        }else if(status == 3){
           <?php
            if($this->session->userdata('log_role') == 1){
        ?>     
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
            data:{use:'reminder',id:id_search,from:dateFrom,to:dateTo,location:location,status:status,category:category},
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
  $("#advertisementPendingTable").table2excel({
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