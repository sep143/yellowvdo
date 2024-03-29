<!DOCTYPE html>
<html lang="en">
    <!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Sep 2018 06:58:29 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>theme/backend/assets/img/favicon.ico">
        <link rel="icon" type="image/png" href="<?= base_url(); ?>theme/backend/assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>  YellowVDO - Admin Login </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="<?= base_url(); ?>theme/backend/assets/css/material-dashboard.min40a0.css?v=2.0.2" rel="stylesheet" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="<?= base_url(); ?>theme/backend/assets/demo/demo.css" rel="stylesheet" />
    </head>
    <body class="off-canvas-sidebar">
        <!-- Extra details for Live View on GitHub Pages -->
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white" id="navigation-example" style="background-color: #fff;">
            <div class="container">
                <div class="navbar-wrapper">
                    <!--<img src="<?= base_url(); ?>theme/backend/assets/img/logo.png" alt="" class="navbar-brand">-->
                    <img src="<?= base_url(); ?>theme/web/images/home_logo4.png" alt="" class="navbar-brand" style="width: auto; height: 60px; padding: 0px;">
                    <!--<a class="navbar-brand" href="#pablo">Login Page</a>-->
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item" >
                            <a href="<?= site_url('admin/dashboard'); ?>" class="nav-link">
                                <i class="material-icons">dashboard</i>
                                Dashboard
                            </a>
                        </li>
<!--                        <li class= "nav-item ">
                            <a href="<?= site_url('register'); ?>" class="nav-link">
                                <i class="material-icons">person_add</i>
                                Register
                            </a>
                        </li>-->
                        <li class= "nav-item  active ">
                            <a href="<?= site_url('admin'); ?>" class="nav-link">
                                <i class="material-icons">fingerprint</i>
                                Login
                            </a>
                        </li>

