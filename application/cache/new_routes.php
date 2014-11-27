<?php
$route['beranda'] = 'welcome/index/';
$route['ambil-angka'] = 'welcome/test/';
$route['ambil-angka/(:any)'] = 'welcome/test/$1';
$route['user-login'] = 'auth/login/';
$route['user-logout'] = 'auth/logout/';
$route['register'] = 'member/index/';
$route['company-profile'] = 'company/profile/';
$route['company-product'] = 'company/product/';
$route['news'] = 'news/news_list/';
$route['news_detail'] = 'news/news_detail/';
$route['news_detail/(:any)'] = 'news/news_detail/$1';
$route['promo'] = 'promo/promo_list/';
$route['promo_detail'] = 'promo/promo_detail/';
$route['promo_detail/(:any)'] = 'promo/promo_detail/$1';
?>