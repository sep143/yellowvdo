<div class="col-sm-9">
    <div class="widget my-profile margin-bottom-none">
        <div class="widget-header">
            <h1>Dear, <?= $user_data->FirstName; ?> </h1>
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
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"></a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="items">
                                                <div class="col-md-9">
                                                    <table class="table table-striped">
                                                        <tr>
<!--                                                            <td colspan="2">
                                                                <a class="btn btn-warning btn-sm pull-right"
                                                                   href="http://www.startajobboard.com/"
                                                                   title="Remove Item">X</a>
                                                                <b>
                                                                    Premium Posting</b></td>-->
                                                        </tr>
                                                        <tr>
                                                            <td><p>We are sorry! Your last transaction was cancelled.</p>
<!--                                                                <ul>
                                                                    <li>One Job Posting Credit</li>
                                                                    <li>Job Distribution*</li>
                                                                    <li>Social Media Distribution</li>
                                                                </ul>-->
                                                            </td>
<!--                                                            <td>
                                                                <b>$1010.00</b>
                                                            </td>-->
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-3">
                                                    <div style="text-align: center;">
                                                        <h3>Total</h3>
                                                        <h3><span style="color:green;">$1010.00</span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <div style="text-align: center; width:100%;">
                                            <a style="width:100%;"  href="<?= site_url('myads'); ?>"
                                               class=" btn btn-danger"> Retry »</a></div>
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
