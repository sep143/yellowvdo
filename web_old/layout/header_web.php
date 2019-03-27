<!DOCTYPE html>
<html lang="en">

    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>YellowVdo</title>

        <!-- Favicon Icon -->
        <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>theme/web/images/favicon.ico">
        <link rel="icon" type="image/png" href="<?= base_url(); ?>theme/web/images/favicon.ico">

        <!--  Social tags      -->
        <meta name="keywords" content="">
        <meta name="description" content="">
        
        <!-- Bootstrap CSS -->
        <link href="<?= base_url(); ?>theme/web/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?= base_url(); ?>theme/web/css/style.css" rel="stylesheet">
        <link href="<?= base_url(); ?>theme/web/css/custome.css" rel="stylesheet">
       
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="<?= base_url(); ?>theme/web/plugins/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="<?= base_url(); ?>theme/web/plugins/owl-carousel/owl.theme.css">

        <!-- Font Awesome -->
        <link href="<?= base_url(); ?>theme/web/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!--<script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>-->
        <script src="<?= base_url(); ?>theme/web/js/jquery.js"></script>
        
        <!--Popup Box open if select delete button and open popup and confirm than delete data-->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
        
        <!--for google map link api use-->
        <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyABhRG0XvZUaEsA45MW6PVVsf9cl8Uv3hU"></script>

        <!--Using to footer in google play and mac button to use-->
        <style>
            .app-store, .app-store:hover {
                background: #ffffff none repeat scroll 0 0;
                border-radius: 32px;
                color: #7e7e7e;
                display: block;
                padding-bottom: 0px;
                padding-left: 47px;
                padding-top: 0px;
                position: relative;
                text-decoration: none;
            }
            
            #default-tree .node-disabled {
                display: none;
            }
            @media (max-width: 768px){
                .navbar-brand1{
                    max-width: 50%;
                    margin: 3%;
                }
                .navbar-brand{
                    float: none;
                }
                .nav{
                    float: right;
                }
                .log-hed{
                    float: left;
                }
            }
            
        </style>

    </head>
    <body>

        <!-- Preloder -->
        <div id="preloader"></div>
        <!-- End Preloder -->

        <!-- Navbar -->
        <nav class="navbar top-navbar" role="navigation">
            <div class="container">
                <div class="navbar-header col-sm-2">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= site_url(); ?>"><img alt="logo" src="<?= base_url(); ?>theme/web/images/logo2.png" class="navbar-brand1"></a>
                    <!--<a class="navbar-brand" href="./index.html">Yellow VDO</a>-->
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <!--<ul class="nav navbar-nav">-->
                        <!--<li style="margin-top: 5px;"><a href="<?= site_url(); ?>">Home</a></li>-->
                        <!--<li style="margin-top: 5px;"><a href="<?= site_url('contact'); ?>">Contact Us</a></li>-->
                        <!--                  <li class="dropdown">
                                             <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"> Categories Pages <b class="caret"></b></a>
                                             <ul class="dropdown-menu">
                                                <li>
                                                   <a href="categories.html"><i class="fa fa-fw fa-angle-right"></i> Categories</a>
                                                </li>
                                                <li>
                                                   <a href="category-grid.html"><i class="fa fa-fw fa-angle-right"></i> Category Grid</a>
                                                </li>
                                                <li>
                                                   <a href="single.html"><i class="fa fa-fw fa-angle-right"></i> Single Item</a>
                                                </li>
                                             </ul>
                                          </li>
                                          <li><a href="pricing.html">Pricing</a></li>
                                          <li><a href="faq.html">FAQ</a></li>
                                          <li><a href="contact.html">Contact Us</a></li>
                                          <li class="dropdown">
                                             <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">Blog <b class="caret"></b></a>
                                             <ul class="dropdown-menu">
                                                <li>
                                                   <a href="blog.html"><i class="fa fa-fw fa-angle-right"></i> Blog</a>
                                                </li>
                                                <li>
                                                   <a href="blog_details.html"><i class="fa fa-fw fa-angle-right"></i> Blog Details</a>
                                                </li>
                                             </ul>
                                          </li>
                                          <li class="dropdown">
                                             <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"> Other Pages <b class="caret"></b></a>
                                             <ul class="dropdown-menu">
                                                <li>
                                                   <a href="create_post.html"><i class="fa fa-fw fa-angle-right"></i> Post Your Ad</a>
                                                </li>
                                                <li>
                                                   <a href="settings.html"><i class="fa fa-fw fa-angle-right"></i> Settings</a>
                                                </li>
                                                <li>
                                                   <a href="close-account.html"><i class="fa fa-fw fa-angle-right"></i> Close account</a>
                                                </li>
                                                <li>
                                                   <a href="my-ads.html"><i class="fa fa-fw fa-angle-right"></i> My Ads</a>
                                                </li>
                                                <li>
                                                   <a href="favourite.html"><i class="fa fa-fw fa-angle-right"></i> Favourite Ads</a>
                                                </li>
                                                <li>
                                                   <a href="privacy.html"><i class="fa fa-fw fa-angle-right"></i> Privacy Policy</a>
                                                </li>
                                                <li>
                                                   <a href="404.html"><i class="fa fa-fw fa-angle-right"></i> 404</a>
                                                </li>
                                             </ul>
                                          </li>-->
                    <!--</ul>-->
                    
                    <?php
                    if(!empty($this->session->userdata('web_login'))){
                        $user_data1 = $this->session->userdata('user_profile');
                        
                        ?>
                                       
                    <div class="user-dropdown pull-right">
                        <ul class="navbar-left log-hed"> 
                            <li style="margin-top: 23%; font-weight: 700; font-size: 14px;">
                                <a style="color:#000;" href="<?= site_url('contact'); ?>">Contact us </a>&nbsp;&nbsp;<span style="color:#c7c5c5;">|</span>&nbsp;&nbsp;
                            </li>
                            
                        </ul>
                                                
                        <a class="btn btn-md <?php if($this->uri->segment(1) == 'create_ad') { echo 'btn-success';} else{ echo 'btn-primary2';}?> " href="<?= site_url('create_ad'); ?>" style="margin-top: 5%;">Create Ad</a>&nbsp;&nbsp;
                            <ul class="nav navbar-right top-nav">
                                <li class="dropdown">
                                    <a aria-expanded="true" href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <?php
                                            if($user_data->Profile != null){
                                                if (strpos($user_data->Profile, 'http') === false){
                                                    $user_data->Profile = base_url() . 'uploads/profile/' . $user_data->Profile;
                                                }
                                            }else{
                                                $user_data->Profile = base_url().'theme/web/images/img_avatar.png';
                                            }
                                        
//                                            if($user_data->RegisterType == 3){
//                                                if(!empty($user_data->Profile)){
//                                                    $profile_img = base_url().'uploads/profile/'.$user_data->Profile;
//                                                }else{
//                                                    $profile_img = base_url().'theme/web/images/img_avatar.png';
//                                                }
//
//
//                                            }else if($user_data->RegisterType == 1 || $user_data->RegisterType == 2){
//                                                $profile_img = $user_data->Profile;
//                                            }

                                            ?>
                                        <img src="<?= $user_data->Profile; ?>" alt="User Image" class="user-dp"> 
                                        <?php
                                        if(!empty($this->session->userdata['user_profile']['first_name'])){
                                            echo $this->session->userdata['user_profile']['first_name'];
                                        }
                                        ?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?= site_url('profile'); ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                                        </li>
                                        <li>
                                            <a href="<?= site_url('myads'); ?>"><i class="fa fa-fw fa-pencil"></i> My Ads</a>
                                        </li>
<!--                                        <li>
                                            <a href="settings_1.html"><i class="fa fa-fw fa-gear"></i> Settings</a>
                                        </li>-->
                                        <li>
                                            <a href="<?= site_url('logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    <?php
                    }else{
                        ?>
                    
                    <div class="user-login pull-right hed" style="color:#000; font-weight: 900; font-size: 14px;">
                        <!--<a class="btn btn-md btn-primary" href="<?= site_url('login'); ?>">Create Ad</a>&nbsp;&nbsp;-->
                        <!--<a class="btn btn-md btn-primary" href="create_post.html">Create Ad</a>-->
                        <a style="color:#000;" href="<?= site_url('contact'); ?>">Contact us </a>&nbsp;&nbsp;<span style="color:#c7c5c5;">|</span>&nbsp;&nbsp;
                        <a style="color:#000;" href="<?= site_url('login'); ?>">Login</a>&nbsp;&nbsp;
                        <span style="color:#c7c5c5;">|</span>&nbsp;&nbsp;
                        <a style="color:#000;" href="<?= site_url('register'); ?>">Sign up</a>
                    </div>
                    <?php
                    }
                    ?>
                                       
                    
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        