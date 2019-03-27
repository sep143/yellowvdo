<?php
                                if($all_ads){
                                    foreach ($all_ads as $count=>$row):
                                        ?>
                                <div class="item">
                                            <div class="item-ads-grid icon-violet">
<!--                                                                                         <div class="item-badge-grid btn-primary">
                                                                                             <a href="#">Premium Ad</a>
                                                                                         </div>-->
                                                <div class="item-img-grid">
                                                    <a class="" href="<?= site_url('view/'.$row->ID); ?>" target="_blank">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <?php
                                                                if(!empty($row->image)){
                                                                    $image = base_url().'uploads/ads/_thumb/'.$row->image;
                                                                }else{
                                                                    $image = base_url().'theme/web/images/banner_design.png';
                                                                }
                                                                ?>
                                                                <img alt="" src="<?= $image; ?>" style="width: 250px; height: 215px; object-fit: cover;" class="responsive img-responsive img-center" >
<!--                                                         <div class="item-title">
                                                             <a href="single.html">
                                                                 <h4>Passage of Lorem Ipsum </h4>
                                                             </a>
                                                             <h3>$ 64.5000</h3>
                                                         </div>-->
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h4>&nbsp;</h4>
                                                                        <!--<h3 class="group inner list-group-item-heading" >Restaurant > Veg</h3>-->
                                                                        <div class="my-item-title">
                                                                            <strong style="font-size: 18px; padding-left: 10px; color:#000;"><?= $row->BusinessName; ?></strong>
                                                                        </div>
                                                                        
                                                                        <small style="color:#6b6b6b; padding-left: 10px;" id="ads_in_ssn<?= $row->ID; ?>"></small><br>
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
                                                                        <div class="text-justify" style="padding-right: 10px; padding-left: 10px; color: #000;">
                                                                            <?= $row->CaptionLine; ?>
                                                                            <?php mb_strimwidth($row->Description, 0, 250, "..."); ?>
                                                                            
                                                                        </div>
                                                                        <div class="align-left text-left">
                                                                            <ul style="padding-left: 10px; padding-right: 10px; ">
                                                                                
                                                                                <?php
//                                                                                    if ($row->CellNoShow == 1) {
//                                                                                        echo '<li class="item-date"><i class="fa fa-mobile"></i> &nbsp;'.$row->CellNo.'</li>';
//                                                                                    } 
                                                                                    ?>
                                                                                    <?php
                                                                                    if($row->BusinessAddressShow == 1){
                                                                                        echo '<li class="item-cat"><i class="fa fa-map-marker"></i> &nbsp;'. $row->BusinessAddress.' </li>';
                                                                                    }
                                                                                    ?>
                                                                                <!--<li class="item-type"><i class="fa fa-bookmark"></i> New</li>-->
                                                                            </ul>
                                                                        </div>
                                                                        <div class="align-left text-left"><br>
                                                                            <table class="table table-responsive" style="width: 100%;">
                                                                                <tr style="border-top: 1pt solid lightgray;">
                                                                                    <td style="width: 50%;"><i class="fa fa-mobile" style="font-size:20px;"></i> &nbsp;<a href="tel:<?= $row->CellNo; ?>"> <?= $row->CellNo; ?></a></td>
                                                                                    <td style="width: 50%;"><i class="fa fa-envelope"></i> &nbsp; <a href="mailto:<?= $row->Email; ?>"><?= $row->Email; ?></a></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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