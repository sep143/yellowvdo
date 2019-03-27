<div class="row">
    <div class="col-md-12">
        <!--Message box start-->
        <div class="messaging" >
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4><img src="<?= base_url(); ?>uploads/profile/<?= $image; ?>" alt="" style="width: 40px; height: 40; object-fit: cover;" class="img img-thumbnail">
                                <?= $name; ?></h4>
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
                        if($chat_ads){
                            foreach ($chat_ads as $count=>$row):
                                ?>
                        <div class="chat_list" onclick="chat_open(this)" style="cursor: pointer;" data-chatid='<?= $row->ID; ?>' data-userid='<?= $row->UserID; ?>'
                             data-image='<?= base_url();?>uploads/ads/<?= $row->image; ?>'>
                            <div class="chat_people">
                                <div class="chat_img"> 
                                    <?php
                                    if($row->image){
                                        ?>
                                        <img src="<?= base_url();?>uploads/ads/_thumb/<?= $row->image; ?>" alt="">
                                    <?php
                                    }else{
                                        ?>
                                        <img src="<?= base_url();?>theme/web/images/banner_design.png" alt="">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="chat_ib">
                                    <h5><?= $row->BusinessName; ?> 
                                        <?php
                                        if($row->NotifyAdmin == 0){
                                            echo '<lable style="color: green;"><u></u></lable> ';
                                        }else if($row->NotifyAdmin == 1){
                                            echo '<lable style="color: red;" id="unread'.$row->ID.'"><u>Unread</u></lable> ';
                                        }
                                        ?>
                                        <span class="chat_date"><?= date('d-M', strtotime($row->LastModifiedDT))?></span></h5>
                                    <p><?= $row->CaptionLine; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                            endforeach;
                        }
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

<script>
function chat_open(current){
    var chat_id = $(current).data('chatid');
    var user_id = $(current).data('userid');
    var image = $(current).data('image');
    $.ajax({
        url:'<?= site_url('chatting'); ?>',
        type:'post',
        data:{chat:'msg',chat_id:chat_id, user_id:user_id, image:image},
        success:function(data){
            $('#all_msg').html(data);
            $('.chat_list').removeClass('active_chat');
            $('#unread'+chat_id).text('');
            $(current).addClass('active_chat');
            var wtf = $('.msg_history');
            var height = wtf[0].scrollHeight;
            wtf.scrollTop(height);
        }
    });
}
</script>