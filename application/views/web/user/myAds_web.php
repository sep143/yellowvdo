<style type="text/css">
.center-cropped {
background-repeat: no-repeat;
object-fit: cover; // Do not scale the image /
object-position: center; // Center the image within the element /
overflow: hidden;
}

</style>

<div class="col-sm-9">
    <?= AlertMsg(); ?>
    <div class="widget my-profile margin-bottom-none">
        <div class="widget-header">
            <h1>My Ads <a href="<?= site_url('create_ad'); ?>" class="btn btn-primary1 btn-md pull-right">Create Ad</a></h1>
        </div>
        <div class="widget-body">
            <table class="table table-design">
                <tbody>
                    <?php
                    if($ads){
                        foreach ($ads as $count=>$row):
                            ?>
                    <tr>
                        <td>
                            <?php
                            if(!empty($row->image)){
                                $ad_image = base_url().'uploads/ads/_thumb/'. $row->image;
                            }else{
                                $ad_image = base_url().'theme/web/images/banner_design.png';
                            }
                            ?>
                            <img src="<?= $ad_image; ?>" class="thumb-img img-responsive center-cropped" alt="Ads Image">
                        </td>
                        <td>
                            <div class="my-item-title"><a target="_blank" href="<?= site_url('view_ad/'.$row->ID); ?>"><strong><?= $row->CaptionLine; ?></strong></a></div>
                            <div class="item-meta">
                                <ul>
                                    <li class="item-date"><i class="fa fa-clock-o"></i><?= date('d-M-Y', strtotime($row->CreatedDT)); ?></li>
                                    <!--<li class="item-date"><i class="fa fa-clock-o"></i><?= date('d-M-Y', strtotime($row->ExpiryDT)); ?></li>-->
                                    <li class="item-location"><a href="javascript:void(0)"><i class="fa fa-map-marker"></i> <?= $row->City.', '.$row->Country; ?></a></li>
                                    <!--<li class="item-type"><i class="fa fa-bookmark"></i> Used</li>-->
                                </ul>
                            </div>
                        </td>
                        <td>
                            <?php
                            if($row->StatusID == 0){
                                $btn = 'btn-info';
                                $text = 'Pending';
                            }else if($row->StatusID == 1){
                                $btn = 'btn-success';
                                $text = 'Active';
                            }else if($row->StatusID == 2){
                                $btn = 'btn-warning';
                                $text = 'Inactive';
                            }else if($row->StatusID == 4){
                                $btn = 'btn-danger';
                                $text = 'Disapprove';
                            }else if($row->StatusID == 5){
                                $btn = 'btn-danger';
                                $text = 'Expired';
                            }else if($row->StatusID == 6){
                                $btn = 'btn-primary';
                                $text = 'Payment Due';
                            }
                            ?>
                            <!--<button type="button" style="cursor: default;" class="btn btn-xs <?= $btn; ?>"><?= $text; ?></button>-->
                            <span style="cursor: def; pointer-events: none;" class="btn btn-xs <?= $btn; ?>"><?= $text; ?></span>
                        </td>
                        <td>
                            <?php
                            if($row->StatusID == 5){
                                echo '<a href="'.  site_url('payment/'.$row->ID).'" class="btn btn-xs btn-warning">Renew</a>'; 
                            }else if($row->StatusID == 6){
                                echo '<a href="'.  site_url('payment/'.$row->ID).'" class="btn btn-xs btn-primary">Pay</a>';
                            }else{
                                echo '-';
                            }
                            ?>
                        </td>
                        <td style="width: 120px;">
                            <div class="action">
                                <a class="label label-success" title="" data-target="#bootstrap-modal" data-toggle="modal" data-placement="top" data-original-title="Message"
                                   data-id="<?= $row->ID; ?>"
                                   data-adsname="<?= $row->BusinessName; ?>" onclick="msg_click(this)"><i class="fa fa-comment"></i></a>
                            
                                <a class="label label-warning" title="" data-placement="top" data-toggle="tooltip" href="<?= site_url('edit_ad/'.$row->ID); ?>" data-original-title="Edit Ad"><i class="fa fa-pencil"></i></a>
                                <a class="label label-info" title="" data-placement="top" data-toggle="tooltip" href="<?= site_url('view_ad/'.$row->ID); ?>" target="_blank" data-original-title="View Ad"><i class="fa fa-eye"></i></a>
                                <a class="label label-danger" title="" data-placement="top" data-toggle="tooltip" data-id='<?= $row->ID; ?>' data-status="3" onclick="change_status(this)" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    }else{
                        echo '';
                    }
                    ?>
                    
