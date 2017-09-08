<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['users']                             = 'webservices/users';
$route['signup']                            = 'webservices/users/userSignUp';
$route['login']                             = 'webservices/users/userLogin';
$route['verifyOTP']                         = 'webservices/users/verifyOTP';
$route['forgetPassword']                    = 'webservices/users/forgetPassword';
$route['resendOTP']                         = 'webservices/users/resendOTP';
$route['service_fetch_user_primary_record'] = 'webservices/users/get_user_with_primary_key';
$route['service_upload_verification_files'] = 'webservices/users/upload_user_verification_files';

$route['service_user_account_activeness_state'] = 'webservices/users/user_account_activeness_state';

$route['service_fetch_all_car_data']      = 'webservices/cars/get_car_data';
$route['service_fetch_country_city_list'] = 'webservices/cars/fetch_city';
$route['service_fetch_car_make_year']     = 'webservices/cars/fetch_car_make_year';
$route['service_fetch_car_year_model']    = 'webservices/cars/fetch_car_year_model';
$route['service_insert_car_data']         = 'webservices/cars/save_car_data';
$route['service_user_car_list']           = 'webservices/cars/get_user_car_list';
$route['service_delete_user_car']         = 'webservices/cars/soft_delete_user_car';
$route['service_delete_user_car_image']   = 'webservices/cars/soft_delete_user_car_image';
$route['service_add_new_car_image']       = 'webservices/cars/add_new_images_to_car';
$route['service_edit_car_data']           = 'webservices/cars/edit_car_data';
$route['service_car_input_parameters'] = 'webservices/cars/car_input_parameters';

/* services while seraching car data */
$route['service_get_single_car_data'] = 'webservices/cars/get_single_car_data';
$route['service_get_car_unavail_day'] = 'webservices/cars/get_car_unavail_day';

$route['service_edit_user_data']      = 'webservices/users/edit_user_profile';
$route['service_search_car_data']     = 'webservices/cars/search_car_with_filter';

/*
 * service to check car availability
 */
$route['service_get_car_availability']         = 'webservices/cars/get_car_availability';
/*
 * book the car service
 */
$route['service_book_car']                     = 'webservices/cars/book_car';
/*
 * add car / remove car for user favourite
 */
$route['service_user_favourite_hit']           = 'webservices/cars/manage_car_favourite_list';
/*
 * get  user favourite
 */
$route['service_get_favourite_list']           = 'webservices/cars/user_favourite_car';

/*
 * get all country and city list one hit to all
 */
$route['service_get_country_state_list']       = 'webservices/cars/get_all_country_state_list';
/*
 * get information of user w.r.t. to car id
 */
$route['service_get_active_user_car_relation'] = 'webservices/cars/active_user_car_relation';
/*
 * get all report text
 */
$route['service_get_all_report_text']          = 'webservices/cars/get_all_report_text';
/*
 * save car report
 */
$route['service_save_car_report']              = 'webservices/cars/save_car_report';
/*
* get all text before car delete
*/
$route['service_get_all_deletecar_text']       = 'webservices/cars/get_all_deletecar_text';

/**************  web services related to car booking  start here **********************/

$route['service_fetch_single_request_data']              = 'webservices/cars_booking/fetch_single_request_data';

$route['service_get_all_sent_request']                   = 'webservices/cars_booking/get_all_request_sent_by_user';
$route['service_get_all_incoming_requests_to_car_owner'] = 'webservices/cars_booking/get_all_incoming_requests_to_car_owner';
$route['service_accept_request_by_car_owner']            = 'webservices/cars_booking/request_acceptable_by_car_owner';
$route['service_reject_request_by_car_owner']            = 'webservices/cars_booking/reject_request_by_car_owner';
$route['service_reject_request_by_car_renter']           = 'webservices/cars_booking/reject_request_by_car_renter';
$route['service_get_user_current_booking_records']       = 'webservices/cars_booking/get_user_active_booking_records';
$route['service_get_user_pending_payment_records']       = 'webservices/cars_booking/get_user_pending_payment_booking';

$route['service_get_user_history_booking_records']       = 'webservices/cars_booking/get_user_booking_history_records';
$route['service_get_user_success_booking_records']       = 'webservices/cars_booking/get_successfull_booking_history_records';
$route['service_get_user_car_request']                   = 'webservices/cars_booking/get_incoming_requests_to_car_owner';


$route['service_set_car_renter_is_not_showing']          = 'webservices/cars_booking/car_renter_is_not_showing';
$route['service_set_car_owner_is_not_showing']           = 'webservices/cars_booking/car_owner_is_not_showing';

$route['service_set_car_renter_reached_at_location']     = 'webservices/cars_booking/car_renter_reached_at_location';
$route['service_set_car_owner_reached_at_location']      = 'webservices/cars_booking/car_owner_reached_at_location';

$route['service_request_car_owner_is_delay']             = 'webservices/cars_booking/car_owner_is_delay';
$route['service_request_car_renter_is_delay']            = 'webservices/cars_booking/car_renter_is_delay';

