<!-- Breadcumb -->
<section class="breadcumb_area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <div class="breadcumb_section">
                    <div class="page_title">
                        <h3 style="color:#000;">Contact Us</h3>
                    </div>
                    <div class="page_pagination">
                        <ul>
                            <li><a href="<?= site_url(); ?>">Home</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>Contact us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Breadcumb -->

<!-- Contact Us -->
<section class="contact">
    <div class="container">
        <div class="row">
            
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-8 ">
                <?= AlertMsg(); ?>
                <div class="widget top-space margin-bottom-none">
                    <div class="widget-header">
                        
                    </div>
                    <form method="POST" action="<?= site_url('mail_admin'); ?>">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Your Name <span class="required">*</span></label>
                                    <input type="text" name="name" placeholder="Enter Name" class="form-control" maxlength="50" required="">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Your Contact No. <span class="required">*</span></label>
                                    <input type="text" name="mobile" placeholder="Enter Contact No." class="form-control" maxlength="15" required="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Your Email Address <span class="required">*</span></label>
                            <input type="email" name="email" placeholder="Enter Email Address" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Subject</label>
                            <input type="text" name="subject" placeholder="Enter The Subject" class="form-control" maxlength="150" required="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Message <span class="required">*</span></label>
                            <textarea placeholder="Enter Message" name="message" class="form-control" rows="3" required=""></textarea>
                        </div>
                        <div class="text-right">
                            <input type="submit" class="btn btn-primary1" value="Send Message">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2">&nbsp;</div>
<!--            <div class="col-md-6">
                <div class="widget margin-bottom-none">
                    <div class="widget-header">
                        <h1>Get in Touch</h1>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <hr>
                    <h4 class="heading-primary">Yellow  <strong>VDO</strong></h4>
                    <ul class="list list-icons list-icons-style-3 mt-xlg">
                        <li><i class="fa fa-fw fa-map-marker"></i> <strong>Address:</strong> 1234 Street Name, City Name, United States</li>
                        <li><i class="fa fa-fw fa-phone"></i> <strong>Phone:</strong> (123) 456-789</li>
                        <li><i class="fa fa-fw fa-envelope"></i> <strong>Email:</strong> <a href="mailto:mail@example.com">mail@example.com</a></li>
                    </ul>
                    <hr>
                    <h4 class="heading-primary">Business <strong>Hours</strong></h4>
                    <ul class="list list-icons list-dark mt-xlg">
                        <li><i class="fa fa-fw fa-clock-o"></i> Monday - Friday - 9am to 5pm</li>
                        <li><i class="fa fa-fw fa-clock-o"></i> Saturday - 9am to 2pm</li>
                        <li><i class="fa fa-fw fa-clock-o"></i> Sunday - Closed</li>
                    </ul>
                </div>
            </div>-->
        </div>
    </div>
</section>
<!-- End Contact Us -->