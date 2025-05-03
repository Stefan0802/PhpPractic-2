<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout'])->middleware('auth');

Route::add(['GET', 'POST'], '/admin', [Controller\Site::class, 'admin'])->middleware('isAdmin');
Route::add(['GET', 'POST'], '/admin/createUser', [Controller\Site::class, 'create_user'])->middleware('isAdmin');

Route::add('GET', '/department', [Controller\Site::class, 'view_department'])->middleware('auth');
Route::add(['GET', 'POST'], '/department/createDepartment', [Controller\Site::class, 'create_department'])->middleware('auth');

Route::add(['GET', 'POST'], '/department/TypeDepartment', [Controller\Site::class, 'create_type_department'])->middleware('auth');

Route::add('GET', '/room', [Controller\Site::class, 'view_room'])->middleware('auth');
Route::add(['GET', 'POST'], '/room/createRoom', [Controller\Site::class, 'create_room'])->middleware('auth');

Route::add(['GET', 'POST'], '/room/TypeRoom', [Controller\Site::class, 'create_type_room'])->middleware('auth');


Route::add('GET', '/phone', [Controller\Site::class, 'view_phone'])->middleware('auth');
Route::add(['GET', 'POST'], '/phone/createPhone', [Controller\Site::class, 'create_phone'])->middleware('auth');


