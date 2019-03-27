<style>
  
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
<!--                        <input type="text" name="catname" value="<?= $catname; ?>" placeholder="Select Category" class="form-control input-lg search-form" id="category_search">
                        
                        <script>
                        $(document).ready(function(){
                            $('#category_search').on('keyup', function(){
                                var cat_name = $(this).val();
                                //console.log(cat_name);
                                $.ajax({
                                    url:'<?php ?>',
                                    type:'post',
                                    data:{},
                                    success:function(data){
                                        
                                    }
                                });
                            });
                        });
                        </script>-->
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

<!-- Featured Products -->
         <!--<section class="featured-products">-->
<section class="categories-list main-categories-list">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <!--<div class="carousel-section-header">-->
                <div class="">
                    <h1>&nbsp; <!--Popular Services--> <a href="<?= site_url('categories'); ?>" class="btn btn-md btn-primary1 pull-right ">View All <b></b> <i class="fa fa-arrow-right"></i></a></h1>
                    <!--<h1>Trending Ads <a href="categories.html" class="btn btn-md btn-primary pull-right">Show More Items <b>24727</b> <i class="fa fa-arrow-right"></i></a></h1>-->
                </div>&nbsp;<br>
            </div>
        </div>
        <div class="row">
            
<!--                              <div class="col-md-1">
                                  <button type="button"><i class="fa fa-arrow"></i></button>
                              </div>-->
            <div class="col-md-12">
                
                <div id="owl-carousel-featured" class="owl-carousel owl-carousel-featured">
                    <?php
                    $div = array("blue-widget", "green-widget", "brown-widget", "violet-widget", "dark-blue-widget", "orange-widget", "light-blue-widget", "light-green-widget");
                    $icon = array("icon-blue", "icon-green", "icon-brown", "icon-violet", "icon-dark-blue", "icon-orange", "icon-light-blue", "icon-light-green");
                    $rand_div = array_rand($div, 2);
                    $rand_icon = array_rand($icon, 2);
                    ?>
<!--                    <div class="item">
                        <div class="widget <?= $div[$rand_div[0]]; ?>">
                            <div class="widget-header">
                                <small>98,156 Ads</small>
                                <h2><i class="fa fa-glass shortcut-icon <?= $icon[$rand_icon[0]]; ?>"></i> Restaurant</h2>
                            </div>
                            <div class="widget-body">
                                <ul class="trends">
                                    <li><a href="categories_1_1.html">Cafe <span class="item-numbers">155</span></a></li>
                                    <li><a href="categories_1_1.html">Fast Food <span class="item-numbers">80</span></a></li>
                                    <li><a href="categories_1_1.html">Restaurants <span class="item-numbers">65</span></a></li>
                                    <li><a href="categories_1_1.html">Show More <span class="item-numbers">4</span></a></li>
                                     <li><a href="categories_1_1.html">Pubs <span class="item-numbers">35</span></a></li>
                                    <li><a href="categories_1_1.html">Food Truck <span class="item-numbers">12</span></a></li>
                                    <li><a href="categories_1_1.html">Show More <span class="item-numbers">7</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>-->
                    
                    <?php
                    if($category){
                        foreach ($category as $row):
                            ?>
<!--                        <div class="item">
                            <div class="widget green-widget">
                                <div class="widget-header">
                                    <small><?= $row->ad_count; ?> Ads</small>
                                    <a href="<?= site_url('category-wise/ads/' . $row->ID); ?>">
                                        <h3>
                                            <img class="img img-circle" src="<?= base_url() ?>uploads/category/<?= $row->Icon; ?>" alt="Category Image" width="45"> <?= $row->Name; ?>
                                            <span class="item-numbers" id="ads_count<?= $row->ID; ?>"></span>
                                        </h3>
                                    </a>
                                </div>
                                <div id="cat_id<?= $row->ID; ?>">

                                </div>
                            </div>
                        </div>-->
                    <div class="item">
                        <div class="item-ads-grid icon-blue">
                            <div class="item-img-grid">
                                <a href="<?= site_url('category-wise/ads/' . $row->ID); ?>" data-catid="<?= $row->ID; ?>" onclick="select_category(this)">
                                <img class="img-responsive img-center" src="<?= base_url() ?>uploads/category/<?= $row->Icon; ?>" style="width: 350px; height: 250px; object-fit: cover;" alt="Category Image">
                                <div class="item-title">
                                        <h4><?= $row->Name; ?></h4>
                                    <h3 id="ads_count<?= $row->ID; ?>"></h3>
                                </div>
                                </a>
                            </div>
                            <div class="item-meta" id="cat_id<?= $row->ID; ?>">

                            </div>
                        </div>
                    </div>

                        <?php
                    endforeach;
                    }
                    ?>
                </div>
                <?php
                if($category){
                    foreach ($category as $row):
                        ?>
                        <!--Get sub category-->
                        <script>
                            $(document).ready(function(){
                                var id = <?= $row->ID; ?>;
                                $.ajax({
                                    url:'<?= site_url('sub_category'); ?>',
                                    type:'post',
                                    data:{catid:id},
                                    success:function(data){
                                        $('#cat_id'+id).html(data);
                                    }
                                });

                            });
                        </script>
                        <script>
                            $(document).ready(function(){
                                var id = <?= $row->ID; ?>;
                                $.ajax({
                                    url:'<?= site_url('ads_count'); ?>',
                                    type:'post',
                                    data:{id:id},
                                    success:function(data){
                                        $('#ads_count'+id).html(data);
                                    }
                                });
                            });
                        </script>
                <?php
                    endforeach;
                }
                ?>
            </div>
