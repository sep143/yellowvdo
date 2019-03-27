<div class="col-sm-9">
    <div class="widget my-profile margin-bottom-none">
        <div class="widget-header">
            <h1>Review Your Order & Complete Checkout <a href="<?= site_url('myads'); ?>" class="btn btn-sm btn-primary pull-right">Back</a></h1>
        </div>
        <div class="widget-body">
            
            <div id='mainContentWrapper'>
                <div class="col-md-8 col-md-offset-2">
                    <h2 style="text-align: center;">
                        <br>
                    </h2>

                    <div class="shopping_cart">
                        <form class="form-horizontal" role="form" action="" method="post" id="payment-form">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><?= $ads->BusinessName; ?></a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="items">
                                                <div class="col-md-12">
                                                    <table class="table ">
                                                        <thead>
                                                            <tr>
                                                                <th>Description</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?= $ads->CaptionLine; ?></td>
                                                                <td>$ 1000</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tax</td>
                                                                <td>$ 10 </td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td class="pull-right"> Total </td>
                                                                <td> <span style="color:green;">$ 1010.00</span> </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
<!--                                                <div class="col-md-3">
                                                    <div style="text-align: center;">
                                                        <h3>Order Total</h3>
                                                        <h3><span style="color:green;">$10.00</span></h3>
                                                    </div>
                                                </div>-->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <div style="text-align: center; width:100%;">
                                            <a style="width:100%;" href="<?= site_url('PaymentGetwayController/buy/'.$ads->ID); ?>"
                                               class=" btn btn-success">Pay Now </a></div>
                                    </h4>
                                </div>
                            </div>
                           
                    </div>
                </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
</div>
</div>
</section>
