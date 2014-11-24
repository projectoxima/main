<?php
$route['beranda'] = 'welcome/index/';
$route['ambil-angka'] = 'welcome/test/';
$route['ambil-angka/(:any)'] = 'welcome/test/$1';
$route['user-login'] = 'auth/login/';
$route['user-logout'] = 'auth/logout/';
$route['register'] = 'member/index/';
$route['company-profile'] = 'company/profile/';
$route['company-product'] = 'company/product/';
?>