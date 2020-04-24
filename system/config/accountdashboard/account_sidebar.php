<?php
// Single Setting
$_['module_account_sidebar_status'] 				= '1';
$_['module_account_sidebar_titlebgcolor'] 			= '#666666';
$_['module_account_sidebar_titlecolor'] 			= '';
$_['module_account_sidebar_linkbgcolor'] 			= '';
$_['module_account_sidebar_linkcolor'] 			= '';
$_['module_account_sidebar_hoverbgcolor'] 			= '';
$_['module_account_sidebar_hovercolor'] 			= '';

// Multiple Sections
$_['module_account_sidebar_title'][0]['status']  	= 1;
$_['module_account_sidebar_title'][0]['sort_order']= 1;
$_['module_account_sidebar_title'][0]['description'][1]['title']  = 'DASHBOARD & ORDERS';

$_['module_account_sidebar_title'][1]['status']  	= 1;
$_['module_account_sidebar_title'][1]['sort_order']= 2;
$_['module_account_sidebar_title'][1]['description'][1]['title']  = 'SHOPPING TOOLS';

$_['module_account_sidebar_title'][2]['status']  	= 1;
$_['module_account_sidebar_title'][2]['sort_order']= 3;
$_['module_account_sidebar_title'][2]['description'][1]['title']  = 'LOGOUT';

$_['module_account_sidebar_title'][0]['link_title'][0]['module_account_sidebar_link_title_description'][1]['name'] = 'Login';
$_['module_account_sidebar_title'][0]['link_title'][0]['link'] = 'index.php?route=account/login';
$_['module_account_sidebar_title'][0]['link_title'][0]['iconclass'] = 'fa-sign-in';
$_['module_account_sidebar_title'][0]['link_title'][0]['logged'] = '0';
$_['module_account_sidebar_title'][0]['link_title'][0]['sort_order'] = '1';


$_['module_account_sidebar_title'][0]['link_title'][1]['module_account_sidebar_link_title_description'][1]['name'] = 'Register';
$_['module_account_sidebar_title'][0]['link_title'][1]['link'] = 'index.php?route=account/register';
$_['module_account_sidebar_title'][0]['link_title'][1]['iconclass'] = 'fa-user-plus';
$_['module_account_sidebar_title'][0]['link_title'][1]['logged'] = '0';
$_['module_account_sidebar_title'][0]['link_title'][1]['sort_order'] = 2;

$_['module_account_sidebar_title'][0]['link_title'][2]['module_account_sidebar_link_title_description'][1]['name'] = 'Dashboard & Orders';
$_['module_account_sidebar_title'][0]['link_title'][2]['link'] = 'index.php?route=account/account';
$_['module_account_sidebar_title'][0]['link_title'][2]['iconclass'] = 'fa-dashboard';
$_['module_account_sidebar_title'][0]['link_title'][2]['logged'] = '1';
$_['module_account_sidebar_title'][0]['link_title'][2]['sort_order'] = 3;

$_['module_account_sidebar_title'][0]['link_title'][3]['module_account_sidebar_link_title_description'][1]['name'] = 'Edit Account';
$_['module_account_sidebar_title'][0]['link_title'][3]['link'] = 'index.php?route=account/edit';
$_['module_account_sidebar_title'][0]['link_title'][3]['iconclass'] = 'fa-pencil';
$_['module_account_sidebar_title'][0]['link_title'][3]['logged'] = '1';
$_['module_account_sidebar_title'][0]['link_title'][3]['sort_order'] = 4;

$_['module_account_sidebar_title'][0]['link_title'][4]['module_account_sidebar_link_title_description'][1]['name'] = 'Password';
$_['module_account_sidebar_title'][0]['link_title'][4]['link'] = 'index.php?route=account/password';
$_['module_account_sidebar_title'][0]['link_title'][4]['iconclass'] = 'fa-key';
$_['module_account_sidebar_title'][0]['link_title'][4]['logged'] = '1';
$_['module_account_sidebar_title'][0]['link_title'][4]['sort_order'] = 5;

$_['module_account_sidebar_title'][0]['link_title'][5]['module_account_sidebar_link_title_description'][1]['name'] = 'Address Book';
$_['module_account_sidebar_title'][0]['link_title'][5]['link'] = 'index.php?route=account/address';
$_['module_account_sidebar_title'][0]['link_title'][5]['iconclass'] = 'fa-book';
$_['module_account_sidebar_title'][0]['link_title'][5]['logged'] = '2';
$_['module_account_sidebar_title'][0]['link_title'][5]['sort_order'] = 6;

