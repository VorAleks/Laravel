<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
$text1 = 'Привет мир!';
$text2 = 'Информация о проекте';
$text3 = 'Новости';
$title1 = 'Главная стпаница';
$title2 = 'Информация';
$title3 = 'Новости';
$info = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras imperdiet diam non metus iaculis laoreet. Cras aliquam ultricies eros ac luctus. Fusce accumsan lorem eget accumsan accumsan. Morbi vitae commodo nunc. Nam velit mi, eleifend id aliquet sit amet, posuere nec lorem. Aliquam pretium, nisl a tincidunt molestie, neque ligula.';
$new1 = 'Cras imperdiet diam non metus iaculis laoreet. Cras aliquam ultricies eros ac luctus. Fusce accumsan lorem eget accumsan accumsan.';
$new2 = 'Morbi vitae commodo nunc. Nam velit mi, eleifend id aliquet sit amet, posuere nec lorem. Aliquam pretium, nisl a tincidunt molestie, neque ligula.';

Route::get('/', function () use($text1, $title1) {
//   return view('Welcome');
    return <<<php
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$title1</title>
</head>
<body>
    <h1>$text1</h1>
</body>
php;

});

Route::get('/info/', function () use($text2, $title2, $info) {
    return <<<php
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$title2</title>
</head>
<body>
    <h1>$text2</h1>
    <p>$info</p>
</body>
php;

});

Route::get('/news/', function () use($text3, $title3, $new1, $new2) {
    return <<<php
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>$title3</title>
</head>
<body>
    <h1>$text3</h1>
    <ul>
        <li>$new1</li>
        <li>$new2</li>
    </ul>
</body>
php;

});
