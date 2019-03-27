<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

//// ------------------------------------------------------------------------
//// Paypal IPN Class
//// ------------------------------------------------------------------------
//
//// Use PayPal on Sandbox or Live
//$config['sandbox'] = TRUE; // FALSE for live environment
//
//// PayPal Business Email ID
////$config['business'] = 'learnjoy007@gmail.com';
////$config['business'] = 'learnjoy007-facilitator@gmail.com';
////$config['business'] = 'info@codexworld.com';
//$config['business'] = 'satishprajapat143dp-facilitator-1@gmail.com';
////$config['business'] = 'manojtailor2k5-facilitator@gmail.com';
//
//// If (and where) to log ipn to file
//$config['paypal_lib_ipn_log_file'] = BASEPATH . 'logs/paypal_ipn.log';
//$config['paypal_lib_ipn_log'] = TRUE;
//
//// Where are the buttons located at 
//$config['paypal_lib_button_path'] = 'buttons';
//
//// What is the default currency?
//$config['paypal_lib_currency_code'] = 'USD';


// ------------------------------------------------------------------------
// Paypal library configuration
// ------------------------------------------------------------------------

// PayPal environment, Sandbox or Live
$config['sandbox'] = TRUE; // FALSE for live environment

// PayPal business email
//$config['business'] = 'info@codexworld.com';
//$config['business'] = 'sandeepgavankar@yahoo.co.in';
$config['business'] = 'sandeepgavankar-facilitator@yahoo.co.in';
//$config['business'] = 'satishprajapat143dp-facilitator@gmail.com';

// What is the default currency?
$config['paypal_lib_currency_code'] = 'USD';

// Where is the button located at?
$config['paypal_lib_button_path'] = 'assets/';

// If (and where) to log ipn response in a file
$config['paypal_lib_ipn_log'] = TRUE;
$config['paypal_lib_ipn_log_file'] = BASEPATH . 'logs/paypal_ipn.log';

?>