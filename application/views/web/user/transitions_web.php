<div class="col-sm-9">
    <?= AlertMsg(); ?>
    <div class="widget my-profile margin-bottom-none">
        <div class="widget-header">
            <h1>Payment Transaction</h1>
        </div>
        <div class="widget-body">
            <table class="table table-design table-responsive">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Detail</th>
                        <!--<th>Status</th>-->
                        <th>Refund Request</th>
                        <th>Amount</th>
                        <th>Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($transitions){
                        foreach ($transitions as $count=>$row):
                            ?>
                    <tr>
                        <td><img src="<?= base_url(); ?>/uploads/ads/_thumb/<?= $row->image; ?>" class="thumb-img img-responsive" alt=""></td>
                        <td>
                            <div class="my-item-title"><a target="_blank" href="<?= site_url('view_ad/'.$row->ID); ?>"><strong><?= $row->CaptionLine; ?></strong></a></div>
                            <div class="item-meta">
                                <ul>
                                    <li class="item-date"><i class="fa fa-clock-o"></i><?= date('d-M-Y', strtotime($row->payDT)); ?></li>
                                    <li class="item-location"><a href="#"><i class="fa fa-map-marker"></i> <?= $row->City.', '.$row->Country; ?></a></li>
                                    <!--<li class="item-type"><i class="fa fa-bookmark"></i> IN123456</li>-->
                                </ul>
                            </div>
                        </td>
                        <td>
                            <?php
                            if($row->stID == 0){
                                $current_dt = (new DateTime())->format('Y-m-d');
                                $pay_date = date('Y-m-d', strtotime($row->payDT.' + 30 days'));
                                if($pay_date >= $current_dt){
                                ?>
                            <button type="button" class="btn btn-xs btn-warning" 
                                    data-name="<?= $row->CaptionLine; ?>" 
                                    data-txtid="<?= $row->TxtID; ?>" 
                                    data-payid="<?= $row->PayID; ?>" 
                                    data-amt="<?= $row->TotalAmt; ?>" 
                                    onclick="get_ads(this)" data-target="#bootstrap-modal" data-toggle="modal" type="button">
                                <i class="fa fa-reply"></i> Refund
                            </button>
                            <?php
                                //button hide
                                }else{
                                    echo '<button type="button" class="btn btn-xs btn-danger">No refund</button>';
                                }
                            }
                            else if($row->stID == 2){
                                echo '<button type="button" class="btn btn-xs btn-danger">Requested</button>';
                            }else if($row->stID == 1){
                                echo '<button type="button" class="btn btn-xs btn-success">Refunded</button>';
                            }else if($row->stID == 4){
                                echo '<button type="button" class="btn btn-xs btn-danger">Rejected</button>';
                            }
                            ?>
                            
                        </td>
                        <td><i class="fa fa-credit-card1"></i> <?= $row->TotalAmt; ?></td>
                        <td class="text-center">
                            <?php
                            if($row->stID != 1){
                            ?>
                            <a href="<?= site_url('invoice/'.$row->transID); ?>" target="_blank"><i class="fa fa-download" style="cursor: pointer;"></i></a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    }
                    ?>
                    
<!--                    <tr>
                        <td><img src="./images/categories/cars/4.png" class="thumb-img img-responsive" alt=""></td>
                        <td>
                            <div class="my-item-title">
                                <a target="_blank" href="single.html"><strong>Lorem Ipsum is simply</strong></a>
                            </div>
                            <div class="item-meta">
                                <ul>
                                    <li class="item-date"><i class="fa fa-clock-o"></i>10.35 am, 11-Dec-2018</li>
                                    <li class="item-location"><a href="#"><i class="fa fa-map-marker"></i> Manchester</a></li>
                                    <li class="item-type"><i class="fa fa-bookmark"></i> IN123456</li>
                                </ul>
                            </div>
                        </td>
                        <td><button type="button" class="btn btn-xs btn-warning">Inactive</button></td>
                        <td>
                            <button type="button" class="btn btn-xs btn-warning" data-target="#bootstrap-modal" data-toggle="modal" ><i class="fa fa-reply"></i> Refund</button>
                            <button class="btn btn-link btn-success btn-just-icon" data-target="#bootstrap-modal" data-toggle="modal" type="button"><i class="material-icons">edit</i></button>
                        </td>
                        <td> <i class="fa fa-credit-card"></i> CC </td>
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
<form action="<?= site_url('refund_request_submit'); ?>" method="post">
<div id="bootstrap-modal" class="modal fade">
    <div class="modal-dialog">
            <input type="hidden" id="Payid" name="Payid" >
            <input type="hidden" id="Txtid" name="Txtid">
            <input type="hidden" id="Amt" name="Amt">
            
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Refund Request</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table style="width: 100%">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">Advertiser Name</td><td>:</td><td><?= $user_data->FirstName . ' ' . $user_data->LastName; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">Ads Name</td><td>:</td><td id="adsName">Ads Demo</td>
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
</div>
    </form>
<!--Popup box open end-->


 <!--popup box open start--> 
<script>
$("#bootstrap-modal").on("shown.bs.modal", function() {
//  var name = $(this).data('name');
//  $('#adsName').text(name);
//  alert(name);
});

</script>
<!--popup box open end--> 

<script>
function get_ads(current){
    var name = $(current).data('name');
    var payid = $(current).data('payid');
    var txtid = $(current).data('txtid');
    var amt = $(current).data('amt');
    
        $('#adsName').text(name);
        $('#Payid').val(payid);
        $('#Txtid').val(txtid);
        $('#Amt').val(amt);
    //alert(name);
}
</script>