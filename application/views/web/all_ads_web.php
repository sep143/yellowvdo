 <style>
  .glyphicon { margin-right:5px; }
.thumbnail
{
    margin-bottom: 20px;
    padding: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
}

.item.list-group-item
{
    float: none;
    width: 100%;
    background-color: #fff;
    margin-bottom: 10px;
}
.item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
{
    //background: #428bca;
    border: 1px solid #0000ff;
}
.item{
    transition: transform 1s;
    max-width: 100%;
  //padding: 10px;
  -moz-transition: all 0.3s;
  -webkit-transition: all 0.3s;
  //transition: all 0.3s;
}

.item:hover{
   border-radius: 12px;
   /*box-shadow: 2px 2px 2px #4611A7;*/
   box-shadow: 2px 2px 2px #fbd800;
   transform: scale(1.02);
    -ms-transform: scale(1.02); // IE 9 
  -webkit-transform: scale(1.02); // Safari 3-8 
}

.item.list-group-item .list-group-image
{
    margin-right: 10px;
}
.item.list-group-item .thumbnail
{
    margin-bottom: 0px;
}
.item.list-group-item .caption
{
    padding: 9px 9px 0px 9px;
}
.item.list-group-item:nth-of-type(odd)
{
   // background: #eeeeee;
}

.item.list-group-item:before, .item.list-group-item:after
{
    display: table;
    content: " ";
}

.item.list-group-item img
{
    float: left;
}
.item.list-group-item:after
{
    clear: both;
}
.list-group-item-text
{
    margin: 0 0 11px;
}

//all ads show in div bottom to set
.ads-div-tel-email {
    position: absolute;
    bottom: -80%;
    width: 100%;
}

.container-grid-body{
    height: 160px!important;
}
.container-grid-img{
    height: 242px!important;
}
        </style>


<!-- Search Box -->
<section class="search-box">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <img src="<?= base_url(); ?>theme/web/images/home_logo4.png" alt="" class="img img-responsive center" width="550" style="width: 350px; height: auto;">
            </div>
        </div>
        <div class="row" style="margin-top: 15px;">
            <div class="main-search-box text-center">
                <!--<h1 class="intro-title">Advertise anything online</h1>-->
                <!--<p class="sub-title"></p>-->
                <form action="<?= site_url('search'); ?>" method="GET">
                    <?php
                        $search = null;
                        $catid = null;
                        $location = null;
                        $catname = null;
                        if(!empty($this->session->userdata['web']['search'])){
                            $search = $this->session->userdata['web']['search'];
                        }
                        if(!empty($this->session->userdata['web']['catid'])){
                            $catid = $this->session->userdata['web']['catid'];
                        }
                        if(!empty($this->session->userdata['web']['location'])){
                            $location = $this->session->userdata['web']['location'];
                        }else if(!empty ($this->session->userdata['default_location']['location'])){ //location set nahi hone pr default location show krwai
                            $location = $this->session->userdata['default_location']['location'];
                        }
                        if(!empty($this->session->userdata['web']['category_name'])){
                            $catname = $this->session->userdata['web']['category_name'];
                        }
                    ?>
                    <div class="col-md-4 col-sm-4 search-input">
                        <input placeholder="What are you looking for...?" class="form-control input-lg search-form" type="text" name="search" value="<?= $search; ?>">
                    </div>
                    <div class="col-md-3 col-sm-3 search-input">
                        <input type="hidden" class="readonly" id="category_id" name="catid" value="<?= $catid; ?>">
                        <input type="text" name="catname" value="<?= $catname; ?>" placeholder="Select Category" class="form-control input-lg search-form" readonly="" id="category_view" data-target="#bootstrap-modal" data-toggle="modal" style="cursor: pointer;">
