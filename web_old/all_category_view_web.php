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
.yellow-widget{
    border-bottom: 2px solid #fbd800;
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

    <section class="categories-list main-categories-list">
          <div class="container">
              <!--<div class="row">-->
                  <?php
                  if($category){
                      foreach ($category as $count=> $row):
                          ?>
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <div class="widget yellow-widget" style="padding: 20px;">
                                <div class="widget-header" style="margin-bottom: -15px;">
                                    <h3>
                                        <img src="<?= base_url(); ?>uploads/category/<?= $row->Icon; ?>" alt="category image" style="width: 30px; height: 30px; object-fit: cover;" class="img img-circle"> 
                                        <a href="<?= site_url('sub-category-view/'.$row->ID); ?>" style="color: rgba(0,47,52,.7); font-weight: 400;">
                                            <?= $row->Name; ?><small class="pull-right" style="margin-top:10px;" id="ads_count<?= $row->ID; ?>"><!--98,156 Ads--></small>
                                        </a>
                                        <!--<span class="item-numbers" id="ads_count<?php $row->ID; ?>"></span>-->
                                    </h3>
                                </div><hr>
                                <div class="widget-body" id="sub_category<?= $row->ID; ?>" style="height: 100%; margin-top: -15px;">

                                </div>
                            </div>
                        </div>
                  <?php
                      endforeach;
                  }
                  ?>
              <!--</div>-->
          </div>
      </section>

<?php
if($category){
    foreach ($category as $row):
        ?>
<!--Get sub category-->
        <script>
            $(document).ready(function(){
                var id = <?= $row->ID; ?>;
                $.ajax({
                    url:'<?= site_url('sub_category_all_category'); ?>',
                    type:'post',
                    data:{catid:id},
                    success:function(data){
                        $('#sub_category'+id).html(data);
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