<!--                              <div class="col-md-1">
                                  <button type="button" class="align-bottom">Next</button>
                              </div>-->
        </div>
    </div>
</section>
<!-- End Featured Products -->

<!-- Categories List Page -->
<!--      <section class="categories-list main-categories-list">
 <div class="container">
    <div id="Restaurant" class="row">
       
       <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="single-categorie">
             <div id="owl-carousel-featured" class="owl-carousel categories-list-page">
                <div class="item">
                   <div class="item-ads-grid icon-blue">
                      <div class="item-img-grid">
                          <img alt="" src="<?= base_url(); ?>theme/web/images/categories/restaurant/1.png" class="img-responsive img-center">
                         <div class="item-title">
                            <a href="single.html">
                               <h4>There are many variations</h4>
                            </a>
                            <h3>$ 64.5000</h3>
                         </div>
                      </div>
                      <div class="item-meta">
                         <ul>
                            <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 AM</li>
                            <li class="item-cat"><i class="fa fa-glass"></i> <a href="#">Restaurant</a> , <a href="#">Cafe</a></li>
                            <li class="item-location"><a href="#"><i class="fa fa-map-marker"></i> Buffalo </a></li>
                            <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                         </ul>
                      </div>
                   </div>
                </div>
                <div class="item">
                   <div class="item-ads-grid icon-blue">
                      <div class="item-img-grid">
                         <img alt="" src="<?= base_url(); ?>theme/web/images/categories/restaurant/2.png" class="img-responsive img-center">
                         <div class="item-title">
                            <a href="single.html">
                               <h4>There are many variations</h4>
                            </a>
                            <h3>$ 64.5000</h3>
                         </div>
                      </div>
                      <div class="item-meta">
                         <ul>
                            <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 AM</li>
                            <li class="item-cat"><i class="fa fa-glass"></i> <a href="#">Restaurant</a> , <a href="#">Cafe</a></li>
                            <li class="item-location"><a href="#"><i class="fa fa-map-marker"></i> Buffalo </a></li>
                            <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                         </ul>
                      </div>
                   </div>
                </div>
                <div class="item">
                   <div class="item-ads-grid icon-blue">
                      <div class="item-img-grid">
                         <img alt="" src="<?= base_url(); ?>theme/web/images/categories/restaurant/3.png" class="img-responsive img-center">
                         <div class="item-title">
                            <a href="single.html">
                               <h4>There are many variations</h4>
                            </a>
                            <h3>$ 64.5000</h3>
                         </div>
                      </div>
                      <div class="item-meta">
                         <ul>
                            <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 AM</li>
                            <li class="item-cat"><i class="fa fa-glass"></i> <a href="#">Restaurant</a> , <a href="#">Cafe</a></li>
                            <li class="item-location"><a href="#"><i class="fa fa-map-marker"></i> Buffalo </a></li>
                            <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                         </ul>
                      </div>
                   </div>
                </div>
                <div class="item">
                   <div class="item-ads-grid icon-blue">
                      <div class="item-img-grid">
                         <img alt="" src="<?= base_url(); ?>theme/web/images/categories/restaurant/4.png" class="img-responsive img-center">
                         <div class="item-title">
                            <a href="single.html">
                               <h4>There are many variations</h4>
                            </a>
                            <h3>$ 64.5000</h3>
                         </div>
                      </div>
                      <div class="item-meta">
                         <ul>
                            <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 AM</li>
                            <li class="item-cat"><i class="fa fa-glass"></i> <a href="#">Restaurant</a> , <a href="#">Cafe</a></li>
                            <li class="item-location"><a href="#"><i class="fa fa-map-marker"></i> Buffalo </a></li>
                            <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                         </ul>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
   
 </div>
