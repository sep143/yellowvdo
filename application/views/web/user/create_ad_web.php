<!--
this view page final code starting view single page to video youtube link
-->

<link rel="stylesheet" href="<?= base_url(); ?>theme/backend/build/css/intlTelInput.css">
<link rel="stylesheet" href="<?= base_url(); ?>theme/plugin/crop/css/cropper.css">

<style>
#default-tree .node-disabled {
    display: none;
}
</style>

<div class="col-sm-9">
   <div class="login-panel widget margin-bottom-none">
      <div class="login-body">
          
          <form action="<?= site_url('createads_data'); ?>" method="post" enctype="multipart/form-data">
             <div class="row">
                 <div class="col-md-6 col-xs-12">
                     <div class="form-group">
                         <label class="control-label">Category <span class="required">*</span></label>
                         <input type="hidden" class="readonly" id="category_id" name="catid">
                         <input type="text" class="form-control"  required="true" id="category_view" data-target="#bootstrap-modal" data-toggle="modal" style="cursor: pointer;">
                     </div>
                 </div>
                 <div class="col-md-6 col-xs-12">
<!--                                    <div class="form-group">
                         <label class="control-label">Sub Category <span class="required">*</span></label>
                         <select class="form-control border-form">
                             <option selected="">Sub Category</option>
                             <option>Hand Phone</option>
                             <option>Motorcycle</option>
                             <option>Properti</option>
                         </select>
                     </div>-->
                 </div>
             </div>


            <div class="form-group">
               <label class="control-label">Business Name <span class="required">*</span></label>
               <input type="text" name="businessname" placeholder="e.g. Xyz Restaurant/Hotel, Univercity" required="required" maxlength="50" class="form-control border-form">
            </div>
            <div class="form-group">
               <label class="control-label">Advertisement Title / Caption Line <span class="required">*</span></label>
               <input type="text" name="captionline" placeholder="e.g. Food Ads" required="required" maxlength="100" class="form-control border-form">
            </div>
            <div class="form-group">
               <div class="row">
                   <div class="col-md-12 col-xs-12">
                     <label class="control-label">Description <span class="required">*</span></label>
                     <textarea rows="10" style="width: 100%;" id="editor2" class="form-control border-form" name="description"></textarea>
                   </div>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label">Key Word <span class="required">*</span></label>
               <input type="text" name="keyword" placeholder="e.g. car,jobs etc." required="required" maxlength="300" class="form-control border-form">
            </div>
            <div class="form-group">
               <div class="row">
                   <div class="col-md-11 col-xs-9">
                     <label class="control-label">Email <span class="required"></span></label>
                     <input type="email" name="email" id="email" placeholder="e.g. example@domain.com" class="form-control border-form" >
                   </div>
                  <div class="col-sm-1 col-xs-3">
                     <div class="checkboxes" style="margin-top: 40px;">
                         <input type="hidden" name="emailShow" value="0">
                         <input type="checkbox" name="emailShow" value="1" id="c1" checked="checked" />
                         <label class="check" for="c1" title="Show on web"></label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="row">
                   <div class="col-md-6 col-xs-12">
                       <div class="row">
                           <div class="col-md-10 col-xs-8">
                               <label class="control-label">WhatsApp <span class="required"></span></label>
                               <input type="text" name="whatsappNo" id="whatsappNo" placeholder="e.g. 9000000001" maxlength="13" class="form-control border-form">
                           </div>
                           <div class="col-md-2 col-xs-4">
                               <div class="checkboxes" style="margin-top: 15px;">
                                   <input type="hidden" value="0" name="whatsappNoShow">
                                   <input type="checkbox" name="whatsappNoShow" value="1" id="c2" checked="" />
                                   <label class="check" for="c2" title="Show on web"></label>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6 col-xs-12">
                       <div class="row">
                           <div class="col-md-10 col-xs-8">
                               <label class="control-label">Cell No. <span class="required"></span></label>
                               <input type="text" name="cellNo" id="phone1" placeholder="e.g. 800000009" maxlength="13" class="form-control border-form">
                           </div>
                           <div class="col-md-2 col-xs-4">
                               <div class="checkboxes" style="margin-top: 15px;">
                                   <input type="hidden" value="0" name="cellNoShow">
                                   <input type="checkbox" value="1" name="cellNoShow" id="c3" checked="checked" />
                                   <label class="check" for="c3" title="Show on web"></label>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
            <div class="form-group">
               <div class="row">
                   <div class="col-md-11 col-xs-9">
                     <label class="control-label">Land Line No. <span class="required"></span></label>
                     <input type="text" name="landLine" id="landLine" placeholder="e.g. 024812345678" class="form-control border-form">
                   </div>
                  <div class="col-md-1 col-xs-3">
                     <div class="checkboxes" style="margin-top: 40px;">
                         <input type="hidden" value="0" name="landLineShow">
                         <input type="checkbox" value="1" name="landLineShow" id="c4" checked="checked" />
                         <label class="check" for="c4" title="Show on web"></label>
                     </div>
                  </div>
               </div>
            </div>

            <div class="form-group">
               <div class="row">
                   <div class="col-md-11 col-xs-9">
                     <label class="control-label">Web Site Link <span class="required"></span></label>
                     <input type="text" name="url1" placeholder="e.g. www.domainname.com" class="form-control border-form">
                   </div>
                   <div class="col-md-1 col-xs-3">
                     <div class="checkboxes" style="margin-top: 40px;">
                         <input type="hidden" value="0" name="url1Show">
                         <input type="checkbox" value="1" name="url1Show" id="c5" checked="checked" />
                         <label class="check" for="c5" title="Show on web"></label>
                     </div>
                  </div>
               </div>
            </div>
             <b>Quick Links</b>
            <div class="form-group">
               <div class="row">
                   <div class="col-md-11 col-xs-9">
                     <label class="control-label">URL 1 <span class="required"></span></label>
                     <input type="text" name="url2" placeholder="e.g. http://example.com" class="form-control border-form">
                   </div>
                   <div class="col-md-1 col-xs-3">
                     <div class="checkboxes" style="margin-top: 40px;">
                         <input type="hidden" value="0" name="url2Show">
                         <input type="checkbox" value="1" name="url2Show" id="c6" checked="checked" />
                         <label class="check" for="c6" title="Show on web"></label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="row">
                   <div class="col-md-11 col-xs-9">
                     <label class="control-label">URL 2 <span class="required"></span></label>
                     <input type="text" name="url3" placeholder="e.g. http://example.in" class="form-control border-form">
                   </div>
                   <div class="col-md-1 col-xs-3">
                     <div class="checkboxes" style="margin-top: 40px;">
                         <input type="hidden" value="0" name="url3Show">
                         <input type="checkbox" value="1" name="url3Show" id="c7" checked="checked" />
                         <label class="check" for="c7" title="Show on web"></label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="row">
                   <div class="col-md-11 col-xs-9">
                     <label class="control-label">URL 3 <span class="required"></span></label>
                     <input type="text" name="url4" placeholder="e.g. http://fb.com/id" class="form-control border-form">
                   </div>
                   <div class="col-md-1 col-xs-3">
                     <div class="checkboxes" style="margin-top: 40px;">
                         <input type="hidden" value="0" name="url4Show">
                         <input type="checkbox" value="1" name="url4Show" id="c8" checked="checked" />
                         <label class="check" for="c8" title="Show on web"></label>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="row">
                   <div class="col-md-11 col-xs-9">
                     <label class="control-label">URL 4 <span class="required"></span></label>
                     <input type="text" name="url5" placeholder="e.g. http://twitter.com/id" class="form-control border-form">
                   </div>
                   <div class="col-md-1 col-xs-3">
                     <div class="checkboxes" style="margin-top: 40px;">
                         <input type="hidden" value="0" name="url5Show">
                         <input type="checkbox" value="1" name="url5Show" id="c9" checked="checked" />
                         <label class="check" for="c9" title="Show on web"></label>
                     </div>
                  </div>
               </div>
            </div>
            
             <div class="row">
                     <div class="col-md-8 col-xs-12">
                         <div class="row">
                             <div class="col-md-10 col-xs-9">
                                 <div class="form-group">
                                     <label class="control-label">Business Address <span class="required">*</span></label><br>
                                     <input type="text" name="businessAddress" id="searchInput" class="form-control input-controls" required="true">
                                 </div>
                             </div>
                             <div class="col-md-2 col-xs-3">
                                 <div class="checkboxes" style="margin-top: 40px;">
                                     <input type="hidden" value="0" name="businessAddressShow">
                                     <input type="checkbox" value="1" name="businessAddressShow" id="c11" checked="checked" />
                                     <label class="check" for="c11" title="Show on web"></label>
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-10 col-xs-9" >
                                 <div class="">
                                 <label class="bmd-label-floating"> Country <span class="required">*</span></label>
                                 <input class="field form-control" name="country" id="country" disabled="true" required="true"/>

                                 </div>
                             </div>
                             <div class="col-md-2 col-xs-3">
                                 <div class="checkboxes" style="margin-top: 40px;">
                                     <input type="hidden" value="0" name="countryShow">
                                     <input type="checkbox" value="1" name="countryShow" id="c12" checked="checked" />
                                     <label class="check" for="c12" title="Show on web"></label>
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-10 col-xs-9">
                                 <label class="bmd-label-floating"> State <span class="required">*</span></label>
                                 <input class="field form-control" name="state" id="administrative_area_level_1" disabled="true" required="true"/>

                             </div>
                             <div class="col-md-2 col-xs-3">
                                 <div class="checkboxes" style="margin-top: 40px;">
                                     <input type="hidden" value="0" name="stateShow">
                                     <input type="checkbox" value="1" name="stateShow" id="c13" checked="checked" />
                                     <label class="check" for="c13" title="Show on web"></label>
                                 </div>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-10 col-xs-9">
                                 <label class="bmd-label-floating"> City <span class="required">*</span></label>
                                 <input class="field form-control" name="city" id="locality" disabled="true" required="true"/>
                             </div>
                             <div class="col-md-2 col-xs-3">
                                 <div class="checkboxes" style="margin-top: 40px;">
                                     <input type="hidden" value="0" name="cityShow">
                                     <input type="checkbox" value="1" name="cityShow" id="c14" checked="checked" />
                                     <label class="check" for="c14" title="Show on web"></label>
                                 </div>
                             </div>
                         </div>
                         &nbsp;<br>
                         <div class="row">
                             <div class="col-md-10 col-xs-9">
                                 <div class="form-group">
                                     <label class=""> Post Code <span class="required">*</span></label>
                                     <input type="text" class="form-control" name="postCode" id="postal_code" required="true">
                                 </div>
                             </div>
                             <div class="col-md-2 col-xs-3">
                                 <div class="checkboxes" style="margin-top: 40px;">
                                     <input type="hidden" value="0" name="postCodeShow">
                                     <input type="checkbox" value="1" name="postCodeShow" id="c15" checked="checked" />
                                     <label class="check" for="c15" title="Show on web"></label>
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-10 col-xs-9">
                                 <div class="form-group">
                                     <label class="">Landmark Address </label>
                                     <div class="input-group">
                                         <input type="text" name="LandmarkAddress" class="form-control" placeholder="How do you want coustomer to rich you." >
                                         <div class="input-group-addon" data-toggle="tooltip" data-placement="left" title="1st floor in abc building take first right. opp xyz office.">
                                             <i class="fa fa-info-circle"></i>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-2 col-xs-3">
                                 <div class="checkboxes" style="margin-top: 40px;">
                                     <input type="hidden" value="0" name="LandmarkAddressShow">
                                     <input type="checkbox" value="1" name="LandmarkAddressShow" id="c16" checked="checked" />
                                     <label class="check" for="c16" title="Show on web"></label>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4 col-xs-12">
                         <!--For google map div start-->
                         <!--<input id="searchInput" class="input-controls" type="text" placeholder="Enter a location">-->
                         <div class="map" id="map" style="width: 100%; height: 450px; margin-top: 40px;"></div>
                         <div class="form_area">
                             <input type="hidden" name="location" id="location">
                             <input type="hidden" name="lat" id="lat">
                             <input type="hidden" name="lng" id="lng">
                         </div>

                         <!--For google map div end-->
                     </div>
                 </div>


             <div class="form-group">
                 <div class="row">
                     <div class="col-md-12">
                         <label>Select Image </label>
                     </div>
                 </div>
                 <div class="row">
                     
                     <?php
                     //image limit set then view
                     if(!empty($this->img_limit_fix)){
                         for($i=1;$i<=$this->img_limit_fix;$i++){
                             ?>
                            <div class="col-md-3 col-xs-6 text-center">
                                <center style=" width:150px; height:150px; max-width: 150px; max-height: 150px; border: 1px solid #0000ff; cursor: pointer; margin: 2px;" id="img_div_<?= $i; ?>">
                                    <img src="<?= base_url(); ?>theme/web/images/ads_image.png"  alt="ads image" title="Select Image"  
                                    data-toggle="modal" 
                                    data-target="#avatar-modal" 
                                    id="render-avatar<?= $i; ?>" class="circular-fix has-shadow border marg-top10" 
                                    data-ussuid="<?php print base64_encode($i);?>" 
                                    data-backdrop="static" 
                                    data-keyboard="false" 
                                    data-upltype="avatar" style="width:148px; height:148px; object-fit: cover; object-position: center;">
                                </center>
                                <div id="trash<?= $i; ?>"></div>
                            </div>
                     <?php
                         }
                     }
                     ?>

                 </div>
             </div>


             <div class="form-group">
                 &nbsp;<br>
