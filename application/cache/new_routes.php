<?php
$route['beranda'] = 'welcome/index/';
$route['ambil-angka'] = 'welcome/test/';
$route['ambil-angka/(:any)'] = 'welcome/test/$1';
$route['user-login'] = 'auth/login/';
$route['user-logout'] = 'auth/logout/';
$route['register'] = 'member/index/';
$route['company-profile'] = 'company/profile/';
$route['company-product'] = 'company/product/';
$route['login-dashboard'] = 'auth/dashboard_login/';
$route['manage-pin-dan-idbarang'] = 'managepinidbarang/pin_and_idbarang/';
$route['daftar-pin'] = 'managepinidbarang/pin_list/';
$route['generate-pin'] = 'managepinidbarang/generate_pin/';
$route['daftar-idbarang'] = 'managepinidbarang/idbarang_list/';
$route['manage-user'] = 'manageuser/index/';
$route['daftar-user'] = 'manageuser/user_list/';
$route['tambah-user'] = 'manageuser/add_user/';
$route['detail-user'] = 'manageuser/user_detail/';
$route['detail-user/(:any)'] = 'manageuser/user_detail/$1';
$route['status-user'] = 'manageuser/toggle_status_user/';
$route['status-user/(:any)'] = 'manageuser/toggle_status_user/$1';
$route['reserved-pin'] = 'reservedpin/index/';
$route['tambah-reserved'] = 'reservedpin/add/';
$route['daftar-reserved'] = 'reservedpin/reserved_list/';
?>