</section>-->
<!-- End Categories List Page -->


<!-- Categories List -->
<!--      <section class="categories-list">
<div class="container">
  <div class="row">
     <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="widget blue-widget">
           <div class="widget-header">
              <small>98,156 Ads</small>
              <h1><i class="fa fa-glass shortcut-icon icon-blue"></i> Restaurant</h1>
           </div>
           <div class="widget-body">
              <ul class="trends">
                 <li><a href="#">Cafe <span class="item-numbers">155</span></a></li>
                 <li><a href="#">Fast Food <span class="item-numbers">80</span></a></li>
                 <li><a href="#">Restaurants <span class="item-numbers">65</span></a></li>
                 <li><a href="#">Pubs <span class="item-numbers">35</span></a></li>
                 <li><a href="#">Food Truck <span class="item-numbers">12</span></a></li>
                 <li><a href="#">Show More <span class="item-numbers">7</span></a></li>
              </ul>
           </div>
        </div>
     </div>
     <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="widget green-widget">
           <div class="widget-header">
              <small>98,156 Ads</small>
              <h1><i class="fa fa-home shortcut-icon icon-green"></i> Real Estate</h1>
           </div>
           <div class="widget-body">
              <ul class="trends">
                 <li><a href="#">For Sale <span class="item-numbers">135</span></a></li>
                 <li><a href="#">For Rent <span class="item-numbers">116</span></a></li>
                 <li><a href="#">To Share <span class="item-numbers">65</span></a></li>
                 <li><a href="#">Land & Estates <span class="item-numbers">47</span></a></li>
                 <li><a href="#">Appartments <span class="item-numbers">23</span></a></li>
                 <li><a href="#">Show More <span class="item-numbers">4</span></a></li>
              </ul>
           </div>
        </div>
     </div>
     <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="widget brown-widget">
           <div class="widget-header">
              <small>98,156 Ads</small>
              <h1><i class="fa fa-car shortcut-icon icon-brown"></i> Cars</h1>
           </div>
           <div class="widget-body">
              <ul class="trends">
                 <li><a href="#">Car Parts <span class="item-numbers">98</span></a></li>
                 <li><a href="#">Cars <span class="item-numbers">65</span></a></li>
                 <li><a href="#">Motobikes <span class="item-numbers">55</span></a></li>
                 <li><a href="#">Wanted <span class="item-numbers">28</span></a></li>
                 <li><a href="#">Rentacar <span class="item-numbers">15</span></a></li>
                 <li><a href="#">Show More <span class="item-numbers">12</span></a></li>
              </ul>
           </div>
        </div>
     </div>
     <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="widget violet-widget">
           <div class="widget-header">
              <small>98,156 Ads</small>
              <h1><i class="fa fa-shopping-cart shortcut-icon icon-violet"></i> Shopping</h1>
           </div>
           <div class="widget-body">
              <ul class="trends">
                 <li><a href="#">Food <span class="item-numbers">68</span></a></li>
                 <li><a href="#">Wear <span class="item-numbers">44</span></a></li>
                 <li><a href="#">Accessories <span class="item-numbers">23</span></a></li>
                 <li><a href="#">IT & Sofware <span class="item-numbers">19</span></a></li>
                 <li><a href="#">For Kids <span class="item-numbers">5</span></a></li>
                 <li><a href="#">Show More <span class="item-numbers">3</span></a></li>
              </ul>
           </div>
        </div>
     </div>
  </div>
  <div class="row">
     <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="widget dark-blue-widget margin-bottom-none">
           <div class="widget-header">
              <small>98,156 Ads</small>
              <h1><i class="fa fa-briefcase shortcut-icon icon-dark-blue"></i> Job</h1>
           </div>
           <div class="widget-body">
              <ul class="trends">
                 <li><a href="#">Accountancy <span class="item-numbers">78</span></a></li>
                 <li><a href="#">Banking <span class="item-numbers">45</span></a></li>
                 <li><a href="#">Managerment <span class="item-numbers">30</span></a></li>
                 <li><a href="#">Secretarial & PA <span class="item-numbers">28</span></a></li>
                 <li><a href="#">Voluntary Work <span class="item-numbers">16</span></a></li>
                 <li><a href="#">Show More <span class="item-numbers">9</span></a></li>
              </ul>
           </div>
        </div>
     </div>
     <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="widget orange-widget margin-bottom-none">
           <div class="widget-header">
              <small>98,156 Ads</small>
              <h1><i class="fa fa-building-o shortcut-icon icon-orange"></i> Hotels</h1>
           </div>
           <div class="widget-body">
              <ul class="trends">
                 <li><a href="#">Artists <span class="item-numbers">95</span></a></li>
                 <li><a href="#">Events & Nightlife <span class="item-numbers">86</span></a></li>
                 <li><a href="#">Hotel Stuff <span class="item-numbers">60</span></a></li>
                 <li><a href="#">Classes <span class="item-numbers">30</span></a></li>
                 <li><a href="#">Hostel <span class="item-numbers">22</span></a></li>
                 <li><a href="#">Show More <span class="item-numbers">19</span></a></li>
              </ul>
           </div>
        </div>
     </div>
     <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="widget light-blue-widget margin-bottom-none">
           <div class="widget-header">
              <small>98,156 Ads</small>
              <h1><i class="fa fa-star shortcut-icon icon-light-blue"></i> Services</h1>
           </div>
           <div class="widget-body">
              <ul class="trends">
                 <li><a href="#">Computers <span class="item-numbers">55</span></a></li>
                 <li><a href="#">Clothing <span class="item-numbers">35</span></a></li>
                 <li><a href="#">Childcare <span class="item-numbers">31</span></a></li>
                 <li><a href="#">Business <span class="item-numbers">29</span></a></li>
                 <li><a href="#">Cleaning <span class="item-numbers">18</span></a></li>
                 <li><a href="#">Show More <span class="item-numbers">8</span></a></li>
              </ul>
           </div>
        </div>
     </div>
     <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="widget light-green-widget margin-bottom-none">
           <div class="widget-header">
              <small>98,156 Ads</small>
              <h1><i class="fa fa-paw shortcut-icon icon-light-green"></i> Pets</h1>
           </div>
           <div class="widget-body">
              <ul class="trends">
                 <li><a href="#">Cats <span class="item-numbers">66</span></a></li>
                 <li><a href="#">Dogs <span class="item-numbers">54</span></a></li>
                 <li><a href="#">Birds <span class="item-numbers">34</span></a></li>
                 <li><a href="#">Wanted <span class="item-numbers">12</span></a></li>
                 <li><a href="#">Pets for Sale <span class="item-numbers">6</span></a></li>
                 <li><a href="#">Show More <span class="item-numbers">1</span></a></li>
              </ul>
           </div>
        </div>
     </div>
  </div>
</div>
</section>-->
<!-- End Categories List -->

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
            
        }
    });
}
</script>