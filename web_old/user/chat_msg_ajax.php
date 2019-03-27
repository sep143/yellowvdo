<style>
    .received_withd_msg p {
    background: #797979 none repeat scroll 0 0;
    border-radius: 3px;
    color: #ffffff;
    font-size: 14px;
    margin: 0;
    padding: 5px 10px 5px 12px;
    width: 100%;
}
</style>


<?php
if ($chat_msg) {
    echo '<div class="msg_history" >';
    foreach ($chat_msg as $count => $row):
        if($user_id == $row->UserID){
            ?>
            <div class="outgoing_msg">
                <div class="sent_msg">
                    <p><?= $row->Msg; ?></p>
                    <span class="time_date"> <?= date('h:i A', strtotime($row->CreatedDT)); ?>    |  <?= date('M d', strtotime($row->CreatedDT)); ?></span>
                </div>
            </div>
<?php
        }else{
            ?>

            <div class="incoming_msg">
                <!--<div class="incoming_msg_img"> <img src="<?= $image; ?>" alt="user"> </div>-->
                <div class="received_msg">
                    <div class="received_withd_msg">
                        <p><?= $row->Msg; ?></p>
                        <span class="time_date"> <?= date('h:i A', strtotime($row->CreatedDT)); ?>    |  <?= date('M d', strtotime($row->CreatedDT)); ?></span>
                    </div>
                </div>
            </div>
<div id="scrolldivdown"></div>
            
<?php
        }
        ?>
        
        <?php
    endforeach;
    
    ?>
<div class="check">
        
            </div>
    </div>
    <div class="type_msg">
            <div class="input_msg_write form-group">
                <input type="text" class="form-control write_msg" id="msg" placeholder="Type a message" />
                <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
        </div>
    
    <?php
}
?>

<script>
$(document).ready(function(){
    $('.msg_send_btn').click(function(){
        var chat_id = <?= $chat_id; ?>;
        var user_id = <?= $this->session->userdata['user_profile']['id']; ?>;
        var msg = $('#msg').val();
           
        $.ajax({
            url:'<?= site_url('user_chat'); ?>',
            type:'post',
            data:{chat:'send',ch_id:chat_id,us_id:user_id,msg:msg},
            success:function(data){
                //alert('Reclick Ads Title');
                $('.check').append('<div class="outgoing_msg">\n\
                    <div class="sent_msg">\n\
                     <p>'+msg+'</p>\n\
                    <span class="time_date"><?= date('h:i A'); ?> | <?= date('M d'); ?></span>\n\
                </div>\n\
            </div>');
              $('#msg').val('');
            var wtf = $('.msg_history');
            var height = wtf[0].scrollHeight;
            wtf.scrollTop(height);
            }
            
        });
        //$('#check').html('<b>Chat ID : '+chat_id+'</b><br><b>User ID : '+user_id+'</b><br><p>Msg : '+msg+'</p>');
    });
});
</script>
