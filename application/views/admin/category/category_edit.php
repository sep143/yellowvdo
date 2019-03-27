<link rel="stylesheet" href="<?= base_url(); ?>theme/backend/dataTables/multi-level/css/tabelizer.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!--Tree view pattern use in add category time-->
<link href="<?= base_url(); ?>/theme/backend/tree-view/css/bootstrap-treeview.css" rel="stylesheet" />


<style>
.fileinput .thumbnail {
    max-width: 166px;
}
</style>

<div class="content">
    <div class="content">
        <div class="container-fluid">
            
            <!--Category and sub category add form-->
            <div class="row" id="two-form">
                <div class="col-md-12">
                    <label>Category and Sub Category Edit Form</label>
                </div>
                <div class="col-md-12">
                    <!--Category Add form-->
                    <?php
                    if(!empty($edit_category)){
                    ?>
                    <form id="RegisterValidation" action="<?= site_url('category_edit/'.$edit_category->ID); ?>" method="POST" enctype="multipart/form-data">
                   
                        <div class="card ">
                            <div class="card-header card-header-rose card-header-icon">
                                <a href="<?= site_url('admin/category'); ?>" class="btn btn-sm btn-rose pull-right">Back</a>
                                <div class="card-icon">
                                    <i class="material-icons">folder</i>
                                </div>
                                <h4 class="card-title">Edit Category</h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating"> <?= $category_add_placeholder_name; ?></label>
                                                    <input type="text" class="form-control" name="category" required="true" value="<?php if(!empty($edit_category)) echo $edit_category->Name; ?>">
                                                </div>
                                            </div>
                                            <?php
                                            if($edit_category->ParentID == 0){
                                                ?>
                                            <div class="col-md-1 mt-3">
                                                <div class="form-check form-check-inline pull-right">
                                                    <label class="form-check-label">
                                                        <input type="hidden" name="popular" value="0">
                                                        <input class="form-check-input" type="checkbox" name="popular" value="1" <?php if(!empty($edit_category)) if($edit_category->Popular == 1) echo 'checked';?>> <?= $category_add_checkbox; ?>
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            
                                        </div>
                                        <!--using popup box open-->
                                        &nbsp;<br>
                                        <div class="row">
                                            <div class="col-md-12">
                                               <div class="form-group">
                                                    <label class="bmd-label-floating"> Category Select </label>
                                                    <input type="hidden" id="category_id" name="category_id">
                                                    
                                                    <input type="text" class="form-control" id="category_view" 
                                                           value="<?php 
                                                            if($brend_kram){
                                                                foreach ($brend_kram as $ct=> $cat):
                                                                    if($ct == sizeof($brend_kram) - 1){
                                                                        echo  $cat->Name;
                                                                    }else{
                                                                        echo  $cat->Name.' -> ';
                                                                    }

                                                                endforeach;
                                                            } ?>" data-target="#bootstrap-modal" data-toggle="modal" disabled="" style="background-color: white;">
                                                </div>
<!--                                                <button type="button" class="btn btn-rose btn-round"  data-target="#bootstrap-modal" data-toggle="modal"><i class="material-icons">folder</i> Select Category</button>-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--Image div start-->
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <?php
                                              //  if($edit_category->ParentID == 0){
                                                    ?>
                                                    <div class="row">
                                                    <div class="col-md-3">
                                                        <label class="bmd-label-floating"><?= $category_image; ?></label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <?php
                                                                    if($edit_category){
                                                                        if(!empty($edit_category->Icon)){
                                                                            ?>
                                                                            <img src="<?= base_url(); ?>uploads/category/<?= $edit_category->Icon; ?>" alt="Category Image" style="height: 100px; width: auto;">
                                                                <?php
                                                                        }else{
                                                                            ?>
                                                                            <img src="<?= base_url(); ?>theme/backend/assets/img/image_placeholder.jpg" alt="Category Image" style="height: 100px; width: auto;">
                                                                            <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                            <div>
                                                                <span class="btn btn-rose btn-round btn-file">
                                                                    <span class="fileinput-new">Select image</span>
                                                                    <span class="fileinput-exists">Change</span>
                                                                    <input type="file" name="category_image" accept="image/x-png,image/gif,image/jpeg"/>
                                                                </span>
                                                                <a href="#" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                               // }
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!--Image div end-->
                                </div>
                               
                                <div class="category form-category"> <?= $category_add_required_field; ?> </div>
                                
                            </div>
                            <div class="card-footer text-right">
                                <!--<button type="submit" class="btn btn-rose"><?= $category_submit; ?></button>-->
                                <input type="submit" name="submit" class="btn btn-rose" value="<?= $category_submit; ?>">
                            </div>
                        </div>
                    </form>
                   <?php
                    }else{
                        echo 'Invalid ID No.';
                    }
                    ?>
                </div>
                
            </div>
            
            <!--Category select popup div start-->
            <div id="bootstrap-modal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3>Select Category</h3>
                        </div>
                        <div class="modal-body">
                            <div style="width: 100%; height: 350px; border: 1px solid lightgray; overflow-y: scroll; overflow-x: hidden;">
                            <!--tree view pattern start div-->
                                <div id="default-tree"></div>
                            <!--tree view pattern end div-->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>-->
                            <button type="button" class="btn btn-default ok" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--Category select popup div end-->

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


<!--tree view table script-->
<script src="<?= base_url(); ?>theme/backend/dataTables/multi-level/js/jquery.tabelizer.js"></script>

<script src="<?= base_url(); ?>/theme/backend/tree-view/js/bootstrap-treeview.js"></script>
<!--Tree view pattern json-->
<script type="text/javascript">
$(document).ready(function(){
  
   var treeData;
   
   $.ajax({
        type: "GET",  
       // url: "/getItem",
        url: "<?= site_url('/getItem'); ?>",
        dataType: "json",       
        success: function(response)  
        {
           initTree(response);
           
        }   
  });
    
  function initTree(treeData) {
    $('#default-tree').treeview({
        data: treeData,
        levels: 1,
        
         // custom icons
  expandIcon: 'fa fa-plus',
  collapseIcon: 'fa fa-minus',
  emptyIcon: 'fa',
  nodeIcon: '',
  selectedIcon: '',
  checkedIcon: 'fa fa-check',
  uncheckedIcon: 'fa fa-unchecked',

  // colors
  color: undefined, // '#000000',
  backColor: undefined, // '#FFFFFF',
  borderColor: undefined, // '#dddddd',
  onhoverColor: '#F5F5F5',
  selectedColor: '#FFFFFF',
  selectedBackColor: '#428bca',
  searchResultColor: '#D9534F',
  searchResultBackColor: undefined, //'#FFFFFF',
    });
  }
   
});
</script>

<!--Open popup box and slect category and sub category and ok button click then set value-->
<script>
$('.ok').on('click', function(e){
    //alert($("#default-tree ul li.node-selected").text());
    var vt = $("#default-tree ul li.node-selected").text();
    var id = $("#default-tree ul li.node-selected i").data('id');
    //var vt = $("#default-tree ul li.node-selected").text();
    $('#category_view').val(vt);
    $('#category_id').val(id);
    //alert(id);
});

</script>

 <!--popup box open start--> 
<script>
$("#bootstrap-modal").on("shown.bs.modal", function() {
  
  
}).on("hidden.bs.modal", function() {
  
});

</script>
<!--popup box open end--> 