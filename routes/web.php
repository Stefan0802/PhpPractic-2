<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\User::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\User::class, 'login']);
Route::add('GET', '/logout', [Controller\User::class, 'logout'])->middleware('auth');

Route::add(['GET', 'POST'], '/admin', [Controller\Admin::class, 'admin'])->middleware('isAdmin');
Route::add(['GET', 'POST'], '/admin/createUser', [Controller\Admin::class, 'create_user'])->middleware('isAdmin');

Route::add('GET', '/department', [Controller\Department::class, 'view_department'])->middleware('auth');
Route::add(['GET', 'POST'], '/department/createDepartment', [Controller\Department::class, 'create_department'])->middleware('auth');

Route::add(['GET', 'POST'], '/department/TypeDepartment', [Controller\Department::class, 'create_type_department'])->middleware('auth');

Route::add('GET', '/room', [Controller\Room::class, 'view_room'])->middleware('auth');
Route::add(['GET', 'POST'], '/room/createRoom', [Controller\Room::class, 'create_room'])->middleware('auth');

Route::add(['GET', 'POST'], '/room/TypeRoom', [Controller\Room::class, 'create_type_room'])->middleware('auth');


Route::add('GET', '/phone', [Controller\Phone::class, 'view_phone'])->middleware('auth');
Route::add(['GET', 'POST'], '/phone/createPhone', [Controller\Phone::class, 'create_phone'])->middleware('auth');


