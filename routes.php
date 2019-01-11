<?php
// Route file

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
// use Model\Category;


$app->map('GET', '/', "\Controller\AuthController@loginPage");

$app->map('POST', '/create_admin', "\Controller\UserController@createAdmin");
$app->map('GET', '/home', "\Controller\HomeController@home");

// Alternatif
$app->map('GET', '/alternatif', "\Controller\AlternatifController@index");
$app->map('GET', '/alternatif/create', "\Controller\AlternatifController@create");
$app->map('POST', '/alternatif/do_create', "\Controller\AlternatifController@store");
$app->map('GET', '/alternatif/edit/{id}', "\Controller\AlternatifController@edit");
$app->map('POST', '/alternatif/edit/{id}/update', "\Controller\AlternatifController@update");
$app->map('POST', '/alternatif/delete/{id}', "\Controller\AlternatifController@destroy");
$app->map('GET', '/alternatif/{id}/show', "\Controller\AlternatifController@show");

// Kriteria
$app->map('GET', '/kriteria', "\Controller\KriteriaController@index");
$app->map('GET', '/kriteria/create', "\Controller\KriteriaController@create");
$app->map('POST', '/kriteria/do_create', "\Controller\KriteriaController@store");
$app->map('GET', '/kriteria/edit/{id}', "\Controller\KriteriaController@edit");
$app->map('POST', '/kriteria/edit/{id}/update', "\Controller\KriteriaController@update");
$app->map('POST', '/kriteria/delete/{id}', "\Controller\KriteriaController@destroy");

// Alternatif To Kriteria
$app->map('POST', '/alternatif_to_kriteria/{id}', "\Controller\AlternatifToKriteriaController@store");
$app->map('POST', '/alternatif_to_kriteria/{id}/update', "\Controller\AlternatifToKriteriaController@update");

// Weighted Product
$app->map('GET', '/weighted_product', "\Controller\WeightedProductController@index");

// Auth
$app->map('GET', '/login', "\Controller\AuthController@loginPage");
$app->map('POST', '/do_login', "\Controller\AuthController@login");
$app->map('GET', '/logout', "\Controller\AuthController@logout");
$app->map('GET', '/check_user', "\Controller\AuthController@checkUser");
$app->map('GET', '/admin', "\Controller\AuthController@admin");
$app->map('GET', '/getuser', "\Controller\AuthController@getUser");