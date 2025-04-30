<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add('GET', '/admin', [Controller\Site::class, 'admin'])->middleware('isAdmin');
Route::add(['GET', 'POST'], '/admin/createUser', [Controller\Site::class, 'create_user'])->middleware('isAdmin');
Route::add('GET', '/division', [Controller\Site::class, 'division'])->middleware('auth');
Route::add('GET', '/room', [Controller\Site::class, 'room'])->middleware('auth');
Route::add('GET', '/phone', [Controller\Site::class, 'phone'])->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);