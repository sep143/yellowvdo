<style>
    p{
        color:red;
    }
    .alert-success1 {
    background-color: #dbf1db;
    border: 1.5px solid #458645;
        
}
.alert {
   // border: none;
    color: #000;
}
</style>

<!-- Breadcumb -->
<section class="breadcumb_area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <div class="breadcumb_section">
                    <div class="page_title">
                        <h3 style="color:#000;">Log In</h3>
                    </div>
                    <div class="page_pagination">
                        <ul>
                            <li><a href="<?= site_url(); ?>">Home</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>Log In</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Breadcumb -->

<!-- Login -->
<section class="login">
    <?= login_msg(); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <?= AlertMsg(); ?>
                <div class="login-panel widget">
                    <div class="login-body">
                        <form action="<?= site_url('user_login'); ?>" method="post">
                            <div class="form-group">
                                <label class="control-label">Email <span class="required">*</span></label>
                                <input type="text" name="user_name" placeholder="Email ID" class="form-control">
                                <div><?= form_error('user_name'); ?></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password <span class="required">*</span></label>
                                <input type="password" name="password" placeholder="Password" class="form-control">
                                <div><?= form_error('password'); ?></div>
                            </div>
                            <p class="text-center pull-right"> <a href="<?= site_url('forgot'); ?>"> Forgot password? </a> </p>
                            <div class="form-group">
                                <!--<a href="./settings_1.html" class="btn btn-block btn-lg btn-primary">Sign In</a>-->
                                <button type="submit" class="btn btn-block btn-lg btn-primary1">Sign In</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="login-with-sites text-center">
                        <a href="<?php echo $this->facebook->login_url(); ?>" style="color: white;" class="btn-facebook btn-size login-icons btn-lg btn-block">
                            <i class="fa fa-facebook"></i>&emsp;&nbsp; Login With Facebook
                        </a>
                        
                        <a href="<?php echo $this->googleplus->loginURL(); ?>" style="color: white;" class="btn-google btn-size login-icons btn-lg btn-block">
                            <i class="fa fa-google"></i>&emsp;&nbsp; Login With Google&emsp;
                        </a>
                    </div>
                    <div class="login-footer">
                        <!--                        <div class="checkbox checkbox-primary pull-left">
                                                   <input id="checkbox2" type="checkbox" >
                                                   <label for="checkbox2">
                                                   Remember me
                                                   </label>
                                                </div>-->
<!--                        <p class="text-center pull-right"> <a href="<?= site_url('forgot'); ?>"> Forgot password? </a> </p>-->
                        <div class="clearfix"></div>
                    </div>
                </div>
                <p class="text-center margin-bottom-none">Don't have an account? <a href="<?= site_url('register'); ?>"><strong>Signup</strong></a></p>
            </div>
        </div>
    </div>
</section>
<!-- End Login -->

