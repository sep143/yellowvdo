<div class="col-sm-9">
    <div class="widget my-profile margin-bottom-none">
        <div class="widget-header">
            <h1>Dear, <?= $user_data->FirstName; ?> </h1>
        </div><hr>
        <div class="widget-body">
            
            <div id='mainContentWrapper'>
                <div class="col-md-8 col-md-offset-2">
                    <h2 style="text-align: center;">
                        <br>
                    </h2>

                    <div class="shopping_cart">
                        <div>
                            <span>Thank you for your purchase. Your payment was successful.</span><br/>
                            <span>Item Number : 
                                <strong><?php echo $item_number; ?></strong>
                            </span><br/>
                            <span>TXN ID : 
                                <strong><?php echo $txn_id; ?></strong>
                            </span><br/>
                            <span>Amount Paid : 
                                <strong>$<?php echo $payment_amt.' '.$currency_code; ?></strong>
                            </span><br/>
                            <span>Payment Status : 
                                <strong><?php echo $status; ?></strong>
                            </span><br/><br/>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-md-offset-2">
                    <span>
                        <!-- <STRONG>Redirect to my ads:</STRONG> <br/> -->
                    Your Ad is submited and pending approval from admin. you can Check ad status in my ads.</span>
                </div>
                <div class="col-md-8 col-md-offset-2"><br/>
                    <a class="btn btn-primary1 btn-md" href="<?php echo base_url('myads');?>">Go to My Ads</a>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
