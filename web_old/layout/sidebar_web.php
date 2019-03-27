<!-- Breadcumb -->
<section class="profile-breadcumb">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-left">
                <div class="breadcumb_section">
                    <div class="page_pagination">
                        <ul>
                            <li><a href="<?= site_url(); ?>"><i class="fa fa-home"></i> Home</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>My Account</li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li><?= $navbar_title; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Breadcumb -->

<!-- Settings -->
<section class="settings">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="widget profile-widget margin-bottom-none">
                    <div class="widget-body">
                        <div class="avatar">
                            <a class="btn-icon" title="" data-placement="left" data-toggle="tooltip" href="<?= site_url('profile'); ?>" data-original-title="Edit">
                            <!--<i class="fa fa-camera"></i>-->
                            </a>
                            <?php
                            if($user_data->Profile != null){
                                if (strpos($user_data->Profile, 'http') === false){
                                    $user_data->Profile = base_url() . 'uploads/profile/' . $user_data->Profile;
                                }
                            }else{
                                $user_data->Profile = base_url().'theme/web/images/img_avatar.png';
                            }
//                            if($user_data->RegisterType == 3){
//                                if(!empty($user_data->Profile)){
//                                    $profile_img = base_url().'uploads/profile/'.$user_data->Profile;
//                                }else{
//                                    $profile_img = base_url().'theme/web/images/img_avatar.png';
//                                }
//                                
//                                
//                            }else if($user_data->RegisterType == 1 || $user_data->RegisterType == 2){
//                                $profile_img = $user_data->Profile;
//                            }
                            
                            ?>
                            <img class="profile-dp" alt="User Image" src="<?= $user_data->Profile; ?>" style="width: 100%; height: auto;">
                        </div>
                        <div class="profile-info">
                            <h2 class="seller-name"><?= $user_data->FirstName.' '.$user_data->LastName; ?></h2>
                            <p class="seller-detail"> Joined : <strong><?= date('d F Y', strtotime($user_data->CreatedDT)); ?></strong></p>
                        </div>
                        <div class="list-group">
                            <a class="list-group-item" href="<?= site_url('myads'); ?>">
                                <!--<span class="label label-info">15</span>-->
                                <i class="fa fa-fw fa-pencil"></i> My Ads
                            </a>
                            <a class="list-group-item" href="<?= site_url('message'); ?>">
                                <!--<span class="label label-success">10</span>-->
                                <i class="fa fa-fw fa-heart"></i> Message
                            </a>
                            <a class="list-group-item" href="<?= site_url('transitions'); ?>">
                           <!--<span class="label label-success">10</span>-->
                                <i class="fa fa-fw fa-dollar"></i> Transaction
                            </a>
                            <a class="list-group-item" href="<?= site_url('refund'); ?>">
                            <!--<span class="label label-success">10</span>-->
                                <i class="fa fa-fw fa-dollar"></i> Refund
                            </a>
                            <!--
                           <a class="list-group-item" href="./ad-alerts.html">
                           <i class="fa fa-fw fa-clock-o"></i> Ad Alerts
                           </a>-->
                            <a class="list-group-item active" href="<?= site_url('profile'); ?>">
                                <i class="fa fa-fw fa-gear"></i> Profile
                            </a>
                            <a class="list-group-item" href="<?= site_url('logout'); ?>">
                                <i class="fa fa-fw fa-power-off"></i> Log Out</a>

                        </div>
                    </div>
                </div>
                 <!--<a href="close-account.html" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Delete Account</a>-->
            </div>