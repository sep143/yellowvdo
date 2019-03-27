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
                         <h3 style="color:#000;">Reset Password</h3>
                     </div>
                     <div class="page_pagination">
                        <ul>
                            <li><a href="<?= site_url(); ?>">Home</a></li>
                           <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                           <li>Reset password</li>
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
                         <form action="<?= site_url('update_password'); ?>" method="post">
                             <input type="hidden" name="key" value="<?= $temp_email; ?>">
                           <div class="form-group">
                              <label class="control-label">Email <span class="required">*</span></label>
                              <input type="email" name="email" value="<?= set_value('email'); ?>" placeholder="Your Email" class="form-control" required="">
                              <div><?= form_error('email'); ?></div>
                           </div>
                           <div class="form-group">
                              <label class="control-label">Password <span class="required">*</span></label>
                              <input type="password" name="password"  placeholder="Enter New Password" class="form-control" id="pass1" onkeyup="checkPass(); return false;" required="">
                              <div><?= form_error('password'); ?></div>
                           </div>
                           <div class="form-group">
                              <label class="control-label">Confirm Password <span class="required">*</span></label>
                              <input type="password" name="cpassword"  placeholder="Enter Confirm Password" class="form-control" id="pass2" onkeyup="checkPass(); return false;" required="">
                              <div><?= form_error('cpassword'); ?></div>
                              <div id="error-nwl">&nbsp;</div>
                           </div>
                           <div class="form-group">
                               <button type="submit" class="btn btn-block btn-lg btn-primary1">Reset Password</button>
                           </div>
                        </form>
                     </div>
                  </div>
                   <p class="text-center margin-bottom-none">Don't have an account? <a href="<?= site_url('login'); ?>"><strong>Login</strong></a></p>
               </div>
            </div>
         </div>
      </section>
      <!-- End Forgot Password -->
      
      
<script>
function checkPass()
{
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    var message = document.getElementById('error-nwl');
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
 	
    if(pass1.value.length > 7)
    {
//        pass1.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "character number ok!"
    }
    else
    {
//        pass1.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = " you have to enter at least 8 digit!"
        return;
    }
  
    if(pass1.value == pass2.value)
    {
//        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "ok !"
    }
	else
    {
//        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = " These passwords don't match"
    }
} 
</script>