<!--                        <select class="form-control input-lg search-form" name="catid">
                            <option selected="selected" value="">All Categories</option>
                            <?php
                            if($category){
                                foreach ($category as $count=> $row):
                                    ?>
                            <option value="<?= $row->ID; ?>" <?php if(!empty($catid)){ if($row->ID == $catid){echo 'selected';} }?> ><?= $row->Name; ?></option>
                            <?php
                                endforeach;
                            }
                            ?>
                        </select>-->
                    </div>
                    <div class="col-md-3 col-sm-3 search-input">
                        <input placeholder="Enter Location" id="autocomplete" onFocus="geolocate()" class="form-control input-lg search-form" value="<?= $location; ?>" type="text" name="location">
                        <!--<input placeholder="Enter Location" id="location" class="form-control input-lg search-form" value="<?= $location; ?>" type="text" name="location">-->
                        

                    </div>
                    <div class="col-md-2 col-sm-2 search-input">
                        <button class="btn btn-primary1 btn-lg simple-btn btn-block">
                            <i class="fa fa-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
            <!--               <div class="top-categories margin-bottom-none">
                              <h4>Popular Categories</h4>
                              <a href="categories.html">
                              <i class="fa fa-book"></i>Books
                              </a>
                              <a href="categories.html">
                              <i class="fa fa-briefcase"></i>Jobs
                              </a>
                              <a href="categories.html">
                              <i class="fa fa-mobile"></i>Mobiles
                              </a>
                              <a href="categories.html">
                              <i class="fa fa-laptop"></i>Laptop
                              </a>
                              <a href="categories.html">
                              <i class="fa fa-building-o"></i>Property
                              </a>
                           </div>-->
        </div>
    </div>
</section>
<!-- End Search Box -->

<section class="category-grid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="listing-actions clearfix row">
                    <div class="tags col-md-6 text-left">
