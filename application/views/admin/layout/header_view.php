<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>theme/backend/assets/img/favicon.ico">
        <link rel="icon" type="image/png" href="<?= base_url(); ?>theme/backend/assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?= $this->head_tital; ?></title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

        <!--  Social tags      -->
        <meta name="keywords" content="">
        <meta name="description" content="">
        <!-- Schema.org markup for Google+ -->

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
       
        <!--image crop se dali gayi file-->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <!-- CSS Files -->
        <link href="<?= base_url(); ?>theme/backend/assets/css/material-dashboard.min40a0.css?v=2.0.2" rel="stylesheet" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="<?= base_url(); ?>theme/backend/assets/demo/demo.css" rel="stylesheet" />
        <link href="<?= base_url(); ?>theme/backend/assets/demo/custom.css" rel="stylesheet" />
        
               
       <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       
       <!--Popup Box open if select delete button and open popup and confirm than delete data-->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
       
        <!--for google map link api use-->
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCzJGdKvtCKj1g4JGFITkaEqyXPCvKIrBM"></script>--><!--apps key-->
    <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyABhRG0XvZUaEsA45MW6PVVsf9cl8Uv3hU"></script>
    </head>
    <body class="">
        <div class="wrapper ">
            <div class="sidebar" data-color="rose" data-background-color="black" data-image="<?= base_url(); ?>theme/backend/assets/img/sidebar-1.jpg">

                <div class="logo">
                    <a href="<?= site_url('admin/dashboard'); ?>" class="simple-text logo-mini"> <?= $this->short_name; ?> </a>
                    <a href="<?= site_url('admin/dashboard'); ?>" class="simple-text logo-normal"> <?= $this->site_name; ?> </a>
                </div>
                <div class="sidebar-wrapper">
                    <div class="user">
                        <div class="photo">
                            <!--<img src="<?= base_url(); ?>theme/backend/assets/img/faces/avatar.jpg" />-->
                            <img src="//icons.iconarchive.com/icons/custom-icon-design/flatastic-4/512/User-blue-icon.png" />
                        </div>
                        <div class="user-info">
                            <a data-toggle="collapse" href="#collapseExample" class="username">
                                <span> <?= $this->admin_name; ?> 
                                        <!-- <b class="caret"></b> -->
                                </span>
                            </a>
<!--                            <div class="collapse" id="collapseExample">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <span class="sidebar-mini"> MP </span>
                                            <span class="sidebar-normal"> My Profile </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <span class="sidebar-mini"> EP </span>
                                            <span class="sidebar-normal"> Edit Profile </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                            <span class="sidebar-mini"> S </span>
                                            <span class="sidebar-normal"> Settings </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>-->
                        </div>
                    </div>
                    <ul class="nav">
                        <li class="nav-item <?php if ($this->uri->segment(2) == 'dashboard') echo 'active'; ?> ">
                            <a class="nav-link" href="<?= site_url('admin/dashboard'); ?>">
                                <i class="material-icons">dashboard</i>
                                <p> <?= $this->dashboard; ?> </p>
                            </a>
                        </li>
                        <li class="nav-item <?php if ($this->uri->segment(2) == 'category') echo 'active'; ?> ">
                            <a class="nav-link" href="<?= site_url('admin/category'); ?>">
                                <i class="material-icons">folder</i>
                                <p> <?= $this->category; ?> </p>
                            </a>
                        </li>
                        <li class="nav-item <?php if ($this->uri->segment(2) == 'advertiser') echo 'active'; ?> ">
                            <a class="nav-link" href="<?= site_url('admin/advertiser/show'); ?>">
                                <i class="material-icons">supervisor_account</i>
                                <p> <?= $this->advertiser; ?> </p>
                            </a>
                        </li>
                    <!--Dropdown advertisement list button-->  
                        <li class="nav-item <?php if ($this->uri->segment(2) == 'advertisement' || $this->uri->segment(2) == 'promotion') echo 'active'; ?>">
                            <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
                                <i class="material-icons">receipt</i>
                                <p> <?= $this->advertisement_head; ?> 
                                    <b class="caret"></b>
                                </p>
                            </a>

                            <div class="collapse" id="pagesExamples">
                                <ul class="nav">
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'list') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/advertisement/list'); ?>">
                                            <i class="material-icons">AL</i>
                                            <p> <?= $this->advertisement; ?> </p>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'free-list') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/advertisement/free-list'); ?>">
                                            <i class="material-icons">FL</i>
                                            <p> <?= $this->advertisement_free_ad_list; ?> </p>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'pending') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/advertisement/pending'); ?>">
                                            <i class="material-icons">PL</i>
                                            <p> <?= $this->advertisement_pending; ?> </p>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'editads') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/advertisement/editads'); ?>">
                                            <i class="material-icons">EL</i>
                                            <p> Edit Ads </p>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'disapprove') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/advertisement/disapprove'); ?>">
                                            <i class="material-icons">DL</i>
                                            <p> <?= $this->advertisement_disapprove; ?> </p>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'expired') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/advertisement/expired'); ?>">
                                            <i class="material-icons">EL</i>
                                            <p> <?= $this->advertisement_expired; ?> </p>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'due_payment') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/advertisement/due_payment'); ?>">
                                            <i class="material-icons">PP</i>
                                            <p> <?= $this->advertisement_payment_ads; ?> </p>
                                        </a>
                                    </li>
                                    
