<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>theme/backend/datatables/dataTables.bootstrap.css">

<style>
    table.dataTable thead tr th,
    table.dataTable tbody tr td {
    white-space: nowrap;
}
table.dataTable thead tr th,
table.dataTable tbody tr td {
/*    word-wrap: break-word;
    word-break: break-all;*/
   // min-width: 120px;
}

.dataTables_scroll
{
    overflow:auto;
}
</style>

<div class="content">
    <div class="content">
        <div class="container-fluid">
            <!--Data Table Use-->
            <div class="row">
                <!--Category Table show on left-->
                <div class="col-md-12" >
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">folder</i>
                            </div>
                            <h4 class="card-title">Enquiry List</h4>
                        </div>
                        <div class="card-body">
                            <div class="toolbar">
                                <!--        Here you can write extra buttons/actions for the toolbar              -->
                            </div>
                            <div class="material-datatables">
                                <table id="enquirytables" class="table table-striped table-no-bordered table-hover dt-responsive" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>S.No &nbsp;</th>
                                            <th>Advertiser ID</th>
                                            <th>Ads ID &nbsp;</th>
                                            <th>Name &nbsp;</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Created Date</th>
                                            <!--<th>Updated Date</th>-->
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>10</td>
                                            <td>Demo</td>
                                            <td>testenquiry@gmail.com</td>
                                            <td>7894561230</td>
                                            <td>Hello, Dear Enquiry message show</td>
                                            <td>10:33 AM, 1-12-2018</td>
                                            <!--<td>12:43 AM, 4-12-2018</td>-->
                                            <td class="text-right">
                                                <a href="#" class="btn btn-link btn-success btn-just-icon "><i class="material-icons">edit</i></a>
                                                <a href="#" class="btn btn-link btn-danger btn-just-icon "><i class="material-icons">delete</i></a>
                                                
                                            </td>
                                        </tr>
                                        
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
            <!-- end row -->
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

<!--Datatable scripting useing at dashboard-->
<script>
    $(document).ready(function () {
        $('#enquirytables').DataTable({
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

//        var table = $('#subCategory').DataTable();
//
//        // Edit record
//        table.on('click', '.edit', function () {
//            $tr = $(this).closest('tr');
//            var data = table.row($tr).data();
//            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
//        });
//
//        // Delete a record
//        table.on('click', '.remove', function (e) {
//            $tr = $(this).closest('tr');
//            table.row($tr).remove().draw();
//            e.preventDefault();
//        });
//
//        //Like record
//        table.on('click', '.like', function () {
//            alert('You clicked on Like button');
//        });
    });
</script>