<!--                        <span>Car Parts <a href="#"><i class="fa fa-close"></i></a></span>
                       <span>Cars <a href="#"><i class="fa fa-close"></i></a></span>
                       <span>Clear All <a href="#"><i class="fa fa-close"></i></a></span>-->
                    </div>
                    <ul class="listing-actions-nav col-md-6 text-right">
                       <!--<li><a class="layout-action" title="" data-placement="top" data-toggle="tooltip" href="category-list.html" data-original-title="List layout"><i class="fa fa-bars"></i></a></li>
                          <li><a class="layout-action active" title="" data-placement="top" data-toggle="tooltip" href="category-grid.html" data-original-title="Grid layout"><i class="fa fa-th"></i></a></li> -->
                        <!--                        <li class="dropdown">
                                                   <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-filter"></i> Recently Published <b class="caret"></b></a>
                                                   <ul class="dropdown-menu">
                                                      <li><a href="#">Price Low to High</a></li>
                                                      <li><a href="#">Price High to Low</a></li>
                                                      <li><a href="#">Price High to Low</a></li>
                                                      <li><a href="#">Recently Published</a></li>
                                                   </ul>
                                                </li>-->
                        <!--                        <li class="dropdown">
                                                   <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-filter"></i> All Type <b class="caret"></b></a>
                                                   <ul class="dropdown-menu">
                                                      <li><a href="#">Popular</a></li>
                                                      <li><a href="#">Recently</a></li>
                                                      <li><a href="#">Recently</a></li>
                                                   </ul>
                                                </li>-->
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4">
                <div class="listing-filters">
                    <div class="widget listing-filter-block filter-categories">
                        <div class="widget-header">
                            <h2><b>Categories</b></h2>
                            <a href="<?= site_url('ads'); ?>">
                                <p style="margin-top: 10px;"><img src="https://cdn3.iconfinder.com/data/icons/advertising-and-media-2-3/512/77-512.png" width="30" alt="All ads"> All Ads</p>
                            </a>
                        </div>

                        <div class="widget-body categoryview" id="category-view" style="height: 300px; overflow-y: auto; overflow-x: hidden;">
                            <ul class="first">
                                <?php
                                if($category_list){
                                    foreach ($category_list as $count=> $row):
                                        ?>
                                <li data-catid="<?= $row->ID; ?>" onclick="select_category(this)" id="sel_cat<?= $row->ID; ?>">
                                    <a href="<?= site_url('category-wise/ads/'.$row->ID); ?>">
                                        <!--<i class="fa fa-glass shortcut-icon icon-blue"></i>--> 
                                        <p><img src="<?= base_url() ?>uploads/category/<?= $row->Icon; ?>" class="img img-circle" style="height:30px; width: 30px; object-fit: cover;" alt="category image">
                                        <?= $row->Name; ?> <small><!--5,56 Ads--></small></p>
                                    </a>
                                </li>
                                <?php
                                    endforeach;
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                        if(!empty($open_sub_category)){
                    ?>
                    <div class="widget listing-filter-block">
                        <div class="widget-header">
                            <h2><b>Sub Category</b></h2>
                        </div>

                        <div class="widget-body">
                            <div class="range-inputs row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control border-form" id="myInput" onkeyup="myFunction()" placeholder="Search for Sub category.." title="Type in a name">
                                </div>
                            </div>&nbsp;<br>
                            <ul class="trends" id="myUL">
                                <?php
                                $hide_count = 0;
                                if($sub_category){
                                    foreach ($sub_category as $count=> $row):
                                        if($count < 10){
                                        ?>
                                        <li><a href="<?= site_url('category-wise/ads/'.$row->ID); ?>"><?= $row->Name; ?></a></li>
<!--                                <li>
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox<?php $row->ID; ?>" type="checkbox">
                                        <label for="checkbox<?php $row->ID; ?>">
                                            <?php $row->Name; ?>
                                        </label>
                                    </div>
                                </li>-->
                                <?php
                                        }else{
                                            ?>
                                            <li class="maxlist-hidden" style="display: none;">
                                                <a href="<?= site_url('category-wise/ads/'.$row->ID); ?>"><?= $row->Name; ?></a>
                                            </li>
                                            <?php
                                            $hide_count++;
                                        }
                                    endforeach;
                                }
                                ?>
                                <?php
                                  if($hide_count && $sub_category){
                                ?>
                                    <li style="color:#369;"><u><small><span style="cursor: pointer;" data-status="1" id="view_all_sub_category">View More (<?= $hide_count; ?>)</span></small></u></li>
                                <?php
                                  }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
<!--                                         <div class="widget listing-filter-block">
                                            <div class="widget-header">
                                               <h1>Price Range</h1>
                                            </div>
                                            <div class="widget-body">
                                               <div class="range-widget">
                                                  <div class="form-group">
                                                     <div class="range-inputs row">
                                                        <div class="col-md-6"><input class="form-control border-form" type="text" placeholder="From"></div>
                                                        <div class="col-md-6"><input class="form-control border-form" type="text" placeholder="To"></div>
                                                     </div>
                                                  </div>
                                                  <div class="form-group">
                                                     <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i> Search</button>
                                                  </div>
                                               </div>
                                            </div>
                                         </div>
                    
                                    <div class="widget listing-filter-block margin-bottom-none">
                                         <div class="widget-header">
                                            <h1>Trending Ads </h1>
                                         </div>
                                         <div class="widget-body">
                                            <div class="similar-ads">
                                               <a href="single.html">
                                                  <div class="similar-ad-left">
                                                     <img class="img-responsive img-center" src="./images/categories/restaurant/1.png" alt="">
                                                  </div>
                                                  <div class="similar-ad-right">
                                                     <h4>Duis autem vel eum iriure do hen...</h4>
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
                                                     <h4>Duis autem vel eum iriure do hen...</h4>
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
                                                     <h4>Duis autem vel eum iriure do hen...</h4>
                                                     <p><i class="fa fa-dollar"></i> 450 - <i class="fa fa-map-marker"></i> Buffalo </p>
                                                  </div>
                                                  <div class="clearfix"></div>
                                               </a>
                                            </div>
                                         </div>
                                         </div>-->
                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-sm-8">
                <div class="row container-fluid">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="">
                            <div class="row">
                                <!--<div class="well well-xs">-->
                                <div class="" style="box-shadow: 1px 1px 1px #4611A7;">
                                    <div class="listing-actions clearfix row">
                                        <div class="tags col-md-6 text-left" style="margin-top: 5px;">
                                            <?php
                                        if (!empty($category_name->Name)) {
                                            //echo '<h3> &nbsp;&nbsp;<strong>' . $category_name->Name . '</strong> </h3>';
                                            echo '<h3>&nbsp;&nbsp;<strong id="category_view1"></strong></h3>';
                                            ?>
                                            <script>
                                                $(document).ready(function(){
                                                    var id = <?= $category_id; ?>;
                                                    $.ajax({
                                                        url:'<?= site_url('brand_kram_link'); ?>',
                                                        type:'post',
                                                        data:{catid:id},
                                                        success:function(data){
                                                            $('#category_view1').html(data);
                                                        }
                                                    });
                                            });
                                            </script>
                                            <?php
                                        }else if(!empty ($sort)){
                                            echo '<h3> &nbsp;&nbsp;<strong>'.$sort.'</strong> </h3>';
                                        }
                                        else{
                                            echo '<h3> &nbsp;&nbsp;<strong>All Category</strong> </h3>';
                                        }
                                        ?>
                                        </div>
                                        <ul class="listing-actions-nav col-md-6 text-right">
                                           <!--<li><a class="layout-action" title="" data-placement="top" data-toggle="tooltip" href="category-list.html" data-original-title="List layout"><i class="fa fa-bars"></i></a></li>
                                              <li><a class="layout-action active" title="" data-placement="top" data-toggle="tooltip" href="category-grid.html" data-original-title="Grid layout"><i class="fa fa-th"></i></a></li> -->

                                            <li class="dropdown" id="sortf">
                                                <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-filter"></i> Sort By <b class="caret"></b></a>
<!--                                                <ul class="dropdown-menu">
                                                    <li class="" style="cursor: pointer;" data-id="popular" onclick="sort(this)"><a >Popular</a></li>
                                                    <li class="" style="cursor: pointer;" data-id="recently" onclick="sort(this)"><a >Recently</a></li>
                                                    <li class="" style="cursor: pointer;" data-id="nearby" onclick="sort(this)"><a >Near By</a></li>
                                                </ul>-->
                                                <ul class="dropdown-menu" style="padding: 5px;">
                                               
                                                    <li>
                                                        <form action="<?= site_url('sort'); ?>" method="get">
                                                            <input style="margin-top: 2px;" type="submit" value="Popular" name="sort" class="btn2 btn-primary11 btn-xs simple-btn btn-block">
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="<?= site_url('sort'); ?>" method="get">
                                                            <input style="margin-top: 8px;" type="submit" value="Recently" name="sort" class="btn2 btn-primary11 btn-xs simple-btn btn-block">
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="<?= site_url('sort'); ?>" method="get">
                                                            <input type="hidden" name="lat" value="24.585445">
                                                            <input type="hidden" name="long" value="73.712479">
                                                            <input style="margin-top: 8px;" type="submit" value="Nearby" name="sort" class="btn2 btn-primary11 btn-xs simple-btn btn-block">
                                                        </form>
                                                    </li>
                                                
                                                </ul>
                                            </li>
                                        </ul>
<!--                                        <script>
                                                function sort(current){
                                                    var value = $(current).data('id');
                                                   // alert(value);
                                                   $.ajax({
                                                       url:'<?php site_url('sort'); ?>',
                                                       type:'post',
                                                       data:{value:value},
                                                       success:function(data){
                                                           $('#products').html(data);
                                                           $('#sortf ul li.active').removeClass('active');
                                                           $(current).addClass('active');
                                                           $('#pagination_link').remove();
                                                       }
                                                   });
                                                }
                                        </script>-->
                                    </div>
                                </div>
                            </div>
                            <div id="products" class="row list-group">
                                <?php
                                if($all_ads){
                                    foreach ($all_ads as $count=>$row):
                                        ?>
                                <div class="item">
                                            <div class="item-ads-grid icon-violet">
                                                <?php
                                                  if($row->AdsType == 1){
                                                      echo '<div class="item-badge-grid btn-primary1 featured-ads1">';
                                                      echo 'Premium';
                                                      echo '</div>';
                                                  }else{
//                                                            echo '<div class="item-badge-grid btn-primary2 featured-ads1">';
//                                                            echo 'Free';
//                                                            echo '</div>';
                                                  }
                                                ?>  
                                                <div class="item-img-grid">
                                                    <a class="" href="<?= site_url('view/'.$row->ID); ?>" target="_blank">
                                                        <div class="row">
                                                            <div class="col-md-3 col-xs-12">
                                                                <div class="container-grid-img">
                                                                    <?php
                                                                    if(!empty($row->image)){
                                                                        $image = base_url().'uploads/ads/_thumb/'.$row->image;
                                                                    }else{
                                                                        $image = base_url().'theme/web/images/banner_design.png';
                                                                    }
                                                                    ?>
                                                                    <img alt="" src="<?= $image; ?>" style="width: 250px; height: 250px; object-fit: cover; object-position: center; min-width: 100%;" class="responsive img-responsive img-center" >
                                                                    <!--  <div class="item-title">
                                                                     <a href="single.html">
                                                                         <h4>Passage of Lorem Ipsum </h4>
                                                                     </a>
                                                                     <h3>$ 64.5000</h3>
                                                                    </div>-->
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9 col-xs-12" style="padding: 20px;">
                                                                <div class="container-grid-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-xs-12">
                                                                            <div class="my-item-title">
                                                                                <strong style="font-size: 18px; color:#000;"><?= $row->BusinessName; ?></strong>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-xs-12">
                                                                            <small style="color:#6b6b6b; " id="ads_in_ssn<?= $row->ID; ?>"></small>
                                                                            <script>
                                                                                $(document).ready(function(){
                                                                                    var id = <?= $row->CategID; ?>;
                                                                                    $.ajax({
                                                                                        url:'<?= site_url('brand_kram'); ?>',
                                                                                        type:'post',
                                                                                        data:{catid:id},
                                                                                        success:function(data){
                                                                                           // alert(data);
                                                                                            $('#ads_in_ssn<?= $row->ID; ?>').html(data);
                                                                                        }
                                                                                    });
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-xs-12">
                                                                            <span class="text-justify" style="color: #000;"><b><?= $row->CaptionLine; ?></b></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-xs-12">
                                                                            <spam style="color: #000;"><?= mb_strimwidth($row->Description, 0, 150, "..."); ?></spam>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-xs-12">
                                                                            <span><i class="fa fa-map-marker"></i> &nbsp; <?= mb_strimwidth($row->BusinessAddress, 0, 80, "..."); ?> </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12 col-xs-12 ads_box_item">
                                                                        <table class="table table-responsive ads_div2" style="width: 100%;">
                                                                            <tr style="border-top: 1pt solid lightgray;">
                                                                                <td style="width: 50%;"><i class="fa fa-mobile" style="font-size:20px;"></i> &nbsp;<a href="tel:<?= $row->CellNo; ?>"> <?php if(!empty($row->CellNo)&&(strlen($row->CellNo)>3)){echo $row->CellNo;}else{ echo $row->CellNo."XXXXXXXXXX";} ?></a></td>
                                                                                <td style="width: 50%;"><i class="fa fa-envelope"></i> &nbsp; <a href="mailto:<?= $row->Email; ?>"><?php if(!empty($row->Email)){echo $row->Email;}else {echo "xxxxxxxx@xxxx.xxx";} ?></a></td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--Div col-md-9 end-->
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    endforeach;
                                }else{
//                                    echo 'No ads';
                                    ?>
                                <div class="item text-center">
                                    <div class="item-ads-grid icon-violet">
                                        <p><h3><b>No ads found.</b></h3></p>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                                <!--First box start-->   
                                
                            </div>
                        </div>


                    </div>
                    
                </div>
                <!--                  <div class="text-center">
                                     <a class="btn btn-primary btn-load-more btn-lg" href="#"> LOAD MORE ADS... </a>
                                  </div>-->
                <div class="text-center" id="pagination_link">
                    <ul class="pagination pagination-sm">
                        <?php 
                        if(!empty($links)){
                            echo $links;
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<!--<script>
          $(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();
        $('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();
        $('#products .item').removeClass('list-group-item');
        $('#products .item').addClass('grid-group-item');});
});
      </script>-->
 <!--Category select then set session start-->     
<script>
function select_category(current){
    var catid = $(current).data('catid');
    //alert(catid);
    $.ajax({
        url:'<?= site_url('category_session'); ?>',
        type:'post',
        data:{catid:catid},
        success:function(data){
            $('#sel_cat'+catid+' a p').css({
                'color':'#4411a7ed',
                'font-size':'15px',
                'font-weight':'700'
            });
                var container = $('#category-view'),
                scrollTo = $('#sel_cat'+catid);

                container.animate({
                    scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
                });
        }
    });
}
</script>

<script>
$(document).ready(function(){
    <?php
    if(!empty($this->session->userdata['cat_select']['select_cat'])){
    ?>
    var catid = <?= $this->session->userdata['cat_select']['select_cat']; ?>;
        
    $('#sel_cat'+catid+' a p').css({
        'color':'#4411a7ed',
        'font-size':'15px',
        'font-weight':'700'
    });
    
    var container = $('#category-view'),
    scrollTo = $('#sel_cat'+catid);

container.animate({
    scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
});
    <?php } ?>   
});
</script>

<script >
$(document).ready(function(){
$('#first-view').on('click',function(){
  $('#category-view .maxlist-hidden').show('slow');
  $('#first-view').hide();
  $('#first-hide').show();

});
$('#first-hide').on('click',function(){
  $('#category-view .maxlist-hidden').hide('slow');
  $('#first-view').show();
  $('#first-hide').hide();
});
});
</script>
<!--Category select then set session end-->   
<!--sub category view-->
<script>
$(document).ready(function(){
    $('#view_all_sub_category').on('click', function(){
        var status = $(this).data('status');
        if(status == 1){
            $('.maxlist-hidden').show('slow');
            $(this).data('status',2);
            $(this).text('View Less');
        }else if(status == 2){
            $('.maxlist-hidden').hide('slow');
            $(this).data('status',1);
            $(this).text('View More ('+<?= $hide_count; ?>+')');
        }
//        $('.maxlist-hidden').toggle('slow')
    });
});
</script>
      
<!--Sub category search real time-->
<script>
    function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByTagName("a")[0];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
              li[i].style.display = "";
          } else {
              li[i].style.display = "none";
          }
        }
    }
</script>