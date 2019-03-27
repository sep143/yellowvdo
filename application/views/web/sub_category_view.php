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
    box-shadow: 2px 2px 2px #4611A7;
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
                        <!--<input placeholder="Enter Location" id="location" class="form-control input-lg search-form" value="<?php $location; ?>" type="text" name="location">-->
                        

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
                            <h1><b>Categories</b></h1>
                        </div>

                        <div class="widget-body" id="category-view">
                            <ul class="first">
                                <?php
                                if($category_list){
                                    foreach ($category_list as $count=> $row):
                                        ?>
                                        <li>
                                            <a href="<?= site_url('sub-category-view/'.$row->ID); ?>">
                                                <!--<i class="fa fa-glass shortcut-icon icon-blue"></i>--> 
                                                <p><img src="<?= base_url() ?>uploads/category/<?= $row->Icon; ?>" class="img img-circle" style="width: 30px; height: 30px; object-fit: cover;" alt="category image">
                                                   <?= $row->Name; ?><small><!--5,56 Ads--></small></p>
                                            </a>
                                        </li>
                                <?php
                                    endforeach;
                                }
                                ?>
                                <li class="maxlist-hidden" style="display: none;">
                                    <a href="#">
                                        <i class="fa fa-paw shortcut-icon icon-light-green"></i> 
                                        <p>Pets <small>9,156 Ads</small></p>
                                    </a>
                                </li>
                            </ul>
<!--                            <div id="category_btn">
                                <span  class="maxlist-more" id="first-view" style="cursor: pointer;">Read More</span>
                                <span  id="first-hide" style="display: none; cursor: pointer;">Read Less</span>
                            </div>-->

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-9 col-md-8 col-sm-8">
                <div class="row all-categories-nav">
                    <?php
                    if($sub_category){
                        foreach ($sub_category as $row):
                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="widget light-blue-widget img-center">
                                    <a href="<?= site_url('category-wise/ads/'.$row->ID); ?>">
                                        <?php
                                        if(!empty($row->Icon)){
                                            $icon = base_url().'uploads/category/'.$row->Icon;
                                        }else{
                                            $icon = base_url().'theme/web/images/cat.png';
                                        }
                                        ?>
                                        <img class="img img-circle" src="<?= $icon; ?>" alt="Sub Category" style="width: 60px; height: 60px; object-fit: cover;"><p>&nbsp;</p>
                                        <p><?= $row->Name; ?> <small id="ads_count<?= $row->ID; ?>"></small></p>
                                    </a>
                                </div>
                            </div>
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
                    }else{
//                        echo 'No sub category found...';
                        redirect('category-wise/ads/'.$sub_cate_id);
                    }
                    ?>
                    
                </div>
                <!--                  <div class="text-center">
                                     <a class="btn btn-primary btn-load-more btn-lg" href="#"> LOAD MORE ADS... </a>
                                  </div>-->
<!--                <div class="text-center">
                    <ul class="pagination pagination-sm">
                        <li class="disabled"><a href="#">«</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>-->
            </div>
        </div>
    </div>
</section>

