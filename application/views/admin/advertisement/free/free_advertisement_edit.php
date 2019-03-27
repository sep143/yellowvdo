<link rel="stylesheet" href="<?= base_url(); ?>theme/backend/build/css/intlTelInput.css">
<!--<link rel="stylesheet" href="<?= base_url(); ?>theme/backend/build/css/demo.css">-->

<!--<link href="<?= base_url(); ?>theme/backend/ssi-uploader/dist/ssi-uploader/styles/ssi-uploader.min.css" rel="stylesheet"/>
<script src="<?= base_url(); ?>theme/backend/ssi-uploader/dist/ssi-uploader/js/ssi-uploader.min.js"></script>-->

<!--Image function crop-->
<!--<link  href="<?= base_url(); ?>theme/backend/image-crop/css/cropper.css" rel="stylesheet">
<link  href="<?= base_url(); ?>theme/backend/image-crop/css/main.css" rel="stylesheet">-->
<!--<script src="<?= base_url(); ?>theme/backend/image-crop/js/main.js"></script>-->

 <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>theme/plugin/crop/css/cropper.css">

<style>
  
#default-tree .node-disabled {
    display: none;
}
</style>

<div class="content">
    <div class="content">
        <div class="container-fluid">
            
            <!--Free ads form and submit to data in Advertisement db table and status use to free type--> 
            <div class="row">
                <div class="col-md-12">
                    <?= AlertMsg(); ?>
                    
                    <?php

                    if($free_ad){
                    ?>
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <a href="<?= site_url('admin/advertisement/free-list'); ?>" class="btn btn-sm btn-rose pull-right">Back</a>
                                <div class="card-icon">
                                    <i class="material-icons">folder</i>
                                </div>
                                <h4 class="card-title">Free Ad Post</h4>
                            </div>
                        <div class="card-body">
                            <div style="margin-top: 20px;"><!--This Div use to card body and form between space now then use div and set top margin-->
                                <form method="post" action="<?= site_url('free_ad_update'); ?>" enctype="multipart/form-data">
                                    <input type="hidden" value="<?= $free_ad->ID; ?>" name="id">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Category Select * </label>
                                            <input type="hidden" id="category_id" name="catid" value="<?= $free_ad->CategID; ?>">
                                            <input type="text" class="form-control" id="category_view" 
											value="<?php 
                                                   if($category){
                                                       foreach ($category as $ct=> $cat):
                                                           if($ct == sizeof($category) - 1){
                                                               echo  $cat->Name;
                                                           }else{
                                                               echo  $cat->Name.' -> ';
                                                           }
                                                           
                                                       endforeach;
                                                      
                                                       
                                                   } ?>" data-target="#bootstrap-modal" data-toggle="modal" readonly="" style="background-color: white;" required="">
                                        </div>
<!--                                                <button type="button" class="btn btn-rose btn-round"  data-target="#bootstrap-modal" data-toggle="modal"><i class="material-icons">folder</i> Select Category</button>-->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Business Name * </label>
                                            <input type="text" class="form-control" name="businessname" value="<?= $free_ad->BusinessName; ?>" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Advertisement Title/Caption Line * </label>
                                            <input type="text" class="form-control" name="captionline" value="<?= $free_ad->CaptionLine; ?>" required="">
                                        </div>
                                    </div>
                                </div>&nbsp;<br>
                                <!--Address div row start md-12-->
                                <div class="row">
                                    <div class="col-md-8 col-xs-12">
                                        
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Business Address * </label>
                                                    <input type="text" name="businessAddress" id="searchInput" class="form-control input-controls" required="true" value="<?= $free_ad->BusinessAddress; ?>">
                                                    <!--<textarea class="form-control" required="" name="businessAddress" rows="3"><?= $ads->BusinessAddress; ?></textarea>-->
                                                    <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="businessAddressShow">
                                                            <input class="form-check-input" name="businessAddressShow" type="checkbox" value="1" <?php if($free_ad->BusinessAddressShow == 1) echo 'checked=""'; ?>> Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp;<br>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="">
                                                <label class="bmd-label-floating"> Country *</label>
                                                <input class="field form-control" name="country" id="country" required="true" value="<?= $free_ad->Country; ?>"/>
                                                <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="countryShow">
                                                            <input class="form-check-input" type="checkbox" name="countryShow" value="1" <?php if($free_ad->CountryShow == 1) echo 'checked=""'; ?>> Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp;<br>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating"> State *</label>
                                                <input class="field form-control" name="state" id="administrative_area_level_1" required="true" value="<?= $free_ad->State; ?>"/>
                                                <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="stateShow">
                                                            <input class="form-check-input" type="checkbox" name="stateShow" value="1" <?php if($free_ad->StateShow == 1) echo 'checked=""'; ?>> Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                            </div>
                                        </div>
                                        &nbsp;<br>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <label class="bmd-label-floating"> City *</label>
                                                <input class="field form-control" name="city" id="locality" required="true" value="<?= $free_ad->City; ?>"/>
                                                <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="cityShow">
                                                            <input class="form-check-input" type="checkbox" name="cityShow" value="1" <?php if($free_ad->CityShow == 1) echo 'checked=""'; ?>> Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                            </div>
                                        </div>
                                        &nbsp;<br>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class=""> Post Code *</label>
                                                    <input type="text" class="form-control" name="postCode" id="postal_code" required="true" value="<?= $free_ad->PostCode; ?>">
                                                    <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="postCodeShow">
                                                            <input class="form-check-input" type="checkbox" name="postCodeShow" value="1" <?php if($free_ad->PostCodeShow == 1) echo 'checked=""'; ?>> Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="">Landmark Address </label>
                                                    <div class="input-group">
                                                        <input type="text" name="LandmarkAddress" value="<?= $free_ad->LandmarkAddress; ?>" class="form-control" placeholder="How do you want coustomer to rich you.">
                                                        <div class="input-group-addon" data-toggle="tooltip" data-placement="left" title="1st floor in abc building take first right. opp xyz office.">
                                                            <i class="fa fa-info-circle"></i>
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="LandmarkAddressShow">
                                                            <input class="form-check-input" type="checkbox" name="LandmarkAddressShow" value="1"  <?php if($free_ad->LandmarkAddressShow == 1) echo 'checked=""'; ?>> Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-12">
                                        <!--For google map div start-->
                                        <!--<input id="searchInput" class="input-controls" type="text" placeholder="Enter a location">-->
                                        <div class="map" id="map" style="width: 100%; height: 420px; margin-top: 40px;"></div>
                                    <div class="form_area">
                                        <input type="hidden" name="location" id="location">
                                        
                                        <?php
                                        $lt[0] = '';
                                        $lt[1] = '';
                                        if(!empty($free_ad->LatLong)){
                                            $lt = explode(',', $free_ad->LatLong);
                                        }
                                        
                                        ?>
                                        <input type="hidden" name="lat" id="lat"  value="<?php echo $lt[0]; ?>">
                                        <input type="hidden" name="lng" id="lng" value="<?php echo $lt[1]; ?>">
                                    </div>

                                        <!--For google map div end-->
                                    </div>
                                </div>
                                <hr>
                                <b>Optional Details</b>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating"> Keyword </label>
                                            <input type="text" class="form-control" name="keyword" value="<?= $free_ad->Keyword; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Email </label>
                                            <input type="email" class="form-control" name="email" value="<?= $free_ad->Email; ?>">
                                            <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                <label class="form-check-label">
                                                    <input type="hidden" value="0" name="emailShow">
                                                    <input class="form-check-input" type="checkbox" name="emailShow" value="1" <?= ($free_ad->EmailShow == 1)? 'checked=""' : '';?>> Show
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>WhastApp No. </label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline pull-right">
                                                    <label class="form-check-label">
                                                        <input type="hidden" value="0" name="whatsappNoShow">
                                                        <input class="form-check-input" type="checkbox" name="whatsappNoShow" value="1" <?= ($free_ad->WhatsAppNoShow == 1)? 'checked=""' : '';?>> Show
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <input type="tel" class="form-control" name="whatsappNo" id="phone" maxlength="13" value="<?= $free_ad->WhatsAppNo; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label> Cell Phone No. </label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-check form-check-inline pull-right">
                                                    <label class="form-check-label">
                                                        <input type="hidden" value="0" name="cellNoShow">
                                                        <input class="form-check-input" type="checkbox" name="cellNoShow" value="1" <?= ($free_ad->CellNoShow == 1)? 'checked=""' : '';?>> Show
                                                        <span class="form-check-sign">
                                                            <span class="check"></span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <input type="tel" class="form-control" name="cellNo" id="phone1" maxlength="13" value="<?= $free_ad->CellNo; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating"> Land Line No. </label>
                                                    <input type="text" class="form-control" name="landLine" value="<?= $free_ad->LandLine; ?>">
                                                    <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="landLineShow">
                                                            <input class="form-check-input" type="checkbox" name="landLineShow" value="1" <?= ($free_ad->LandLineShow == 1)? 'checked=""' : '';?> > Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="bmd-label-floating1"> Description </label><br>
                                            <!--<textarea class="form-control" rows="5" placeholder="Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat."  name="wrereview" id="wrereview"></textarea>-->
                                            <textarea class="form-control pane" name="description" id="editor2" rows="14" ><?= $free_ad->Description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Web Site Link</label>
                                                    <input type="text" class="form-control" name="url1" value="<?= $free_ad->Url1; ?>">
                                                    <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="url1Show">
                                                            <input class="form-check-input" type="checkbox" name="url1Show" value="1" <?= ($free_ad->Url1Show == 1)? 'checked=""' : '';?> > Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <b class="">Quick Link</b>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Link 2</label>
                                                    <input type="text" class="form-control" name="url2" value="<?= $free_ad->Url2; ?>">
                                                    <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="url2Show">
                                                            <input class="form-check-input" type="checkbox" name="url2Show" value="1" <?= ($free_ad->Url2Show == 1)? 'checked=""' : '';?> > Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Link 3</label>
                                                    <input type="text" class="form-control" name="url3" value="<?= $free_ad->Url3; ?>">
                                                    <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="url3Show">
                                                            <input class="form-check-input" type="checkbox" name="url3Show" value="1" <?= ($free_ad->Url3Show == 1)? 'checked=""' : '';?>> Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Link 4</label>
                                                    <input type="text" class="form-control" name="url4" value="<?= $free_ad->Url4; ?>">
                                                    <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="url4Show">
                                                            <input class="form-check-input" type="checkbox" name="url4Show" value="1" <?= ($free_ad->Url4Show == 1)? 'checked=""' : '';?>> Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Link 5</label>
                                                    <input type="text" class="form-control" name="url5" value="<?= $free_ad->Url5; ?>">
                                                    <div class="form-check form-check-inline pull-right" style="margin-top: -25px;">
                                                        <label class="form-check-label">
                                                            <input type="hidden" value="0" name="url5Show">
                                                            <input class="form-check-input" type="checkbox" name="url5Show" value="1" <?= ($free_ad->Url5Show == 1)? 'checked=""' : '';?>> Show
                                                            <span class="form-check-sign">
                                                                <span class="check"></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Last Description and url text use end-->
                                &nbsp;<br>
                                                                                               
                            <!--Image div start-->
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Select Image </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <?php
                                $i=0;
                                if ($images) {
                                    foreach ($images as $count=> $row):
                                        ?>
                                    <div class="col-md-3 col-xs-6 text-center" id="afterDelRefresh">
                                        <center style="width:150px; height:150px; max-width: 150px; max-height: 150px; cursor: pointer;" id="img_div_<?= $count+1; ?>">
                                            <img src="<?= base_url() . 'uploads/ads/' . $row->Images; ?>"  alt="ads image" title="Select Image"  
                                            data-toggle="0" 
                                            data-target="#avatar-modal" 
                                            id="render-avatar<?= $count+1 ?>" class="circular-fix has-shadow border marg-top10" 
                                            data-ussuid="<?php print base64_encode($count+1);?>" 
                                            data-backdrop="static" 
                                            data-keyboard="false" 
                                            data-upltype="avatar" style="width:150px; height:150px; object-fit: cover; object-position: center; border: 1px solid #0000ff;">
                                        </center>
                                        <div id="trash<?= $count+1; ?>">
                                            <a href="javascript:void(0)" onclick="img_unlink(this)" data-imgid="<?= $row->ID; ?>" data-id="<?= $count+1 ?>" data-img="<?= $row->Images; ?>"><i class="fa fa-trash"> Delete</i></a>
                                        </div>
                                    </div>
                            <?php
                                    $i++;
                                    endforeach;
                                }
//                                $limit = 4 - sizeof($images);
                                $limit = $this->img_limit_fix - sizeof($images);
                                for($j=0; $j<$limit; $j++){
                                    $i++;
                                    ?>
                                    <div class="col-md-3 col-xs-6 text-center" id="img_div_<?= $i; ?>">
                                        <center style="width:150px; height:150px; max-width: 150px; max-height: 150px; border: 1px solid #0000ff; cursor: pointer;" >
                                            <img src="<?= base_url(); ?>theme/web/images/ads_image.png"  alt="ads image" title="Select Image"  
                                            data-toggle="modal" 
                                            data-target="#avatar-modal" 
                                            id="render-avatar<?= $i ?>" class="circular-fix has-shadow border marg-top10" 
                                            data-ussuid="<?php print base64_encode($i);?>" 
                                            data-backdrop="static" 
                                            data-keyboard="false" 
                                            data-upltype="avatar" style="width:150px; height:150px; object-fit: cover; object-position: center;">
                                        </center>
                                        <div id="trash<?= $i; ?>">
                                            &nbsp;
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!--Image div end-->
                            
                            <?php
                                $check_store = 0;
                                if(strpos($free_ad->Video, 'http') !== false){
                                    $check_store = 1;
                                }
                                if($free_ad->Video != null){
                                    if (strpos($free_ad->Video, 'http') === false){
                                        $free_ad->Video = base_url() . 'uploads/video/' . $free_ad->Video;
                                    }
                                }else{
//                                    $ads->Video = base_url().'theme/web/images/img_avatar.png';
                                    $free_ad->Video = 'mmb.bbc.mp4';
                                }
                                ?>
<!--                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <span class="btn btn-rose btn-file">
                                            <span class="fileinput-new">Add Video</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="video_link" class="btn file_multi_video" accept="video/mp4, video/wmv, video/avi, video/mov" />
                                        </span><br>
                                       <input type="file" name="file[]" class="btn file_multi_video" accept="video/*">&nbsp;<br>
                                        <video style="width: 50%; height: auto;" controls>
                                            <source src="<?php $free_ad->Video; ?>" id="video_here">
                                        </video>
                                    </div>
                                </div>-->
                            
                            <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <span class="fileinput-new">Add Video Type</span>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="radio" name="video_sel" id="vido_sel" <?php echo (empty($check_store)) ? 'checked=""' : ''; ?> >
                                                <label for="vido_sel">Select video</label>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="radio" name="video_sel" id="video_you" <?php echo (($check_store == 1)) ? 'checked=""' : ''; ?>>
                                                <label for="video_you">Youtube link</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 col-xs-12" id="type_append">
                                                <div id="select_div">
                                                    <label for="select_video">Select video</label>
                                                    <input type="file" name="video_link" class="file_multi_video" id="select_video" accept="video/mp4, video/wmv, video/avi, video/mov" />
                                                </div>
                                                <div id="youtube_div" style="display: none;">
                                                    <label for="youtube_link">Youtube link</label>
                                                    <input type="text" id="youtube_link" name="youtube_link" class="form-control" value="<?= $free_ad->Video; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-md-12 col-xs-12">
                                                <div id="select_video_view">
                                                    <video style="width: 50%; height: auto;" controls>
                                                        <source src="mov_bbb.mp4" id="video_here">
                                                    </video>
                                                </div>
                                                <div id="video_here_youtube">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            &nbsp;<br>
                                <!--Image and video div end-->
                                <div class="card-footer text-right">
                                <div class="form-check mr-auto">
<!--                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="" required> Subscribe to newsletter
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>-->
                                </div>
                                    
                                <input type="submit" class="btn btn-rose" name="submit" value="Submit">
                            </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    }//check data then open edit form
                    else{
                        echo 'No Data Found';
                    }
                    ?>
                </div>
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/arrive.min.js"></script>
    
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="//buttons.github.io/buttons.js"></script>
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
  
   
  <script src="<?= base_url(); ?>theme/backend/build/js/intlTelInput.js"></script>
<script>
      var input = document.querySelector("#phone");
      window.intlTelInput(input, {
          // allowDropdown: false,
           autoHideDialCode: false,
//           autoPlaceholder: "off",
          // dropdownContainer: document.body,
           excludeCountries: ["us"],
           formatOnDisplay: false,
//           geoIpLookup: function(callback) {
//             $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
//               var countryCode = (resp && resp.country) ? resp.country : "";
//               callback(countryCode);
//             });
//           },
           hiddenInput: "full_number",
//           initialCountry: "auto",
//           localizedCountries: { 'de': 'Deutschland' },
           nationalMode: false,
         onlyCountries: ['au', 'in'],
//            placeholderNumberType: "MOBILE",
          // preferredCountries: ['cn', 'jp'],
//           separateDialCode: true,
          utilsScript: "<?= base_url(); ?>theme/backend/build/js/utils.js",
      });
</script>

<script>
        var input = document.querySelector("#phone1");
        window.intlTelInput(input, {
            // allowDropdown: false,
           autoHideDialCode: false,
          // autoPlaceholder: "off",
          // dropdownContainer: document.body,
          // excludeCountries: ["us"],
           formatOnDisplay: false,
//           geoIpLookup: function(callback) {
//             $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
//               var countryCode = (resp && resp.country) ? resp.country : "";
//               callback(countryCode);
//             });
//           },
          // hiddenInput: "full_number",
          // initialCountry: "auto",
          // localizedCountries: { 'de': 'Deutschland' },
           nationalMode: false,
          onlyCountries: ['au', 'in'],
//            placeholderNumberType: "MOBILE",
          // preferredCountries: ['cn', 'jp'],
//           separateDialCode: true,
            utilsScript: "<?= base_url(); ?>theme/backend/build/js/utils.js",
        });
    </script>
  
  <!--this under use script all category select to link scripting use-->
  <script src="<?= base_url(); ?>/theme/backend/tree-view/js/bootstrap-treeview.js"></script>
<!--Tree view pattern json-->
<script type="text/javascript">
$(document).ready(function(){
   var tree;
   $.ajax({
        type: "GET",  
        url: "<?= site_url('/getItem'); ?>",
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
    //$('#category_view').val(vt);
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
  
<!--video upload and view-->
<script>
$(document).on("change", ".file_multi_video", function(evt) {
    var $source = $('#video_here');
    $source[0].src = URL.createObjectURL(this.files[0]);
    $source.parent()[0].load();
  });
</script>

<!--Image delete via ajax to call function and delete image-->
<script>
function image_del(current){
 var id = $(current).data('id');    
//alert('hello-'+id);
    $.ajax({
        url:'<?= site_url('admin/AdvertisementController/delete_ads_image'); ?>',
        type:'post',
        data:{id:id},
        success:function(data){
            $('#image'+id).remove();
           // alert('hello-'+id);
        }
    });
}
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
       
   // var latitude = position.coords.latitude;
   // var longitude = position.coords.longitude;
    
	<?php
	if(!empty($free_ad->LatLong)){
		echo 'var latlng = new google.maps.LatLng('. $free_ad->LatLong .');';
	}else{
		echo 'var latlng = new google.maps.LatLng(-33.865143, 151.209900);';
	}
	?>
	  
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



<script>
function img_unlink(name){
    var img = $(name).data('img');
    var img_div_id = $(name).data('id');
    var img_id = $(name).data('imgid');
    //alert(img_id);
    $.ajax({
        url:'<?= site_url('Crop/delete_img_unlink'); ?>',
        type:'post',
        data:{img_name:img,type:'edit',id:img_id},
        success:function(data){
           // alert(data);
            $('#img_div_'+img_div_id).empty();
            $('#trash'+img_div_id).empty();
            $('#trash'+img_div_id).append("&nbsp;");
            var i;
//            var image_limit = <?= $this->img_limit_fix; ?>;
            var image_limit = <?= sizeof($images); ?>;
            for(i=1;i<=image_limit;i++){
                if(img_div_id == i){
                    $('#img_div_'+img_div_id).html('<img src="<?= base_url(); ?>theme/web/images/ads_image.png"  alt="ads image" title="Select Image"\n\
                     data-toggle="modal"\n\
                     data-target="#avatar-modal"\n\
                     id="render-avatar'+img_div_id+'" class="circular-fix has-shadow border marg-top10"\n\
                     data-ussuid="'+btoa(i)+'"\n\
                     data-backdrop="static"\n\
                     data-keyboard="false"\n\
                     data-upltype="avatar" style="width:148px; height:148px; object-fit: cover; object-position: center; border: 1px solid #0000ff;">');
                }
            }

        }
    });
}
</script>


<script>
 $(document).ready(function() {
     var video_sel_div = <?php echo $check_store; ?>; //value hone pr youtube link hoga
         if(video_sel_div){
//            $('#youtube_link').attr('required','true');
//            $('#select_video').removeAttr('required','false');
            $('#select_div').hide();
            $('#youtube_div').show();
            $('#select_video_view').empty();
            $('#select_video').val('');
            
         }else{
//            $('#youtube_link').removeAttr('required','false');
//            $('#select_video').attr('required','true');
            $('#select_div').show();
            $('#youtube_div').hide();
            $('#youtube_link').val('');
            $('#video_here_youtube').empty();
            $('#source_link_add').empty();
            $('#select_video_view').html('<video style="width: 50%; height: auto;" controls id="source_link_add"><source src="<?= $free_ad->Video; ?>" id="video_here"></video>');
         }
     
     //video type select then open type link
    $('#vido_sel').click(function(){
//        $('#youtube_link').removeAttr('required','false');
//        $('#select_video').attr('required','true');
        $('#select_div').show();
        $('#youtube_div').hide();
        $('#youtube_link').val('');
        $('#video_here_youtube').empty();
        $('#source_link_add').empty();
//        $('#select_video_view').show();
        $('#select_video_view').html('<video style="width: 70%; height: auto;" controls id="source_link_add"><source src="<?= $free_ad->Video; ?>" id="video_here"></video>');
        
    });
    $('#video_you').click(function(){
//        $('#youtube_link').attr('required','true');
//        $('#select_video').removeAttr('required','false');
        $('#select_div').hide();
        $('#youtube_div').show();
        $('#select_video_view').empty();
        $('#select_video').val('');
    });
 });
</script>

<script>
$(document).ready(function(){
    var video_sel_div = <?php echo $check_store; ?>;
    
    if(video_sel_div){
        var link = '<?= $free_ad->Video; ?>';
        var myId = getId(link);
        
        $('#video_here_youtube').html('<iframe width="560" height="315" src="//www.youtube.com/embed/' + myId + '" frameborder="0" allowfullscreen></iframe>');
    }
    
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

<!--<script src="//cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script>
    //CKEDITOR.replace( 'editor1' ); //edit ads in show
    CKEDITOR.replace( 'editor2' ); //edit ads in show
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
    var baseurl = "<?php echo site_url(); ?>";
    var ad_id = "<?= $free_ad->ID; ?>";
    var image_limit = <?= $this->img_limit_fix; ?>
</script>
    
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.js"></script>
<script src="<?= base_url(); ?>theme/plugin/crop/js/cropper.js"></script>
<script src="<?= base_url(); ?>theme/plugin/crop/js/main.js"></script>
<?php
$this->load->view('crop/profileAvatar');
?>