$route['service_mark_car_owner_is_delay']                = 'webservices/cars_booking/set_mark_owner_delayed_by_renter';
$route['service_mark_car_renter_is_delay']               = 'webservices/cars_booking/set_mark_renter_delayed_by_owner';

$route['service_initialize_car_info_by_owner']           = 'webservices/cars_booking/initialize_car_info_by_owner';
$route['service_initialize_car_info_by_renter']          = 'webservices/cars_booking/initialize_car_info_by_renter';

//@ while returning
$route['service_return_car_renter_reached_at_location']  = 'webservices/cars_booking/return_car_renter_reached_at_location';
$route['service_return_car_owner_reached_at_location']   = 'webservices/cars_booking/return_car_owner_reached_at_location';

$route['service_return_request_car_owner_is_delay']      = 'webservices/cars_booking/return_car_owner_is_delay';
$route['service_return_request_car_renter_is_delay']     = 'webservices/cars_booking/return_car_renter_is_delay';

$route['service_return_set_car_renter_is_not_showing']   = 'webservices/cars_booking/return_car_renter_is_not_showing';
$route['service_return_set_car_owner_is_not_showing']    = 'webservices/cars_booking/return_car_owner_is_not_showing';

$route['service_return_mark_car_owner_is_delay']         = 'webservices/cars_booking/return_set_mark_owner_delayed_by_renter';
$route['service_return_mark_car_renter_is_delay']        = 'webservices/cars_booking/return_set_mark_renter_delayed_by_owner';

$route['service_return_initialize_car_info_by_owner']    = 'webservices/cars_booking/return_initialize_car_info_by_owner';
$route['service_return_initialize_car_info_by_renter']   = 'webservices/cars_booking/return_initialize_car_info_by_renter';

$route['service_return_claim_for_car']                   = 'webservices/cars_booking/claim_for_car';

/* Notification services */

$route['service_get_notification_for_user']              = 'webservices/users_notification/get_user_notification';
$route['service_update_notification']		=	'webservices/user_quick_settings/update_notification';

/* get Reviews*/

$route['service_get_reviews_user']                       = 'webservices/reviews/get_all_reviews_of_users';
$route['service_get_reviews_car']                        = 'webservices/reviews/get_all_reviews_of_cars';
$route['service_get_reviews_user_for_all_cars']          = 'webservices/reviews/get_all_reviews_user_all_cars';
$route['service_give_rate_to_user']                      = 'webservices/reviews/give_rate_to_user';
$route['service_give_rate_to_car']                       = 'webservices/reviews/give_rate_to_car';

/* *************  web services related to car booking  end here *********************** */


/* quick services  starts here */

$route['service_send_otp_to_mobile']         = 'webservices/user_quick_settings/send_verification_otp';
$route['service_update_mobile']              = 'webservices/user_quick_settings/update_mobile_number';
$route['service_update_user_settings']       = 'webservices/user_quick_settings/change_notifications';
$route['service_update_user_first_name']     = 'webservices/user_quick_settings/update_frist_name';
$route['service_update_user_last_name']      = 'webservices/user_quick_settings/update_last_name';
$route['service_update_user_email']          = 'webservices/user_quick_settings/update_user_email';
$route['service_update_user_password']       = 'webservices/user_quick_settings/update_user_password';
$route['service_update_transmission_state']  = 'webservices/user_quick_settings/update_transmission_state';
$route['service_update_device_tokken']       = 'webservices/user_quick_settings/update_device_tokken';
$route['service_update_user_language']       = 'webservices/user_quick_settings/update_user_language';
/* quick services  end here */

/* upload user verfication files v 2.0*/
$route['service_upload_user_verification_info']  = 'webservices/users/upload_user_verification_information';
$route['service_get_user_document_info']         = 'webservices/users/get_user_document_info';
$route['service_edit_user_document_info']        = 'webservices/users/edit_user_document_info';


/******************************************* HIT THE PUSHER  @ WEBSERVICES ****************************************/
$route['service_push_message']         = 'webservices/user_pusher/push_message';

/******************************************* Image uploading   @ WEBSERVICES ****************************************/
$route['service_insert_car_picture']         = 'webservices/picture_upload/insert_car_picture';


/**********************************************User loggeout************************************************************************/
$route['service_user_logout']        = 'webservices/users/user_logout';

/* wallet */

$route['service_create_user_wallet']         = 'webservices/users/create_user_wallet';
$route['service_wallet_info_with_user_id']         = 'webservices/users/wallet_info_with_user_id';
$route['service_account_info_with_user_id']         = 'webservices/users/account_info_with_user_id';
$route['service_delete_user_card_info'] = 'webservices/users/delete_user_card_with_card_id';
$route['service_update_user_bank_id'] = 'webservices/users/update_user_bank_id';

$route['User']            = '/User';
$route['signIn']          = 'User/signIn';
$route['signUp']          = 'User/signUp';
$route['forgot_password'] = 'User/forgot_password';
$route['resetPassword']   = 'User/resetPassword';


$route['admin'] = 'auth_panel/login';
