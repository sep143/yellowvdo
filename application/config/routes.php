<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//error page
$route['error_page'] = 'admin/DashboardController/error_page';

//Admin Route
$route['admin'] = 'admin/LoginController';
$route['login_admin'] = 'admin/LoginController/login';
$route['admin/logout'] = 'admin/LoginController/logout';

$route['admin/forgot'] = 'admin/LoginController/forgate_password';
//Admin Sidebar
$route['admin/dashboard'] = 'admin/DashboardController';
$route['admin/blank'] = 'admin/DashboardController/blank';
$route['admin/free_ad'] = 'admin/AdvertisementController/free_ads';
$route['free_ad_create'] = 'admin/AdvertisementController/free_ads_create';
$route['free_ad_update'] = 'admin/AdvertisementController/edit_free_ad_update';
$route['admin/advertisement/free-list'] = 'admin/AdvertisementController/free_ads_list';
$route['admin/advertisement/free-ad-edit/(:num)'] = 'admin/AdvertisementController/edit_free_ad/$1';
//edit free ads list to get category name then use ajax function
$route['edit_free_ads_category_name'] = 'admin/AdvertisementController/get_category';
$route['free-ads-change_status'] = 'admin/AdvertisementController/change_status';

//admin after login then register any advertiser and admin
$route['admin/advertiser/show'] = 'admin/RegisterController'; //this function useing only admin. If new user create then.

$route['advertiser_add'] = 'admin/RegisterController/createUser';
$route['advertiser_edit'] = 'admin/RegisterController/updateUser';
$route['admin/advertiser/new'] = 'admin/RegisterController/createUser';
$route['admin/advertiser/edit/(:num)'] = 'admin/RegisterController/editUser/$1';
$route['admin/advertiser/view/(:num)'] = 'admin/RegisterController/viewUser/$1';
//advertiser change status 
$route['advertiser_change_status'] = 'admin/RegisterController/advertiser_change_status';

$route['admin/category'] = 'admin/CategoryController';
$route['category_add'] = 'admin/CategoryController/addCategory';
$route['category_edit/(:num)'] = 'admin/CategoryController/edit_category/$1';
//$route['subcategory_add'] = 'admin/CategoryController/addSubcategory';
//category table use to ajax call then change status
$route['category_change_st'] = 'admin/CategoryController/category_status_change';
//category tree view
$route['item'] = "admin/ItemCategoryController";
$route['getItem'] = "admin/ItemCategoryController/getItem";

$route['admin/payment/transition'] = 'admin/PaymentController';
$route['allTransitions'] = 'admin/PaymentController/allTransitions';
$route['refund'] = 'admin/PaymentController/refundTransition';
$route['admin/payment/refund'] = 'admin/PaymentController/refund';
$route['admin/payment/all-refund'] = 'admin/PaymentController/all_refund';
$route['admin/payment/refund_action'] = 'admin/PaymentController/refund_action';

$route['admin/advertisement/list'] = 'admin/AdvertisementController';
$route['admin/advertisement/add'] = 'admin/AdvertisementController/ads_add';
$route['advertisement_add'] = 'admin/AdvertisementController/createAds';
$route['advertisement_edit'] = 'admin/AdvertisementController/updateAds';
$route['admin/advertisement/new'] = 'admin/AdvertisementController/createAds';
$route['admin/advertisement/edit/(:num)'] = 'admin/AdvertisementController/editAds/$1';
$route['admin/advertisement/pending'] = 'admin/AdvertisementController/pendingAds';
$route['admin/advertisement/editads'] = 'admin/AdvertisementController/editAdsList';
//pending ad to view then approve
$route['admin/view_ad/(:num)'] = 'admin/AdvertisementController/view_ad_user/$1';

$route['admin/advertisement/disapprove'] = 'admin/AdvertisementController/disapproveAds';
$route['admin/advertisement/expired'] = 'admin/AdvertisementController/expiredAds';
$route['admin/advertisement/due_payment'] = 'admin/AdvertisementController/due_paymentAds';

