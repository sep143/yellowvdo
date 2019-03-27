<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function AlertMsg() {
    $ci = & get_instance();
    if ($ci->session->flashdata('success_msg')) {
        ?>
        <div class="alert alert-success" id="success-alert" style="color:#fff;">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <?= $ci->session->flashdata('success_msg'); ?>
        </div>
        <script>
        $(document).ready (function(){
//            $("#success-alert").hide();
//            $("#myWish").click(function showAlert() {
                $("#success-alert").fadeTo(9000, 500).slideUp(500, function(){
               $("#success-alert").slideUp(500);
                });   
//            });
        });
        </script>
        <?php
    }
    
    if ($ci->session->flashdata('danger_msg')) {
        ?>
        <div class="alert alert-danger" id="danger-alert" style="color:#fff;">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <?= $ci->session->flashdata('danger_msg'); ?>
        </div>
        <script>
        $(document).ready (function(){
//            $("#success-alert").hide();
//            $("#myWish").click(function showAlert() {
                $("#danger-alert").fadeTo(9000, 500).slideUp(500, function(){
               $("#danger-alert").slideUp(500);
                });   
//            });
        });
        </script>
        <?php
    }
    
}

function login_msg(){
    $ci = & get_instance();
    //using login page >> after register new user then view msg
    if ($ci->session->flashdata('register_msg')) {
        ?>
        <div class="row">
            <div class="col-sm-1">&nbsp;</div>
            <div class="col-sm-10 col-xs-12">
                <div class="alert alert-success1">
                    <span style="font-size: 13px; color:#3d5d3d;">

                        <strong><i class="fa fa-check-circle" style="color:#458645;"></i></strong> Welcome to Yellow VDO. <strong>Signup successfully!</strong> <b>Email address verification needed.</b><br>
                        Before you can login, check your email to activate your user account. if you dont't receive  an email within a few seconds, please check your spam folder.<br>

                    </span>
                </div>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
        <?php
    }
    //emai to click link and verify mail
    if ($ci->session->flashdata('verify_msg')) {
        ?>
        <div class="row">
            <div class="col-sm-1">&nbsp;</div>
            <div class="col-sm-10 col-xs-12">
                <div class="alert alert-success1">
                    <span style="font-size: 13px; color:#3d5d3d;">

                        <strong><i class="fa fa-check-circle" style="color:#458645;"></i> Email verify successfully!</strong> - <b>Sign in below.</b><br>
                        <!--Before you can login, check your email to activate your user account. if you dont't receive  an email within a few seconds, please check your spam filters.<br>-->

                    </span>
                </div>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
        <?php
    }
    //email already verify
    if ($ci->session->flashdata('already_verify_msg')) {
        ?>
        <div class="row">
            <div class="col-sm-1">&nbsp;</div>
            <div class="col-sm-10 col-xs-12">
                <div class="alert alert-success1">
                    <span style="font-size: 13px; color:#3d5d3d;">

                        <strong><i class="fa fa-check-circle" style="color:#458645;"></i> Email address already verified !</strong> - <b>Sign in below.</b><br>
                        <!--Before you can login, check your email to activate your user account. if you dont't receive  an email within a few seconds, please check your spam filters.<br>-->

                    </span>
                </div>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
        <?php
    }
    //email already verify
    if ($ci->session->flashdata('resend_msg')) {
        ?>
        <div class="row">
            <div class="col-sm-1">&nbsp;</div>
            <div class="col-sm-10 col-xs-12">
                <div class="alert alert-success1">
                    <span style="font-size: 13px; color:#3d5d3d;">

                        <strong><i class="fa fa-check-circle" style="color:#458645;"></i> Verification mail sent !</strong> - <b>Sign in your email and verify account.</b><br>
                        <!--Before you can login, check your email to activate your user account. if you dont't receive  an email within a few seconds, please check your spam filters.<br>-->

                    </span>
                </div>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
        <?php
    }
}
