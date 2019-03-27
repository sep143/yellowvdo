<style>
    p{
        color:red;
    }
</style> 

<!-- Breadcumb -->
      <section class="breadcumb_area">
         <div class="container">
            <div class="row">
               <div class="col-xs-12 text-center">
                  <div class="breadcumb_section">
                     <div class="page_title">
                         <h3 style="color:#000;">Forgot Password</h3>
                     </div>
                     <div class="page_pagination">
                        <ul>
                            <li><a href="<?= site_url(); ?>">Home</a></li>
                           <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                           <li>Forgot password</li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- End Breadcumb -->
      
	  <!-- Forgot Password -->
      <section class="forgot-password">
         <div class="container">
            <div class="row">
               <div class="col-sm-4 col-sm-offset-4">
                   <?= AlertMsg(); ?>
                  <div class="login-panel widget">
                     <div class="login-body">
                         <form action="<?= site_url('user_forgot'); ?>" method="post">
                           <div class="form-group">
                              <label class="control-label">Email <span class="required">*</span></label>
                              <input type="email" name="email" value="<?= set_value('email'); ?>" placeholder="Your Email" class="form-control" required="">
                              <div><?= form_error('email'); ?></div>
                           </div>
                           <div class="form-group">
                               <button type="submit" class="btn btn-block btn-lg btn-primary1">Send Reset Link</button>
                           </div>
                        </form>
                     </div>
                  </div>
                   <!--<p class="text-center margin-bottom-none">Have an account ? <a href="<?= site_url('login'); ?>"><strong>Login</strong></a></p>-->
                   <p class="text-center margin-bottom-none">Don't have an account? <a href="<?= site_url('register'); ?>"><strong>Signup</strong></a></p>
               </div>
            </div>
         </div>
      </section>
      <!-- End Forgot Password -->