$_['module_account_sidebar_title'][0]['link_title'][6]['module_account_sidebar_link_title_description'][1]['name'] = 'Wish List';
$_['module_account_sidebar_title'][0]['link_title'][6]['link'] = 'index.php?route=account/wishlist';
$_['module_account_sidebar_title'][0]['link_title'][6]['iconclass'] = 'fa-heart';
$_['module_account_sidebar_title'][0]['link_title'][6]['logged'] = '2';
$_['module_account_sidebar_title'][0]['link_title'][6]['sort_order'] = 7;

$_['module_account_sidebar_title'][0]['link_title'][7]['module_account_sidebar_link_title_description'][1]['name'] = 'Order History';
$_['module_account_sidebar_title'][0]['link_title'][7]['link'] = 'index.php?route=account/order';
$_['module_account_sidebar_title'][0]['link_title'][7]['iconclass'] = 'fa-shopping-cart';
$_['module_account_sidebar_title'][0]['link_title'][7]['logged'] = '2';
$_['module_account_sidebar_title'][0]['link_title'][7]['sort_order'] = 8;

$_['module_account_sidebar_title'][0]['link_title'][8]['module_account_sidebar_link_title_description'][1]['name'] = 'Downloads';
$_['module_account_sidebar_title'][0]['link_title'][8]['link'] = 'index.php?route=account/download';
$_['module_account_sidebar_title'][0]['link_title'][8]['iconclass'] = 'fa-download';
$_['module_account_sidebar_title'][0]['link_title'][8]['logged'] = '2';
$_['module_account_sidebar_title'][0]['link_title'][8]['sort_order'] = 9;

$_['module_account_sidebar_title'][0]['link_title'][9]['module_account_sidebar_link_title_description'][1]['name'] = 'Newsletter';
$_['module_account_sidebar_title'][0]['link_title'][9]['link'] = 'index.php?route=account/newsletter';
$_['module_account_sidebar_title'][0]['link_title'][9]['iconclass'] = 'fa-envelope';
$_['module_account_sidebar_title'][0]['link_title'][9]['logged'] = '2';
$_['module_account_sidebar_title'][0]['link_title'][9]['sort_order'] = 10;

$_['module_account_sidebar_title'][1]['link_title'][0]['module_account_sidebar_link_title_description'][1]['name'] = 'Recurring Payments';
$_['module_account_sidebar_title'][1]['link_title'][0]['link'] = 'index.php?route=account/recurring';
$_['module_account_sidebar_title'][1]['link_title'][0]['iconclass'] = 'fa-credit-card';
$_['module_account_sidebar_title'][1]['link_title'][0]['logged'] = '2';
$_['module_account_sidebar_title'][1]['link_title'][0]['sort_order'] = 1;

$_['module_account_sidebar_title'][1]['link_title'][1]['module_account_sidebar_link_title_description'][1]['name'] = 'Reward Points';
$_['module_account_sidebar_title'][1]['link_title'][1]['link'] = 'index.php?route=account/reward';
$_['module_account_sidebar_title'][1]['link_title'][1]['iconclass'] = 'fa-gift';
$_['module_account_sidebar_title'][1]['link_title'][1]['logged'] = '2';
$_['module_account_sidebar_title'][1]['link_title'][1]['sort_order'] = 2;

$_['module_account_sidebar_title'][1]['link_title'][2]['module_account_sidebar_link_title_description'][1]['name'] = 'Returns';
$_['module_account_sidebar_title'][1]['link_title'][2]['link'] = 'index.php?route=account/return';
$_['module_account_sidebar_title'][1]['link_title'][2]['iconclass'] = 'fa-exchange';
$_['module_account_sidebar_title'][1]['link_title'][2]['logged'] = '2';
$_['module_account_sidebar_title'][1]['link_title'][2]['sort_order'] = 3;

$_['module_account_sidebar_title'][1]['link_title'][3]['module_account_sidebar_link_title_description'][1]['name'] = 'Transactions';
$_['module_account_sidebar_title'][1]['link_title'][3]['link'] = 'index.php?route=account/transaction';
$_['module_account_sidebar_title'][1]['link_title'][3]['iconclass'] = 'fa-money';
$_['module_account_sidebar_title'][1]['link_title'][3]['logged'] = '2';
$_['module_account_sidebar_title'][1]['link_title'][3]['sort_order'] = 4;

$_['module_account_sidebar_title'][2]['link_title'][0]['module_account_sidebar_link_title_description'][1]['name'] = 'LOGOUT';
$_['module_account_sidebar_title'][2]['link_title'][0]['link'] = 'index.php?route=account/logout';
$_['module_account_sidebar_title'][2]['link_title'][0]['iconclass'] = 'fa-sign-out';
$_['module_account_sidebar_title'][2]['link_title'][0]['logged'] = '2';
$_['module_account_sidebar_title'][2]['link_title'][0]['sort_order'] = 1;