<!--                    <tr>
                        <td><img src="./images/categories/hotels/1.png" class="thumb-img img-responsive" alt=""></td>
                        <td>
                            <div class="my-item-title"><a target="_blank" href="single.html"><strong>Lorem Ipsum is simply</strong></a></div>
                            <div class="item-meta">
                                <ul>
                                    <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 am</li>
                                    <li class="item-location"><a href="#"><i class="fa fa-map-marker"></i> Manchester</a></li>
                                    <li class="item-type"><i class="fa fa-bookmark"></i> Used</li>
                                </ul>
                            </div>
                        </td>
                        <td><button type="button" class="btn btn-xs btn-danger">Inactive</button></td>
                        <td><strong>-</strong></td>
                        <td>
                            <div class="action">
                                <a class="label label-success" title="" data-placement="top" data-target="#bootstrap-modal" data-toggle="modal" href="#" data-original-title="Message"><i class="fa fa-comment"></i></a>
                                <a class="label label-warning" title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Edit Ad"><i class="fa fa-pencil"></i></a>
                                <a class="label label-info" title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="View Ad"><i class="fa fa-eye"></i></a>
                                <a class="label label-danger" title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>-->
                    
                </tbody>
            </table>
            <div class="text-center">
                <ul class="pagination pagination-sm">
                    <?php echo $links;?>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</section>
<!-- End My Ads -->

<!--Popup box open start-->
<div id="bootstrap-modal" class="modal fade">
    <form action="<?= site_url('myads_msg'); ?>" method="POST">
        <input type="hidden" id="id" name="id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Message</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">Advertiser Name</td><td>:</td><td><?= $user_data->FirstName.' '.$user_data->LastName; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Ads Name</td><td>:</td><td id="adsname"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Message :</label>
                                <textarea class="form-control" rows="5" name="msg" onkeyup="this.value = this.value.replace(/[&*<>]/g, '')"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit">Submit</button>&nbsp;
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </form>
</div>
<!--Popup box open end-->

<script>
function msg_click(current){
    var id = $(current).data('id');
    var adsName = $(current).data('adsname');
    $('#id').val(id);
    $('#adsname').text(adsName);
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
 <!--Category Table in Active and deactive ajax-->
<script>
function change_status(current){
        var id = $(current).data('id');
        var status = $(current).data('status');
        
        if(status == 3){
                  // alert('delete');     
            $.confirm({
                //animation: 'zoom',
                icon:'fa fa-warning',
                title: 'Delete Advertisement',
                content: 'This Advertisement and all associated data will be deleted. This is not reversible.',
                theme: 'modern',
                buttons: {
                    confirm: function () {
                       
                       $.ajax({
                            url:'<?= site_url('deleted_ad'); ?>',
                            type:'POST',
                            data:{id:id, value: '3'},
                            success:function(data){
                               // alert('delete');
                                $.confirm({
                                   //animation: 'zoom',
                                    icon:'fa fa-check-circle',
                                    title: 'Advertisement Deleted',
                                    content: 'The selected Advertisement and associated data was deleted.',
                                    theme: 'modern',
                                    buttons:{
                                        Ok: function(){
                                            window.location.reload();
                                        }
                                    }
                               });
                            }
                        });
                       
                    },
                    cancel: function () {
                        //$.alert('Canceled!');
                    },
                    
                }
            });
        }
        
    }
</script> 