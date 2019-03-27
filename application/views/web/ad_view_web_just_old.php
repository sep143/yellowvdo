<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
<!--Popup Box open if select delete button and open popup and confirm than delete data-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>theme/web/css/ninja-slider.css">
<script src="<?= base_url(); ?>theme/web/js/ninja-slider.js"></script>

<style>
    li.item > img{
    max-width: 100%;
    max-height: 100%;
    height: inherit !important;
    object-fit: contain;
    width: auto!important;
    height: auto!important;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
@media (max-width: 768px){
    .nav {
     float: none; 
    }
}

h2{
  color:#002f34;  
}

a.quick-link {
    word-wrap: break-word; 
    color: rgba(0,47,52,.7); 
    font-weight: 400;
}
    
</style>
<?php
if($ad_view){
?>
<section class="single-detail">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-6 col-sm-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="item single-ads">
                            <div class="item-ads-grid margin-bottom-none">
                                <div class="item-title-single">
                                    <h2 style="color:#002f34;"><b><?= $ad_view->CaptionLine; ?></b></h2>
                                    <div class="item-meta">
                                        <ul style="color: rgba(0,47,52,.7); font-weight: 400;">
                                            <li class="item-date"><i class="fa fa-clock-o"></i> <?= date('d-M-Y', strtotime($ad_view->CreatedDT)); ?></li>
                                            <!--<li class="item-cat"><i class="fa fa-glass"></i> <a href="./categories2.html">Restaurant</a> , <a href="./categories2.html">Cafe</a></li>-->
                                            <li class="item-location"><i class="fa fa-map-marker"></i> <?= $ad_view->State.', '.$ad_view->Country; ?> </li>
                                            <li class="item pull-right"><span class="btn btn-xs btn-success"><?php if(!empty($review_count->review)) {echo number_format($review_count->review,2); }else{ echo '0';} ?></span> &nbsp;&nbsp;
                                                <?php
                                                if(!empty($review_count->review)){
                                                    $count = 5-$review_count->review;
                                                    
                                                    for($i=1;$i<=$review_count->review;$i++){
                                                        echo '<span class="fa fa-star"></span>';
                                                    }
                                                    for($j=1;$j<=$count;$j++){
                                                        echo '<span class="fa fa-star-o"></span>';
                                                    }
                                                }else{
                                                    for($i=1;$i<=5;$i++){
                                                        echo '<span class="fa fa-star-o"></span>';
                                                    }
                                                }
                                                
                                                ?>
<!--                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star-o"></span>
                                                <span class="fa fa-star-o"></span>-->
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="item-img-grid">
                                    <div class="favourite-icon">
                                       <!--<a class="fav-btn" title="" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Save Ad">115 <i class="fa fa-heart"></i></a>-->
                                    </div>
                                    
                                    <?php
                                $check_store = 0;
                                if(strpos($ad_view->Video, 'http') !== false){
                                    $check_store = 1;
                                }
                                if($ad_view->Video != null){
                                    if (strpos($ad_view->Video, 'http') === false){
                                        $ad_view->Video = base_url() . 'uploads/video/' . $ad_view->Video;
                                    }
                                }else{
//                                    $ads->Video = base_url().'theme/web/images/img_avatar.png';
                                    $ad_view->Video = 'mmb.bbc.mp4';
                                }
                                ?>
                                    
                                    <div id="sync1" class="owl-carousel">
                                        <?php
                                        if(empty($check_store)){
                                            ?>
                                        <div class="item">
                                            <center>
                                                <video style="width: 100%; height: 400px; object-fit: cover;" controls onclick="lightbox(0)">
                                                    <source src="<?= $ad_view->Video; ?>" >
                                                </video>
                                            </center>
                                        </div>
                                        <?php
                                        }else if($check_store == 1){
                                            ?>
                                        <div class="item">
                                            <center id="video_here_youtube"></center>
                                        </div>
                                        <?php
                                            
                                        } //video condition check end if
                                        ?>
                                        <!--Images get and view-->
                                        <?php
                                        if($images){
                                            $i=1;
                                            foreach ($images as $row):
                                                echo '<div class="item"><center><img alt="" src="'.  base_url().'uploads/ads/'.$row->Images.'" '
                                                    . 'style="width:auto; height:400px; object-fit: cover; object-position: center;" '
                                                    . 'class="img-responsive img-center"'
                                                    . ' onclick="lightbox('.$i.')"></center></div>';
                                            $i++;
                                            endforeach;
                                        }
                                        ?>
                                        <!--<div class="item"><center><img alt="" src="./images/single-ads/big/1.png" class="img-responsive img-center"></center></div>-->
                                        
                                    </div>
                                    <div id="sync2" class="owl-carousel" style="height: 130px; margin-left: 2px;">
                                        <?php
                                         if(empty($check_store)){
                                             ?>
                                        <div class="item">
                                            <video style="width: 100%; height: 120px;" controls>
                                                <source src="<?= $ad_view->Video; ?>" >
                                            </video>
                                        </div>
                                        <?php
                                         }else if($check_store == 1){
                                             ?>
                                        <div class="item">
                                            <div id="video_here_youtube2"></div>
                                        </div>
                                        <?php
                                         } //video condition check
                                        ?>
                                        
                                        <!--Images get and view-->
                                        <?php
                                        if($images){
                                            foreach ($images as $row):
                                                echo '<div class="item" style="margin-top:7px; margin-left:2px;"><center><img alt="" src="'.  base_url().'uploads/ads/_thumb/'.$row->Images.'" style="width:auto; height:120px; object-fit: cover; object-position: center;" class="img-responsive img-center"></center></div>';
                                            endforeach;
                                        }
                                        ?>
                                        <!--<div class="item"><img alt="" src="./images/single-ads/big/1.png" class="img-responsive img-center"></div>-->
                                    </div>
                                </div>
                                <div class="single-item-meta">
<!--                          <h4><strong>Spesification</strong></h4>
                                <table class="table table-condensed table-hover table-bordered">
                                   <tbody>
                                      <tr>
                                         <td>Classified ID</td>
                                         <td>012345</td>
                                      </tr>
                                      <tr>
                                         <td>Condition</td>
                                         <td>New</td>
                                      </tr>
                                      <tr>
                                         <td>Brand</td>
                                         <td>Samsung</td>
                                      </tr>
                                      <tr>
                                         <td>Payments</td>
                                         <td>PayPal, Credit Card</td>
                                      </tr>
                                   </tbody>
                                </table>-->

                                    <div class="panel with-nav-tabs panel-default">
                                        <div class="panel-heading">
                                            <ul class="nav nav-tabs">
                                                <li class="active col-md-6 col-xs-6 text-center"><a href="#description" data-toggle="tab">Description</a></li>
                                                <!--<li class="col-md-4 col-xs-12 text-center"><a href="#tab2default" data-toggle="tab">Enquiry</a></li>-->
                                                <li class="col-md-6 col-xs-6 text-center"><a href="#review" data-toggle="tab">Review</a></li>
                    <!--                            <li><a href="#tab3default" data-toggle="tab">Default 3</a></li>
                                                <li class="dropdown">
                                                    <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#tab4default" data-toggle="tab">Default 4</a></li>
                                                        <li><a href="#tab5default" data-toggle="tab">Default 5</a></li>
                                                    </ul>
                                                </li>-->
                                            </ul>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade in active" id="description">
                                                    <h4><strong>Description</strong></h4>
                                                    <p><?= $ad_view->Description; ?></p>
                                                </div>
                                                <!--Enquiry submit div-->
<!--                                                <div class="tab-pane fade" id="tab2default">
                                                    <form>
                                                        <div class="form-group">
                                                            <label class="control-label">Name <span class="required">*</span></label>
                                                            <input type="text" placeholder="Full Name" class="form-control" required="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Email <span class="required">*</span></label>
                                                            <input type="email" placeholder="Email Address" class="form-control" required="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Phone No. <span class="required">*</span></label>	
                                                            <input type="number" placeholder="Phone No." class="form-control" required="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Message <span class="required">*</span></label>	
                                                            <textarea class="form-control" rows="5" required=""></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-block btn-lg btn-primary">Enquiry</button>
                                                        </div>
                                                    </form>
                                                </div>-->
                                                
                                                <div class="tab-pane fade" id="review">
                                                    <!--<form id="review_form" action="<?= site_url('review'); ?>" method="post">-->
                                                    <form id="review_form" action="" method="get">
                                                        <input type="hidden" id="adid" name="adid" value="<?= $ad_view->ID; ?>">
                                                        <input type="hidden" id="lat" name="lat">
                                                        <input type="hidden" id="long" name="long">
                                                        <div class="row">
                                                            <div class="col-md-3" style="margin-top: 0px;">
                                                                <b>Star Rating : <label> (<span id="star_view">0</span>) </label></b>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input id="input-1" name="rating" required="" class="rating rating-loading" value="0" data-min="0" data-max="5" data-step="1" data-size="xs">
                                                                <script>
                                                                    $('#input-1').on('change', function (){
                                                                        var rat = $(this).val();
                                                                        $('#star_view').text(rat);
                                                                        });
                                                                    $("#input-1").rating();
                                                                    $('.caption').remove();
                                                                    $('.rating-container').addClass('pull-left');

                                                                </script>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="text-left">
                                                                    <span> Comment : </span><br><br>
                                                                    <textarea class="rew-txt" id="comment" name="comment" rows="5" placeholder="Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat." id="wrereview" style="border: 1px solid #4611A7; width: 100%; padding: 5px;"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        &nbsp; <br>
                                                        <div class="form-group">
                                                            <button type="button" id="btn-submit" onclick="submit_rating(this)" class="btn btn-block btn-lg btn-primary1" style="position: relative;">Submit 
                                                                <img id="img-loder" class="hidden" style="height: 15px!important;" src="<?php echo base_url('theme/web/images/loader.gif');?>">
                                                            </button>
                                                            
                                                        </div>
                                                    </form>
                                                    <!--Rating start div and script down side-->
                                                    <hr>
                                                    <?php
                                                    if(!empty($review)){
                                                        foreach ($review as $row):
                                                            ?>
                                                        <div class="row hover">
                                                            <div class="col-md-12">
                                                                <div class="col-md-2">
                                                                    <img src="<?= base_url(); ?>theme/web/images/img_avatar.png" style="width: 60px; height: auto; image-resolution: snap;" alt="" class="img img-circle">
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <p><b>User : Rating <?= $row->Rating; ?>
                                                                    &nbsp;[<?php
                                                                        $count = 5-$row->Rating;
                                                    
                                                                        for($i=1;$i<=$row->Rating;$i++){
                                                                            echo '<span class="fa fa-star"></span>';
                                                                        }
                                                                        for($j=1;$j<=$count;$j++){
                                                                            echo '<span class="fa fa-star-o"></span>';
                                                                        }
                                                                    ?>]
                                                                    </b><small class="pull-right"><?= date('h:i a, d-M-Y', strtotime($row->CreatedDT)); ?></small><p>
                                                                    <p><?= $row->Comment; ?></p>
                                                                </div>
                                                            </div>
                                                        </div><hr>
                                                    <?php
                                                        endforeach;
                                                    }
                                                    ?>
                                                    <!--Rating end div-->
                                                </div>
                                                <!--                                                <div class="tab-pane fade" id="tab4default">Default 4</div>
                                                                                                <div class="tab-pane fade" id="tab5default">Default 5</div>-->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="item-footer">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-5">
                                           <!--<span class="item-views"> <i class="fa fa-eye"></i> Ad Views : <b>6544</b></span>-->
                                            <!--<a class="item-views btn btn-primary"> <i class="fa fa-eye"></i> Ad Claim </a>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <!--                  <div class="price-widget short-widget">
                                     <i class="fa fa-dollar"></i>
                                     <strong>235.00</strong>
                                  </div>-->
                <div class="widget user-widget">
                    <div class="widget-body text-center">
                        <?php
                            if(!empty($ad_view->image)){
                                $image = base_url().'uploads/ads/'.$ad_view->image;
                            }else{
                                $image = base_url().'theme/web/images/banner_design.png';
                            }
                            ?>
                        <img class="user-dp" alt="Ad Image" src="<?= $image; ?>">
<!--                        <span class="user-status user-online"></span>
                         <span class="user-status user-offline"></span> -->
                        <h2 class="seller-name"><b><?= $ad_view->BusinessName; ?></b></h2>
                        <p class="seller-detail">
<!--                           <i class="fa fa-map-marker"></i> Location: <strong>Orlando</strong><br>
                           <i class="fa fa-clock-o"></i> Joined : <strong>21 June 2017</strong>-->
                        </p>
                    </div>
                    <div class="widget-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="trends" style="color: rgba(0,47,52,.7); font-weight: 400;">
                                    <?php
                                    if($ad_view->WhatsAppNoShow == 1){
                                        if(!empty($ad_view->WhatsAppNo) && (strlen($ad_view->WhatsAppNo)>3)){
                                            if(!empty($ad_view->WhatsAppNo)){
                                                $lt= explode('+', $ad_view->WhatsAppNo);
                                                }else{
                                                    $lt= explode('+', '0');
                                                }
                                                    echo '<li><a href="https://api.whatsapp.com/send?phone='.$lt[1].'&text=&source=&data=" target="_blank" style="color: rgba(0,47,52,.7); font-weight: 400;"><i class="fa fa-fw fa-whatsapp" style="color: #4611A7;"></i> &nbsp;'.$ad_view->WhatsAppNo.'</a></li>';
                                                }
                                            else {
                                                echo '<li><a href="" target="_blank" style="color: rgba(0,47,52,.7); font-weight: 400;"><i class="fa fa-fw fa-whatsapp" style="color: #4611A7;"></i> &nbsp;'.$ad_view->WhatsAppNo.'XXXXXXXXXX</a></li>'; 
                                        }
                                    }else{
                                       // echo '<li><a href="#"><i class="fa fa-fw fa-whatsapp"></i>*****</a></li>';
                                    }
                                    
                                    if($ad_view->CellNoShow == 1) {
                                        if (!empty($ad_view->CellNo) && (strlen($ad_view->CellNo) > 3)) {
                                            echo '<li><a href="tel:' . $ad_view->CellNo . '" style="color: rgba(0,47,52,.7); font-weight: 400;"><i class="fa fa-fw fa-mobile" style="color: #4611A7;"></i> &nbsp;' . $ad_view->CellNo . '</a></li>';
                                        } else {
                                            echo '<li><a href="tel:" style="color: rgba(0,47,52,.7); font-weight: 400;"><i class="fa fa-fw fa-mobile" style="color: #4611A7;"></i> &nbsp;' . $ad_view->CellNo . 'XXXXXXXXXX</a></li>';
                                        }
                                    } else {
        // echo '<li><a href="#" ><i class="fa fa-fw fa-mobile"></i> *****</a></li>';
                                    }
                                    
                                    if($ad_view->LandLineShow == 1){
                                        if(!empty($ad_view->LandLine) && (strlen($ad_view->LandLine)>3)){
                                            echo '<li><a href="tel:'.$ad_view->LandLine.'" style="color: rgba(0,47,52,.7); font-weight: 400;"><i class="fa fa-fw fa-tty" style="color: #4611A7;"></i> &nbsp;'.$ad_view->LandLine.'</a></li>';
                                        }else {
                                            echo '<li><a href="tel:" style="color: rgba(0,47,52,.7); font-weight: 400;"><i class="fa fa-fw fa-tty" style="color: #4611A7;"></i> &nbsp;'.$ad_view->LandLine.'XXXXXXXXXXXXX</a></li>';
                                        }
                                    }else{
                                       // echo '<li><a href="#" ><i class="fa fa-fw fa-tty"></i>*****</a></li>';
                                    }
                                    
                                    if($ad_view->EmailShow == 1){
                                        if(!empty($ad_view->Email)){
                                            echo '<li><a href="mailto:'.$ad_view->Email.'" style="color: rgba(0,47,52,.7); font-weight: 400;"><i class="fa fa-fw fa-envelope" style="color: #4611A7;"></i> &nbsp;'.$ad_view->Email.'</a></li>';
                                        }
                                        else{
                                            echo '<li><a href="#" style="color: rgba(0,47,52,.7); font-weight: 400;"><i class="fa fa-fw fa-envelope" style="color: #4611A7;"></i> xxxxxxxx@xxxx.xxx</a></li>';
                                        }
                                    }else{
                                       // echo '<li><a href="#" ><i class="fa fa-fw fa-envelope"></i> *****@domain.***</a></li>';
                                    }
                                    
                                    if($ad_view->BusinessAddressShow == 1){
                                        if(!empty($ad_view->BusinessAddress)){
                                            echo '<li><i class="fa fa-fw fa-map-marker" style="color: #4611A7;"></i> &nbsp;'.$ad_view->BusinessAddress.'</li>';
                                        }
                                    }else{
                                       // echo '<li><a href="#"><i class="fa fa-fw fa-map-marker"></i> <u>Address:</u> ***** </a></li>';
                                    }
                                    ?>
                                </ul>
<!--                                                              <div class="profile-action-btns text-center">
                                                                 <a href="#" data-toggle="tooltip" data-placement="top" title="0133 4568 9876" class="btn btn-primary btn-lg"><i class="fa fa-whatsapp"></i></a>
                                                                 <a href="#" data-toggle="tooltip" data-placement="top" title="Send Message" class="btn btn-primary btn-lg"><i class="fa fa-envelope-o"></i></a>
                                                                 <a data-toggle="collapse" data-parent="#accordion" href="#popup" title="Live Chat" class="btn btn-primary btn-lg"><i class="fa fa-comment-o"></i></a>
                                                              </div>-->
                            </div>
                        </div>
                    </div>
                </div>

<!--                                  <div class="listing-filters">
                                     <div class="widget listing-filter-block">
                                        <div class="widget-header">
                                           <h1>Similar ads</h1>
                                        </div>
                                        <div class="widget-body">
                                                                   <div class="similar-ads">
                                              <a href="single.html">
                                                 <div class="similar-ad-left">
                                                    <img class="img-responsive img-center" src="./images/categories/cars/1.png" alt="">
                                                 </div>
                                                 <div class="similar-ad-right">
                                                    <h4>Duis autem vel eum iriure dolor in hendrerit in vulputate velit .</h4>
                                                    <p><i class="fa fa-dollar"></i> 450 - <i class="fa fa-map-marker"></i> Buffalo </p>
                                                 </div>
                                                 <div class="clearfix"></div>
                                              </a>
                                           </div>	
                                           <div class="similar-ads">
                                              <a href="single.html">
                                                 <div class="similar-ad-left">
                                                    <img class="img-responsive img-center" src="./images/categories/restaurant/1.png" alt="">
                                                 </div>
                                                 <div class="similar-ad-right">
                                                    <h4>Duis autem vel eum iriure dolor in hendrerit in vulputate velit .</h4>
                                                    <p><i class="fa fa-dollar"></i> 450 - <i class="fa fa-map-marker"></i> Buffalo </p>
                                                 </div>
                                                 <div class="clearfix"></div>
                                              </a>
                                           </div>
                                           <div class="similar-ads">
                                              <a href="single.html">
                                                 <div class="similar-ad-left">
                                                    <img class="img-responsive img-center" src="./images/categories/pets/1.png" alt="">
                                                 </div>
                                                 <div class="similar-ad-right">
                                                    <h4>Duis autem vel eum iriure dolor in hendrerit in vulputate velit .</h4>
                                                    <p><i class="fa fa-dollar"></i> 450 - <i class="fa fa-map-marker"></i> Buffalo </p>
                                                 </div>
                                                 <div class="clearfix"></div>
                                              </a>
                                           </div>
                                           <div class="similar-ads">
                                              <a href="single.html">
                                                 <div class="similar-ad-left">
                                                    <img class="img-responsive img-center" src="./images/categories/real_estate/2.png" alt="">
                                                 </div>
                                                 <div class="similar-ad-right">
                                                    <h4>Duis autem vel eum iriure dolor in hendrerit in vulputate velit .</h4>
                                                    <p><i class="fa fa-dollar"></i> 450 - <i class="fa fa-map-marker"></i> Buffalo </p>
                                                 </div>
                                                 <div class="clearfix"></div>
                                              </a>
                                           </div>
                                           <div class="similar-ads">
                                              <a href="single.html">
                                                 <div class="similar-ad-left">
                                                    <img class="img-responsive img-center" src="./images/categories/cars/1.png" alt="">
                                                 </div>
                                                 <div class="similar-ad-right">
                                                    <h4>Duis autem vel eum iriure dolor in hendrerit in vulputate velit .</h4>
                                                    <p><i class="fa fa-dollar"></i> 450 - <i class="fa fa-map-marker"></i> Buffalo </p>
                                                 </div>
                                                 <div class="clearfix"></div>
                                              </a>
                                           </div>
                                           <div class="similar-ads">
                                              <a href="single.html">
                                                 <div class="similar-ad-left">
                                                    <img class="img-responsive img-center" src="./images/categories/job/1.png" alt="">
                                                 </div>
                                                 <div class="similar-ad-right">
                                                    <h4>Duis autem vel eum iriure dolor in hendrerit in vulputate velit .</h4>
                                                    <p><i class="fa fa-dollar"></i> 450 - <i class="fa fa-map-marker"></i> Buffalo </p>
                                                 </div>
                                                 <div class="clearfix"></div>
                                              </a>
                                           </div>
                                        </div>
                                     </div>
                                  </div>-->
                <!--if any url never link then box hide-->
                <?php
                if(!empty($ad_view->Url1) || !empty($ad_view->Url2) || !empty($ad_view->Url3) || !empty($ad_view->Url4) || !empty($ad_view->Url5))
                {
                ?>                
                <div class="widget listing-filter-block filter-categories margin-bottom-none">
                    <div class="widget-header">
                        <h2><b>Quick Links</b></h2>
                    </div>
                    <div class="widget-body">
                        <ul class="trends">
                            <?php
                            if($ad_view->Url1Show == 1){
                                if(!empty($ad_view->Url1))
                                echo '<li><a href="'.$ad_view->Url1.'" style="word-wrap: break-word; color: rgba(0,47,52,.7); font-weight: 400;" target="_blank"><i class="fa fa-fw fa-globe" style="color: #4611A7;"></i> '.$ad_view->Url1.'</a></li>';
                            }
                            if($ad_view->Url2Show == 1){
                                if(!empty($ad_view->Url2))
                                echo '<li><a href="'.$ad_view->Url2.'" style="word-wrap: break-word; color: rgba(0,47,52,.7); font-weight: 400;" target="_blank"><i class="fa fa-fw fa-globe" style="color: #4611A7;"></i> '.$ad_view->Url2.'</a></li>';
                            }
                            if($ad_view->Url3Show == 1){
                                if(!empty($ad_view->Url3))
                                echo '<li><a href="'.$ad_view->Url3.'" style="word-wrap: break-word; color: rgba(0,47,52,.7); font-weight: 400;" target="_blank"><i class="fa fa-fw fa-globe" style="color: #4611A7;"></i> '.$ad_view->Url3.'</a></li>';
                            }
                            if($ad_view->Url4Show == 1){
                                if(!empty($ad_view->Url4))
                                echo '<li><a href="'.$ad_view->Url4.'" style="word-wrap: break-word; color: rgba(0,47,52,.7); font-weight: 400;" target="_blank"><i class="fa fa-fw fa-globe" style="color: #4611A7;"></i> '.$ad_view->Url4.'</a></li>';
                            }
                            if($ad_view->Url5Show == 1){
                                if(!empty($ad_view->Url5))
                                echo '<li><a href="'.$ad_view->Url5.'" style="word-wrap: break-word; color: rgba(0,47,52,.7); font-weight: 400;" target="_blank"><i class="fa fa-fw fa-globe" style="color: #4611A7;"></i> '.$ad_view->Url5.'</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <?php
                }//if koi bhi url nahi milta heto he div hide ho jayega
                ?>
                &nbsp;<br>
                <div class="widget listing-filter-block filter-categories margin-bottom-none">
                    <div class="widget-header">
                        <h2><b>Share</b></h2>
                    </div>
                    <div class="widget-body">
                        <div class="social-links social-bg ">
                            <ul>
                                <li><a class="fa fa-twitter" target="_blank" href="http://www.twitter.com/share?text=Im sharing on Twitter&url=<?= base_url(uri_string());?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"></a></li>
                                <li><a class="fa fa-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url(uri_string());?>&t=<?= $ad_view->BusinessName; ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"></a></li>
                                <!--<li><a class="fa fa-google-plus" target="_blank" href="https://plus.google.com/share?url=<?= base_url(uri_string());?>&content=Sharing my ad" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"></a></li>-->
                                <li><a class="fa fa-linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?= base_url(uri_string());?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"></a></li>
                                <li>
                                    <a class="fa fa-whatsapp" target="_blank" href="https://wa.me/?text=<?= $ad_view->CaptionLine; ?>, click the below link to see details of ad - <?= base_url(uri_string());?>, send from YellowVdo" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"></a></li>
                                <!--<li><a href="https://api.whatsapp.com/send?phone=+910000000000&text=Hi, I contacted you Through your website." class="social-icon whatsapp"></a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
                &nbsp;<br>
                <div class="widget listing-filter-block filter-categories margin-bottom-none">
                    <div class="widget-header">
                        <h2><b>Posted in</b></h2>
                    </div>
                    <div class="widget-body">
                        <div class="row" style="margin-top: -20px; margin-bottom: -13px; line-height: initial; color: rgba(0,47,52,.7); font-weight: 400;">
                            <div class="col-md-12 col-xs-12">
                                <small><?= $ad_view->BusinessAddress; ?></small>
                            </div>
                        </div>
                        <hr>
                        <?php
                        $latlong = ',';
                        if(!empty($ad_view->LatLong)){
                            $latlong = $ad_view->LatLong;
                            $add = $ad_view->BusinessAddress;
                        }
                        ?>
                        <div style="width: 100%;">
<!--                            <iframe src = "https://www.google.com/maps/embed/v1/place?q=<?= $latlong; ?>&amp;key=AIzaSyDF8WvqWLINfF3CG_B46R9YaGotAMMXqPU"></iframe>
                            <iframe src = "https://maps.google.com/maps?q=<?= $latlong; ?>&hl=es;z=14&amp;output=embed"></iframe>-->
                            <iframe width="100%" height="300" src="https://maps.google.com/maps?q=<?= $add; ?>&hl=es;z=14&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                            <a href="https://www.maps.ie/map-my-route/">Create a route on google maps</a>
                            </iframe>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

<!-- Image Light Box -->
<div style="display:none;">
    <div id="ninja-slider">
        <div class="slider-inner">
            <ul>
                <?php
                   if(empty($check_store)){
                       ?>
                  <li class="item">
                      <video style="width: 100%; height: 100%;" controls>
                          <source src="<?= $ad_view->Video; ?>" >
                      </video>
                  </li>
                  <?php
                   }else if($check_store == 1){
                       ?>
                  <li class="item">
                      <div id="video_here_youtube3"></div>
                  </li>
                  <?php
                   } //video condition check
                  ?>
                  
                  <!--Images get and view-->
                  <?php
                  if($images){
                   
                      foreach ($images as $row):
                          echo '<li class="item"><img alt="" src="'.  base_url().'uploads/ads/'.$row->Images.'" style="max-width:auto; max-height:100%; vertical-align: middle;"></li>';
                      endforeach;
                  }
                  ?>
                <!-- <li>
                    <a class="ns-img" href="img/abc.jpg"></a>
                    <div class="caption">
                        <h3>Dummy Caption 1</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus accumsan purus.</p>
                    </div>
                </li> -->
                
            </ul>
            <div id="fsBtn" class="fs-icon" title="Expand/Close"></div>
        </div>
    </div>
</div>

<!--if youtube video play then call function-->

<script>
$(document).ready(function(){
    var video_sel_div = <?php echo $check_store; ?>;
    
    if(video_sel_div){
        var link = '<?= $ad_view->Video; ?>';
        var myId = getId(link);
        
        $('#video_here_youtube').html('<iframe width="100%" height="400" src="//www.youtube.com/embed/' + myId + '" frameborder="0" allowfullscreen></iframe>');
        $('#video_here_youtube3').html('<iframe width="100%" height="500" src="//www.youtube.com/embed/' + myId + '" frameborder="0" allowfullscreen></iframe>');
        $('#video_here_youtube2').html('<iframe width="100%" height="120" src="//www.youtube.com/embed/' + myId + '" frameborder="0" allowfullscreen></iframe>');
    }
    
//    $('#youtube_link').on('keyup', function() {
//        var link = $(this).val();
//        var myId = getId(link);
//        
//        $('#video_here_youtube').html('<iframe width="560" height="315" src="//www.youtube.com/embed/' + myId + '" frameborder="0" allowfullscreen></iframe>');
//        console.log(link);
//    });
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

<!--Slider image view script-->
<script>
    function lightbox(idx) {
        //show the slider's wrapper: this is required when the transitionType has been set to "slide" in the ninja-slider.js
        var ninjaSldr = document.getElementById("ninja-slider");
        ninjaSldr.parentNode.style.display = "block";

        nslider.init(idx);

        var fsBtn = document.getElementById("fsBtn");
        fsBtn.click();
    }

    function fsIconClick(isFullscreen, ninjaSldr) { //fsIconClick is the default event handler of the fullscreen button
        if (isFullscreen) {
            ninjaSldr.parentNode.style.display = "none";
        }
    }
</script>

<!--Rating star for script start-->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<script>
    function submit_rating(current){
        var adid = $('#adid').val();
        var lat = $('#lat').val();
        var long = $('#long').val();
        var rating = $('#input-1').val();
        var comment = $('textarea#comment').val();
        //alert(comment);
        if(rating != ''){
             $.ajax({
                    url:'<?= site_url('review');?>',
                    type:'post',
                    data:{adid:adid,lat:lat,long:long,rating:rating,comment:comment},
                    beforeSend:function() {
                        $("#btn-submit").attr("disabled","true");
                        $("#img-loder").removeClass("hidden");
                    },
                    success:function(data){
                        if(data == 1){
                            $("#img-loder").addClass("hidden");
                            $.alert({
                                animation: 'zoom',
                                icon:'fa fa-check-circle',
                                title: 'Review Submit',
                                content: 'Thanks for this ad review',
                                theme: 'modern',
                            });
                            
                        }else{
                            $("#img-loder").addClass("hidden");
                            $.alert({
                                animation: 'zoom',
                                icon:'fa fa-warning',
                                title: 'Review Already Submit',
                                content: 'Sorry one device to one time revice submit',
                                theme: 'modern',
                            });
                        }
                    },
                    complete:function () {
                        $("#btn-submit").removeAttr("disabled");
                        $("#comment").val("");
                        $('#star_view').text("0");
                        $(".filled-stars").css("width","0%");
                    }
                });
        }else{
            $.alert({
                animation: 'zoom',
               // icon:'fa fa-check-circle',
                title: 'Select Star',
                content: 'Please select star',
               // theme: 'modern',
            });
        }
       
    }
</script>
<!--Rating star for script end-->        
        
        
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

<script>
function initialize(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
//    $('#lat').val(latitude);
//    $('#long').val(longitude);
}
</script>

<?php
}//if condition check 
else{
    $this->load->view('error');
}
?>