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
    min-width: 100px;
}

.dataTables_scroll
{
    overflow:auto;
}

/*.form-control{
        border: 1px solid #000;
        padding: 5px;
          
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
                <?= AlertMsg(); ?>
                <div class="col-md-12">
                    <a href="<?= site_url('admin/payment/refund'); ?>" class="btn <?php if($this->uri->segment(3) == 'refund'){echo 'btn-success'; }else { echo 'btn-rose';} ?>">Refund Request</a>
                    <a href="<?= site_url('admin/payment/all-refund'); ?>" class="btn <?php if($this->uri->segment(3) == 'all-refund'){echo 'btn-success'; }else { echo 'btn-rose';} ?>"> All Refund </a>
                    <!--<button type="button" class="btn btn-rose" data-id="filter" id="filter"> <i class="fa fa-filter"></i> Filter</button>-->
<!--                    <div class="pull-right">
                        <b>Refund Request Pending 
                            <div class="btn btn-warning btn-just-icon btn-round">
                                <span>05</span>
                            </div>
                        </b>
                        <b>Refund Request All 
                            <div class="btn btn-round btn-info">
                                <span>10111</span>
                            </div>
                        </b>
                    </div>-->
                </div>
            </div>
            
            <!--Data Table Use-->
            <div class="row">
                <!--Category Table show on left-->
                <div class="col-md-12" id="pending_refund">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">folder</i>
                            </div>
                            <h4 class="card-title">Refund Request</h4>
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
<!--                                                <li class="">
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
                                                </li>-->
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
                                <table id="refundPendingTable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Advertiser Name</th>
                                            <th>Advertisement Name</th>
                                            <th>TXT ID</th>
                                            <th>Amount</th>
                                            <th>Request Date</th>
                                            <th>Status</th>
                                            <?php
                                            if($done){
                                                echo '<th class="disabled-sorting text-right">Actions</th>';
                                            }
                                            ?>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if($refund){
                                            foreach ($refund as $count=>$row):
                                                ?>
                                        <tr>
                                            <td><?= $count+1; ?></td>
                                            <td><?= $row->FirstName.' '.$row->LastName; ?></td>
                                            <td><?= $row->BusinessName; ?></td>
                                            <td><?= $row->TxtID; ?></td>
                                            <td><?= $row->Amt; ?></td>
                                            <td><?= date('h:i A, d-M-Y', strtotime($row->CreatedDT)); ?></td>
                                            <td>
                                                <?php
                                                if($row->Status == 0){
                                                    $btn = 'btn-warning';
                                                    $text = 'Pending';
                                                }else if($row->Status == 1){
                                                    $btn = 'btn-success';
                                                    $text = 'Success';
                                                }else if($row->Status == 2){
                                                    $btn = 'btn-danger';
                                                    $text = 'Rejected';
                                                }
                                                ?>
                                               <span class="<?= $btn; ?> btn" style="border-radius: 10px; padding: 5px;"> &nbsp;<?= $text; ?>&nbsp; </span>
                                            </td>
                                            <?php
                                            if($done){
                                                ?>
                                            <td class="text-right">
                                                <a href="<?= site_url('admin/view_ad/'.$row->adid); ?>" target="_blank" class="btn btn-link btn-info btn-just-icon" title="View ad"><i class="material-icons">visibility</i></a>
                                                <button class="btn btn-link btn-success btn-just-icon" 
                                                        data-target="#bootstrap-modal" 
                                                        data-toggle="modal" 
                                                        data-status="1"
                                                        data-payid="<?= $row->PayID; ?>"
                                                        data-id="<?= $row->ID; ?>"
							data-txtid="<?= $row->TxtID; ?>"
                                                        data-adname="<?= $row->BusinessName; ?>"
                                                        data-usermsg="<?= $row->UserMsg; ?>"
                                                        data-name="<?= $row->FirstName . ' ' . $row->LastName; ?>" onclick="submit_req(this)" type="button">
                                                    <i class="material-icons">done</i>
                                                </button>
                                                <button class="btn btn-link btn-danger btn-just-icon" 
                                                        data-target="#bootstrap-modal" 
                                                        data-toggle="modal" 
                                                        data-status="4"
                                                        data-payid="<?= $row->PayID; ?>"
                                                        data-id="<?= $row->ID; ?>"
							data-txtid="<?= $row->TxtID; ?>"
                                                        data-adname="<?= $row->BusinessName; ?>"
                                                        data-usermsg="<?= $row->UserMsg; ?>"
                                                        data-name="<?= $row->FirstName . ' ' . $row->LastName; ?>" onclick="submit_req(this)" type="button">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                
                                                <!--<a href="#" class="btn btn-danger btn-just-icon "><i class="material-icons">close</i></a>-->
                                            </td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                            endforeach;
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!--Refund Request action -->
                        <script>
                        function submit_req(current){
                            var id = $(current).data('id');
                            var payid = $(current).data('payid');
                            var name = $(current).data('name');
                            var adname = $(current).data('adname');
                            var status = $(current).data('status');
                            var msg = $(current).data('usermsg');
							var txtid = $(current).data('txtid');
                            $('#id').val(id);
                            $('#payid').val(payid);
                            $('#txtid').val(txtid);
                            $('#name').text(name);
                            $('#adname').text(adname);
                            $('#usermsg1').text(msg);
                            if(status == 1){
                                $('#status_show').html('Action : <b style="color:green"> Accept Refund</b>');
                                $('#status_value').val(1);
                            }else if(status == 4){
                                $('#status_show').html('Action : <b style="color:red"> Reject Refund</b>');
                                $('#status_value').val(4);
                            }
                        }
                        </script>
                        <!-- end content-->
                    </div>
                    <!--  end card  -->
                </div>
                <!-- end col-md-6 -->
             
            </div>
            <!-- end row -->
            
            <!--Ajax to get data and view-->
            
                <div id="dataAjax">
                    <div id="loading" style="margin-left: 480px; display: none;" class="">
                        Loading Please Wait....
                        <img src="<?= base_url();?>theme/backend/assets/img/gif/ajax-loader.gif" alt="Loading" style="margin-right: 500px;"/>
                    </div>
                </div>
           
        </div>
    </div>
    
    <!--Popup box open start-->
    <div id="bootstrap-modal" class="modal fade">
        <form action="<?= site_url('admin/payment/refund_action'); ?>" method="post">
            <input type="hidden" id="id" name="id">
            <input type="hidden" id="payid" name="payid">
	    <input type="hidden" id="txtid" name="txtid">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3>Refund Request</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Advertiser Name : <i id="name"></i></p>
                                <p>Ads Name : <i id="adname"></i></p>
                                <p id="status_show"></p>
                                <div style="">
                                    <label>User Message :</label>
                                    <pre id="usermsg1">Please wait...</pre>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="status" id="status_value">
<!--                                        <select class="form-control" name="status">
                                            <option value="1">Success</option>
                                            <option value="2">Reject</option>
                                        </select>-->
                                    </div>
                                </div>&nbsp;<br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Admin Message :</label>
                                        <textarea class="form-control" rows="5" name="msg"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Submit</button>&nbsp;
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    <!--Popup box open end-->
    
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


<script>
$(document).ready(function(){
    $('#refund').click(function(){
        $('#loading').show();
        $('#pending_refund').show();
        $('#refund').addClass('btn-success');
        $('#refund').removeClass('btn-rose');
        $('#all_refund').addClass('btn-rose');
        $('#all_refund').removeClass('btn-success');
        $('#dataAjax').empty();
     
    });
});
</script>


<script>
$(document).ready(function(){
    $('#all_refund').click(function(){
        $('#loading').show();
        
        $.ajax({
            url:'<?= site_url('refund'); ?>',
            type:'post',
            data:{file:'all_refund'},
            success:function(data){
                $('#all_refund').addClass('btn-success');
                $('#all_refund').removeClass('btn-rose');
                $('#refund').addClass('btn-rose');
                $('#refund').removeClass('btn-success');
                
                $('#dataAjax').html(data);
                $('#loading').hide();
                $('#pending_refund').hide();
            }
        });
    });
});
</script>

          
<!--Datatable scripting useing at dashboard-->
<script>
  $(document).ready(function() {
    $('#refundPendingTable').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      responsive: true,
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
        $('#loading').show();
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
        $('#loading').show();
    });
    //location enter
    $('#location').on('keyup', function(event){
        event.preventDefault();
        location = $(this).val();
        filter_get();
        $('#loading').show();
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
            data:{use:'refund_req',id:id_search,from:dateFrom,to:dateTo,location:location,status:status,type:'refund_all'},
            success:function(data){
                $('#loading').hide();
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
  $("#refundPendingTable").table2excel({
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