<!--                                <div class="row container-fluid">
                     <b class="">Upload Images</b>
                     <div class="col-md-12" style="height: 350px; border: 1px solid lightgray; overflow-y: scroll; overflow-x: hidden;">

                         <div class="field" align="left" id="files_img">

                         </div>

                     </div>
                 </div>-->
                  &nbsp;<br>
<!--                                <div class="row">
                     <div class="col-md-4">
                         &nbsp;
                     </div>
                         <div class="col-md-4">
                             <input type="file" id="files" name="images[]" multiple />
                         </div>
                     <div class="col-md-4">
                         &nbsp;
                     </div>
                     <hr>
                 </div>-->
                 <div class="row">
                     <div class="col-md-12 col-xs-12">
                             <span class="fileinput-new">Add Video Type</span>
                             <div class="row">
                                 <div class="col-md-3">
                                     <input type="radio" name="video_sel" id="vido_sel" checked="">
                                     <label for="vido_sel">Select video</label>
                                 </div>
                                 <div class="col-md-3">
                                     <input type="radio" name="video_sel" id="video_you" class="">
                                     <label for="video_you">Youtube link</label>
                                 </div>
                             </div>
                             <hr>
                             <div class="row">
                                 <div class="col-md-12 col-xs-12" id="type_append">
                                     <div id="select_div">
                                        <label for="select_video">Select video</label>
                                        <input type="file" name="video" class="file_multi_video" id="select_video" accept="video/*" size="30" required=""/>
                                     </div>
                                     <div id="youtube_div" style="display: none;">
                                            <label for="youtube_link">Youtube link</label>
                                            <input type="text" id="youtube_link" name="youtube_link" class="form-control">
                                     </div>
                                 </div>
                             </div>
                             <div class="row" style="margin-top: 10px;">
                                 <div class="col-md-12 col-xs-12">
                                     <div id="select_video_view">
                                         <video style="width: 70%; height: auto;" controls>
                                             <source src="mov_bbb.mp4" id="video_here">
                                         </video>
                                     </div>
                                     <div id="video_here_youtube">
                                     </div>
                                 </div>
                             </div>
                             
                     </div>
                 </div>
             </div>
            <hr>

             <div class="row">
                 <div class="col-sm-11 col-xs-9">
                     <div class="checkboxes">
                         <input type="checkbox" value="1" id="c17" data-status="1" onclick="ative_btn(this)"/>
                         <label class="check" for="c17" title="Show on web"></label>
                         <div style="margin-top: -36px; margin-left: 31px;">
                             <lable>I have read and agree to the <a href="#">Terms and Conditions</a> and Privacy Policy</lable>
                         </div>

                     </div>

                 </div>
             </div> 

            <div class="form-group text-right margin-bottom-none">
               <button type="submit" disabled="true" id="term_chk" class="btn btn-success"><i class="fa fa-save"></i> Create ad</button>
               <!--<button type="submit" class="btn btn-danger"><i class="fa fa-close"></i> Cancel</button>-->
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
         </form>
      </div>
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
                        <div class="row">
                            <div class="col-md-9">
                                <input type="input" class="form-control" id="input-search" placeholder="Search Category..." value="">
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-sm btn-default" id="btn-clear-search">Clear</button>
                            </div>
                        </div>
                        <br>

                        <div style="width: 100%; height: 350px; border: 1px solid lightgray; overflow-y: scroll; overflow-x: hidden;">

                        <!--tree view pattern start div-->
                        <div id="default-tree" class="treeview" ></div>
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
</section>