<!--                        <li class= "nav-item ">
                            <a href="<?= site_url('admin/forgot'); ?>" class="nav-link">
                                <i class="material-icons">lock_open</i>
                                Forgot Password
                            </a>
                        </li>-->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="wrapper wrapper-full-page">
            <!--<div class="page-header login-page header-filter" filter-color="black" style="background-image: url('<?= base_url(); ?>theme/backend/assets/img/login.jpg'); background-size: cover; background-position: top center;">-->
            <div class="page-header login-page header-filter" filter-color="black" style="background-color: #4611A7; background-size: cover; background-position: top center;">
                <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
                <div class="container">
                    <div class="col-lg-4 col-md-6 col-sm-6 ml-auto mr-auto">
                        <form class="form" method="post" action="<?= site_url('login_admin'); ?>">
                            
                            <?php if (isset($msg) || validation_errors() !== ''): ?>
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                                    <?= validation_errors(); ?>
                                    <?= isset($msg) ? $msg : ''; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($this->session->flashdata('msg'))): ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-warning"></i> Reset Password!</h4>

                                    <?= $this->session->flashdata('msg'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card card-login card-hidden">
                                <div class="card-header card-header-rose text-center">
                                    <h4 class="card-title">Admin Login</h4>
<!--                                    <div class="social-line">
                                        <a href="<?php echo $this->facebook->login_url(); ?>" class="btn btn-just-icon btn-link btn-white">
                                            <i class="fa fa-facebook-square"></i>
                                        </a>
                                        <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="<?php echo $this->googleplus->loginURL();?>" class="btn btn-just-icon btn-link btn-white">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </div>-->
                                </div>
                                <div class="card-body ">
                                    <p class="card-description text-center"></p>
<!--                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">face</i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="First Name...">
                                        </div>
                                    </span>-->
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">email</i>
                                                </span>
                                            </div>
                                            <input type="email" name="user_name" class="form-control" placeholder="Email..." required="">
                                        </div>
                                    </span>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                            </div>
                                            <input type="password" name="password" class="form-control" placeholder="Password..." required="">
                                        </div>
                                    </span>
                                </div>
                                <div class="card-footer justify-content-center">
                                    <!--<a href="#pablo" class="btn btn-rose btn-link btn-lg">Lets Go</a>-->
                                    <input type="submit" value="Lets Go" class="btn btn-rose btn-link btn-lg">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <footer class="footer" >
                    <div class="container">
                        <nav class="float-left">
<!--                            <ul>
                                <li>
                                    <a href="#">
                                        About Us
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Blog
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Licenses
                                    </a>
                                </li>
                            </ul>-->
                        </nav>
                        <div class="copyright float-right">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, <i class="material-icons"></i> 
                            <a href="#" target="_blank">Yellow VDO</a> All Right Reserve.
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!--   Core JS Files   -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/core/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>theme/backend/assets/js/core/popper.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>theme/backend/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/perfect-scrollbar.jquery.min.js" ></script>
        <!-- Plugin for the momentJs  -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/moment.min.js"></script>
        <!--  Plugin for Sweet Alert -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/sweetalert2.js"></script>
        <!-- Forms Validations Plugin -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery.validate.min.js"></script>
        <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-selectpicker.js" ></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>

        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery.dataTables.min.js"></script>

        <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-tagsinput.js"></script>

        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jasny-bootstrap.min.js"></script>

        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/fullcalendar.min.js"></script>

        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/jquery-jvectormap.js"></script>

        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/nouislider.min.js" ></script>

        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        <script src="../../../../cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

        <!-- Library for adding dinamically elements -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/arrive.min.js"></script>
        <!--  Google Maps Plugin    -->
        <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="../../../../buttons.github.io/buttons.js"></script>

        <!-- Chartist JS -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/chartist.min.js"></script>

        <!--  Notifications Plugin    -->
        <script src="<?= base_url(); ?>theme/backend/assets/js/plugins/bootstrap-notify.js"></script>

        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc --><script src="<?= base_url(); ?>theme/backend/assets/js/material-dashboard.min40a0.js?v=2.0.2" type="text/javascript"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="<?= base_url(); ?>theme/backend/assets/demo/demo.js"></script>
        <script>
                                $(document).ready(function () {
                                    $().ready(function () {
                                        $sidebar = $('.sidebar');

                                        $sidebar_img_container = $sidebar.find('.sidebar-background');

                                        $full_page = $('.full-page');

                                        $sidebar_responsive = $('body > .navbar-collapse');

                                        window_width = $(window).width();

                                        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                                        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                                            if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                                                $('.fixed-plugin .dropdown').addClass('open');
                                            }

                                        }

                                        $('.fixed-plugin a').click(function (event) {
                                            // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                                            if ($(this).hasClass('switch-trigger')) {
                                                if (event.stopPropagation) {
                                                    event.stopPropagation();
                                                } else if (window.event) {
                                                    window.event.cancelBubble = true;
                                                }
                                            }
                                        });

                                        $('.fixed-plugin .active-color span').click(function () {
                                            $full_page_background = $('.full-page-background');

                                            $(this).siblings().removeClass('active');
                                            $(this).addClass('active');

                                            var new_color = $(this).data('color');

                                            if ($sidebar.length != 0) {
                                                $sidebar.attr('data-color', new_color);
                                            }

                                            if ($full_page.length != 0) {
                                                $full_page.attr('filter-color', new_color);
                                            }

                                            if ($sidebar_responsive.length != 0) {
                                                $sidebar_responsive.attr('data-color', new_color);
                                            }
                                        });

                                        $('.fixed-plugin .background-color .badge').click(function () {
                                            $(this).siblings().removeClass('active');
                                            $(this).addClass('active');

                                            var new_color = $(this).data('background-color');

                                            if ($sidebar.length != 0) {
                                                $sidebar.attr('data-background-color', new_color);
                                            }
                                        });

                                        $('.fixed-plugin .img-holder').click(function () {
                                            $full_page_background = $('.full-page-background');

                                            $(this).parent('li').siblings().removeClass('active');
                                            $(this).parent('li').addClass('active');


                                            var new_image = $(this).find("img").attr('src');

                                            if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                                                $sidebar_img_container.fadeOut('fast', function () {
                                                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                                    $sidebar_img_container.fadeIn('fast');
                                                });
                                            }

                                            if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                                                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                                                $full_page_background.fadeOut('fast', function () {
                                                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                                                    $full_page_background.fadeIn('fast');
                                                });
                                            }

                                            if ($('.switch-sidebar-image input:checked').length == 0) {
                                                var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                                                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                                                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                                $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                                            }

                                            if ($sidebar_responsive.length != 0) {
                                                $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                                            }
                                        });

                                        $('.switch-sidebar-image input').change(function () {
                                            $full_page_background = $('.full-page-background');

                                            $input = $(this);

                                            if ($input.is(':checked')) {
                                                if ($sidebar_img_container.length != 0) {
                                                    $sidebar_img_container.fadeIn('fast');
                                                    $sidebar.attr('data-image', '#');
                                                }

                                                if ($full_page_background.length != 0) {
                                                    $full_page_background.fadeIn('fast');
                                                    $full_page.attr('data-image', '#');
                                                }

                                                background_image = true;
                                            } else {
                                                if ($sidebar_img_container.length != 0) {
                                                    $sidebar.removeAttr('data-image');
                                                    $sidebar_img_container.fadeOut('fast');
                                                }

                                                if ($full_page_background.length != 0) {
                                                    $full_page.removeAttr('data-image', '#');
                                                    $full_page_background.fadeOut('fast');
                                                }

                                                background_image = false;
                                            }
                                        });

                                        $('.switch-sidebar-mini input').change(function () {
                                            $body = $('body');

                                            $input = $(this);

                                            if (md.misc.sidebar_mini_active == true) {
                                                $('body').removeClass('sidebar-mini');
                                                md.misc.sidebar_mini_active = false;

                                                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                                            } else {

                                                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                                                setTimeout(function () {
                                                    $('body').addClass('sidebar-mini');

                                                    md.misc.sidebar_mini_active = true;
                                                }, 300);
                                            }

                                            // we simulate the window Resize so the charts will get updated in realtime.
                                            var simulateWindowResize = setInterval(function () {
                                                window.dispatchEvent(new Event('resize'));
                                            }, 180);

                                            // we stop the simulation of Window Resize after the animations are completed
                                            setTimeout(function () {
                                                clearInterval(simulateWindowResize);
                                            }, 1000);

                                        });
                                    });
                                });
        </script>

        <!-- Sharrre libray -->
        <script src="<?= base_url(); ?>theme/backend/assets/demo/jquery.sharrre.js"></script>

        <script>
                                $(document).ready(function () {


                                    $('#facebook').sharrre({
                                        share: {
                                            facebook: true
                                        },
                                        enableHover: false,
                                        enableTracking: false,
                                        enableCounter: false,
                                        click: function (api, options) {
                                            api.simulateClick();
                                            api.openPopup('facebook');
                                        },
                                        template: '<i class="fab fa-facebook-f"></i> Facebook',
                                        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
                                    });

                                    $('#google').sharrre({
                                        share: {
                                            googlePlus: true
                                        },
                                        enableCounter: false,
                                        enableHover: false,
                                        enableTracking: true,
                                        click: function (api, options) {
                                            api.simulateClick();
                                            api.openPopup('googlePlus');
                                        },
                                        template: '<i class="fab fa-google-plus"></i> Google',
                                        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
                                    });

                                    $('#twitter').sharrre({
                                        share: {
                                            twitter: true
                                        },
                                        enableHover: false,
                                        enableTracking: false,
                                        enableCounter: false,
                                        buttons: {twitter: {via: 'CreativeTim'}},
                                        click: function (api, options) {
                                            api.simulateClick();
                                            api.openPopup('twitter');
                                        },
                                        template: '<i class="fab fa-twitter"></i> Twitter',
                                        url: 'https://demos.creative-tim.com/material-dashboard-pro/examples/dashboard.html'
                                    });


                                    var _gaq = _gaq || [];
                                    _gaq.push(['_setAccount', 'UA-46172202-1']);
                                    _gaq.push(['_trackPageview']);

                                    (function () {
                                        var ga = document.createElement('script');
                                        ga.type = 'text/javascript';
                                        ga.async = true;
                                        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                                        var s = document.getElementsByTagName('script')[0];
                                        s.parentNode.insertBefore(ga, s);
                                    })();

                                    // Facebook Pixel Code Don't Delete
                                    !function (f, b, e, v, n, t, s) {
                                        if (f.fbq)
                                            return;
                                        n = f.fbq = function () {
                                            n.callMethod ?
                                                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                                        };
                                        if (!f._fbq)
                                            f._fbq = n;
                                        n.push = n;
                                        n.loaded = !0;
                                        n.version = '2.0';
                                        n.queue = [];
                                        t = b.createElement(e);
                                        t.async = !0;
                                        t.src = v;
                                        s = b.getElementsByTagName(e)[0];
                                        s.parentNode.insertBefore(t, s)
                                    }(window,
                                            document, 'script', '../../../../connect.facebook.net/en_US/fbevents.js');

                                    try {
                                        fbq('init', '111649226022273');
                                        fbq('track', "PageView");

                                    } catch (err) {
                                        console.log('Facebook Track Error:', err);
                                    }

                                });
        </script>
        <noscript>
        <img height="1" width="1" style="display:none"
             src="https://www.facebook.com/tr?id=111649226022273&amp;ev=PageView&amp;noscript=1"
             />

        </noscript>
        <script>
            $(document).ready(function () {
                demo.checkFullPageBackgroundImage();
                setTimeout(function () {
                    // after 1000 ms we add the class animated to the login/register card
                    $('.card').removeClass('card-hidden');
                }, 700);
            });
        </script>
    </body>

    <!-- Mirrored from demos.creative-tim.com/material-dashboard-pro/examples/pages/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Sep 2018 06:58:29 GMT -->
</html>