//reminder
$route['admin/reminder/pendings_ads'] = 'admin/ReminderController';
$route['admin/reminder/renew_ads'] = 'admin/ReminderController/renew_ads';
//send mail via ajax use to
$route['send_reminder_mail'] = 'admin/ReminderController/send_reminder_mail';

//Message
$route['admin/message/show'] = 'admin/MessageController';
$route['chatting'] = 'admin/MessageController/chatting';

//Notification
$route['admin/notification/show'] = 'admin/NotificationController';

//Enquiry
$route['admin/enquiry'] = 'admin/EnquiryController';

//promotion video In Advertisement Slider 
$route['admin/promotion/video'] = 'admin/PromotionController';

//review
$route['admin/review'] = 'admin/ReviewController';
$route['admin/review/edit/(:num)'] = 'admin/ReviewController/edit_review/$1';
//$route['admin/review/edit_update'] = 'admin/ReviewController/update_review';
$route['admin/review/show/(:num)'] = 'admin/ReviewController/view_review/$1';
$route['change_review_status'] = 'admin/ReviewController/change_review_status';
//datatable me user ke name ke liye ajax function call
$route['advertisername'] = 'admin/ReviewController/get_advertiser';

//setting 
$route['admin/setting/common_setting'] = 'admin/SettingController/common_setting';
$route['admin/setting/user_role'] = 'admin/RoleController/user_role_list';
$route['admin/setting/user_role_add'] = 'admin/RoleController/add_role_user';
$route['admin/setting/edit_role_user/(:num)'] = 'admin/RoleController/edit_role_user/$1';
$route['admin/setting/update_role_user/(:num)'] = 'admin/RoleController/update_edit_role/$1';
$route['role_filter'] = 'admin/RoleController/role_filter';
//filter use session contorller in set session
$route['filter'] = 'admin/SessionController/filter';


//Front end view

//webApp use to 
$route['contact'] = 'welcome/contact';
$route['privacy_policy'] = 'welcome/privacy_policy';
//contact us to send mail by admin
$route['mail_admin'] = 'Welcome/contact_mail';

//category view if click view all ->Home page to
$route['categories'] = 'web/CategoryController/category_open';
//category select then set session
$route['category_session'] = 'web/CategoryController/session_category';

//home page view subcategory
$route['sub_category'] = 'web/SearchController/sub_category';
$route['ads_count'] = 'web/SearchController/ads_count';
$route['sub_category_all_category'] = 'web/CategoryController/sub_category_all_category';
//click show more then all sub category view
$route['sub-category-view/(:num)'] = 'web/CategoryController/sub_category_view/$1';

//search ads for web
$route['search?(:any)'] = 'web/SearchController/search/$1';
//sort filter any session set time if Search session and category session set time
$route['sort?(:any)'] = 'web/SearchController/short_ads/$1';
//category select then category wise get ads
$route['category-wise/ads/(:num)'] = 'web/CategoryController/category_wise_ads/$1';
$route['category-wise/ads/(:num)/(:num)'] = 'web/CategoryController/category_wise_ads/$1/$1';
//get all ads for web
$route['ads'] = 'web/All_ads_Controller/get_all_ads';
$route['ads/(:num)'] = 'web/All_ads_Controller/get_all_ads/$1';
//click ad then open view ad for web
$route['view/(:any)'] = 'web/All_ads_Controller/view_ad/$1';
//review submit
$route['review'] = 'web/All_ads_Controller/submit_review';


//Route Login with google/fb/self USER Panel
$route['login'] = 'user/LoginController/index';
$route['user_login'] = 'user/LoginController/login';
$route['register'] = 'user/LoginController/register';
$route['user_register'] = 'user/LoginController/add_register';
$route['verify_email/(:any)'] = 'user/LoginController/verify_link/$1';
$route['resend_email?(:any)'] = 'user/LoginController/resend_link_mail/$1';

$route['forgot'] = 'user/LoginController/forgate_password';
$route['user_forgot'] = 'user/LoginController/submit_forgot';
$route['reset_password/(:any)'] = 'user/LoginController/reset_password/$1';
$route['update_password'] = 'user/LoginController/update_password';
$route['logout'] = 'user/LoginController/logout';

