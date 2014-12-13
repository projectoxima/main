<?php
$route['beranda'] = 'welcome/index/';
$route['ambil-angka'] = 'welcome/test/';
$route['ambil-angka/(:any)'] = 'welcome/test/$1';
$route['login-member-oxima'] = 'auth/login/';
$route['user-logout'] = 'auth/logout/';
$route['register-member-oxima'] = 'auth/register/';
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
$route['reserved-stokis'] = 'reservedpin/index/';
$route['tambah-reserved'] = 'reservedpin/add/';
$route['daftar-reserved'] = 'reservedpin/reserved_list/';
$route['daftar-pin-aktif'] = 'reservedpin/pin_list/';
$route['daftar-pin-aktif/(:any)'] = 'reservedpin/pin_list/$1';
$route['reserved-daftar-stokis'] = 'reservedpin/stokis_list/';
$route['reserved-daftar-stokis/(:any)'] = 'reservedpin/stokis_list/$1';
$route['reserved-daftar-parent'] = 'reservedpin/parent_list/';
$route['reserved-daftar-parent/(:any)'] = 'reservedpin/parent_list/$1';
$route['reserved-idbarang-list'] = 'reservedpin/idbarang_list/';
$route['reserved-idbarang-list/(:any)'] = 'reservedpin/idbarang_list/$1';
$route['register-check-pin'] = 'auth/check_pin/';
$route['error-bad-request'] = 'welcome/bad_request/';
$route['reserved-to-member'] = 'reservedpin/reserved_member/';
$route['reserved-member-save'] = 'reservedpin/reserved_member_save/';
?>