<!--                                    <li class="nav-item <?php if ($this->uri->segment(2) == 'promotion') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?php site_url('admin/promotion/video'); ?>">
                                            <i class="material-icons">VD</i>
                                            <p> <?= $this->promotion; ?> </p>
                                        </a>
                                    </li>-->
                                    
                                </ul>
                            </div>
                        </li>
                        <!--payment dropdown div-->
                        <?php
                        if($this->session->userdata('log_role') == 1){
                        ?>
                        <li class="nav-item <?php if ($this->uri->segment(3) == 'transition' || $this->uri->segment(3) == 'refund') echo 'active'; ?>">
                            <a class="nav-link" data-toggle="collapse" href="#payment">
                                <i class="material-icons">account_balance</i>
                                <p> <?= $this->payment_head; ?> 
                                    <b class="caret"></b>
                                </p>
                            </a>

                            <div class="collapse" id="payment">
                                <ul class="nav">
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'transition') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/payment/transition'); ?>">
                                            <i class="material-icons">PH</i>
                                            <p> <?= $this->payment_history; ?> </p>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'refund') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/payment/refund'); ?>">
                                            <i class="material-icons">RF</i>
                                            <p> <?= $this->refund_request; ?> </p>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item <?php if ($this->uri->segment(2) == 'message') echo 'active'; ?> ">
                            <a class="nav-link" href="<?= site_url('admin/message/show'); ?>">
                                <i class="material-icons">mail</i>
                                <p> <?= $this->message; ?> </p>
                            </a>
                        </li>
                        
                        <!--Reminder drop down start-->
                        <li class="nav-item <?php if ($this->uri->segment(3) == 'renew_ads' || $this->uri->segment(3) == 'pendings_ads') echo 'active'; ?>">
                            <a class="nav-link" data-toggle="collapse" href="#reminder">
                                <i class="material-icons">notifications</i>
                                <p> <?= $this->reminder_head; ?> 
                                    <b class="caret"></b>
                                </p>
                            </a>

                            <div class="collapse" id="reminder">
                                <ul class="nav">
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'renew_ads') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/reminder/renew_ads'); ?>">
                                            <i class="material-icons">account_balance</i>
                                            <p> <?= $this->reminder_renew; ?> </p>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'pendings_ads') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/reminder/pendings_ads'); ?>">
                                            <i class="material-icons">redo</i>
                                            <p> <?= $this->reminder_pending_ads; ?> </p>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <!--Reminder drop down end-->
                        
<!--                        <li class="nav-item <?php if ($this->uri->segment(2) == 'notification') echo 'active'; ?> ">
                            <a class="nav-link" href="<?= site_url('admin/notification/show'); ?>">
                                <i class="material-icons">notifications</i>
                                <p> Notification </p>
                            </a>
                        </li>-->
