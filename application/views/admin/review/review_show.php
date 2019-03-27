<div class="content">
    <div class="content">
        <div class="container-fluid">
            
            
            <div class="row">
                <div class="col-md-12">
                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">comment</i>
                                </div>
                                <h4 class="card-title">Edit Review <a class="btn btn-sm btn-rose pull-right" href="<?= site_url('admin/review'); ?>">Back</a></h4>
                            </div>
                        <div class="card-body">
                            <form id="RegisterValidation" action="<?= site_url('admin/review/edit/'.$review->ID); ?>" method="POST" enctype="multipart/form-data">
                                <table class="table table-bordered table-striped dt-responsive">
                                    <tr>
                                        <td style="width: 220px;">Advertiser ID</td><td style="width: 20px;">:</td>
                                        <td><?= $review->UserID; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 220px;">Advertiser Name</td><td style="width: 20px;">:</td>
                                        <td><?php echo $advertiser->FirstName.' '.$advertiser->LastName; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 220px;">Advertisement ID</td><td style="width: 20px;">:</td>
                                        <td><?= $review->AdsID; ?></td>
                                    </tr>   
                                        <td style="width: 220px;">Advertisement Title</td><td style="width: 20px;">:</td>
                                        <td><?= $review->CaptionLine; ?></td>
                                    </tr>
                                    </tr>   
                                        <td style="width: 220px;">Advertisement Link</td><td style="width: 20px;">:</td>
                                        <td><a href="<?= base_url().'view/'.$review->AdsID; ?>" class="btn btn-info btn-sm" target="_blank">Ad View</a></td>
                                    </tr>
                                </table>
                                <label>Review Information</label>
                                <table class="table table-bordered table-striped dt-responsive">
                                    <tr>
                                        <td style="width: 220px;">IP Address</td><td style="width: 20px;">:</td>
                                        <td><?= $review->DeviceID; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 220px;">Browser</td><td style="width: 20px;">:</td>
                                        <td><?= $review->Browser; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 220px;">Platform</td><td style="width: 20px;">:</td>
                                        <td><?= $review->Platform; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 220px;">Review Date</td><td style="width: 20px;">:</td>
                                        <td><?= date('h:i A, d-M-Y', strtotime($review->CreatedDT)) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 220px;">Star Rating</td><td style="width: 20px;">:</td>
                                        <td><?= $review->Rating ?></td>
                                    </tr>
                                </table>
                                <label>Edit Information</label>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2">
                                        <!--<p style="margin-top: 10px;">Review Status : </p>-->
                                        <label style="margin-top: 15px;">Review Status :</label>
                                    </div>
                                    <div class="col-md-9 form-group">
                                        <select class="form-control" name="status" disabled="">
                                            <option value="1" <?php if($review->stID == 1) echo 'selected' ;?> >Approve</option>
                                            <option value="0" <?php if($review->stID == 0) echo 'selected' ;?>>Disapprove</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Comment :</label>
                                    <textarea class="form-control" name="comment" rows="5" readonly=""><?= $review->Comment; ?></textarea>
                                </div>
                                <hr>
                               
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
<script src="http://geodata.solutions/includes/countrystatecity.js"></script>
<!--Click button then open required-->

<!-- Scripts -->
<!--  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://fengyuanchen.github.io/js/common.js"></script>-->
<script src="<?= base_url(); ?>theme/backend/image-crop/js/cropper.js"></script>
<script src="<?= base_url(); ?>theme/backend/image-crop/js/main.js"></script>
    