//Social to login
$route['facebook'] = 'FacebookController/web_login';
$route['google'] = 'GoogleplusController';
$route['google_profile'] = 'GoogleplusController/profile';
//after login successfully then redirect Dashboard
$route['dashboard'] = 'user/DashboardController';
$route['profile'] = 'user/DashboardController/profile';
$route['update_profile'] = 'user/DashboardController/update_profile';

$route['myads'] = 'user/MyadsController/get_all_ads';
$route['myads/(:num)'] = 'user/MyadsController/get_all_ads/$1';

$route['myads_msg'] = 'user/MyadsController/send_msg';
$route['edit_ad/(:num)'] = 'user/MyadsController/edit_ad/$1';
$route['edit_updateAds/(:num)'] = 'user/MyadsController/edit_updateAds/$1';
$route['create_ad'] = 'user/MyadsController/create_ad';
$route['brand_kram'] = 'web/OtherAjaxController/bread_kram';
//for using link create
$route['brand_kram_link'] = 'web/OtherAjaxController/bread_kram2';

$route['deleted_ad'] = 'user/MyadsController/change_status';
$route['view_ad/(:num)'] = 'user/MyadsController/view_ad_user/$1';
$route['createads_data'] = 'user/MyadsController/create_ads';
$route['payment/(:num)'] = 'PaymentGetwayController/index/$1';

// video Manipulation 
$route['video'] = 'video/VideoController/video';
// $route['video_input'] = 'video/VideoController/videoSelect';
$route['video_input'] = 'video/VideoController/videoInput';
$route['video_edit'] = 'video/VideoController/videoEdit';
$route['video_length/(:any)'] = 'video/VideoController/getVideoLengthSeconds/$1';
$route['video_rotate'] = 'video/VideoController/videoRotate';
// Video Manipulation

$route['message'] = 'user/MessageController/get_message';
$route['user_chat'] = 'user/MessageController/chatting_user';

$route['transitions'] = 'user/TransitionsController/get_transitions';
$route['transitions/(:num)'] = 'user/TransitionsController/get_transitions/$1';

$route['refund'] = 'user/RefundController/refund_request';
$route['refund/(:num)'] = 'user/RefundController/refund_request/$1';
$route['refund_request_submit'] = 'user/RefundController/refund_request_submit';

//user panel to pdf generate path
$route['invoice/(:num)'] = 'PdfGenerate/index/$1';
//admin panel use to get pdf generate
$route['admin/invoice/(:num)'] = 'PdfGenerate/adminpdf/$1';
//user send mail then invoice download link send 
$route['download/token/(:any)'] = 'PdfGenerate/downloadpdf/$1';

//API
$route['api/check'] = 'api/LoginApi';
$route['api/other'] = 'api/OtherApi';
$route['api/category'] = 'api/CategoryApi/getCategory';

//advertisement
$route['api/ads'] = 'api/AdvertisementApi/advertisement';
$route['api/ads/limit/(:num)/offset/(:num)'] = 'api/AdvertisementApi/adsfn/$1/$2';
//get get by user id put
$route['api/ads?id=(:num)'] = 'api/advertisementapi/advertisement/$1';

//login
$route['api/login'] = 'api/LoginApi/login';
$route['api/resend_verify_mail'] = 'api/LoginApi/resendEmail'; //post type
$route['api/forgot_pwd'] = 'api/LoginApi/forgot'; //post type

$route['uploads_pro'] = 'admin/UploadController';

//cron job
$route['set_expired'] = 'CronAds';
$route['reminder_mail'] = 'CronAds/reminder_mail';
$route['video_process'] = 'CronAds/video_cron';
$route['video_process_second'] = 'CronAds/video_cron2';

//ajax to send form
$route['upload_form'] = 'user/MyadsController/ajaxUpload';

//excel import in database
$route['admin/import/view'] = 'admin/Import';
$route['admin/import/save'] = 'admin/Import/save';

