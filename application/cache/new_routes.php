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
$route['manage-pin-dan-idbarang'] = 'admin/pin_and_idbarang/';
$route['daftar-pin'] = 'admin/pin_list/';
$route['generate-pin'] = 'admin/generate_pin/';
?>