<!--                        <li class="nav-item <?php if ($this->uri->segment(2) == 'enquiry') echo 'active'; ?> ">
                            <a class="nav-link" href="<?= site_url('admin/enquiry'); ?>">
                                <i class="material-icons">notifications</i>
                                <p> <?= $this->enquiry; ?> </p>
                            </a>
                        </li>-->
                        
                        <li class="nav-item <?php if ($this->uri->segment(2) == 'review') echo 'active'; ?> ">
                            <a class="nav-link" href="<?= site_url('admin/review'); ?>">
                                <i class="material-icons">comment</i>
                                <p> <?= $this->review; ?> </p>
                            </a>
                        </li>
                        <li class="nav-item <?php if ($this->uri->segment(2) == 'import') echo 'active'; ?> ">
                            <a class="nav-link" href="<?= site_url('admin/import/view'); ?>">
                                <i class="material-icons">arrow_upward</i>
                                <p> Import </p>
                            </a>
                        </li>
                        <!--Setting list start-->
                        <?php
                        if($this->session->userdata('log_role') == 1){
                        ?>
                        <li class="nav-item <?php if ($this->uri->segment(2) == 'setting') echo 'active'; ?>">
                            <a class="nav-link" data-toggle="collapse" href="#setting">
                                <i class="material-icons">build</i>
                                <p> <?= $this->setting; ?> 
                                    <b class="caret"></b>
                                </p>
                            </a>

                            <div class="collapse" id="setting">
                                <ul class="nav">
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'common_setting') echo 'active'; ?> ">
                                        <a class="nav-link" href="<?= site_url('admin/setting/common_setting'); ?>">
                                            <i class="material-icons">CS</i>
                                            <p> <?= $this->setting_common; ?> </p>
                                        </a>
                                    </li>
                                    <!--This page only view super admin access other wise hide-->
                                    <?php
                                    if($this->session->userdata('log_role') == 1){
                                        ?>
                                    <li class="nav-item <?php if ($this->uri->segment(3) == 'user_role') echo 'active'; ?> ">
                                            <a class="nav-link" href="<?= site_url('admin/setting/user_role'); ?>">
                                                <i class="material-icons">UR</i>
                                                <p> <?= $this->setting_role; ?> </p>
                                            </a>
                                        </li>
                                    <?php
                                    }
                                    ?>

                                </ul>
                            </div>
                        </li>
                       <?php
                        }
                       ?>
       
                    </ul>
                </div>
            </div>

            <div class="main-panel">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
                    <div class="container-fluid">
                        <div class="navbar-wrapper">

                            <div class="navbar-minimize">
                                <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                                    <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                                    <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                                </button>
                            </div>

                            <a class="navbar-brand" href="#"><?= $tital; ?></a>
                            <!--If language select then set session and reload page then set string to call core controller-->
                            <span>
                                <?php if(!empty($this->session->userdata['lang_set']['language'])) {
                             $lang_ses = $this->session->userdata['lang_set']['language'];   
                            } ?></span>
                            
                        </div>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-end">
<!--                            <form class="navbar-form">
                                <div class="input-group no-border">
                                    <input type="text" value="" class="form-control" placeholder="Search...">
                                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                        <i class="material-icons">search</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </form>-->

                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="btn btn-warning" href="<?= site_url('admin/free_ad'); ?>" id="free_ad_post">Free Ads</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= site_url('admin/dashboard'); ?>">
                                        <i class="material-icons">dashboard</i>
                                        <p class="d-lg-none d-md-block">
                                            Stats
                                        </p>
                                    </a>
                                </li>
                                <!--all notification add-->
                                <?php
                                $notify_count = '';
                                if($this->user_count || $this->ads_count || $this->edit_ads_count || $this->refund_count || $this->msg_count){
                                    if($this->session->userdata('log_role') == 1){
                                        $this->refund_count;
                                    }else{
                                        $this->refund_count = 0;
                                    }
                                    $notify_count = $this->user_count+$this->ads_count+$this->edit_ads_count+$this->refund_count+$this->msg_count;
                                }
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">notifications</i>
                                        <?php
                                        if(!empty($notify_count)){
                                            echo '<span class="notification">'.$notify_count.'</span>';
                                        }
                                        ?>
                                        <p class="d-lg-none d-md-block">
                                            Some Actions
                                        </p>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        <?php
                                        if(!empty($this->user_count)){
                                            echo '<a class="dropdown-item" onclick="change_notification(this)" data-status="1" href="#"><strong>'.$this->user_count.'</strong>  &nbsp; New advertiser registered</a>';
                                        }
                                        if(!empty($this->ads_count)){
                                            echo '<a class="dropdown-item" onclick="change_notification(this)" data-status="2" href="#"><strong>'.$this->ads_count.'</strong> &nbsp; New ads are pending for approved</a>';
                                        }
                                        if(!empty($this->edit_ads_count)){
                                            echo '<a class="dropdown-item" onclick="change_notification(this)" data-status="3" href="#"><strong>'.$this->edit_ads_count.'</strong> &nbsp; Edited ads are pending for approved</a>';
                                        }
                                        if(!empty($this->refund_count) && $this->session->userdata('log_role') == 1){
                                            echo '<a class="dropdown-item" onclick="change_notification(this)" data-status="4" href="#"><strong>'.$this->refund_count.'</strong> &nbsp; Refund request for advertiser</a>';
                                        }
                                        if(!empty($this->msg_count)){
                                            echo '<a class="dropdown-item" onclick="change_notification(this)" data-status="5" href="#"><strong>'.$this->msg_count.'</strong> &nbsp; New messages check inbox</a>';
                                        }
                                        if(empty($notify_count)){
                                            echo '<p> &nbsp;&nbsp;No notification.</p>';
                                        }
                                        ?>
                                           
                                    </div>
                                </li>
