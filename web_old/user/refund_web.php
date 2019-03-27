<div class="col-sm-9">
    <div class="widget my-profile margin-bottom-none">
        <div class="widget-header">
            <h1>Refund Request</h1>
        </div>
        <div class="widget-body">
            <table id="refundTable" class="table table-design display" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Detail</th>
                        <!--<th>Status</th>-->
                        <th>Status</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($refund){
                        foreach ($refund as $count=>$row):
                            ?>
                    <tr>
                        <td><img src="<?= base_url(); ?>/uploads/ads/<?= $row->image; ?>" class="thumb-img img-responsive" alt=""></td>
                        <td>
                            <div class="my-item-title"><a target="_blank" href="<?= site_url('view_ad/'.$row->Ad_id); ?>"><strong><?= $row->CaptionLine; ?></strong></a></div>
                            <div class="item-meta">
                                <ul>
                                    <li class="item-date"><i class="fa fa-clock-o"></i><?= date('d-M-Y', strtotime($row->refundDT)); ?></li>
                                    <li class="item-location"><a href="#"><i class="fa fa-map-marker"></i> <?= $row->City.', '.$row->Country; ?></a></li>
                                    <!--<li class="item-type"><i class="fa fa-bookmark"></i> IN123456</li>-->
                                </ul>
                            </div>
                        </td>
                        <td>
                            <?php
                            $btn = '';
                            $text = '';
                            if($row->Status == 0){
                                $btn = 'btn-warning';
                                $text = 'Pending';
                            }else if($row->Status == 1){
                                $btn = 'btn-success';
                                $text = 'Success';
                            }else if($row->Status == 2){
                                $btn = 'btn-danger';
                                $text = 'Rejected';
                            }
                            ?>
                            <button type="button" class="btn btn-xs <?= $btn; ?>"><?= $text; ?></button>
                        </td>
                        <td><button type="button" class="btn btn-xs btn-primary" 
                                    data-usermsg="<?= $row->UserMsg; ?>" 
                                    data-adminmsg="<?php if(!empty($row->AdminMsg)) echo $row->AdminMsg; ?>" 
                                    onclick="get_ads(this)"
                                    data-target="#bootstrap-modal" data-toggle="modal" type="button"><i class="fa fa-eye"></i> View</button></td>
                    </tr>
                    <?php
                        endforeach;
                    }
                    ?>
<!--                    <tr>
                        <td><img src="./images/categories/real_estate/1.png" class="thumb-img img-responsive" alt=""></td>
                        <td>
                            <div class="my-item-title"><a target="_blank" href="single.html"><strong>Lorem Ipsum is simply</strong></a></div>
                            <div class="item-meta">
                                <ul>
                                    <li class="item-date"><i class="fa fa-clock-o"></i>10.35 am, 12-Dec-2018</li>
                                    <li class="item-location"><a href="#"><i class="fa fa-map-marker"></i> Manchester</a></li>
                                    <li class="item-type"><i class="fa fa-bookmark"></i> IN123456</li>
                                </ul>
                            </div>
                        </td>
                        <td><button type="button" class="btn btn-xs btn-success">Success</button></td>
                        <td><button type="button" class="btn btn-xs btn-primary" data-target="#bootstrap-modal" data-toggle="modal" type="button"><i class="fa fa-eye"></i> View</button></td>
                        <td><i class="fa fa-credit-card"></i> CC</td>
                                 <td>
                           <div class="action">
                              <a class="label label-success" title="" data-placement="top" data-toggle="tooltip" href="#" data-original-title="Message"><i class="fa fa-comment"></i></a>
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
                  <?php echo $links; ?>
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
<!--Popup box open start-->
<div id="bootstrap-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Refund Request</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
<!--                                <p>Advertiser Name : Test 1</p>
                        <p>Ads Name : Ads Demo</p>
                        <p>Ads ID : IN123456</p>-->
                        <div style="">
                            <label>User Message :</label>
                            <pre id="userMsg"></pre>
                        </div>

                    </div>
                </div>&nbsp;<br>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <div style="">
                            <label>Admin Message :</label>
                            <pre id="adminMsg">Under Process...</pre>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <!--<button class="btn btn-success" type="button">Submit</button>&nbsp;-->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
<!--Popup box open end-->


<script>
function get_ads(current){
    var userMsg = $(current).data('usermsg');
    var adminMsg = $(current).data('adminmsg');
        $('#userMsg').text(userMsg);
        if(adminMsg != ''){
            $('#adminMsg').text(adminMsg);
        }
}
</script>