<!--<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>-->
<!--<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>-->
<!--<script src="<?= base_url(); ?>theme/plugin/ckeditor.js"></script>-->


<!--<script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     
<script src="<?= base_url(); ?>theme/backend/assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>theme/backend/tree-view/js/bootstrap-treeview.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?= base_url(); ?>theme/backend/build/js/intlTelInput.js"></script>

<!--<script>
    //CKEDITOR.replace( 'editor1' ); //edit ads in show
   CKEDITOR.replace('editor2'); 
CKEDITOR.editorConfig = function( config ) {
 config.toolbarGroups = [
  { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
  { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
  { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
  { name: 'forms', groups: [ 'forms' ] },
  '/',
  { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
  { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
  { name: 'links', groups: [ 'links' ] },
  { name: 'insert', groups: [ 'insert' ] },
  { name: 'styles', groups: [ 'styles' ] },
  { name: 'colors', groups: [ 'colors' ] },
  { name: 'tools', groups: [ 'tools' ] },
  { name: 'others', groups: [ 'others' ] },
  { name: 'about', groups: [ 'about' ] }
 ];
 config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Strike,Subscript,Superscript';
};
</script>-->

<script>
  var input = document.querySelector("#phone1");
  window.intlTelInput(input, {
    autoHideDialCode: false,
      formatOnDisplay: false,
      nationalMode: false,
    onlyCountries: ['au', 'in'],
    utilsScript: "<?= base_url(); ?>theme/backend/build/js/utils.js",
  });
</script>
<script>
  var input = document.querySelector("#whatsappNo");
  window.intlTelInput(input, {
    autoHideDialCode: false,
      formatOnDisplay: false,
      nationalMode: false,
    onlyCountries: ['au', 'in'],
    utilsScript: "<?= base_url(); ?>theme/backend/build/js/utils.js",
  });
</script>

<!--<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>-->
<!--<script src="<?php echo base_url();?>theme/js/jquery.mask.js"></script>
<script>
    $("#email").inputmask({
           mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            greedy: false,
            onBeforePaste: function (pastedValue, opts) {
                pastedValue = pastedValue.toLowerCase();
                return pastedValue.replace("mailto:", "");
            },
            definitions: {
                '*': {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                    cardinality: 1,
                    casing: "lower"
                }
            }
    });
  </script>
  <script>

    $("#whatsappNo").mask("9999999999");
    $("#phone1").mask("9999999999");
    $("#landLine").mask("999999999999");
    
  </script>-->
<script>
      function ative_btn(e){
          var st = $(e).data('status');
          //alert(st);
          if(st == 1){
              //alert('1');
              $(e).data('status',0);
              $('#term_chk').removeAttr('disabled');
          }else if(st == 0){
              //alert('0');
              $(e).data('status',1);
              $('#term_chk').attr('disabled','');
          }
      }
  </script>

<script>
$(document).ready(function(){
   var tree;
   $.ajax({
        type: "GET",  
        url: "<?= site_url('getItem'); ?>",
        dataType: "json",       
        success: function(response)  
        {
           initTree(response);
        }   
  });
     
function initTree(tree) {
     // return tree;
    $('#default-tree').treeview({
        data: tree,
        levels: 1,
        
         // custom icons
  expandIcon: 'fa fa-plus',
  collapseIcon: 'fa fa-minus',
//  emptyIcon: 'fa',
//  nodeIcon: '',
//  selectedIcon: '',
//  checkedIcon: 'fa fa-check',
//  uncheckedIcon: 'fa fa-unchecked',
//
//  // colors
//  color: undefined, // '#000000',
//  backColor: undefined, // '#FFFFFF',
//  borderColor: undefined, // '#dddddd',
//  onhoverColor: '#F5F5F5',
//  selectedColor: '#FFFFFF',
//  selectedBackColor: '#428bca',
//  searchResultColor: '#D9534F',
//  searchResultBackColor: undefined, //'#FFFFFF',
    });
    
  }
  
  //search value
  var selectors = {
        'tree': '#default-tree',
        'input': '#input-search',
        'reset': '#btn-clear-search'
    };
    var lastPattern = ''; 
    // closure variable to prevent redundant operation

    // collapse and enable all before search //
    function reset(tree) {
        tree.collapseAll();
        tree.enableAll();
    }

    // find all nodes that are not related to search and should be disabled:
    // This excludes found nodes, their children and their parents.
    // Call this after collapsing all nodes and letting search() reveal.
    //
    function collectUnrelated(nodes) {
        var unrelated = [];
        $.each(nodes, function (i, n) {
            if (!n.searchResult && !n.state.expanded) { // no hit, no parent
                unrelated.push(n.nodeId);
            }
            if (!n.searchResult && n.nodes) { // recurse for non-result children
                $.merge(unrelated, collectUnrelated(n.nodes));
            }
        });
        return unrelated;
    }

    // search callback
    var search = function (e) {
        var pattern = $(selectors.input).val();
        //alert(pattern);
        if (pattern === lastPattern) {
            return;
        }
        lastPattern = pattern;
        var tree = $(selectors.tree).treeview(true);
       
        if (pattern.length < 2) { // avoid heavy operation
            reset(tree);
            tree.clearSearch();
        } else {
            tree.search(pattern);
            // get all root nodes: node 0 who is assumed to be
            //   a root node, and all siblings of node 0.
            var roots = tree.getSiblings(0);
            roots.push(tree.getNode(0));
            //first collect all nodes to disable, then call disable once.
             //  Calling disable on each of them directly is extremely slow! 
            var unrelated = collectUnrelated(roots);
            tree.disableNode(unrelated, {silent: true});
        }
    };

    // typing in search field
    $(selectors.input).on('keyup', search);

    // clear button
    $(selectors.reset).on('click', function (e) {
        $(selectors.input).val('');
        var tree = $(selectors.tree).treeview(true);
        reset(tree);
        tree.clearSearch();
    });
   
});
</script>

<!--Open popup box and slect category and sub category and ok button click then set value-->
<script>
$('.ok').on('click', function(e){
    //alert($("#default-tree ul li.node-selected").text());
    var vt = $("#default-tree ul li.node-selected").text();
    var id = $("#default-tree ul li.node-selected i").data('id');
    //var vt = $("#default-tree ul li.node-selected").text();
    
    $('#category_view').prop('readonly', true);
    $('#category_id').val(id);
    //alert(id);
    $.ajax({
        url:'<?= site_url('brand_kram'); ?>',
        type:'post',
        data:{catid:id},
        success:function(data){
            $('#category_view').val(data);
        }
    });
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
    if(latitude && longitude){
       var latitude1 = position.coords.latitude;
       var longitude1 = position.coords.longitude;
    }else{
       var latitude1 = '24.580327';
       var longitude1 = '73.7221453';
    }
    
   var latlng = new google.maps.LatLng(latitude1,longitude1);
//   var latlng = new google.maps.LatLng(24.5854,73.7125);
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

<!--image select then delete-->
<script>
function img_unlink(name){
    var img = $(name).data('img');
    var img_div_id = $(name).data('id');
    //alert(img_div_id);
    $.ajax({
        url:'<?= site_url('Crop/delete_img_unlink'); ?>',
        type:'post',
        data:{img_name:img,type:'create'},
        success:function(data){
           // alert(data);
            $('#img_div_'+img_div_id).empty();
            $('#trash'+img_div_id).empty();
            var i;
            var image_limit = <?= $this->img_limit_fix; ?>;
            for(i=1;i<=image_limit;i++){
                if(img_div_id == i){
                   $('#img_div_'+img_div_id).html('<img src="<?= base_url(); ?>theme/web/images/ads_image.png"  alt="ads image" title="Select Image"\n\
                    data-toggle="modal"\n\
                    data-target="#avatar-modal"\n\
                    id="render-avatar'+img_div_id+'" class="circular-fix has-shadow border marg-top10"\n\
                    data-ussuid="'+btoa(i)+'"\n\
                    data-backdrop="static"\n\
                    data-keyboard="false"\n\
                    data-upltype="avatar" style="width:148px; height:148px; object-fit: cover; object-position: center;">'); 
                }
            }

        }
    });
}
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<!--video upload and view-->
<script>
$(document).on("change", ".file_multi_video", function(evt) {
        
    var fsize = $('.file_multi_video')[0].files[0].size;
		
		if(fsize>2.5e+7) //do something if file size more than 1 mb (1048576)
		{
                    $('.file_multi_video').val('');
//			alert(fsize +" bites\nToo big!");
                    $.alert({
                        animation: 'zoom',
                        icon:'fa fa-warning',
                        title: 'Video size',
                        content: 'Please upload a video upto 25 MB',
                        theme: 'modern',
                    });
		}else{
                    var $source = $('#video_here');
                    $source[0].src = URL.createObjectURL(this.files[0]);
                    $source.parent()[0].load();
//			alert(fsize +" bites\nYou are good to go!");
//                    $.alert({
//                                animation: 'zoom',
//                                icon:'fa fa-success',
//                                title: 'Thanks',
//                                content: 'Video succefully upload',
//                                theme: 'modern',
//                            });
		}
  });
</script>

<script>
 $(document).ready(function() {
     //video type select then open type link
    $('#vido_sel').click(function(){
//        alert('hello select video');
        $('#youtube_link').removeAttr('required','false');
        $('#select_video').attr('required','true');
        $('#select_div').show();
        $('#youtube_div').hide();
        $('#youtube_link').val('');
        $('#video_here_youtube').empty();
        $('#source_link_add').empty();
//        $('#select_video_view').show();
        $('#select_video_view').html('<video style="width: 70%; height: auto;" controls id="source_link_add"><source src="mov_bbb.mp4" id="video_here"></video>');
        
    });
    $('#video_you').click(function(){
//        alert('hello youtube video');
        $('#youtube_link').attr('required','true');
        $('#select_video').removeAttr('required','false');
        $('#select_div').hide();
        $('#youtube_div').show();
        $('#select_video_view').empty();
        $('#select_video').val('');
    });
 });
</script>

<script>
$(document).ready(function(){
    $('#youtube_link').on('keyup', function() {
//        alert('hello');
        var link = $(this).val();
        var myId = getId(link);
        
        $('#video_here_youtube').html('<iframe width="560" height="315" src="//www.youtube.com/embed/' + myId + '" frameborder="0" allowfullscreen></iframe>');
        console.log(link);
    });
});

function getId(url) {
    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    var match = url.match(regExp);

    if (match && match[2].length == 11) {
        return match[2];
    } else {
        return 'error';
    }
}
</script>

<script> 
    var baseurl = "<?php echo site_url(); ?>"; 
    var ad_id = '';
    var image_limit = <?= $this->img_limit_fix; ?>;
</script>
    
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.js"></script>
<script src="<?= base_url(); ?>theme/plugin/crop/js/cropper.js"></script>
<script src="<?= base_url(); ?>theme/plugin/crop/js/main.js"></script>
<?php
$this->load->view('crop/profileAvatar');
?>