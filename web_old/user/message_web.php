<link rel="stylesheet" href="<?= base_url(); ?>theme/web//css/message_v1.css">

<div class="col-sm-9">
    <?php
    if($chat_ads){
    ?>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-12">
            <!--Message box start-->
            <div class="messaging" >
                <div class="inbox_msg">
                    <div class="inbox_people">
                        <div class="headind_srch">
                            <div class="recent_heading">
                                <h4>All Ads</h4>
                            </div>
<!--                        <div class="srch_bar">
                            <div class="stylish-input-group">
                                <input type="text" class="search-bar"  placeholder="Search" >
                                <span class="input-group-addon">
                                    <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                                </span> </div>
                        </div>-->
                        </div>
                        <div class="inbox_chat">
                            <?php
                        
                            foreach ($chat_ads as $count=>$row):
                                ?>
                        <div class="chat_list" onclick="chat_open(this)" data-chatid='<?= $row->ID; ?>' data-userid='<?= $row->UserID; ?>'
                             data-image='<?= base_url();?>uploads/ads/<?= $row->image; ?>'>
                            <div class="chat_people">
                                <div class="chat_img"> 
                                    <?php
                                    if($row->image){
                                        ?>
                                    <img src="<?= base_url();?>uploads/ads/<?= $row->image; ?>" alt="ads_image">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="chat_ib">
                                    <h5><?= $row->BusinessName; ?> <span class="chat_date"><?= date('d-M', strtotime($row->msg_dt))?></span></h5>
                                    <p><?= $row->CaptionLine; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                            endforeach;
                       
                        ?>
                        </div>
                    </div>
                    
                    <div class="mesgs" id="all_msg">
                    
                    
                    </div>
                    
                </div>

            </div>
            <!--Message box end-->
        </div>
    </div>

    <!--                    <div class="widget my-profile margin-bottom-none">
                            <div class="widget-header">
                                <h1>My Ads</h1>
                            </div>
                            <div class="widget-body">
    
    
                            </div>
                        </div>-->
    <?php
    } //if not data then else echo
    else{
        ?>
    <div class="widget my-profile margin-bottom-none">
        <div class="widget-body">
            <div class="align-center">
                <p>Any no message</p>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>
</div>
</div>
</section>
<!-- End My Ads -->



<script>
function chat_open(current){
    var chat_id = $(current).data('chatid');
    var user_id = $(current).data('userid');
    var image = $(current).data('image');
    
//    $('#all_msg').animate({
//                scrollTop: $("#scrolldivdown").offset().top
//                }, 2000);
    $.ajax({
        url:'<?= site_url('user_chat'); ?>',
        type:'post',
        data:{chat:'msg',chat_id:chat_id, user_id:user_id, image:image},
        success:function(data){
            $('#all_msg').html(data);
            $(current).addClass('active_chat');
            var wtf = $('.msg_history');
            var height = wtf[0].scrollHeight;
            wtf.scrollTop(height);
        }
    });
}


</script>