<!--                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="http://example.com/" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">mail</i>
                                        <span class="notification">5</span>
                                        <p class="d-lg-none d-md-block">
                                            Some Actions
                                        </p>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="#">Mike John responded to your email</a>
                                        <a class="dropdown-item" href="#">You have 5 new tasks</a>
                                        <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                                        <a class="dropdown-item" href="#">Another Notification</a>
                                        <a class="dropdown-item" href="#">Another One</a>
                                    </div>
                                </li>-->
<!--                                <li class="nav-item dropdown">
                                    <select id="lang" name="lang">
                                        <option value="english" <?php if(!empty($lang_ses)){ if($lang_ses == 'english'){     echo 'selected';} }?> >English</option>
                                            <option value="hindi" <?php if(!empty($lang_ses)){ if($lang_ses == 'hindi'){     echo 'selected';} }?> >Hindi</option>
                                        </select>

                                </li>-->

                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url('admin/logout'); ?>" title="Log-Out">
                                        <i class="material-icons">power_settings_new</i>
                                        <p class="d-lg-none d-md-block">
                                            Logout
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                
<script>
$(document).ready(function(){
    $('select[id^="lang"]').change(function(){
        var value = $(this).val();
        $.ajax({
            url:'<?= site_url('admin/SessionController/languageSession'); ?>',
            type:'post',
            data:{lang: value},
            success:function(data){
                //alert(data+' Done');
                location.reload();
            }
                    
        });
    });
});
</script>

<!--Notification click then all--> 
<script>
//$(document).ready(function(){
    function change_notification(current){
        var status = $(current).data('status');
        //alert(status);
       $.ajax({
           url:'<?= site_url('admin/SessionController/change_notification_after_view'); ?>',
           type:'post',
           data:{status:status},
           success:function(data){
               if(data){
                  // alert('success');
//                   var notify = $.notify('<strong>Process...</strong>', {
//                        allow_dismiss: false,
//                        showProgressbar: false
//                    });
                if(status == 1){
                    window.location = '<?= site_url('admin/advertiser/show'); ?>';
//                    setTimeout(function() {
//                    notify.update({'type': 'success'});
//                    }, 1500);
//                    setTimeout(function() {
//                        window.location = '<?= site_url('admin/advertiser/show'); ?>';
//                    }, 3000);
                }else if(status == 2){
                    window.location = '<?= site_url('admin/advertisement/pending'); ?>';
//                    setTimeout(function() {
//                    notify.update({'type': 'success'});
//                    }, 1500);
//                    setTimeout(function() {
//                        window.location = '<?= site_url('admin/advertisement/pending'); ?>';
//                    }, 3000);
                }else if(status == 3){ //edit ads
                    window.location = '<?= site_url('admin/advertisement/editads'); ?>';
//                    setTimeout(function() {
//                    notify.update({'type': 'success'});
//                    }, 1500);
//                    setTimeout(function() {
//                        window.location = '<?= site_url('admin/advertisement/pending'); ?>';
//                    }, 3000);
                }else if(status == 4){
                    window.location = '<?= site_url('admin/payment/refund'); ?>';
//                    setTimeout(function() {
//                    notify.update({'type': 'success'});
//                    }, 1500);
//                    setTimeout(function() {
//                        window.location = '<?= site_url('admin/payment/refund'); ?>';
//                    }, 3000);
                }else if(status == 5){
                    window.location = '<?= site_url('admin/message/show'); ?>';
//                    setTimeout(function() {
//                    notify.update({'type': 'success'});
//                    }, 1500);
//                    setTimeout(function() {
//                        window.location = '<?= site_url('admin/message/show'); ?>';
//                    }, 3000);
                }
                
            }
               
           }
       });
    }
//});
</script>